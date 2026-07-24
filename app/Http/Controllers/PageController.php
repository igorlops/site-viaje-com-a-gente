<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Banner;
use App\Models\Destination;
use App\Models\SocialLink;
use App\Repositories\TestimonialRepository;
use App\Services\Admin\ServiceService;
use App\Services\BannerService;
use App\Services\CTA_SessionService;
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
        protected CTA_SessionService $cta_sessionService,
        protected PageService $pageService,
        protected ServiceService $serviceService ,
        protected \App\Services\DestinationService $destinationService,
        protected TestimonialRepository $testimonialRepository
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
        [$cta_session, $countCtaSessions] = $this->cta_sessionService->cta_sessionByPageSlug('home');
        $destinations = Destination::where('is_featured', true)->get();
        $socialLinks = SocialLink::where('active', true)->get()->keyBy(function ($item) {
            return strtolower($item->name);
        });
        $testimonials = $this->testimonialRepository->allActiveGlobal();
        return view('home', compact('banner', 'destinations', 'socialLinks', 'testimonials', 'cta_session','countCtaSessions'));
    }

    // public function packages20262027()
    // {
    //     $breadcrumbs = [
    //         [
    //             'label' => 'Pacotes 2026-2027',
    //             'link' => route('packages20262027')
    //         ]
    //     ];
    //     $banner = $this->bannerService->bannerByPageSlug('pacotes-2026-2027');
    //     [$cta_session, $countCtaSessions] = $this->cta_sessionService->cta_sessionByPageSlug('pacotes-2026-2027');
    //     $destinations = Destination::where('type', 'pacotes-2026-2027')->get();
    //     $socialLinks = $this->getSocialLinks();
    //     return view("pacotes-2026-2027", compact("socialLinks", "banner", "destinations", "breadcrumbs", "cta_session"));
    // }

    public function services()
    {
        $breadcrumbs = [
            [
                'label' => 'Nossos Serviços',
                'link' => route('services')
            ]
        ];
        $banner = $this->bannerService->bannerByPageSlug('nossos-servicos');
        [$cta_session, $countCtaSessions] = $this->cta_sessionService->cta_sessionByPageSlug('nossos-servicos');
        $services = $this->serviceService->all();
        $socialLinks = $this->getSocialLinks();
        return view("nossos-servicos", compact("socialLinks", "banner", "breadcrumbs",'services', 'cta_session'));
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
        [$cta_session, $countCtaSessions] = $this->cta_sessionService->cta_sessionByPageSlug('bate-e-volta');
        $destinations = Destination::where('type', 'bate-e-volta')->get();
        $socialLinks = $this->getSocialLinks();
        return view("bate-e-volta", compact("socialLinks", "banner", "destinations", "breadcrumbs", "cta_session"));
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
        [$cta_session, $countCtaSessions] = $this->cta_sessionService->cta_sessionByPageSlug('viagens-em-grupo');
        $destinations = Destination::where('type', 'viagem-em-grupo')->get();
        $socialLinks = $this->getSocialLinks();
        return view("viagens-em-grupo", compact("socialLinks", "banner", "destinations", "breadcrumbs", "cta_session"));
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
        [$cta_session, $countCtaSessions] = $this->cta_sessionService->cta_sessionByPageSlug('perguntas-frequentes');
        $socialLinks = $this->getSocialLinks();
        $faqs = \App\Models\Faq::orderBy('order')->get();
        return view("perguntas-frequentes", compact("socialLinks", "banner", "breadcrumbs", "faqs", "cta_session"));
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
        [$cta_session, $countCtaSessions] = $this->cta_sessionService->cta_sessionByPageSlug('contato');
        return view("contato", compact("socialLinks", "banner", "breadcrumbs", "cta_session"));
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
        [$cta_session, $countCtaSessions] = $this->cta_sessionService->cta_sessionByPageSlug('destinos');
        $destination = Destination::where('slug', $slug)
            ->with(['includes', 'highlights', 'itineraryDays.activities', 'observations', 'paymentMethods.method'])
            ->firstOrFail();

        $socialLinks = SocialLink::where('active', true)->get()->keyBy(function ($item) {
            return strtolower($item->name);
        });

        $testimonials = $this->testimonialRepository->allActiveForDestination($destination->id);

        if($destination->type === 'bate-e-volta') {
            return view('destination.show-bate-e-volta', compact('destination', 'socialLinks', 'banner', 'breadcrumbs', 'testimonials', 'cta_session'));
        }
        return view('destination.show', compact('destination', 'socialLinks', 'banner', 'breadcrumbs', 'testimonials', 'cta_session'));
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
        [$cta_session, $countCtaSessions] = $this->cta_sessionService->cta_sessionByPageSlug('destinos');
        $dto = \App\DTOs\DestinationsFilterDTO::fromRequest($request);
        $destinations = $this->destinationService->paginate($dto);

        $socialLinks = SocialLink::where('active', true)->get()->keyBy(function ($item) {
            return strtolower($item->name);
        });

        return view('destination.index', compact('destinations', 'socialLinks', 'banner', 'breadcrumbs', 'cta_session'));
    }

}
