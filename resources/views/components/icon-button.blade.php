<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-1 py-1 font-semibold text-xs uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
