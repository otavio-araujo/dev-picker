<div class="flex flex-col mt-8">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div class="w-full max-w-lg lg:max-w-xs">
                    <label class="sr-only" for="search">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path clip-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    fill-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input
                            class="block w-full py-2 pl-10 pr-3 leading-5 placeholder-gray-500 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md focus:shadow-outline-blue focus:border-blue-300 focus:placeholder-gray-400 focus:outline-none sm:text-sm"
                            id="search" placeholder="Buscar" type="search" wire:model.live="search">
                    </div>
                </div>
            </div>

            <div class="mt-4 overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-6 py-3 text-left">
                                <div class="flex items-center">
                                    <button
                                        class="text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase"
                                        wire:click="sortBy('github_name')">Name</button>
                                    <x-sort-icon :sortAsc="$sortAsc" :sortField="$sortField" field="github_name" />
                                </div>
                            </th>
                            <th class="px-6 py-3 text-left">
                                <div class="flex items-center">
                                    <button
                                        class="text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase"
                                        wire:click="sortBy('github_login')">Login</button>
                                    <x-sort-icon :sortAsc="$sortAsc" :sortField="$sortField" field="github_login" />
                                </div>
                            </th>
                            <th class="px-6 py-3 text-left">
                                <div class="flex items-center">
                                    <button
                                        class="text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase">Rating</button>
                                </div>
                            </th>
                            <th class="px-6 py-3 text-left">
                                <div class="flex items-center">
                                    <button
                                        class="text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase">Status</button>
                                </div>
                            </th>
                            <th class="px-6 py-3 text-left">
                                <div class="flex items-center">

                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($developers as $developer)
                            <tr>
                                <td class="w-4/12 px-6 py-4 whitespace-no-wrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-10 h-10">
                                            <img alt="" class="w-10 h-10 rounded-full"
                                                src="{{ $developer->github_avatar }}">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium leading-5 text-gray-900">
                                                {{ $developer->github_name }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="w-4/12 px-6 py-4 whitespace-no-wrap">
                                    <div class="text-sm leading-5 text-gray-900">{{ $developer->github_login }}</div>
                                </td>
                                <td class="w-4/12 px-6 py-4 whitespace-no-wrap">
                                    <div class="text-sm leading-5 text-gray-900">{{ $developer->rating->label() }}</div>
                                </td>
                                <td class="w-4/12 px-6 py-4 whitespace-no-wrap">
                                    <span
                                        class="{{ $developer->status->statusColor() }} inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium uppercase leading-4">
                                        {{ $developer->status->label() }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium leading-5 text-right whitespace-no-wrap">
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
