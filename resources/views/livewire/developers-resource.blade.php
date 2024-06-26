<div class="mt-8 flex flex-col">
    <div class="-my-2 sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            {{-- Search --}}
            <div class="flex items-center justify-between">
                <div class="w-full max-w-lg lg:max-w-xs">
                    <label class="sr-only" for="search">Search</label>
                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path clip-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    fill-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input
                            class="focus:shadow-outline-blue block w-full rounded-md border border-gray-300 bg-white py-2 pl-10 pr-3 leading-5 placeholder-gray-500 transition duration-150 ease-in-out focus:border-blue-300 focus:placeholder-gray-400 focus:outline-none sm:text-sm"
                            id="search" placeholder="Buscar" type="search" wire:model.live="search">
                    </div>
                </div>
            </div>
            {{-- Table --}}
            <div class="mt-4 overflow-visible border-b border-gray-200 shadow sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>

                        <tr class="bg-gray-200">

                            <th class="px-6 py-3 text-left">
                                <div class="flex items-center">
                                    <button
                                        class="text-left text-xs font-medium uppercase leading-4 tracking-wider text-gray-500"
                                        wire:click="sortBy('github_name')">desenvolvedor</button>
                                    <x-sort-icon :sortAsc="$sortAsc" :sortField="$sortField" field="github_name" />
                                </div>
                            </th>

                            <th class="hidden px-6 py-3 text-left lg:table-cell">
                                <div class="flex items-center">
                                    <button
                                        class="text-left text-xs font-medium uppercase leading-4 tracking-wider text-gray-500"
                                        wire:click="sortBy('github_login')">usuário do github</button>
                                    <x-sort-icon :sortAsc="$sortAsc" :sortField="$sortField" field="github_login" />
                                </div>
                            </th>

                            <th class="hidden px-6 py-3 text-left md:table-cell">
                                <div class="flex items-center">
                                    <button
                                        class="text-left text-xs font-medium uppercase leading-4 tracking-wider text-gray-500"
                                        wire:click="sortBy('rating')">classificação</button>
                                    <x-sort-icon :sortAsc="$sortAsc" :sortField="$sortField" field="rating" />
                                </div>
                            </th>

                            <th class="hidden px-6 py-3 text-left md:table-cell">
                                <div class="flex items-center">
                                    <button
                                        class="text-left text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Status</button>
                                </div>
                            </th>

                            <th class="px-6 py-3 text-left">
                                <div class="flex items-center">

                                </div>
                            </th>
                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach ($developers as $developer)
                            <tr>

                                <td class="whitespace-no-wrap min-w-4/12 px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0">
                                            <img alt="" class="h-10 w-10 rounded-full"
                                                src="{{ $developer->github_avatar }}">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium leading-5 text-gray-900">
                                                {{ $developer->github_name }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="whitespace-no-wrap hidden px-6 py-4 lg:table-cell">
                                    <div class="text-sm leading-5 text-gray-900">{{ $developer->github_login }}</div>
                                </td>

                                <td class="whitespace-no-wrap text-nowrap hidden px-6 py-4 md:table-cell">
                                    <div class="flex items-center">
                                        @for ($i = 0; $i < 5; $i++)
                                            @can('edit developer rating')
                                                <x-icon-button
                                                    class="{{ $i < $developer->rating->value ? 'text-yellow-400 hover:text-gray-400' : 'text-gray-400 hover:text-yellow-400' }} mx-0 px-0"
                                                    wire:click="updateDeveloperRating({{ $developer->id }}, {{ $i + 1 }})">
                                                    <svg class="size-4" fill="currentColor" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path clip-rule="evenodd"
                                                            d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                                            fill-rule="evenodd" />
                                                    </svg>
                                                </x-icon-button>
                                            @else
                                                <x-icon-button
                                                    class="{{ $i < $developer->rating->value ? 'text-yellow-400 hover:text-gray-400' : 'text-gray-400 hover:text-yellow-400' }} mx-0 px-0">
                                                    <svg class="size-4" fill="currentColor" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path clip-rule="evenodd"
                                                            d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                                            fill-rule="evenodd" />
                                                    </svg>
                                                </x-icon-button>
                                            @endcan
                                        @endfor
                                    </div>
                                </td>

                                <td class="whitespace-no-wrap hidden px-6 py-4 md:table-cell">
                                    <div class="flex items-center gap-x-2">

                                        <div class="flex justify-center">
                                            <div class="relative" x-data="{
                                                open: false,
                                                toggle() {
                                                    if (this.open) {
                                                        return this.close()
                                                    }

                                                    this.$refs.button.focus()

                                                    this.open = true
                                                },
                                                close(focusAfter) {
                                                    if (!this.open) return

                                                    this.open = false

                                                    focusAfter && focusAfter.focus()
                                                }
                                            }" x-id="['dropdown-button']"
                                                x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                                                x-on:keydown.escape.prevent.stop="close($refs.button)">
                                                <!-- Button -->
                                                <button :aria-controls="$id('dropdown-button')" :aria-expanded="open"
                                                    class="flex items-center" type="button" x-on:click="toggle()"
                                                    x-ref="button">
                                                    <span
                                                        class="{{ $developer->status->badgeColor() }} text-nowrap inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium uppercase leading-4">
                                                        {{ $developer->status->label() }}
                                                    </span>
                                                </button>

                                                @can('edit developer status')
                                                    <!-- Panel -->
                                                    <div :id="$id('dropdown-button')"
                                                        class="absolute left-0 z-50 mt-2 w-40 divide-y overflow-visible rounded-md bg-white shadow-md"
                                                        style="display: none;" x-on:click.outside="close($refs.button)"
                                                        x-ref="panel" x-show="open" x-transition.origin.top.left>
                                                        @foreach (App\Enums\DeveloperStatusEnum::cases() as $status)
                                                            @if ($developer->status != $status)
                                                                <button
                                                                    class="{{ $status->textColor() }} flex w-full items-center gap-2 px-4 py-2.5 text-left text-xs uppercase first-of-type:rounded-t-md last-of-type:rounded-b-md hover:bg-gray-50"
                                                                    type="button"
                                                                    wire:click="updateDeveloperStatus({{ $developer->id }}, {{ $status }})"
                                                                    x-on:click="toggle()">
                                                                    {{ $status->label() }}
                                                                </button>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @endcan
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="whitespace-no-wrap px-6 py-4 text-right text-sm font-medium leading-5">
                                    <div class="mx-auto flex items-center gap-x-1">
                                        @can('view developer')
                                            <x-icon-button
                                                class="text-gray-600 hover:text-gray-700 hover:shadow-sm focus:text-gray-700 active:text-gray-900"
                                                wire:click="showDeveloperDetails('{{ $developer->github_url }}')"
                                                wire:loading.attr='disabled'>
                                                <svg class="size-5" fill="none" stroke-width="1.5" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>

                                            </x-icon-button>
                                        @endcan

                                        @can('view developer note')
                                            <x-icon-button
                                                class="text-cyan-600 hover:text-cyan-700 hover:shadow-sm focus:text-cyan-700 active:text-cyan-900"
                                                wire:click="$dispatchTo('developer-notes-modal', 'show-developer-notes', { developer: {{ $developer->id }} })">
                                                <svg class="size-5" fill="none" stroke-width="1.5"
                                                    stroke="currentColor" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </x-icon-button>
                                        @endcan

                                        @can('delete developer')
                                            <div>
                                                {{ ($this->deleteAction)(['developer' => $developer->id]) }}
                                            </div>
                                        @endcan
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
            <div class="mt-8">
                {{ $developers->links() }}
            </div>
        </div>
    </div>
    <x-filament-actions::modals />
</div>
