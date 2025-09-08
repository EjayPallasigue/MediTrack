/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
    './storage/framework/views/*.php',
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
  ],
  theme: {
    extend: {
      colors: {
        brand: '#B54C3D',
        'brand-dark': '#7A2F25',
        'brand-accent': '#D36B5B',
      },
    },
  },
  plugins: [],
}

