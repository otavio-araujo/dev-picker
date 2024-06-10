<div class="w-full justify-center bg-gray-100">
    <div class="mx-auto mt-6 w-full max-w-3xl overflow-hidden rounded-md bg-white px-6 py-4 shadow">
        <form wire:submit="searchDev">
            <x-label>Procura por um Desenvolvedor</x-label>
            <x-input class="w-full" placeholder="Nome do desenvolvedor" wire:model='search' />
            <x-button class="mt-2 w-full justify-center">Buscar</x-button>
        </form>
    </div>

    <div class="mx-auto mt-6 w-full max-w-3xl overflow-hidden rounded-md bg-white px-6 py-4 shadow">
        @empty($users)
            Nenhum usuário encontrado.
        @else
            @foreach ($users as $user)
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <img alt="{{ $user['login'] }}" class="h-10 w-10 rounded-full" src="{{ $user['avatar_url'] }}" />
                        <div class="ml-4">
                            <div class="text-xl font-bold">{{ $user['login'] }}</div>
                        </div>
                    </div>
                    <a class="text-blue-500" href="{{ $user['html_url'] }}" target="_blank">Ver perfil</a>
                </div>
            @endforeach
        @endempty
    </div>
</div>
