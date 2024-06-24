<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div class="flex flex-wrap items-center gap-2" x-data="{ state: $wire.$entangle('{{ $getStatePath() }}') }">

        @foreach ($getRecord()->permissions as $permission)
            <span
                class="text-nowrap rounded-md border border-info-400 bg-info-100 px-2 py-1 text-xs text-info-400">{{ $permission->name }}</span>
        @endforeach

    </div>
</x-dynamic-component>
