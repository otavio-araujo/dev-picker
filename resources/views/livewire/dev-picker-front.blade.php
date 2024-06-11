<div class="flex flex-col justify-center w-full gap-4 lg:flex-row">
    <div class="w-full">
        <form wire:submit="searchDev">
            <div class="px-6 py-4 my-4 mt-4 overflow-hidden bg-white rounded-md shadow">
                <div class="w-full mb-4">
                    <x-label for="minFollowers">Seguidores - Mínimo:</x-label>
                    <x-input class="w-full" id="minFollowers" min="0"
                        placeholder="Quantidade mínima de seguidores..." type='number' wire:model='minFollowers' />
                </div>

                <x-label>Localização:</x-label>
                <div
                    class="flex gap-3 p-4 mb-4 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <div>
                        <label class="flex items-center" for="brasil">
                            <input class="text-indigo-600 border-gray-300 shadow-sm focus:ring-indigo-500"
                                id="brasil" name="location" type="radio" value="brasil" wire:model="location">
                            <span class="text-sm text-gray-600 ms-2">{{ __('Brasil') }}</span>
                        </label>
                    </div>
                    <div>
                        <label class="flex items-center" for="all">
                            <input class="text-indigo-600 border-gray-300 shadow-sm focus:ring-indigo-500"
                                id="all" name="location" type="radio" value="all" wire:model="location">
                            <span class="text-sm text-gray-600 ms-2">{{ __('Todas as Localidades') }}</span>
                        </label>
                    </div>


                </div>

                <x-label>Linguagens & Frameworks:</x-label>
                <div
                    class="flex gap-3 p-4 mb-4 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @foreach ($this->languageEnums as $language => $value)
                        <div>
                            <label class="flex items-center" for="{{ $language }}">
                                <x-checkbox id="{{ $language }}" value="{{ $value }}"
                                    wire:model="languages" />
                                <span class="text-sm text-gray-600 ms-2">{{ __($language) }}</span>
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="w-full mb-4">
                    <x-button class="justify-center w-full mt-2">Buscar</x-button>
                </div>
            </div>
        </form>
    </div>

    <div class="w-full px-6 py-4 mt-4 overflow-hidden bg-white rounded-md shadow">
        @empty($users)
            <p class="text-center">Nenhum usuário encontrado.</p>
        @else
            @foreach ($users as $user)
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <img alt="{{ $user['login'] }}" class="w-10 h-10 rounded-full" src="{{ $user['avatar_url'] }}" />
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
