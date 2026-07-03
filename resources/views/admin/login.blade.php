<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrativo - Viaje com a Gente</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Vite CSS/JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-[#001c3d] to-[#003c73] font-sans antialiased text-gray-800 flex items-center justify-center min-h-screen p-4">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl border border-white/10 overflow-hidden">
        <!-- Card Header -->
        <div class="bg-[#00152b] py-8 px-6 text-center border-b border-gray-100 flex flex-col items-center">
            <img class="h-16 w-auto object-contain mb-3 bg-white p-1 rounded" src="{{ asset('assets/images/logo.jpeg') }}" alt="Logo">
            <h2 class="text-xl font-black text-white uppercase tracking-wider">Painel Administrativo</h2>
            <p class="text-xs text-gray-400 mt-1">Faça login para gerenciar o site</p>
        </div>

        <!-- Card Body / Form -->
        <form action="{{ route('admin.login.submit') }}" method="POST" class="p-8 space-y-6">
            @csrf

            <!-- Email Input -->
            <div>
                <label for="email" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Endereço de E-mail</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i class="far fa-envelope"></i>
                    </span>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                        class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:border-[#002752] focus:ring-1 focus:ring-[#002752] focus:outline-none text-sm transition duration-200"
                        placeholder="admin@viajecomagente.com.br">
                </div>
                @error('email')
                    <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Input -->
            <div>
                <label for="password" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Senha</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" name="password" id="password" required
                        class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:border-[#002752] focus:ring-1 focus:ring-[#002752] focus:outline-none text-sm transition duration-200"
                        placeholder="••••••••">
                </div>
                @error('password')
                    <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me & Reset Link (Mock) -->
            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2 cursor-pointer select-none">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded text-[#002752] focus:ring-[#002752] border-gray-300">
                    <span class="text-xs font-semibold text-gray-600">Lembrar-me</span>
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-[#002752] hover:bg-[#f3a908] hover:text-[#00152b] text-white py-3.5 rounded-lg font-black text-sm tracking-wide uppercase transition duration-300 shadow-md">
                Entrar no Painel
            </button>
            
            <!-- Link to Home -->
            <div class="text-center">
                <a href="{{ route('home') }}" class="text-xs font-bold text-gray-500 hover:text-gray-700 transition duration-200">
                    <i class="fas fa-arrow-left mr-1"></i> Voltar para o Site
                </a>
            </div>
        </form>
    </div>

</body>
</html>
