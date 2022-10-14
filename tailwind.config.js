/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    fontFamily: {
      'serif': ['Ogg', 'serif'],
      'sans': ['HelveticaNeue', 'sans-serif'],
    },
    fontSize: {
      '22': '22px',
      '30': '30px',
      '32': '32px',
      '36': '36px',
      '60': '60px',
      '80': '80px',
      '130': '130px'
    },
    colors: {
      'green': 'var(--color-green)',
      'light-green': 'var(--color-light-green)',
      'dark-green': 'var(--color-dark-green)',
      'black': 'var(--color-black)',
      'gray': 'var(--color-gray)',
      'white': 'var(--color-white)',
    },
    width: {
      '1/12': '8.333333%',
      '2/12': '16.666667%',
      '3/12': '25%',
      '4/12': '33.333333%',
      '5/12': '41.666667%',
      '6/12': '50%',
      '7/12': '58.333333%',
      '8/12': '66.666667%',
      '9/12': '75%',
      '10/12': '83.333333%',
      '11/12': '91.666667%',
      'full': '100%',
      'screen': '100vw',
    },
    height: {
      'full': '100%',
      'screen': '100vh',
    },
    extend: {
      padding: {
        '40': '40px',
        '60': '60px',
        'container': '50px'
      },
      margin: {
        '25': '25px',
        '50': '50px',
        '60': '60px',
        '130': '130px',
        '170': '170px',
        'container': '50px'
      },
    },
  },
  plugins: [],
}
