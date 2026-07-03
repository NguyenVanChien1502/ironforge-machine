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
                    DEFAULT: '#0F2A2E',
                    light: '#1A4045',
                },
                gold: {
                    DEFAULT: '#B08A4E',
                    dark: '#8C6C3B',
                },
            },
            fontFamily: {
                sans: ['Inter', 'ui-sans-serif', 'system-ui'],
                heading: ['Montserrat', 'sans-serif'],
                stats: ['Manrope', 'sans-serif'],
            },
            boxShadow: {
                premium: '0 20px 40px -15px rgba(15, 42, 46, 0.25)',
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
}
