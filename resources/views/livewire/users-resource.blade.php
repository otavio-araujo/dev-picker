<div class="mt-8 flex flex-col">
    <div class="-my-2 sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            {{-- Search --}}
            <div class="flex items-center justify-between gap-x-2">
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
                @can('create user')
                    <div class="whitespace-nowrap">
                        {{ $this->createFormAction }}
                    </div>
                @endcan
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
                                        wire:click="sortBy('name')">Nome</button>
                                    <x-sort-icon :sortAsc="$sortAsc" :sortField="$sortField" field="name" />
                                </div>
                            </th>

                            <th class="hidden px-6 py-3 text-left lg:table-cell">
                                <div class="flex items-center">
                                    <button
                                        class="text-left text-xs font-medium uppercase leading-4 tracking-wider text-gray-500"
                                        wire:click="sortBy('email')">email</button>
                                    <x-sort-icon :sortAsc="$sortAsc" :sortField="$sortField" field="email" />
                                </div>
                            </th>

                            <th class="hidden px-6 py-3 text-left md:table-cell">
                                <div class="flex items-center">
                                    <button
                                        class="text-left text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">
                                        Tipo de Usuário
                                    </button>
                                </div>
                            </th>

                            <th class="hidden w-2/6 px-6 py-3 text-left lg:table-cell">
                                <div class="flex items-center">
                                    <button
                                        class="text-left text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">
                                        Permissões de usuário
                                    </button>
                                </div>
                            </th>

                            <th class="px-6 py-3 text-left">
                                <div class="flex items-center">

                                </div>
                            </th>
                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach ($users as $user)
                            <tr>

                                <td class="whitespace-no-wrap min-w-4/12 px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium leading-5 text-gray-900">
                                                {{ $user->name }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="whitespace-no-wrap hidden px-6 py-4 lg:table-cell">
                                    <div class="text-sm leading-5 text-gray-900">{{ $user->email }}</div>
                                </td>

                                <td class="whitespace-no-wrap hidden px-6 py-4 md:table-cell">
                                    <div class="text-sm capitalize leading-5 text-gray-900">
                                        {{ $user->roles[0]['name'] ?? null }}
                                    </div>
                                </td>

                                <td class="whitespace-no-wrap hidden px-6 py-4 lg:table-cell">
                                    <div class="text-sm capitalize leading-5 text-gray-900">
                                        <div class="flex flex-wrap items-center gap-2">

                                            @foreach ($user->getAllPermissions()->pluck('name') as $permission)
                                                <span
                                                    class="text-nowrap rounded-md border border-primary-600 bg-primary-50 px-2 py-1 text-xs font-medium text-primary-600">{{ $permission }}</span>
                                            @endforeach

                                        </div>
                                    </div>
                                </td>

                                <td class="whitespace-no-wrap px-6 py-4 text-right text-sm font-medium leading-5">
                                    <div class="mx-auto flex items-center gap-x-1">

                                        @can('edit user')
                                            <div>
                                                {{ ($this->editAction)(['user' => $user->id]) }}
                                            </div>
                                        @endcan

                                        @can('view user')
                                            <div>
                                                {{ ($this->viewAction)(['user' => $user->id]) }}
                                            </div>
                                        @endcan

                                        @can('delete user')
                                            <div>
                                                {{ ($this->deleteAction)(['user' => $user->id]) }}
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
                {{ $users->links() }}
            </div>
        </div>
    </div>
    <x-filament-actions::modals />
</div>
