<div class="flex flex-col justify-center flex-shrink w-full gap-4 lg:flex-row">
    <div class="w-full px-6 py-4 mt-4 bg-white rounded-md shadow">
        <form wire:submit="searchDev">
            <div class="w-full mb-4">
                <x-label for="minFollowers">Seguidores - Mínimo:</x-label>
                <x-input class="w-full" id="minFollowers" min="0" placeholder="Quantidade mínima de seguidores..."
                    type='number' wire:model='minFollowers' />
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
                <x-button class="justify-center w-full mt-2">Buscar</x-button>
            </div>

        </form>
    </div>

    <div class="w-full mt-4 overflow-hidden bg-white rounded-md shadow">
        @empty($users)
            <div class="flex flex-col items-center justify-center h-full">
                <svg class="size-28 text-slate-400" fill="none" stroke-width="1.5" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <p class="text-center text-slate-700">Nenhum usuário encontrado.</p>
            </div>
        @else
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 rtl:text-right dark:text-gray-400"
                            scope="col">
                            Desenvolvedor
                        </th>

                        <th class="relative px-4 py-3.5" scope="col">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                    @foreach ($users as $user)
                        <tr>
                            <td class="px-4 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-gray-300">
                                <div class="flex items-center gap-x-2">
                                    <img alt="{{ $user['login'] }}" class="object-cover w-8 h-8 rounded-full"
                                        src="{{ $user['avatar_url'] }}">
                                    <div>
                                        <h2 class="text-sm font-medium text-gray-800 dark:text-white">{{ $user['login'] }}
                                        </h2>
                                        <p class="text-xs font-normal text-gray-600 dark:text-gray-400">
                                            authurmelo@example.com</p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-4 py-4 text-sm whitespace-nowrap">
                                <div class="flex items-center justify-end gap-x-3">
                                    <a class='flex items-center px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 border rounded-md gap-x-2 hover:bg-gray-600 hover:text-gray-400 disabled:opacity-50 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200'
                                        dark:hover:bg-gray-800" href="{{ $user['html_url'] }}" target="_blank">
                                        Selecionar
                                    </a>
                                    <a class='flex items-center px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 border rounded-md gap-x-2 hover:bg-gray-600 hover:text-gray-400 disabled:opacity-50 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200'
                                        dark:hover:bg-gray-800" href="{{ $user['html_url'] }}" target="_blank">
                                        Detalhes
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

            <div class="flex items-center justify-between px-2 mt-4">
                <button @if ($currentPage <= 1) disabled @endif
                    class="flex items-center px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md gap-x-2 hover:bg-gray-100 disabled:opacity-50 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 dark:hover:bg-gray-800"
                    wire:click="previousPage">
                    <svg class="w-5 h-5 rtl:-scale-x-100" fill="none" stroke-width="1.5" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                    <span>
                        previous
                    </span>
                </button>

                <div>Foram encontrados {{ $total }} desenvolvedores.</div>

                <button @if ($currentPage * $perPage >= $total) disabled @endif
                    class="flex items-center px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md disabled:opacity-50flex gap-x-2 hover:bg-gray-100 disabled:opacity-50 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 dark:hover:bg-gray-800"
                    wire:click="nextPage">
                    <span>
                        Next
                    </span>

                    <svg class="w-5 h-5 rtl:-scale-x-100" fill="none" stroke-width="1.5" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        @endempty
    </div>
</div>
