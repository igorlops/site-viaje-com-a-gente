<?php

namespace App\Services\Admin;

use App\DTOs\Admin\SiteSettingDTO;
use App\Http\Requests\Admin\SiteSettingRequest;
use App\Models\SiteSetting;
use App\Repositories\SiteSettingRepository;
use Illuminate\Support\Facades\Storage;

class SiteSettingService
{
    public function __construct(
        protected SiteSettingRepository $repository
    ) {}

    /**
     * Atualiza o valor de uma configuração.
     * Se for do tipo image, faz upload e salva o path.
     */
    public function update(SiteSetting $setting, SiteSettingRequest $request): SiteSetting
    {
        $dto = SiteSettingDTO::fromRequest($request);

        if ($setting->type === 'image' && $dto->hasImage) {
            // Remove imagem antiga do storage (somente se for um arquivo do storage, não asset)
            if ($setting->value && str_starts_with($setting->value, 'settings/')) {
                Storage::disk('public')->delete($setting->value);
            }

            $path = $request->file('value')->store('settings/logos', 'public');

            return $this->repository->update($setting, ['value' => $path]);
        }

        return $this->repository->update($setting, ['value' => $dto->value]);
    }
}
