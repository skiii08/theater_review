import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'custom-primary': '#328cc1',    // メインカラー
                'custom-secondary': '#0b3c5d',  // セカンダリカラー
                'custom-accent': '#d9b310',     // アクセントカラー
                'custom-background': '#f8fafc', // 背景色
                'custom-text': '#1d2731',       // テキスト色
            },
        },
    },

    plugins: [forms],
};