<?php

namespace App\Http\Middleware;

use App\Models\PageView;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackPageView
{
    /**
     * Rotas/prefixos que NÃO devem ser rastreados.
     */
    protected array $excluded = [
        'admin',
        '_debugbar',
        'telescope',
        'horizon',
        'livewire',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Só rastreia GET requests com resposta 200
        if ($request->isMethod('GET') && $response->getStatusCode() === 200) {
            $pathPrefix = explode('/', ltrim($request->path(), '/'))[0];

            if (!in_array($pathPrefix, $this->excluded)) {
                try {
                    $routeName = $request->route()?->getName();

                    PageView::create([
                        'url'        => $request->fullUrl(),
                        'page_name'  => $this->resolvePageName($routeName, $request->path()),
                        'route_name' => $routeName,
                        'ip'         => $request->ip(),
                        'user_agent' => $request->userAgent(),
                        'referer'    => $request->headers->get('referer'),
                        'visited_at' => now(),
                    ]);
                } catch (\Throwable $e) {
                    // Falha silenciosa — nunca quebra a requisição do visitante
                }
            }
        }

        return $response;
    }

    /**
     * Converte o nome da rota em um nome amigável para exibição no admin.
     */
    protected function resolvePageName(?string $routeName, string $path): string
    {
        $map = [
            'home'            => 'Página Inicial',
            'destination'     => 'Lista de Destinos',
            'destination.show'=> 'Detalhe do Destino',
            'services'        => 'Nossos Serviços',
            'service.show'    => 'Detalhe do Serviço',
            // 'packages20262027'=> 'Pacotes 2026-2027',
            'short-trips'     => 'Bate e Volta',
            'group-trips'     => 'Viagens em Grupo',
            'faq'             => 'Perguntas Frequentes',
            'contact'         => 'Contato',
        ];

        if ($routeName && isset($map[$routeName])) {
            return $map[$routeName];
        }

        return $path === '/' ? 'Página Inicial' : ucwords(str_replace(['-', '_', '/'], ' ', $path));
    }
}
