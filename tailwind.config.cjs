// tailwind.config.cjs
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
  ],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        primary: '#1E40AF',
        accent:  '#F59E0B',
      },
      fontFamily: {
        sans: ['Tajawal', 'Inter', 'sans-serif'],
      },
      keyframes: {
        'bounce-slow': {
          '0%, 100%': { transform: 'translateY(-5%)' },
          '50%':       { transform: 'translateY(0)'      },
        },
        'pulse-slow': {
          '0%, 100%': { opacity: '1'   },
          '50%':       { opacity: '0.5' },
        },
      },
      animation: {
        'bounce-slow': 'bounce-slow 2s infinite',
        'pulse-slow':  'pulse-slow 2s infinite',
      },
    },
  },
  plugins: [
    'tailwindcss-rtl',

  ],
};
