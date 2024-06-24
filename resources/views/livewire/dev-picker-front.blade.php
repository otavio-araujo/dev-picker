<div class="flex flex-col justify-center flex-shrink w-full h-full gap-4 lg:flex-row">

    <div class="w-full px-6 py-4 bg-white rounded-md shadow lg:w-1/3">

        <form wire:submit="searchDev">
            <div class="w-full mb-4">
                <x-label for="minFollowers">Seguidores - Mínimo:</x-label>
                <x-input class="w-full" id="minFollowers" min="0" placeholder="Quantidade mínima de seguidores..."
                    type='number' wire:model='minFollowers' />
            </div>

            <x-label>Tipo de Desenvolvedor:</x-label>
            <div
                class="flex flex-wrap gap-3 p-4 mb-4 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <div>
                    <label class="flex items-center" for="user">
                        <input class="text-indigo-600 border-gray-300 shadow-sm focus:ring-indigo-500" id="user"
                            name="developerType" type="radio" value="user" wire:model="developerType">
                        <span class="text-sm text-gray-600 ms-2">{{ __('Desenvolvedores') }}</span>
                    </label>
                </div>
                <div>
                    <label class="flex items-center" for="org">
                        <input class="text-indigo-600 border-gray-300 shadow-sm focus:ring-indigo-500" id="org"
                            name="developerType" type="radio" value="org" wire:model="developerType">
                        <span class="text-sm text-gray-600 ms-2">{{ __('Organizações') }}</span>
                    </label>
                </div>
                <div>
                    <label class="flex items-center" for="user-org">
                        <input class="text-indigo-600 border-gray-300 shadow-sm focus:ring-indigo-500" id="user-org"
                            name="developerType" type="radio" value="user-org" wire:model="developerType">
                        <span class="text-sm text-gray-600 ms-2">{{ __('Ambos') }}</span>
                    </label>
                </div>
            </div>

            <x-label>Localização:</x-label>
            <div
                class="flex gap-3 p-4 mb-4 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <div>
                    <label class="flex items-center" for="brasil">
                        <input class="text-indigo-600 border-gray-300 shadow-sm focus:ring-indigo-500" id="brasil"
                            name="location" type="radio" value="brasil" wire:model="location">
                        <span class="text-sm text-gray-600 ms-2">{{ __('Brasil') }}</span>
                    </label>
                </div>
                <div>
                    <label class="flex items-center" for="all">
                        <input class="text-indigo-600 border-gray-300 shadow-sm focus:ring-indigo-500" id="all"
                            name="location" type="radio" value="all" wire:model="location">
                        <span class="text-sm text-gray-600 ms-2">{{ __('Todas as Localidades') }}</span>
                    </label>
                </div>
            </div>

            <x-label>Linguagens & Frameworks:</x-label>
            <div
                class="flex flex-row flex-wrap gap-3 p-4 mb-4 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @foreach ($this->languageEnums as $language => $value)
                    <label class="flex items-center basis-1/3" for="{{ $language }}">
                        <x-checkbox id="{{ $language }}" value="{{ $value }}" wire:model="languages" />
                        <span class="text-sm text-gray-600 ms-2">{{ __($language) }}</span>
                    </label>
                @endforeach
            </div>

            <div class="w-full mb-4">
                <x-button class="justify-center w-full mt-2" wire:loading.attr='disabled'>
                    <span wire:loading.remove>Buscar</span>
                    <span wire:loading>
                        <svg class="w-5 h-5 mr-2 text-white animate-spin" fill="none" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke-width="4"
                                stroke="currentColor"></circle>
                            <path class="opacity-75"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.963 7.963 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                fill="currentColor"></path>
                        </svg>
                    </span>
                </x-button>
            </div>

        </form>
    </div>

    <div class="w-full overflow-hidden bg-white rounded-md shadow lg:w-2/3">
        <div class="z-50 flex items-center justify-center w-full h-full" wire:loading>
            <div class="flex flex-col items-center justify-center w-full h-full gap-y-4">
                <div
                    class="w-12 h-12 border-4 border-gray-400 rounded-full spinner-border animate-spin border-t-transparent">
                </div>
                <p class="font-medium text-md animate-pulse">Buscando desenvolvedores...</p>
            </div>
        </div>
        @empty($users)
            <div class="flex flex-col items-center justify-center h-full" wire:loading.remove>
                <svg class="mb-4 size-20 text-slate-400" fill="none" stroke-width="1.5" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>

                <p class="text-center text-slate-700">Nenhum desenvolvedor encontrado</p>
            </div>
        @else
            <div class="flex flex-col items-center justify-between">

                <table class="h-full min-w-full divide-y divide-gray-200 dark:divide-gray-700" wire:loading.remove>
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th class="xs:hidden px-4 py-3.5 text-left text-sm font-normal text-gray-500 rtl:text-right dark:text-gray-400 lg:block"
                                scope="col">
                                Desenvolvedor
                            </th>
                            <th class="hidden px-4 py-3.5 text-left text-sm font-normal text-gray-500 rtl:text-right dark:text-gray-400 md:table-cell"
                                scope="col">
                                <span class="sr-only">Detalhes</span>
                            </th>
                            <th
                                class="px-4 py-3.5 text-center text-sm font-normal text-gray-500 rtl:text-right dark:text-gray-400">
                                <span class="sr-only">Ações</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                        @foreach ($users as $user)
                            <tr>
                                <td class="px-4 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-gray-300">
                                    <div class="flex flex-row items-center justify-between gap-x-2">
                                        <div class="flex items-center gap-x-2">
                                            <img alt="{{ $user['login'] }}"
                                                class="object-cover w-8 h-8 border border-gray-100 rounded-full"
                                                src="{{ $user['avatar_url'] }}">
                                            <div>
                                                <h2 class="text-sm font-medium text-gray-800 dark:text-white">
                                                    {{ $user['name'] }}
                                                </h2>
                                                <h2 class="text-xs font-medium dark:gray-300 dark:text-gray-300">
                                                    {{ $user['login'] }}
                                                </h2>
                                                <p class="text-xs font-normal text-gray-600 dark:text-cyan-100">
                                                    {{ $user['email'] ?? '' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td
                                    class="hidden px-4 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-gray-300 md:table-cell">
                                    <div class="flex items-center text-xs gap-x-2">
                                        <svg class="size-5" fill="none" stroke-width="1.5" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <span>{{ number_format($user['followers'], 0, ',', '.') }}</span>
                                    </div>

                                    <div class="flex items-center text-xs gap-x-2">
                                        <svg class="size-5" fill="none" stroke-width="1.5" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path
                                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>

                                        <span>{{ $user['location'] }}</span>
                                    </div>

                                    <div class="flex items-center text-xs gap-x-2">
                                        <svg class="size-5" fill="none" stroke-width="1.5" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>


                                        <span>{{ $user['public_repos'] }}</span>
                                    </div>
                                </td>

                                <td class="px-4 py-4 text-sm max-w-32 whitespace-nowrap">
                                    <div class="flex flex-col items-center gap-y-3">
                                        @if ($user['is_selected'] === true)
                                            @can('delete developer')
                                                <x-danger-button class="justify-center w-full mt-2"
                                                    wire:click="selectDeveloper('{{ $user['url'] }}', 'delete')"
                                                    wire:loading.attr='disabled'>
                                                    <span wire:loading.remove>desmarcar</span>
                                                    <span wire:loading>
                                                        <svg class="w-5 h-5 mr-2 text-white animate-spin" fill="none"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                                stroke-width="4" stroke="currentColor"></circle>
                                                            <path class="opacity-75"
                                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.963 7.963 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                </x-danger-button>
                                            @endcan
                                        @else
                                            @can('select developer')
                                                <x-success-button class="justify-center w-full mt-2"
                                                    wire:click="selectDeveloper('{{ $user['url'] }}', 'select')"
                                                    wire:loading.attr='disabled'>
                                                    <span wire:loading.remove>selecionar</span>
                                                    <span wire:loading>
                                                        <svg class="w-5 h-5 mr-2 text-white animate-spin" fill="none"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                                stroke-width="4" stroke="currentColor"></circle>
                                                            <path class="opacity-75"
                                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.963 7.963 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                </x-success-button>
                                            @endcan
                                        @endif

                                        <x-secondary-button class="justify-center w-full mt-2"
                                            wire:click="showDeveloperDetails('{{ $user['url'] }}')"
                                            wire:loading.attr='disabled'>
                                            <span wire:loading.remove>Detalhes</span>
                                            <span wire:loading>
                                                <svg class="w-5 h-5 mr-2 text-white animate-spin" fill="none"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                                        stroke-width="4" stroke="currentColor"></circle>
                                                    <path class="opacity-75"
                                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.963 7.963 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                                        fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </x-secondary-button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>


                <div class="flex items-center justify-between flex-shrink-0 p-4 gap-x-2" wire:loading.remove>
                    <button @if ($currentPage <= 1) disabled @endif
                        class="flex items-center px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md gap-x-2 hover:bg-gray-100 disabled:opacity-50 dark:hover:bg-gray-800"
                        wire:click="previousPage">
                        <span class="flex items-center gap-x-2">
                            <svg class="w-5 h-5 rtl:-scale-x-100" fill="none" stroke-width="1.5"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>

                            <span class="hidden sm:block">
                                anterior
                            </span>
                        </span>
                    </button>

                    <div class="flex flex-col">
                        <div class="text-xs font-semibold text-center text-gray-500">
                            Página: {{ $this->currentPage }} de {{ $this->totalPages }}
                        </div>
                        <div class="text-sm text-center text-gray-700">
                            {{ $total }}
                            @if ($this->developerType === 'user')
                                desenvolvedores localizados.
                            @elseif ($this->developerType === 'org')
                                organizações localizadas.
                            @else
                                organizações/desenvolvedores localizados.
                            @endif
                        </div>
                    </div>

                    <button @if ($currentPage * $perPage >= $total) disabled @endif
                        class="px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md disabled:opacity-50flex hover:bg-gray-100 disabled:opacity-50 dark:hover:bg-gray-800"
                        wire:click="nextPage" wire:loading.attr="disabled">
                        <span class="flex items-center gap-x-2">
                            <span class="hidden sm:block">
                                próxima
                            </span>

                            <svg class="w-5 h-5 rtl:-scale-x-100" fill="none" stroke-width="1.5"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </span>
                    </button>
                </div>
                </ class="flex flex-col items-center justify-between">
            @endempty
        </div>
    </div>
