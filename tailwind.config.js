/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/views/app/**/*.blade.php",
    "./resources/views/auth/**/*.blade.php",
    "./resources/views/vendor/**/*.blade.php",
  ],
  theme: {
    container: {
      center: true,
      padding: {
        DEFAULT: "0.5rem",
        xs: "1rem",
        md: "0",
        lg: "4rem",
        xl: "5rem",
        "2xl": "6rem",
      },
    },
    fontFamily: {
      vazir: ["vazir"],
    },

    extend: {
      screens: {
        xs: "440px",
      },
      colors: {
        primary: "#c69688",
      },
    },
  },
  plugins: [],
}

