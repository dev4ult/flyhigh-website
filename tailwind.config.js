/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./public/**/*.{html,js,php}'],
  theme: {
    extend: {
      fontFamily: {
        archivo: 'Archivo',
      },
    },
  },
  plugins: [require('daisyui')],
};
