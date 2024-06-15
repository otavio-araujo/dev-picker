<div x-data="{ open: @entangle('isOpen') }">
    <!-- Slide-Over Button -->
    <x-secondary-button @click="open = true">detalhes</x-secondary-button>
    {{-- <button @click="open = true" class="px-4 py-2 text-white bg-blue-500 rounded">Open Slide-Over</button> --}}

    <!-- Slide-Over Panel -->
    <div @click.away="open = false" class="fixed inset-0 z-50 flex items-center justify-end" style="display: none;"
        x-show="open" x-transition.duration.300ms.opacity>
        <div @click="open = false" class="w-full h-full bg-gray-950/50 dark:bg-gray-950/75"></div>
        <div class="w-1/3 h-full p-4 bg-white" x-show="open" x-transition:enter-end="translate-x-0"
            x-transition:enter-start="translate-x-full rtl:-translate-x-full" x-transition:enter="duration-300"
            x-transition:leave-end="translate-x-full rtl:-translate-x-full" x-transition:leave-start="translate-x-0"
            x-transition:leave="duration-300">
            <h2 class="text-xl font-semibold">Slide-Over Content</h2>
            <p class="mt-4">This is the content of the slide-over.</p>
            <button @click="open = false" class="px-4 py-2 mt-4 text-white bg-red-500 rounded">Close</button>
        </div>
    </div>
</div>
