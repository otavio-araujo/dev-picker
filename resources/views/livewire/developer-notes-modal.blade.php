<div class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-cloak
    x-data="{ isOpen: @entangle('isOpen') }" x-show="isOpen" x-transition.duration.300ms.opacity>
    <div @click.away="isOpen = false" class="max-w-lg p-6 mx-auto bg-white rounded-lg shadow-lg" x-show="isOpen"
        x-transition:enter-end="scale-100 opacity-100" x-transition:enter-start="scale-95 opacity-0"
        x-transition:enter="duration-300" x-transition:leave-end="scale-95 opacity-0"
        x-transition:leave-start="scale-100 opacity-100" x-transition:leave="duration-300">


        <div class="flex items-center justify-between pb-3">

            <p class="text-2xl font-bold">Modal Title</p>
            <div @click="isOpen = false" class="z-50 cursor-pointer">
                <svg class="text-black fill-current" height="18" viewBox="0 0 18 18" width="18"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M14.53 3.53a.75.75 0 00-1.06 0L9 7.94 4.53 3.47a.75.75 0 00-1.06 1.06L7.94 9l-4.47 4.47a.75.75 0 101.06 1.06L9 10.06l4.47 4.47a.75.75 0 001.06-1.06L10.06 9l4.47-4.47a.75.75 0 000-1.06z" />
                </svg>
            </div>
        </div>
        <div class="my-5">
            <!-- Modal content goes here -->
            <p>Modal Body Content</p>
        </div>
        <div class="flex justify-end pt-2">
            <button @click="isOpen = false"
                class="p-3 px-4 text-black bg-gray-200 rounded-lg hover:bg-gray-300">Close</button>
        </div>
    </div>
</div>
