<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações do Sistema</title>
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Controle de Visibilidade do Site</h2>
        
        <!-- Mensagem de Sucesso -->
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-md text-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Status Atual -->
        <div class="mb-6 p-4 rounded-md {{ $siteStatus === 'true' ? 'bg-green-50 border border-green-200' : 'bg-red-50 border border-red-200' }}">
            <p class="text-sm font-medium text-gray-700">
                Status Atual: 
                <span class="font-bold {{ $siteStatus === 'true' ? 'text-green-600' : 'text-red-600' }}">
                    {{ $siteStatus === 'true' ? 'ONLINE (Público)' : 'OFFLINE (Bloqueado)' }}
                </span>
            </p>
        </div>

        <!-- Formulário de Ação -->
        <form action="{{ route('admin.settings.toggle') }}" method="POST">
            @csrf
            
            @if($siteStatus === 'true')
                <!-- Se o site está online, o botão serve para DESATIVAR -->
                <input type="hidden" name="status" value="false">
                <input type="text" name="chave_mestra" placeholder="Digite a chave mestra" required>
                <p class="text-sm text-gray-600 mb-4">Ao desativar, todas as rotas públicas exibirão uma mensagem de manutenção (Erro 503).</p>
                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md transition duration-200 cursor-pointer">
                    Desativar Rotas Públicas
                </button>

            @else
                <!-- Se o site está offline, o botão serve para ATIVAR -->
                <input type="hidden" name="status" value="true">
                <input type="text" name="chave_mestra" placeholder="Digite a chave mestra" required>
                <p class="text-sm text-gray-600 mb-4">Clique abaixo para liberar o acesso ao público geral novamente.</p>
                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-md transition duration-200 cursor-pointer">
                    Ativar Rotas Públicas
                </button>
            @endif
        </form>
    </div>

</body>
</html>
