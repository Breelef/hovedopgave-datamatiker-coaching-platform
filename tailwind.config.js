import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                libre: ['"Libre Baskerville"', ...defaultTheme.fontFamily.sans],
            },
            fontSize: {
                xxs: "0.65rem",
                xxxs: "0.5rem",
            },
            colors: {
                'sol-over-vestegnen': '#FFD22D',
                'lys-sol-over-vestegnen': '#FFDB57',

                'vestegns-deep-blues': {
                    'light': '#0a2f7e',
                    DEFAULT: '#071F56',
                    'dark': '#05153d',
                },
                'vestegns-blues': '#002C92',
                'vestegns-easy-blues': '#4877DD',
                'sydsiden-cyan': '#01B9FF',
                'clean-sheet-red': '#FF4C4C',
                'dark': '#101010',
                'grey': '#F0F0F0',
                'bright': '#FFFFFF',
            },
        },
    },

    plugins: [forms, typography],
};
