<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Banner;
use App\Models\Destination;
use App\Models\SocialLink;
use App\Services\BannerService;
use App\Services\PageService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\ContactRequest;
use App\DTOs\ContactDTO;
use App\Services\ContactService;
use League\CommonMark\CommonMarkConverter;

class PageController extends Controller
{
    public function __construct(
        protected BannerService $bannerService,
        protected PageService $pageService,
        protected \App\Services\DestinationService $destinationService
    ) {}
    
    protected function getSocialLinks()
    {
        return SocialLink::where("active", true)->get()->keyBy(function ($item) {
            return strtolower($item->name);
        });
    }
    public function home()
    {
        $banner = $this->bannerService->bannerByPageSlug('home');
        $destinations = Destination::where('is_featured', true)->get();
        
        $socialLinks = SocialLink::where('active', true)->get()->keyBy(function ($item) {
            return strtolower($item->name);
        });

        return view('home', compact('banner', 'destinations', 'socialLinks'));
    }

    public function packages20262027()
    {
        $breadcrumbs = [
            [
                'label' => 'Pacotes 2026-2027',
                'link' => route('packages20262027')
            ]
        ];
        $banner = $this->bannerService->bannerByPageSlug('pacotes-2026-2027');
        $destinations = Destination::where('type', 'pacotes-2026-2027')->get();
        $socialLinks = $this->getSocialLinks();
        return view("pacotes-2026-2027", compact("socialLinks", "banner", "destinations", "breadcrumbs"));
    }

    public function services()
    {
        $breadcrumbs = [
            [
                'label' => 'Nossos Serviços',
                'link' => route('services')
            ]
        ];
        $banner = $this->bannerService->bannerByPageSlug('nossos-servicos');
        $socialLinks = $this->getSocialLinks();
        return view("nossos-servicos", compact("socialLinks", "banner", "breadcrumbs"));
    }

    public function shortTrips()
    {
        $breadcrumbs = [
            [
                'label' => 'Bate e Volta',
                'link' => route('short-trips')
            ]
        ];
        $banner = $this->bannerService->bannerByPageSlug('bate-e-volta');
        $destinations = Destination::where('type', 'bate-e-volta')->get();
        $socialLinks = $this->getSocialLinks();
        return view("bate-e-volta", compact("socialLinks", "banner", "destinations", "breadcrumbs"));
    }

    public function groupTrips()
    {
        $breadcrumbs = [
            [
                'label' => 'Viagens em Grupo',
                'link' => route('group-trips')
            ]
        ];
        $banner = $this->bannerService->bannerByPageSlug('viagens-em-grupo');
        $destinations = Destination::where('type', 'viagem-em-grupo')->get();
        $socialLinks = $this->getSocialLinks();
        return view("viagens-em-grupo", compact("socialLinks", "banner", "destinations", "breadcrumbs"));
    }

    public function faq()
    {
        $breadcrumbs = [
            [
                'label' => 'Perguntas Frequentes',
                'link' => route('faq')
            ]
        ];
        $banner = $this->bannerService->bannerByPageSlug('perguntas-frequentes');
        $socialLinks = $this->getSocialLinks();
        return view("perguntas-frequentes", compact("socialLinks", "banner", "breadcrumbs"));
    }

    public function contact()
    {
        $breadcrumbs = [
            [
                'label' => 'Contato',
                'link' => route('contact')
            ]
        ];
        $banner = $this->bannerService->bannerByPageSlug('contato');
        $socialLinks = $this->getSocialLinks();
        return view("contato", compact("socialLinks", "banner", "breadcrumbs"));
    }

    /**
     * Submit contact form.
     */
    public function submitContact(ContactRequest $request, ContactService $service)
    {
        $dto = ContactDTO::fromRequest($request);
        $service->handle($dto);

        return redirect()->back()->with('success', 'Sua mensagem foi enviada com sucesso! Entraremos em contato o mais rápido possível.');
    }

    /**
     * Exibe a página pública de um serviço dinâmico pelo slug.
     */
    public function serviceShow(string $slug)
    {
        $breadcrumbs = [
            [
                'label' => 'Nossos Serviços',
                'link' => route('services')
            ],
            [
                'label' => $slug,
                'link' => route('service.show', $slug)
            ]
        ];
        $banner = $this->bannerService->bannerByPageSlug('nossos-servicos'); 
        $service = Service::published()->where('slug', $slug)->firstOrFail();
        $socialLinks = $this->getSocialLinks();

        $menuServices = Service::inMenu()->orderBy('title')->get(['id', 'title', 'slug']);

        // Converte o conteúdo Markdown para HTML
        $htmlContent = null;
        if ($service->content) {
            $converter = new CommonMarkConverter([
                'html_input'         => 'strip',
                'allow_unsafe_links' => false,
            ]);
            $htmlContent = $converter->convert($service->content)->getContent();
        }

        return view('services.show', compact('service', 'socialLinks', 'menuServices', 'htmlContent', 'banner', 'breadcrumbs'));
    }
    public function destinationShow($slug)
    {
        $breadcrumbs = [
            [
                'label' => 'Destinos',
                'link' => route('destination')
            ],
            [
                'label' => $slug,
                'link' => route('destination.show', $slug)
            ]
        ];
        $banner = $this->bannerService->bannerByPageSlug('destinos');
        $destination = Destination::where('slug', $slug)
            ->with(['includes', 'highlights', 'itineraryDays.activities'])
            ->firstOrFail();

        $socialLinks = SocialLink::where('active', true)->get()->keyBy(function ($item) {
            return strtolower($item->name);
        });

        return view('destination.show', compact('destination', 'socialLinks', 'banner', 'breadcrumbs'));
    }

    public function destinations(\App\Http\Requests\DestinationsFilterRequest $request)
    {
        $breadcrumbs = [
            [
                'label' => 'Destinos',
                'link' => route('destination')
            ]
        ];
        $banner = $this->bannerService->bannerByPageSlug('destinos');
        
        $dto = \App\DTOs\DestinationsFilterDTO::fromRequest($request);
        $destinations = $this->destinationService->paginate($dto);

        $socialLinks = SocialLink::where('active', true)->get()->keyBy(function ($item) {
            return strtolower($item->name);
        });

        return view('destination.index', compact('destinations', 'socialLinks', 'banner', 'breadcrumbs'));
    }
}
