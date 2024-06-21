import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";
import preset from "./vendor/filament/support/tailwind.config.preset";

/** @type {import('tailwindcss').Config} */
export default {
    presets: [preset],
    content: [
        "./app/Filament/**/*.php",
        "./resources/views/filament/**/*.blade.php",
        "./vendor/filament/**/*.blade.php",
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
    },

    safelist: [
        {
            /* We want any bg color class to be generated */
            // pattern: /^bg-\w+-\d{2,3}$/,
            pattern: /bg-(slate|cyan|fuchsia|indigo|green|yellow|red)-(100)/,
        },
        {
            /* We want any bg color class to be generated */
            pattern: /text-(slate|cyan|fuchsia|indigo|green|yellow|red)-(600)/,
        },
    ],

    plugins: [forms, typography],
};
