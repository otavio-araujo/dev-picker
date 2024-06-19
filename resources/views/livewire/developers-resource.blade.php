<div class="mt-8 flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
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

            <div class="mt-4 overflow-visible border-b border-gray-200 shadow sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-6 py-3 text-left">
                                <div class="flex items-center">
                                    <button
                                        class="text-left text-xs font-medium uppercase leading-4 tracking-wider text-gray-500"
                                        wire:click="sortBy('github_name')">Name</button>
                                    <x-sort-icon :sortAsc="$sortAsc" :sortField="$sortField" field="github_name" />
                                </div>
                            </th>
                            <th class="px-6 py-3 text-left">
                                <div class="flex items-center">
                                    <button
                                        class="text-left text-xs font-medium uppercase leading-4 tracking-wider text-gray-500"
                                        wire:click="sortBy('github_login')">Login</button>
                                    <x-sort-icon :sortAsc="$sortAsc" :sortField="$sortField" field="github_login" />
                                </div>
                            </th>
                            <th class="px-6 py-3 text-left">
                                <div class="flex items-center">
                                    <button
                                        class="text-left text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Rating</button>
                                </div>
                            </th>
                            <th class="px-6 py-3 text-left">
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
                                <td class="whitespace-no-wrap w-4/12 px-6 py-4">
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
                                <td class="whitespace-no-wrap w-4/12 px-6 py-4">
                                    <div class="text-sm leading-5 text-gray-900">{{ $developer->github_login }}</div>
                                </td>
                                <td class="whitespace-no-wrap w-4/12 px-6 py-4">
                                    <div class="text-sm leading-5 text-gray-900">{{ $developer->rating->label() }}</div>
                                </td>
                                <td class="whitespace-no-wrap w-4/12 px-6 py-4">
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
                                                        class="{{ $developer->status->statusColor() }} text-nowrap inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium uppercase leading-4">
                                                        {{ $developer->status->label() }}
                                                    </span>
                                                </button>

                                                <!-- Panel -->
                                                <div :id="$id('dropdown-button')"
                                                    class="absolute left-0 z-50 mt-2 w-40 divide-y overflow-visible rounded-md bg-white shadow-md"
                                                    style="display: none;" x-on:click.outside="close($refs.button)"
                                                    x-ref="panel" x-show="open" x-transition.origin.top.left>
                                                    @foreach (App\Enums\DeveloperStatusEnum::cases() as $status)
                                                        <a class="{{ $status->textColor() }} flex w-full items-center gap-2 px-4 py-2.5 text-left text-xs uppercase first-of-type:rounded-t-md last-of-type:rounded-b-md hover:bg-gray-50"
                                                            href="#">
                                                            {{ $status->label() }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-no-wrap px-6 py-4 text-right text-sm font-medium leading-5">
                                    <a class="text-indigo-600 hover:text-indigo-900" href="#">Observações</a>
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
    <div class="h-96"></div>
</div>
