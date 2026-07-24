<?php

namespace App\Http\Controllers;

use App\DTOs\Admin\ServiceDTO;
use App\DTOs\Admin\TestimonialDTO;
use App\Http\Requests\Admin\ServiceRequest;
use App\Http\Requests\Admin\SiteSettingRequest;
use App\Http\Requests\Admin\TestimonialRequest;
use App\Models\Banner;
use App\Models\ButtonBanner;
use App\Models\CTA_Session;
use App\Models\Destination;
use App\Models\FeatureBanner;
use App\Models\Contact;
use App\Models\Page;
use App\Models\PageView;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\SocialLink;
use App\Models\Testimonial;
use App\Repositories\ServiceRepository;
use App\Repositories\SiteSettingRepository;
use App\Repositories\TestimonialRepository;
use App\Services\Admin\ServiceService;
use App\Services\Admin\SiteSettingService;
use App\Services\Admin\TestimonialService;
use App\Services\BannerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function __construct(
        protected BannerService $bannerService,
        protected \App\Services\Admin\DestinationService $destinationService,
        protected SiteSettingRepository $siteSettingRepository,
        protected SiteSettingService $siteSettingService,
        protected TestimonialService $testimonialService,
        protected TestimonialRepository $testimonialRepository
    ) {}
    /**
     * Display the admin dashboard.
     */
