<?php

namespace App\Http\Controllers;

use App\DTOs\Admin\ServiceDTO;
use App\Http\Requests\Admin\ServiceRequest;
use App\Http\Requests\Admin\SiteSettingRequest;
use App\Models\Banner;
use App\Models\ButtonBanner;
use App\Models\Destination;
use App\Models\FeatureBanner;
use App\Models\Contact;
use App\Models\Page;
use App\Models\PageView;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\SocialLink;
use App\Repositories\ServiceRepository;
use App\Repositories\SiteSettingRepository;
use App\Services\Admin\ServiceService;
use App\Services\Admin\SiteSettingService;
use App\Services\BannerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function __construct(
        protected BannerService $bannerService,
        protected \App\Services\Admin\DestinationService $destinationService,
        protected SiteSettingRepository $siteSettingRepository,
        protected SiteSettingService $siteSettingService
    ) {}
    /**
     * Display the admin dashboard.
     */
public function dashboard()
{
    $bannersCount      = Banner::count();
    $destinationsCount = Destination::count();
    $socialLinksCount  = SocialLink::count();
    $servicesCount     = Service::count();
    $contactsCount     = Contact::count();

    // Últimos 10 contatos
    $latestContacts    = Contact::orderBy('created_at', 'desc')->limit(10)->get();

    // Métricas de visitas
    $totalVisits30d = PageView::where('visited_at', '>=', now()->subDays(30))->count();

    // Top 10 páginas mais visitadas (últimos 30 dias)
    $topPages = PageView::selectRaw('page_name, COUNT(*) as total')
        ->where('visited_at', '>=', now()->subDays(30))
        ->whereNotNull('page_name')
        ->groupBy('page_name')
        ->orderByDesc('total')
        ->limit(10)
        ->get();

    // CORRIGIDO: Visitas por dia nos últimos 14 dias usando DATE_FORMAT (compatível com MySQL)
    $dailyVisits = PageView::selectRaw("DATE_FORMAT(visited_at, '%Y-%m-%d') as day, COUNT(*) as total")
        ->where('visited_at', '>=', now()->subDays(14))
        ->groupByRaw("DATE_FORMAT(visited_at, '%Y-%m-%d')")
        ->orderBy('day')
        ->get()
        ->keyBy('day');

    // Preenche todos os dias (sem gaps)
    $chartLabels = [];
    $chartData   = [];
    for ($i = 13; $i >= 0; $i--) {
        $day = now()->subDays($i)->format('Y-m-d');
        $chartLabels[] = now()->subDays($i)->format('d/m');
        $chartData[]   = $dailyVisits->get($day)?->total ?? 0;
    }

    return view('admin.dashboard', compact(
        'bannersCount', 'destinationsCount', 'socialLinksCount', 'servicesCount',
        'contactsCount', 'latestContacts',
        'totalVisits30d', 'topPages', 'chartLabels', 'chartData'
    ));
}

    /* BANNERS CRUD */

    public function banners()
    {
        $banners = Banner::with('page')->get();
        return view('admin.banners.index', compact('banners'));
    }

    public function bannerEdit(Banner $banner)
    {
        $pages = Page::all();
        $banner->load(['featureBanners','buttons']);
        return view('admin.banners.edit', compact('banner', 'pages'));
    }
    public function bannerCreate()
    {
        $pages = Page::all();
        return view('admin.banners.create', compact('pages'));
    }

    public function bannerStore(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'titulo_destaque' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'page_id' => 'nullable',
            'active' => 'boolean',
            
            // Incluindo a validação das Features (idêntico ao update)
            'features' => 'nullable|array',
            'features.*.name' => 'nullable|string|max:255',
            'features.*.icon' => 'nullable|string|max:255',
            'features.*.order' => 'nullable|integer',
            
            // Incluindo a validação dos Botões (idêntico ao update)
            'buttons' => 'nullable|array',
            'buttons.*.text' => 'nullable|string|max:255',
            'buttons.*.color' => 'nullable|string|max:255',
            'buttons.*.url' => 'nullable|string|max:255',
            'buttons.*.target' => 'nullable|string|max:255',
            'buttons.*.order' => 'nullable|integer',
        ]);

        // Upload da imagem
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('banners', 'public');
        }

        // Tratamento dos botões (limpa vazios e aplica fallbacks)
        if (isset($data['buttons'])) {
            foreach ($data['buttons'] as $index => $button) {
                if (!empty($button['text'])) {
                    $data['buttons'][$index]['url'] = $button['url'] ?? '#';
                    $data['buttons'][$index]['target'] = $button['target'] ?? '_self';
                } else {
                    unset($data['buttons'][$index]);
                }
            }
            $data['buttons'] = array_values($data['buttons']);
        }

        // Tratamento das features (limpa vazios e aplica fallbacks)
        if (isset($data['features'])) {
            foreach ($data['features'] as $index => $feature) {
                if (!empty($feature['name'])) {
                    $data['features'][$index]['icon'] = $feature['icon'] ?? 'fa fa-star';
                    $data['features'][$index]['order'] = $feature['order'] ?? $index + 1;
                } else {
                    unset($data['features'][$index]);
                }
            }
            $data['features'] = array_values($data['features']);
        }

        // Envia tudo tratado para o Service criar no banco de dados
        $this->bannerService->create($data);

        return redirect()->route('admin.banners.index')->with('success', 'Banner criado com sucesso!');
    }

    public function settings()
    {
        $settingsGrouped = $this->siteSettingRepository->allGrouped();
        return view('admin.settings.index', compact('settingsGrouped'));
    }

    public function settingEdit(SiteSetting $setting)
    {
        return view('admin.settings.edit', compact('setting'));
    }

    public function settingUpdate(SiteSettingRequest $request, SiteSetting $setting)
    {
        $this->siteSettingService->update($setting, $request);
        return redirect()->route('admin.settings.index')->with('success', 'Configuração "' . $setting->label . '" atualizada com sucesso!');
    }
    public function featureBannerDelete(FeatureBanner $featureBanner) {
        $featureBanner->delete();
        return redirect()->back()->with('success', 'Característica deletada com sucesso!');
    }
    public function buttonBannerDelete(ButtonBanner $buttonBanner) {
        $buttonBanner->delete();
        return redirect()->back()->with('success', 'Botão deletado com sucesso!');
    }

    public function bannerUpdate(Request $request, Banner $banner)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'titulo_destaque' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'page_id' => 'nullable|integer',
            'active' => 'boolean',
            'features' => 'nullable|array',
            'features.*.id' => 'nullable|integer',
            'features.*.name' => 'nullable|string|max:255',
            'features.*.icon' => 'nullable|string|max:255',
            'features.*.order' => 'nullable|integer',
            'buttons' => 'nullable|array',
            'buttons.*.id' => 'nullable|integer',
            'buttons.*.text' => 'nullable|string|max:255',
            'buttons.*.color' => 'nullable|string|max:255',
            'buttons.*.url' => 'nullable|string|max:255',
            'buttons.*.target' => 'nullable|string|max:255',
            'buttons.*.order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if it exists and is not the default seeder image
            if ($banner->image_path && $banner->image_path !== 'banners/page-home.jpeg') {
                Storage::disk('public')->delete($banner->image_path);
            }
            $data['image_path'] = $request->file('image')->store('banners', 'public');
        }

        if (isset($data['buttons'])) {
            foreach ($data['buttons'] as $index => $button) {
                if (!empty($button['text'])) {
                    $data['buttons'][$index]['url'] = $button['url'] ?? '#';
                    $data['buttons'][$index]['target'] = $button['target'] ?? '_self';
                } else {
                    unset($data['buttons'][$index]);
                }
            }
            $data['buttons'] = array_values($data['buttons']);
        }

        if (isset($data['features'])) {
            foreach ($data['features'] as $index => $feature) {
                if (!empty($feature['name'])) {
                    $data['features'][$index]['icon'] = $feature['icon'] ?? 'fa fa-star';
                    $data['features'][$index]['order'] = $feature['order'] ?? $index + 1;
                } else {
                    unset($data['features'][$index]);
                }
            }
            $data['features'] = array_values($data['features']);
        }

        $this->bannerService->update($banner->id, $data);

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

    public function destinationStore(\App\Http\Requests\Admin\DestinationStoreRequest $request)
    {
        $dto = \App\DTOs\Admin\DestinationStoreDTO::fromRequest($request);
        $this->destinationService->create($dto, $request);

        return redirect()->route('admin.destinations.index')->with('success', 'Destino criado com sucesso!');
    }

    public function destinationEdit(Destination $destination)
    {
        $destination->load(['includes','highlights','itineraryDays']);
        return view('admin.destinations.edit', compact('destination'));
    }

    public function destinationUpdate(\App\Http\Requests\Admin\DestinationStoreRequest $request, Destination $destination)
    {
        $dto = \App\DTOs\Admin\DestinationStoreDTO::fromRequest($request);
        $this->destinationService->update($destination->id, $dto, $request);

        return redirect()->route('admin.destinations.index')->with('success', 'Destino atualizado com sucesso!');
    }

    public function destinationDestroy(Destination $destination)
    {
        $this->destinationService->destroy($destination->id);

        return redirect()->route('admin.destinations.index')->with('success', 'Destino excluído com sucesso!');
    }

    public function destinationDuplicate(Destination $destination)
    {
        $this->destinationService->duplicate($destination->id);

        return redirect()->route('admin.destinations.index')->with('success', 'Destino duplicado com sucesso!');
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

    /* SERVICES CRUD */

    public function services(ServiceRepository $repository)
    {
        $services = $repository->all();
        return view('admin.services.index', compact('services'));
    }

    public function serviceCreate()
    {
        return view('admin.services.create');
    }

    public function serviceStore(ServiceRequest $request, ServiceService $serviceService)
    {
        $dto = ServiceDTO::fromRequest($request);
        $serviceService->create($dto, $request);

        return redirect()->route('admin.services.index')->with('success', 'Serviço criado com sucesso!');
    }

    public function serviceEdit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function serviceUpdate(ServiceRequest $request, Service $service, ServiceService $serviceService)
    {
        $dto = ServiceDTO::fromRequest($request);
        $serviceService->update($dto, $service, $request);

        return redirect()->route('admin.services.index')->with('success', 'Serviço atualizado com sucesso!');
    }

    public function serviceDestroy(Service $service, ServiceService $serviceService)
    {
        $serviceService->destroy($service);
        return redirect()->route('admin.services.index')->with('success', 'Serviço excluído com sucesso!');
    }

    public function serviceDuplicate(Service $service, ServiceService $serviceService)
    {
        $serviceService->duplicate($service);
        return redirect()->route('admin.services.index')->with('success', 'Serviço duplicado com sucesso!');
    }

    public function pages()
    {
        $pages = Page::all();
        return view('admin.pages.index', compact('pages'));
    }

    public function pageEdit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function pageUpdate(Request $request, Page $page)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
        ]);

        $page->update($data);

        return redirect()->route('admin.pages.index')->with('success', 'Página atualizada com sucesso!');
    }

    public function pageCreate()
    {
        return view('admin.pages.create');
    }

    public function pageStore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
        ]);
        $page = Page::create($data);

        return redirect()->route('admin.pages.index')->with('success', 'Página criada com sucesso!');
    }

    public function pageDestroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Página excluída com sucesso!');
    }

    /* LEADS / CONTATOS */

    public function contacts(Request $request)
    {
        $query = Contact::query();

        // Filtro por termo de busca (nome, email ou mensagem)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        // Filtro por tipo (Geral vs Serviços)
        if ($request->filled('type')) {
            $type = $request->input('type');
            if ($type === 'service') {
                $query->where('type', 'like', 'Serviço:%');
            } elseif ($type === 'general') {
                $query->where('type', 'default');
            }
        }

        $contacts = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        return view('admin.contacts.index', compact('contacts'));
    }

    public function contactsDestroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin.contacts.index')->with('success', 'Mensagem de contato excluída com sucesso!');
    }
}
