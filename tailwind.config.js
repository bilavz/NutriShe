const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        // './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        // './storage/framework/views/*.php',
        // './resources/views/**/*.blade.php',
        './storage/framework/views/**/*.{php,js}',
        './resources/views/**/*.{php,js}',
        './app/**/*.{php,js}',
        './src/**/*.{php,js}',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                customOrange: '#EA7F59',
            }
            }
        },
    };

    // plugins: [require('@tailwindcss/forms')]
// };
