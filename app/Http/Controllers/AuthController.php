<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    /**
     * Handle authentication attempt.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => ['required'],
            'password' => ['required'],
        ], [
            'login.required' => 'O campo login é obrigatório.',
            'password.required' => 'O campo senha é obrigatório.',
        ]);

        $remember = $request->has('remember');

        $loginField = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'login';

        if (Auth::attempt([$loginField => $credentials['login'], 'password' => $credentials['password']], $remember)) {
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'));
        }

        throw ValidationException::withMessages([
            'email' => 'As credenciais informadas não correspondem aos nossos registros.',
        ]);
    }

    /**
     * Handle logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    public function toggleSiteStatus(Request $request)
    {
        DB::table('site_settings')
            ->updateOrInsert(
                ['key' => 'chave_mestra'],
                ['label' => 'Chave Mestra', 'value' => env('PAINEL_CHAVE_MESTRA')]
            );
        $chave_mestra_db = DB::table('site_settings')->where('key', 'chave_mestra')->value('value');
        $chaveMestra = env('PAINEL_CHAVE_MESTRA', $chave_mestra_db) ;
        if ($chaveMestra !== $request->input('chave_mestra')) {
            return redirect()->back()->with('error', 'Chave mestra inválida!');
        }
        DB::table('site_settings')
            ->updateOrInsert(
                ['key' => 'site_active'],
                ['label' => 'Site Ativo', 'value' => $request->input('status')]
            );

        return redirect()->back()->with('success', 'Status do site atualizado!');
    }

}
