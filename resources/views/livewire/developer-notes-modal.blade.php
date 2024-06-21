<div class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-auto bg-black bg-opacity-50" x-cloak
    x-data="{ isOpen: @entangle('isOpen') }" x-show="isOpen" x-transition.duration.300ms.opacity>
    <div @click.away="isOpen = false"
        class="flex flex-col justify-between w-full h-full max-w-3xl mx-auto bg-white rounded-lg shadow-lg"
        x-show="isOpen" x-transition:enter-end="scale-100 opacity-100" x-transition:enter-start="scale-95 opacity-0"
        x-transition:enter="duration-300" x-transition:leave-end="scale-95 opacity-0"
        x-transition:leave-start="scale-100 opacity-100" x-transition:leave="duration-300">


        <div class="flex items-center justify-between p-4 border-b border-gray-100">
            <h1 class="text-2xl font-bold">Anotações do Desenvolvedor</h1>
            <div @click="isOpen = false" class="z-50 cursor-pointer">
                <svg class="text-black fill-current" height="18" viewBox="0 0 18 18" width="18"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M14.53 3.53a.75.75 0 00-1.06 0L9 7.94 4.53 3.47a.75.75 0 00-1.06 1.06L7.94 9l-4.47 4.47a.75.75 0 101.06 1.06L9 10.06l4.47 4.47a.75.75 0 001.06-1.06L10.06 9l4.47-4.47a.75.75 0 000-1.06z" />
                </svg>
            </div>
        </div>

        <div class="flex flex-col items-center justify-start h-full p-4 overflow-y-auto border-b border-gray-100">
            <div class="flex flex-col items-center px-4 sm:px-0">
                <img alt="{{ $this->developerDetails->github_login ?? null }}"
                    class="object-cover w-8 h-8 border border-gray-100 rounded-full"
                    src="{{ $this->developerDetails->github_avatar ?? null }}">
                <h3 class="text-base font-semibold leading-7 text-gray-900">
                    {{ $this->developerDetails->github_name ?? null }}</h3>
                <p class="max-w-2xl text-sm leading-6 text-gray-500">
                    {{ $this->developerDetails->github_login ?? null }}</p>
                </p>
            </div>

            <div class="w-full mt-6 border-t border-gray-100">
                <ul class="border border-gray-200 divide-y divide-gray-100 rounded-md" role="list">

                    @if ($this->developerNotes != null)
                        @forelse ($this->developerNotes as $note)
                            <li
                                class="{{ $loop->even ? 'bg-gray-50' : null }} flex flex-col items-start justify-between py-4 pl-4 pr-5 text-sm leading-6 lg:flex-row lg:items-center lg:gap-y-0">
                                <div class="flex flex-col w-full divide-y">
                                    <div class="flex items-center justify-between p-2">
                                        <div>
                                            <span
                                                class="text-sm font-semibold text-gray-800">{{ $note->user->name }}</span>
                                            <h3 class="text-xs text-gray-500">{{ $note->created_at->format('d/m/Y') }}
                                            </h3>
                                        </div>
                                        <div class="flex items-center gap-x-1">
                                            <div>
                                                {{ ($this->deleteAction)(['note' => $note->id]) }}
                                            </div>
                                        </div>
                                    </div>
                                    <p class="w-full p-2 text-sm text-gray-700">{{ $note->note }}</p>
                                </div>
                            </li>
                        @empty
                            <li class="py-4 pl-4 pr-5 text-sm leading-6 lg:flex-row lg:items-center lg:gap-y-0">

                                <p class="p-2 font-semibold text-center text-gray-700 text-md">Sem anotações</p>
                            </li>
                        @endforelse
                    @endif

                </ul>
                <div class="pt-4 mt-4 border-t border-gray-300 p4">
                    <form wire:submit="createDeveloperNote">
                        <div class="w-full mb-4">
                            <x-label for="note">Cadastrar anotações:</x-label>
                            <textarea class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                id="note" id="" name="note" rows="3" wire:model='note'></textarea>
                        </div>

                        <div class="w-full mb-4">
                            <x-button class="justify-center w-full mt-2" wire:loading.attr='disabled'>
                                <span wire:loading.remove>Salvar</span>
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
            </div>

        </div>
        <div class="flex justify-end p-4">
            <button @click="isOpen = false"
                class="p-3 px-4 text-black bg-gray-200 rounded-lg hover:bg-gray-300">Close</button>
        </div>
    </div>
    <x-filament-actions::modals />
</div>
