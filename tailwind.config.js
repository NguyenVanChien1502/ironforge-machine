/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],
    theme: {
        extend: {
            colors: {
                charcoal: {
                    DEFAULT: '#111827',
                    light: '#1f2937',
                },
                gold: {
                    DEFAULT: '#F59E0B',
                    dark: '#B45309',
                },
            },
            fontFamily: {
                sans: ['Inter', 'ui-sans-serif', 'system-ui'],
            },
            boxShadow: {
                premium: '0 20px 40px -15px rgba(17, 24, 39, 0.25)',
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
}
