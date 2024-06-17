<div x-data="{ open: @entangle('isOpen') }">
    <!-- Slide-Over Button -->
    {{-- <x-secondary-button @click="open = true">detalhes</x-secondary-button> --}}
    {{-- <button @click="open = true" class="px-4 py-2 text-white bg-blue-500 rounded">Open Slide-Over</button> --}}

    <!-- Slide-Over Panel -->
    <div @click.away="open = false"
        class="fixed inset-0 z-50 flex items-center justify-end bg-gray-950/50 dark:bg-gray-950/75" style="display: none;"
        x-show="open" x-transition.duration.300ms.opacity>
        <div @click="open = false" class="w-2/12 h-full sm:block sm:w-1/3 lg:w-1/2">
        </div>
        <div class="w-10/12 h-full bg-white sm:w-2/3 lg:w-1/2" x-show="open" x-transition:enter-end="translate-x-0"
            x-transition:enter-start="translate-x-full rtl:-translate-x-full" x-transition:enter="duration-300"
            x-transition:leave-end="translate-x-full rtl:-translate-x-full" x-transition:leave-start="translate-x-0"
            x-transition:leave="duration-300">
            <div class="flex flex-col justify-between h-full">
                <div class="flex items-center justify-between w-full p-4 border-b border-gray-100 min-h-16">
                    <h2 class="text-xl font-semibold leading-7 text-gray-900">Perfil do Desenvolvedor</h2>
                    <x-close-button @click="open = false"></x-close-button>
                </div>
                <div class="w-full h-full p-4 overflow-auto border-b border-gray-100">
                    <div>
                        <div class="flex flex-col items-center px-4 sm:px-0">
                            <img alt="{{ $this->developerDetails['login'] ?? null }}"
                                class="object-cover w-8 h-8 border border-gray-100 rounded-full"
                                src="{{ $this->developerDetails['avatar_url'] ?? null }}">
                            <h3 class="text-base font-semibold leading-7 text-gray-900">
                                {{ $this->developerDetails['name'] ?? null }}</h3>
                            <p class="max-w-2xl text-sm leading-6 text-gray-500">
                                {{ $this->developerDetails['login'] ?? null }}</p>
                            </p>
                        </div>
                        <div class="mt-6 border-t border-gray-100">
                            <dl class="divide-y divide-gray-100">
                                @isset($this->developerDetails['bio'])
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900">
                                            Bio:</dt>
                                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                            {{ $this->developerDetails['bio'] }}
                                        </dd>
                                    </div>
                                @endisset
                                @isset($this->developerDetails['location'])
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900">
                                            Localização:</dt>
                                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                            {{ $this->developerDetails['location'] }}
                                        </dd>
                                    </div>
                                @endisset
                                @isset($this->developerDetails['blog'])
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900">
                                            Blog:</dt>
                                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                            {{ $this->developerDetails['blog'] }}
                                        </dd>
                                    </div>
                                @endisset
                                @isset($this->developerDetails['hireable'])
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900">
                                            Disponível para contratação:</dt>
                                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                            {{ $this->developerDetails['hireable'] === true ? 'Sim' : 'Não' }}
                                        </dd>
                                    </div>
                                @endisset
                                @isset($this->developerDetails['followers'])
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900">
                                            Seguidores:</dt>
                                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                            {{ number_format($developerDetails['followers'], 0, ',', '.') }}
                                        </dd>
                                    </div>
                                @endisset

                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                    <dt class="text-sm font-medium leading-6 text-gray-900">Repositórios Públicos:</dt>
                                    <dd class="mt-2 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                        <ul class="border border-gray-200 divide-y divide-gray-100 rounded-md"
                                            role="list">
                                            @foreach ($this->developerRepositories as $repository)
                                                <li
                                                    class="{{ $loop->even ? 'bg-gray-50' : null }} flex flex-col items-start justify-between gap-y-2 py-4 pl-4 pr-5 text-sm leading-6 lg:flex-row lg:items-center lg:gap-y-0">
                                                    <div class="flex flex-col">
                                                        <div class="flex items-center flex-1 w-full">
                                                            <svg aria-hidden="true"
                                                                class="flex-shrink-0 w-4 h-4 text-gray-400"
                                                                fill="none" stroke-width="1.5" stroke="currentColor"
                                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                            <div class="flex flex-col flex-1 min-w-0 ml-4">
                                                                <span
                                                                    class="flex-shrink-0 font-medium truncate text-wrap">{{ $repository['name'] }}</span>
                                                                <span
                                                                    class="flex-shrink-0 text-xs text-gray-400">{{ $repository['description'] }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="flex items-center flex-1 w-full">
                                                            <svg class="flex-shrink-0 w-4 h-4 text-yellow-300"
                                                                fill="currentColor" viewBox="0 0 24 24"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path clip-rule="evenodd"
                                                                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                                                    fill-rule="evenodd" />
                                                            </svg>

                                                            <div class="flex flex-col flex-1 min-w-0 ml-4">
                                                                <span
                                                                    class="font-medium truncate">{{ number_format($repository['stargazers_count'], 0, ',', '.') }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="flex items-center flex-1 w-full">
                                                            <svg class="flex-shrink-0 w-4 h-4 text-sky-400"
                                                                fill="currentColor" viewBox="0 0 24 24"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                                                <path clip-rule="evenodd"
                                                                    d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z"
                                                                    fill-rule="evenodd" />
                                                            </svg>

                                                            <div class="flex flex-col flex-1 min-w-0 ml-4">
                                                                <span
                                                                    class="font-medium truncate">{{ number_format($repository['watchers_count'], 0, ',', '.') }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="flex items-center flex-1 w-full">
                                                            <svg class="flex-shrink-0 w-4 h-4 text-red-400"
                                                                fill="none" stroke-width="1.5" stroke="currentColor"
                                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>

                                                            <div class="flex flex-col flex-1 min-w-0 ml-4">
                                                                <span class="font-medium truncate">Issues em aberto:
                                                                    {{ number_format($repository['open_issues'], 0, ',', '.') }}</span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="flex items-center justify-between flex-shrink-0">
                                                        <a class="font-medium text-indigo-600 hover:text-indigo-500"
                                                            href="{{ $repository['html_url'] ?? null }}"
                                                            target="_blank">Ver no
                                                            Github</a>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="flex items-center w-full p-4 min-h-16">
                    <button @click="open = false"
                        class="px-4 py-2 text-white capitalize bg-red-500 rounded">fechar</button>
                </div>
            </div>
        </div>
    </div>
</div>
