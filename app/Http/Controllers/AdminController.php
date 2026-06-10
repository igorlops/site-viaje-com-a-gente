<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Destination;
use App\Models\SocialLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function dashboard()
    {
        $bannersCount = Banner::count();
        $destinationsCount = Destination::count();
        $socialLinksCount = SocialLink::count();

        return view('admin.dashboard', compact('bannersCount', 'destinationsCount', 'socialLinksCount'));
    }

    /* BANNERS CRUD */

    public function banners()
    {
        $banners = Banner::latest()->get();
        return view('admin.banners.index', compact('banners'));
    }

    public function bannerEdit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function bannerUpdate(Request $request, Banner $banner)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'active' => 'boolean',
        ]);

        $data = [
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'active' => $request->has('active'),
        ];

        if ($request->hasFile('image')) {
            // Delete old image if it exists and is not the default seeder image
            if ($banner->image_path && $banner->image_path !== 'banners/page-home.jpeg') {
                Storage::disk('public')->delete($banner->image_path);
            }
            $data['image_path'] = $request->file('image')->store('banners', 'public');
        }

        $banner->update($data);

        return redirect()->route('admin.banners.index')->with('success', 'Banner atualizado com sucesso!');
    }

    /* DESTINATIONS CRUD */

    public function destinations()
    {
        $destinations = Destination::latest()->get();
        return view('admin.destinations.index', compact('destinations'));
    }

    public function destinationCreate()
    {
        return view('admin.destinations.create');
    }

    public function destinationStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'duration' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'tag' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'whatsapp_link' => 'nullable|url|max:255',
        ]);

        $imagePath = $request->file('image')->store('destinations', 'public');

        Destination::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'image_path' => $imagePath,
            'duration' => $request->duration,
            'category' => $request->category,
            'price' => $request->price,
            'tag' => $request->tag,
            'is_featured' => $request->has('is_featured'),
            'whatsapp_link' => $request->whatsapp_link,
        ]);

        return redirect()->route('admin.destinations.index')->with('success', 'Destino criado com sucesso!');
    }

    public function destinationEdit(Destination $destination)
    {
        return view('admin.destinations.edit', compact('destination'));
    }

    public function destinationUpdate(Request $request, Destination $destination)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'duration' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'tag' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'whatsapp_link' => 'nullable|url|max:255',
        ]);

        $data = [
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'duration' => $request->duration,
            'category' => $request->category,
            'price' => $request->price,
            'tag' => $request->tag,
            'is_featured' => $request->has('is_featured'),
            'whatsapp_link' => $request->whatsapp_link,
        ];

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($destination->image_path && !str_starts_with($destination->image_path, 'destinations/porto.png') && !str_starts_with($destination->image_path, 'destinations/gramado.png') && !str_starts_with($destination->image_path, 'destinations/rio.png') && !str_starts_with($destination->image_path, 'destinations/foz.png')) {
                Storage::disk('public')->delete($destination->image_path);
            }
            $data['image_path'] = $request->file('image')->store('destinations', 'public');
        }

        $destination->update($data);

        return redirect()->route('admin.destinations.index')->with('success', 'Destino atualizado com sucesso!');
    }

    public function destinationDestroy(Destination $destination)
    {
        if ($destination->image_path && !str_starts_with($destination->image_path, 'destinations/porto.png') && !str_starts_with($destination->image_path, 'destinations/gramado.png') && !str_starts_with($destination->image_path, 'destinations/rio.png') && !str_starts_with($destination->image_path, 'destinations/foz.png')) {
            Storage::disk('public')->delete($destination->image_path);
        }

        $destination->delete();

        return redirect()->route('admin.destinations.index')->with('success', 'Destino excluído com sucesso!');
    }

    /* SOCIAL LINKS CRUD */

    public function socialLinks()
    {
        $socialLinks = SocialLink::all();
        return view('admin.social.index', compact('socialLinks'));
    }

    public function socialStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'icon' => 'required|string|max:255',
            'active' => 'boolean',
        ]);

        SocialLink::create([
            'name' => $request->name,
            'url' => $request->url,
            'icon' => $request->icon,
            'active' => $request->has('active'),
        ]);

        return redirect()->route('admin.social.index')->with('success', 'Rede social criada com sucesso!');
    }

    public function socialUpdate(Request $request, SocialLink $socialLink)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'icon' => 'required|string|max:255',
            'active' => 'boolean',
        ]);

        $socialLink->update([
            'name' => $request->name,
            'url' => $request->url,
            'icon' => $request->icon,
            'active' => $request->has('active'),
        ]);

        return redirect()->route('admin.social.index')->with('success', 'Rede social atualizada com sucesso!');
    }

    public function socialDestroy(SocialLink $socialLink)
    {
        $socialLink->delete();
        return redirect()->route('admin.social.index')->with('success', 'Rede social excluída com sucesso!');
    }
}
