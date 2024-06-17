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
                        <div class="px-4 sm:px-0">
                            <h3 class="text-base font-semibold leading-7 text-gray-900">
                                {{ $this->developerDetails['name'] ?? null }}</h3>
                            <p class="max-w-2xl mt-1 text-sm leading-6 text-gray-500">Personal details and application.
                            </p>
                        </div>
                        <div class="mt-6 border-t border-gray-100">
                            <dl class="divide-y divide-gray-100">
                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                    <dt class="text-sm font-medium leading-6 text-gray-900">Full name</dt>
                                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">Margot Foster
                                    </dd>
                                </div>
                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                    <dt class="text-sm font-medium leading-6 text-gray-900">Application for</dt>
                                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">Backend
                                        Developer</dd>
                                </div>
                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                    <dt class="text-sm font-medium leading-6 text-gray-900">Email address</dt>
                                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                        margotfoster@example.com</dd>
                                </div>
                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                    <dt class="text-sm font-medium leading-6 text-gray-900">Salary expectation</dt>
                                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">$120,000</dd>
                                </div>
                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                    <dt class="text-sm font-medium leading-6 text-gray-900">About</dt>
                                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">Fugiat ipsum
                                        ipsum deserunt culpa aute sint do nostrud anim incididunt cillum culpa
                                        consequat. Excepteur qui ipsum aliquip consequat sint. Sit id mollit nulla
                                        mollit nostrud in ea officia proident. Irure nostrud pariatur mollit ad
                                        adipisicing reprehenderit deserunt qui eu.</dd>
                                </div>
                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                    <dt class="text-sm font-medium leading-6 text-gray-900">Attachments</dt>
                                    <dd class="mt-2 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                        <ul class="border border-gray-200 divide-y divide-gray-100 rounded-md"
                                            role="list">
                                            <li
                                                class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                                                <div class="flex items-center flex-1 w-0">
                                                    <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-gray-400"
                                                        fill="currentColor" viewBox="0 0 20 20">
                                                        <path clip-rule="evenodd"
                                                            d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                                            fill-rule="evenodd" />
                                                    </svg>
                                                    <div class="flex flex-1 min-w-0 gap-2 ml-4">
                                                        <span
                                                            class="font-medium truncate">resume_back_end_developer.pdf</span>
                                                        <span class="flex-shrink-0 text-gray-400">2.4mb</span>
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0 ml-4">
                                                    <a class="font-medium text-indigo-600 hover:text-indigo-500"
                                                        href="#">Download</a>
                                                </div>
                                            </li>
                                            <li
                                                class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                                                <div class="flex items-center flex-1 w-0">
                                                    <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-gray-400"
                                                        fill="currentColor" viewBox="0 0 20 20">
                                                        <path clip-rule="evenodd"
                                                            d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                                            fill-rule="evenodd" />
                                                    </svg>
                                                    <div class="flex flex-1 min-w-0 gap-2 ml-4">
                                                        <span
                                                            class="font-medium truncate">coverletter_back_end_developer.pdf</span>
                                                        <span class="flex-shrink-0 text-gray-400">4.5mb</span>
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0 ml-4">
                                                    <a class="font-medium text-indigo-600 hover:text-indigo-500"
                                                        href="#">Download</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="flex items-center w-full p-4 min-h-16">
                    <button @click="open = false" class="px-4 py-2 text-white bg-red-500 rounded">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
