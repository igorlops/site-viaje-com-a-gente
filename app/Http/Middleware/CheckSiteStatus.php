<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CheckSiteStatus
{
    public function handle(Request $request, Closure $next): Response
    {
        // Ignora o bloqueio se for a rota de login ou o painel administrativo
        if ($request->is('admin*') || $request->is('login*') || $request->is('asdasdasdasdafsdfsadf/desativar/sdfasdfasdf')) {
            return $next($request);
        }

        $siteStatus = DB::table('site_settings')->where('key', 'site_active')->value('value');

        if ($siteStatus === 'false') {
            abort(503, 'Este site está temporariamente indisponível.');
        }

        return $next($request);
    }
}
