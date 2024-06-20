<div class="fi-modal-window pointer-events-auto relative row-start-2 mx-auto flex w-full max-w-md cursor-default flex-col rounded-xl bg-white shadow-xl ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10"
    x-data="{ isShown: false }" x-init="$nextTick(() => {
        isShown = isOpen
        $watch('isOpen', () => (isShown = isOpen))
    })"
    x-on:keydown.window.escape="$dispatch('close-modal', { id: 'ApVb5l6QmFeIvTJmT2Bq-table-action' })" x-show="isShown"
    x-transition:enter-end="scale-100 opacity-100" x-transition:enter-start="scale-95 opacity-0"
    x-transition:enter="duration-300" x-transition:leave-end="scale-95 opacity-0"
    x-transition:leave-start="scale-100 opacity-100" x-transition:leave="duration-300">
    <!--[if BLOCK]><![endif]-->
    <div class="fi-modal-header flex flex-col px-6 pt-6">
        <!--[if BLOCK]><![endif]-->
        <div class="absolute end-4 top-4">
            <!--[if BLOCK]><![endif]--> <button
                class="fi-icon-btn fi-color-gray fi-modal-close-btn relative -m-1.5 flex h-9 w-9 items-center justify-center rounded-lg text-gray-400 outline-none transition duration-75 hover:text-gray-500 focus-visible:ring-2 focus-visible:ring-primary-600 disabled:pointer-events-none disabled:opacity-70 dark:text-gray-500 dark:hover:text-gray-400 dark:focus-visible:ring-primary-500"
                style="--c-300:var(--gray-300);--c-400:var(--gray-400);--c-500:var(--gray-500);--c-600:var(--gray-600);"
                tabindex="-1" title="Close" type="button"
                x-on:click="$dispatch('close-modal', { id: 'ApVb5l6QmFeIvTJmT2Bq-table-action' })">
                <!--[if BLOCK]><![endif]--> <span class="sr-only">
                    Close
                </span>
                <!--[if ENDBLOCK]><![endif]-->

                <!--[if BLOCK]><![endif]--> <svg aria-hidden="true" class="fi-icon-btn-icon h-6 w-6" data-slot="icon"
                    fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg><!--[if ENDBLOCK]><![endif]-->

                <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->

                <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->
            </button>
            <!--[if ENDBLOCK]><![endif]-->
        </div>
        <!--[if ENDBLOCK]><![endif]-->

        <!--[if BLOCK]><![endif]--> <!--[if BLOCK]><![endif]-->
        <div class="mb-5 flex items-center justify-center">
            <div class="fi-color-custom fi-color-danger rounded-full bg-custom-100 p-3 dark:bg-custom-500/20"
                style="--c-100:var(--danger-100);--c-400:var(--danger-400);--c-500:var(--danger-500);--c-600:var(--danger-600);">
                <!--[if BLOCK]><![endif]--> <svg aria-hidden="true"
                    class="fi-modal-icon h-6 w-6 text-custom-600 dark:text-custom-400" data-slot="icon" fill="none"
                    stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"
                        stroke-linecap="round" stroke-linejoin="round"></path>
                </svg><!--[if ENDBLOCK]><![endif]-->
            </div>
        </div>
        <!--[if ENDBLOCK]><![endif]-->

        <div class="text-center">
            <h2 class="fi-modal-heading text-base font-semibold leading-6 text-gray-950 dark:text-white">
                Delete Ut nesciunt nemo aliquam.
            </h2>

            <!--[if BLOCK]><![endif]-->
            <p class="fi-modal-description mt-2 text-sm text-gray-500 dark:text-gray-400">
                Are you sure you would like to do this?
            </p>
            <!--[if ENDBLOCK]><![endif]-->
        </div>
        <!--[if ENDBLOCK]><![endif]-->
    </div>
    <!--[if ENDBLOCK]><![endif]-->

    <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->

    <!--[if BLOCK]><![endif]-->
    <div class="fi-modal-footer mt-6 w-full px-6 pb-6">
        <!--[if BLOCK]><![endif]-->
        <div
            class="fi-modal-footer-actions flex flex-col-reverse gap-3 sm:grid sm:grid-cols-[repeat(auto-fit,minmax(0,1fr))]">
            <!--[if BLOCK]><![endif]--> <!--[if BLOCK]><![endif]-->
            <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->

            <button
                class="fi-btn fi-btn-color-gray fi-color-gray fi-size-md fi-btn-size-md fi-ac-action fi-ac-btn-action relative inline-grid grid-flow-col items-center justify-center gap-1.5 rounded-lg bg-white px-3 py-2 text-sm font-semibold text-gray-950 shadow-sm outline-none ring-1 ring-gray-950/10 transition duration-75 hover:bg-gray-50 focus-visible:ring-2 dark:bg-white/5 dark:text-white dark:ring-white/20 dark:hover:bg-white/10"
                style=";" type="button" wire:loading.attr="disabled" x-on:click="close()">
                <!--[if BLOCK]><![endif]--> <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->

                <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->

                <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->
                <!--[if ENDBLOCK]><![endif]-->

                <span class="fi-btn-label">
                    Cancel
                </span>

                <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->

                <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->

                <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->
            </button>

            <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->

            <button
                class="fi-btn fi-color-custom fi-btn-color-danger fi-color-danger fi-size-md fi-btn-size-md fi-ac-action fi-ac-btn-action relative inline-grid grid-flow-col items-center justify-center gap-1.5 rounded-lg bg-custom-600 px-3 py-2 text-sm font-semibold text-white shadow-sm outline-none transition duration-75 hover:bg-custom-500 focus-visible:ring-2 focus-visible:ring-custom-500/50 dark:bg-custom-500 dark:hover:bg-custom-400 dark:focus-visible:ring-custom-400/50"
                style="--c-400:var(--danger-400);--c-500:var(--danger-500);--c-600:var(--danger-600);" type="submit"
                wire:loading.attr="disabled" x-bind:class="{ 'enabled:opacity-70 enabled:cursor-wait': isProcessing }"
                x-bind:disabled="isProcessing" x-data="{
                    form: null,
                    isProcessing: false,
                    processingMessage: null,
                }" x-init="form = $el.closest('form')

                form?.addEventListener('form-processing-started', (event) => {
                    isProcessing = true
                    processingMessage = event.detail.message
                })

                form?.addEventListener('form-processing-finished', () => {
                    isProcessing = false
                })">
                <!--[if BLOCK]><![endif]--> <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->

                <!--[if BLOCK]><![endif]--> <svg
                    class="fi-btn-icon h-5 w-5 animate-spin text-white transition duration-75" fill="none"
                    viewBox="0 0 24 24" wire:loading.delay.default="" wire:target="callMountedTableAction"
                    xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd"
                        d="M12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                        fill-rule="evenodd" fill="currentColor" opacity="0.2"></path>
                    <path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z" fill="currentColor"></path>
                </svg>
                <!--[if ENDBLOCK]><![endif]-->

                <!--[if BLOCK]><![endif]--> <svg
                    class="fi-btn-icon h-5 w-5 animate-spin text-white transition duration-75" fill="none"
                    style="display: none;" viewBox="0 0 24 24" x-show="isProcessing" xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd"
                        d="M12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                        fill-rule="evenodd" fill="currentColor" opacity="0.2"></path>
                    <path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z" fill="currentColor"></path>
                </svg>
                <!--[if ENDBLOCK]><![endif]-->
                <!--[if ENDBLOCK]><![endif]-->

                <span class="fi-btn-label" x-show="! isProcessing">
                    Confirm
                </span>

                <!--[if BLOCK]><![endif]--> <span class="fi-btn-label" style="display: none;" x-show="isProcessing"
                    x-text="processingMessage"></span>
                <!--[if ENDBLOCK]><![endif]-->

                <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->

                <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->
            </button>

            <!--[if ENDBLOCK]><![endif]-->
            <!--[if ENDBLOCK]><![endif]-->
        </div>
        <!--[if ENDBLOCK]><![endif]-->
    </div>
    <!--[if ENDBLOCK]><![endif]-->
</div>