public function dashboard()
{
    $bannersCount      = Banner::count();
    $destinationsCount = Destination::count();
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

    $isSqlite = DB::connection()->getDriverName() === 'sqlite';

    $dateField = $isSqlite 
        ? "strftime('%Y-%m-%d', visited_at)" 
        : "DATE_FORMAT(visited_at, '%Y-%m-%d')";

    $dailyVisits = DB::table('page_views')
        ->selectRaw("$dateField as day, COUNT(*) as total")
        ->where('visited_at', '>=', '2026-06-19 01:23:35')
        ->groupBy('day')
        ->orderBy('day', 'asc')
        ->get();

    // Preenche todos os dias (sem gaps)
    $chartLabels = [];
    $chartData   = [];
    for ($i = 13; $i >= 0; $i--) {
        $day = now()->subDays($i)->format('Y-m-d');
        $chartLabels[] = now()->subDays($i)->format('d/m');
        $chartData[]   = $dailyVisits->get($day)?->total ?? 0;
    }

    return view('admin.dashboard', compact(
        'bannersCount', 'destinationsCount', 'servicesCount',
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
            'image_path_mobile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
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

        if ($request->hasFile('image_path_mobile')) {
            $data['image_path_mobile'] = $request->file('image_path_mobile')->store('banners', 'public');
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
            'image_path_mobile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
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

        if ($request->hasFile('image_path_mobile')) {
            if ($banner->image_path_mobile) {
                Storage::disk('public')->delete($banner->image_path_mobile);
            }
            $data['image_path_mobile'] = $request->file('image_path_mobile')->store('banners', 'public');
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
        $destinations = Destination::where('type','viagem-em-grupo')->latest()->get();
        return view('admin.destinations.index', compact('destinations'));
    }

    public function destinationCreate()
    {
        $paymentMethods = \App\Models\PaymentMethod::all();
        return view('admin.destinations.create', compact('paymentMethods'));
    }

    public function destinationStore(\App\Http\Requests\Admin\DestinationStoreRequest $request)
    {
        $dto = \App\DTOs\Admin\DestinationStoreDTO::fromRequest($request);
        $this->destinationService->create($dto, $request);

        return redirect()->route('admin.destinations.index')->with('success', 'Destino criado com sucesso!');
    }

    public function destinationEdit(Destination $destination)
    {
        $destination->load(['includes', 'highlights', 'itineraryDays', 'observations', 'paymentMethods.method']);
        $paymentMethods = \App\Models\PaymentMethod::all();
        return view('admin.destinations.edit', compact('destination', 'paymentMethods'));
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

    /* TESTIMONIALS CRUD */

    public function testimonials()
    {
        $testimonials = $this->testimonialRepository->all();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function testimonialCreate()
    {
        $destinations = Destination::all();
        return view('admin.testimonials.create', compact('destinations'));
    }

    public function testimonialStore(TestimonialRequest $request)
    {
        $dto = TestimonialDTO::fromRequest($request);
        $this->testimonialService->create($dto, $request);

        return redirect()->route('admin.testimonials.index')->with('success', 'Depoimento criado com sucesso!');
    }

    public function testimonialEdit(Testimonial $testimonial)
    { 
        $destinations = Destination::all(); 
        return view('admin.testimonials.edit', compact('testimonial', 'destinations'));
    }

    public function testimonialUpdate(TestimonialRequest $request, Testimonial $testimonial)
    {
        $dto = TestimonialDTO::fromRequest($request);
        $this->testimonialService->update($testimonial->id, $dto, $request);

        return redirect()->route('admin.testimonials.index')->with('success', 'Depoimento atualizado com sucesso!');
    }

    public function testimonialDuplicate(Testimonial $testimonial)
    {
        $this->testimonialService->duplicate($testimonial->id);

        return redirect()->route('admin.testimonials.index')->with('success', 'Depoimento duplicado com sucesso!');
    }

    public function testimonialDestroy(Testimonial $testimonial)
    {
        $this->testimonialService->destroy($testimonial->id);
        return redirect()->route('admin.testimonials.index')->with('success', 'Depoimento excluído com sucesso!');
    }

    /* SOCIAL LINKS CRUD */


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

    /* CTA SESSION CRUD */

    public function cta_session()
    {
        $cta_sessions = CTA_Session::with('page', 'cta_session_list')->orderBy('order_position')->get();
        return view('admin.cta_session.index', compact('cta_sessions'));
    }

    public function cta_sessionCreate()
    {
        $pages = Page::all();
        return view('admin.cta_session.create', compact('pages'));
    }

    public function cta_sessionStore(Request $request)
    {
        $request->validate([
            'title'                    => 'nullable|string|max:255',
            'subtitle'                 => 'nullable|string',
            'page_id'                  => 'nullable|integer|exists:pages,id',
            'button_label'             => 'nullable|string|max:255',
            'button_url'               => 'nullable|string|max:255',
            'button_target'            => 'nullable|in:_self,_blank',
            'button_variant'           => 'nullable|string|max:255',
            'button_icon'              => 'nullable|string|max:255',
            'secondary_button_label'   => 'nullable|string|max:255',
            'secondary_button_url'     => 'nullable|string|max:255',
            'secondary_button_target'  => 'nullable|in:_self,_blank',
            'secondary_button_variant' => 'nullable|string|max:255',
            'bg_color'                 => 'nullable|string|max:50',
            'text_color'               => 'nullable|string|max:50',
            'bg_image'                 => 'nullable',
            'alignment'                => 'nullable|in:left,center,right',
            'padding_vertical'         => 'nullable|string|max:50',
            'analytics_event_name'     => 'nullable|string|max:255',
            'layout'                   => 'nullable|string|max:50',
            'order_position'           => 'nullable|integer',
            'active'                   => 'nullable|boolean',
            
            // Validação das listas
            'list_items'               => 'nullable|array',
            'list_items.*.title'       => 'required|string|max:255',
            'list_items.*.icon'        => 'nullable|string|max:255',
            'list_items.*.order'       => 'nullable|integer',
            'list_items.*.active'      => 'nullable|boolean',
        ]);

        $data = $request->except(['_token', 'list_items', 'bg_image_url']);
        if ($request->hasFile('bg_image')) {
            $data['bg_image'] = '/storage/' . $request->file('bg_image')->store('cta', 'public');
        } elseif ($request->filled('bg_image_url')) {
            $data['bg_image'] = $request->input('bg_image_url');
        }

        $cta_session = CTA_Session::create($data);

        if ($request->has('list_items')) {
            foreach ($request->input('list_items') as $item) {
                $cta_session->cta_session_list()->create([
                    'title'  => $item['title'],
                    'icon'   => $item['icon'] ?? 'fa-solid fa-circle-check',
                    'order'  => $item['order'] ?? 0,
                    'active' => isset($item['active']) ? (bool)$item['active'] : true,
                ]);
            }
        }

        return redirect()->route('admin.cta_session.index')->with('success', 'CTA Session criada com sucesso!');
    }

    public function cta_sessionEdit(CTA_Session $cta_session)
    {
        $pages = Page::all();
        return view('admin.cta_session.edit', compact('cta_session','pages'));
    }

    public function cta_sessionUpdate(Request $request, CTA_Session $cta_session)
    {
        $request->validate([
            'title'                    => 'nullable|string|max:255',
            'subtitle'                 => 'nullable|string',
            'page_id'                  => 'nullable|integer|exists:pages,id',
            'button_label'             => 'nullable|string|max:255',
            'button_url'               => 'nullable|string|max:255',
            'button_target'            => 'nullable|in:_self,_blank',
            'button_variant'           => 'nullable|string|max:255',
            'button_icon'              => 'nullable|string|max:255',
            'secondary_button_label'   => 'nullable|string|max:255',
            'secondary_button_url'     => 'nullable|string|max:255',
            'secondary_button_target'  => 'nullable|in:_self,_blank',
            'secondary_button_variant' => 'nullable|string|max:255',
            'bg_color'                 => 'nullable|string|max:50',
            'text_color'               => 'nullable|string|max:50',
            'bg_image'                 => 'nullable',
            'alignment'                => 'nullable|in:left,center,right',
            'padding_vertical'         => 'nullable|string|max:50',
            'analytics_event_name'     => 'nullable|string|max:255',
            'layout'                   => 'nullable|string|max:50',
            'order_position'           => 'nullable|integer',
            'active'                   => 'nullable|boolean',

            // Validação das listas
            'list_items'               => 'nullable|array',
            'list_items.*.id'          => 'nullable|integer',
            'list_items.*.title'       => 'required|string|max:255',
            'list_items.*.icon'        => 'nullable|string|max:255',
            'list_items.*.order'       => 'nullable|integer',
            'list_items.*.active'      => 'nullable|boolean',
        ]);

        $data = $request->except(['_token', '_method', 'list_items', 'bg_image_url']);
        if ($request->hasFile('bg_image')) {
            if ($cta_session->bg_image && \Illuminate\Support\Str::contains($cta_session->bg_image, '/storage/cta/')) {
                $oldPath = str_replace('/storage/', '', $cta_session->bg_image);
                Storage::disk('public')->delete($oldPath);
            }
            $data['bg_image'] = '/storage/' . $request->file('bg_image')->store('cta', 'public');
        } elseif ($request->filled('bg_image_url')) {
            $data['bg_image'] = $request->input('bg_image_url');
        }

        $cta_session->update($data);

        // Atualizar lista relacionada
        $keptIds = [];
        if ($request->has('list_items')) {
            foreach ($request->input('list_items') as $item) {
                if (isset($item['id']) && !empty($item['id'])) {
                    // Update existente
                    $listItem = $cta_session->cta_session_list()->find($item['id']);
                    if ($listItem) {
                        $listItem->update([
                            'title'  => $item['title'],
                            'icon'   => $item['icon'] ?? 'fa-solid fa-circle-check',
                            'order'  => $item['order'] ?? 0,
                            'active' => isset($item['active']) ? (bool)$item['active'] : true,
                        ]);
                        $keptIds[] = $listItem->id;
                    }
                } else {
                    // Criação de novo item
                    $newListItem = $cta_session->cta_session_list()->create([
                        'cta_session_id' => $cta_session->id,
                        'title'  => $item['title'],
                        'icon'   => $item['icon'] ?? 'fa-solid fa-circle-check',
                        'order'  => $item['order'] ?? 0,
                        'active' => isset($item['active']) ? (bool)$item['active'] : true,
                    ]);
                    $keptIds[] = $newListItem->id;
                }
            }
        }
        $cta_session->cta_session_list()->whereNotIn('id', $keptIds)->delete();
        return redirect()->route('admin.cta_session.index')->with('success', 'CTA Session atualizada com sucesso!');
    }

    public function cta_sessionDestroy(CTA_Session $cta_session)
    {
        $cta_session->delete();
        return redirect()->route('admin.cta_session.index')->with('success', 'CTA Session excluída com sucesso!');
    }

    public function cta_sessionDuplicate(CTA_Session $cta_session)
    {
        // Duplicar a sessão principal
        $newSession = $cta_session->replicate();
        // Alterar o título para indicar cópia
        if ($newSession->title) {
            $newSession->title = $newSession->title . ' (Cópia)';
        }
        $newSession->save();

        // Duplicar itens de lista relacionados
        foreach ($cta_session->cta_session_list as $item) {
            $newItem = $item->replicate();
            $newItem->cta_session_id = $newSession->id;
            $newItem->save();
        }

        return redirect()->route('admin.cta_session.index')->with('success', 'CTA Session duplicada com sucesso!');
    }

    /* BATE E VOLTA CRUD */

    public function bateVoltaIndex()
    {
        $destinations = Destination::where('type', 'bate-e-volta')->latest()->get();
        return view('admin.bate-volta.index', compact('destinations'));
    }

    public function bateVoltaCreate()
    {
        return view('admin.bate-volta.create');
    }

    public function bateVoltaStore(\App\Http\Requests\Admin\DestinationStoreRequest $request)
    {
        dd($request->all());
        $dto = \App\DTOs\Admin\DestinationStoreDTO::fromRequest($request);
        $this->destinationService->create($dto, $request);

        return redirect()->route('admin.bate-volta.index')->with('success', 'Passeio Bate e Volta criado com sucesso!');
    }

    public function bateVoltaEdit(Destination $destination)
    {
        $destination->load(['includes', 'observations']);
        return view('admin.bate-volta.edit', compact('destination'));
    }

    public function bateVoltaUpdate(\App\Http\Requests\Admin\DestinationStoreRequest $request, Destination $destination)
    {
        $dto = \App\DTOs\Admin\DestinationStoreDTO::fromRequest($request);
        $this->destinationService->update($destination->id, $dto, $request);

        return redirect()->route('admin.bate-volta.index')->with('success', 'Passeio Bate e Volta atualizado com sucesso!');
    }

    public function bateVoltaDestroy(Destination $destination)
    {
        $this->destinationService->destroy($destination->id);

        return redirect()->route('admin.bate-volta.index')->with('success', 'Passeio excluído com sucesso!');
    }

    public function bateVoltaDuplicate(Destination $destination)
    {
        $this->destinationService->duplicate($destination->id);

        return redirect()->route('admin.bate-volta.index')->with('success', 'Passeio duplicado com sucesso!');
    }
}
