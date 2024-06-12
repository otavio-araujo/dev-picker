<div class="flex w-full flex-shrink flex-col justify-center gap-4 lg:flex-row">
    <div class="mt-4 w-full rounded-md bg-white px-6 py-4 shadow lg:w-1/3">
        <form wire:submit="searchDev">
            <div class="mb-4 w-full">
                <x-label for="minFollowers">Seguidores - Mínimo:</x-label>
                <x-input class="w-full" id="minFollowers" min="0" placeholder="Quantidade mínima de seguidores..."
                    type='number' wire:model='minFollowers' />
            </div>

            <x-label>Tipo de Desenvolvedor:</x-label>
            <div
                class="mb-4 flex flex-wrap gap-3 rounded-md border border-gray-300 p-4 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <div>
                    <label class="flex items-center" for="user">
                        <input class="border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" id="user"
                            name="developerType" type="radio" value="user" wire:model="developerType">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Desenvolvedores') }}</span>
                    </label>
                </div>
                <div>
                    <label class="flex items-center" for="org">
                        <input class="border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" id="org"
                            name="developerType" type="radio" value="org" wire:model="developerType">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Organizações') }}</span>
                    </label>
                </div>
                <div>
                    <label class="flex items-center" for="user-org">
                        <input class="border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" id="user-org"
                            name="developerType" type="radio" value="user-org" wire:model="developerType">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Ambos') }}</span>
                    </label>
                </div>
            </div>

            <x-label>Localização:</x-label>
            <div
                class="mb-4 flex gap-3 rounded-md border border-gray-300 p-4 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <div>
                    <label class="flex items-center" for="brasil">
                        <input class="border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" id="brasil"
                            name="location" type="radio" value="brasil" wire:model="location">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Brasil') }}</span>
                    </label>
                </div>
                <div>
                    <label class="flex items-center" for="all">
                        <input class="border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" id="all"
                            name="location" type="radio" value="all" wire:model="location">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Todas as Localidades') }}</span>
                    </label>
                </div>
            </div>

            <x-label>Linguagens & Frameworks:</x-label>
            <div
                class="mb-4 flex flex-row flex-wrap gap-3 rounded-md border border-gray-300 p-4 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @foreach ($this->languageEnums as $language => $value)
                    <label class="flex basis-1/3 items-center" for="{{ $language }}">
                        <x-checkbox id="{{ $language }}" value="{{ $value }}" wire:model="languages" />
                        <span class="ms-2 text-sm text-gray-600">{{ __($language) }}</span>
                    </label>
                @endforeach
            </div>

            <div class="mb-4 w-full">
                <x-button class="mt-2 w-full justify-center" wire:loading.attr='disabled'>
                    <span wire:loading.remove>Buscar</span>
                    <span wire:loading>
                        <svg class="mr-2 h-5 w-5 animate-spin text-white" fill="none" viewBox="0 0 24 24"
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

    <div class="mt-4 w-full overflow-hidden rounded-md bg-white shadow lg:w-2/3">
        @empty($users)
            <div class="flex h-full flex-col items-center justify-center">
                <svg class="size-20 mb-4 text-slate-400" fill="none" stroke-width="1.5" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>

                <p class="text-center text-slate-700">Nenhum desenvolvedor encontrado</p>
            </div>
        @else
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 rtl:text-right dark:text-gray-400"
                            scope="col">
                            Desenvolvedor
                        </th>
                        <th class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 rtl:text-right dark:text-gray-400"
                            scope="col">
                            Seguidores
                        </th>
                        <th class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 rtl:text-right dark:text-gray-400"
                            scope="col">
                            Localização
                        </th>

                        <th
                            class="px-4 py-3.5 text-center text-sm font-normal text-gray-500 rtl:text-right dark:text-gray-400">
                            Ações
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-900">
                    @foreach ($users as $user)
                        <tr>
                            <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-500 dark:text-gray-300">
                                <div class="flex flex-row items-center justify-between gap-x-2">
                                    <div class="flex items-center gap-x-2">
                                        <img alt="{{ $user['login'] }}" class="h-8 w-8 rounded-full object-cover"
                                            src="{{ $user['avatar_url'] }}">
                                        <div>
                                            <h2 class="text-sm font-medium text-gray-800 dark:text-white">
                                                {{ $user['name'] }}
                                            </h2>
                                            <h2 class="dark:gray-300 text-xs font-medium dark:text-gray-300">
                                                {{ $user['login'] }}
                                            </h2>
                                            <p class="text-xs font-normal text-gray-600 dark:text-cyan-100">
                                                {{ $user['email'] ?? '' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-500 dark:text-gray-300">
                                <div class="flex items-center gap-x-2 text-xs">
                                    <svg class="size-5" fill="none" stroke-width="1.5" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span>{{ number_format($user['followers'], 0, ',', '.') }}</span>
                                </div>
                            </td>

                            <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-500 dark:text-gray-300">
                                <div class="flex items-center gap-x-2 text-xs">
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
                            </td>

                            <td class="whitespace-nowrap px-4 py-4 text-sm">
                                <div class="flex items-center justify-end gap-x-3">
                                    <a class='flex items-center gap-x-2 rounded-md border px-3 py-1 text-xs capitalize text-gray-700 transition-colors duration-200 hover:bg-gray-600 hover:text-gray-400 disabled:opacity-50 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200'
                                        dark:hover:bg-gray-800" href="{{ $user['html_url'] }}" target="_blank">
                                        Selecionar
                                    </a>
                                    <a class='flex items-center gap-x-2 rounded-md border px-3 py-1 text-xs capitalize text-gray-700 transition-colors duration-200 hover:bg-gray-600 hover:text-gray-400 disabled:opacity-50 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200'
                                        dark:hover:bg-gray-800" href="{{ $user['html_url'] }}" target="_blank">
                                        Detalhes
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

            <div class="flex items-center justify-between px-4 py-4">
                <button @if ($currentPage <= 1) disabled @endif
                    class="flex items-center gap-x-2 rounded-md border bg-white px-5 py-2 text-sm capitalize text-gray-700 transition-colors duration-200 hover:bg-gray-100 disabled:opacity-50 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 dark:hover:bg-gray-800"
                    wire:click="previousPage" wire:loading.attr="disabled">
                    <span class="flex items-center gap-x-2" wire:loading.remove>
                        <svg class="h-5 w-5 rtl:-scale-x-100" fill="none" stroke-width="1.5" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>

                        <span>
                            anterior
                        </span>
                    </span>
                    <span wire:loading>
                        <svg class="h-5 w-5 animate-spin" fill="none" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke-width="4"
                                stroke="currentColor"></circle>
                            <path class="opacity-75"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.963 7.963 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                fill="currentColor"></path>
                        </svg>
                    </span>
                </button>

                <div class="text-sm text-gray-700">
                    {{ $total }}
                    @if ($this->developerType === 'user')
                        desenvolvedores localizados.
                    @elseif ($this->developerType === 'org')
                        organizações localizadas.
                    @else
                        organizações e desenvolvedores localizados.
                    @endif

                </div>

                <button @if ($currentPage * $perPage >= $total) disabled @endif
                    class="disabled:opacity-50flex rounded-md border bg-white px-5 py-2 text-sm capitalize text-gray-700 transition-colors duration-200 hover:bg-gray-100 disabled:opacity-50 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 dark:hover:bg-gray-800"
                    wire:click="nextPage" wire:loading.attr="disabled">
                    <span class="flex items-center gap-x-2" wire:loading.remove>
                        <span>
                            próxima
                        </span>

                        <svg class="h-5 w-5 rtl:-scale-x-100" fill="none" stroke-width="1.5" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </span>
                    <span wire:loading>
                        <svg class="h-5 w-5 animate-spin" fill="none" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke-width="4"
                                stroke="currentColor"></circle>
                            <path class="opacity-75"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.963 7.963 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                fill="currentColor"></path>
                        </svg>
                    </span>
                </button>
            </div>
        @endempty
    </div>
</div>
