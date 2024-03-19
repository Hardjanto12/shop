/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js"
    ],
    theme: {
        extend: {
            fontFamily:{
                'main': ["Roboto", 'sans-serif'],
              },
            colors: {
                'theme-dark' : '#201610',
                'theme-pink' : '#ee3453',
                'theme-white' : '#ffffff',
                'theme-neutral' : '#5b3e2e',
                'theme-secondary-white' : '#f8f8f8',
              },
        },
    },
    plugins: [
        require('flowbite/plugin')
    ],
};
