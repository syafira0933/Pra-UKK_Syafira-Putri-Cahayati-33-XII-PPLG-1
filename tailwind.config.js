import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './app/**/*.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                coklat: {
                    DEFAULT: '#7A4B2A',
                    dark: '#4A2E1F',
                    light: '#9C6A43',
                    hover: '#643C20',
                },
                krem: {
                    DEFAULT: '#F4ECE1',
                    light: '#FAF6F0',
                    dark: '#E2D1BD',
                },
                gading: '#FCFAF7',
                emas: {
                    DEFAULT: '#C5A059',
                    light: '#E6C987',
                },
            },
        },
    },

    plugins: [forms],
};
