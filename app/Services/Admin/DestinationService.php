<?php

namespace App\Services\Admin;

use App\DTOs\Admin\DestinationStoreDTO;
use App\Models\Destination;
use App\Repositories\DestinationRepository;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class DestinationService
{
    public function __construct(
        protected DestinationRepository $repository
    ) {}

    public function create(DestinationStoreDTO $dto, Request $request): Destination
    {
        $data = $dto->toArray();

        if ($request->hasFile('image')) {
            $data['image_path'] = $this->uploadImage($request->file('image'), 'destinations');
        }

        if ($request->hasFile('banner_image')) {
            $data['banner_image_path'] = $this->uploadImage($request->file('banner_image'), 'destinations');
        }

        $destination = $this->repository->create($data);

        $this->saveRelations($destination, $dto, $request);

        return $destination;
    }

    public function update(int $id, DestinationStoreDTO $dto, Request $request): Destination
    {
        $data = $dto->toArray();
        $destination = $this->repository->find($id);

        if ($request->hasFile('image')) {
            $this->deleteOldImage($destination->image_path);
            $data['image_path'] = $this->uploadImage($request->file('image'), 'destinations');
        }

        if ($request->hasFile('banner_image')) {
            $this->deleteOldImage($destination->banner_image_path);
            $data['banner_image_path'] = $this->uploadImage($request->file('banner_image'), 'destinations');
        }

        $destination = $this->repository->update($id, $data);

        $this->saveRelations($destination, $dto, $request);

        return $destination;
    }

    public function destroy(int $id): void
    {
        $destination = $this->repository->find($id);
        $this->deleteOldImage($destination->image_path);
        $this->deleteOldImage($destination->banner_image_path);
        
        // Deletar imagens dos highlights associados
        foreach ($destination->highlights as $highlight) {
            $this->deleteOldImage($highlight->image_path);
        }

        // Deletar imagens dos itinerários associados
        foreach ($destination->itineraryDays as $day) {
            $this->deleteOldImage($day->image_path);
        }

        $this->repository->delete($id);
    }

    protected function saveRelations(Destination $destination, DestinationStoreDTO $dto, Request $request): void
    {
        // 1. Salvar Includes (Inclui / Não Inclui)
        $destination->includes()->delete();
        if (!empty($dto->includes)) {
            foreach ($dto->includes as $index => $include) {
                if (!empty($include['text'])) {
                    $destination->includes()->create([
                        'text' => $include['text'],
                        'type' => $include['type'],
                        'order' => $include['order'] ?? ($index + 1),
                    ]);
                }
            }
        }

        // 2. Salvar Highlights (Destaques)
        // Guardar IDs enviados para não deletar
        $keepHighlightIds = [];
        if (!empty($dto->highlights)) {
            foreach ($dto->highlights as $index => $highlightData) {
                if (empty($highlightData['title'])) {
                    continue;
                }

                $highlight = null;
                if (!empty($highlightData['id'])) {
                    $highlight = $destination->highlights()->find($highlightData['id']);
                }

                $highlightDataToSave = [
                    'title' => $highlightData['title'],
                    'subtitle' => $highlightData['subtitle'] ?? null,
                    'order' => $highlightData['order'] ?? ($index + 1),
                ];

                // Upload de imagem do Highlight
                $fileKey = "highlights.{$index}.image";
                if ($request->hasFile($fileKey)) {
                    if ($highlight && $highlight->image_path) {
                        $this->deleteOldImage($highlight->image_path);
                    }
                    $highlightDataToSave['image_path'] = $this->uploadImage($request->file($fileKey), 'highlights');
                }

                if ($highlight) {
                    $highlight->update($highlightDataToSave);
                } else {
                    $highlight = $destination->highlights()->create($highlightDataToSave);
                }

                $keepHighlightIds[] = $highlight->id;
            }
        }
        
        // Deletar os que não vieram no request
        $highlightsToDelete = $destination->highlights()->whereNotIn('id', $keepHighlightIds)->get();
        foreach ($highlightsToDelete as $hlToDelete) {
            $this->deleteOldImage($hlToDelete->image_path);
            $hlToDelete->delete();
        }

        // 3. Salvar Itinerary (Roteiro Dia a Dia e Atividades)
        $keepItineraryIds = [];
        if (!empty($dto->itinerary)) {
            foreach ($dto->itinerary as $index => $dayData) {
                if (empty($dayData['label'])) {
                    continue;
                }

                $itineraryDay = null;
                if (!empty($dayData['id'])) {
                    $itineraryDay = $destination->itineraryDays()->find($dayData['id']);
                }

                $itineraryDataToSave = [
                    'day_number' => $dayData['day_number'],
                    'date' => $dayData['date'] ?? null,
                    'label' => $dayData['label'],
                    'order' => $dayData['order'] ?? ($index + 1),
                ];

                // Upload de imagem do Itinerário
                $fileKey = "itinerary.{$index}.image";
                if ($request->hasFile($fileKey)) {
                    if ($itineraryDay && $itineraryDay->image_path) {
                        $this->deleteOldImage($itineraryDay->image_path);
                    }
                    $itineraryDataToSave['image_path'] = $this->uploadImage($request->file($fileKey), 'itinerary');
                }

                if ($itineraryDay) {
                    $itineraryDay->update($itineraryDataToSave);
                } else {
                    $itineraryDay = $destination->itineraryDays()->create($itineraryDataToSave);
                }

                $keepItineraryIds[] = $itineraryDay->id;

                // Salvar as Atividades deste dia do roteiro
                $itineraryDay->activities()->delete();
                if (!empty($dayData['activities'])) {
                    foreach ($dayData['activities'] as $actIndex => $activityText) {
                        if (!empty($activityText)) {
                            $itineraryDay->activities()->create([
                                'activity' => $activityText,
                                'order' => $actIndex + 1,
                            ]);
                        }
                    }
                }
            }
        }

        // Deletar dias não enviados
        $destination->itineraryDays()->whereNotIn('id', $keepItineraryIds)->delete();
    }

    protected function uploadImage(UploadedFile $file, string $directory): string
    {
        return $file->store($directory, 'public');
    }

    protected function deleteOldImage(?string $path): void
    {
        if ($path && !in_array($path, ['destinations/porto.png', 'destinations/gramado.png', 'destinations/rio.png', 'destinations/foz.png'])) {
            Storage::disk('public')->delete($path);
        }
    }

    public function duplicate(int $id): Destination
    {
        $original = $this->repository->find($id);
        $original->load(['includes', 'highlights', 'itineraryDays.activities']);

        $data = $original->toArray();
        unset($data['id'], $data['created_at'], $data['updated_at']);

        // Ajustar título e slug
        $data['title'] = $original->title . ' (Cópia)';
        
        $slug = \Illuminate\Support\Str::slug($data['title']);
        $originalSlug = $slug;
        $count = 1;
        while (Destination::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }
        $data['slug'] = $slug;

        // Duplicar imagem principal
        if ($original->image_path && Storage::disk('public')->exists($original->image_path)) {
            $ext = pathinfo($original->image_path, PATHINFO_EXTENSION);
            $newPath = 'destinations/' . uniqid() . '.' . $ext;
            Storage::disk('public')->copy($original->image_path, $newPath);
            $data['image_path'] = $newPath;
        }

        // Duplicar banner_image
        if ($original->banner_image_path && Storage::disk('public')->exists($original->banner_image_path)) {
            $ext = pathinfo($original->banner_image_path, PATHINFO_EXTENSION);
            $newPath = 'destinations/' . uniqid() . '.' . $ext;
            Storage::disk('public')->copy($original->banner_image_path, $newPath);
            $data['banner_image_path'] = $newPath;
        }

        $duplicate = $this->repository->create($data);

        // Relação 1: Includes
        foreach ($original->includes as $include) {
            $duplicate->includes()->create([
                'text' => $include->text,
                'type' => $include->type,
                'order' => $include->order,
            ]);
        }

        // Relação 2: Highlights
        foreach ($original->highlights as $highlight) {
            $highlightData = [
                'title' => $highlight->title,
                'subtitle' => $highlight->subtitle,
                'order' => $highlight->order,
            ];

            if ($highlight->image_path && Storage::disk('public')->exists($highlight->image_path)) {
                $ext = pathinfo($highlight->image_path, PATHINFO_EXTENSION);
                $newPath = 'highlights/' . uniqid() . '.' . $ext;
                Storage::disk('public')->copy($highlight->image_path, $newPath);
                $highlightData['image_path'] = $newPath;
            }

            $duplicate->highlights()->create($highlightData);
        }

        // Relação 3: ItineraryDays & Activities
        foreach ($original->itineraryDays as $day) {
            $dayData = [
                'day_number' => $day->day_number,
                'date' => $day->date,
                'label' => $day->label,
                'order' => $day->order,
            ];

            if ($day->image_path && Storage::disk('public')->exists($day->image_path)) {
                $ext = pathinfo($day->image_path, PATHINFO_EXTENSION);
                $newPath = 'itinerary/' . uniqid() . '.' . $ext;
                Storage::disk('public')->copy($day->image_path, $newPath);
                $dayData['image_path'] = $newPath;
            }

            $newDay = $duplicate->itineraryDays()->create($dayData);

            foreach ($day->activities as $activity) {
                $newDay->activities()->create([
                    'activity' => $activity->activity,
                    'order' => $activity->order,
                ]);
            }
        }

        return $duplicate;
    }
}
