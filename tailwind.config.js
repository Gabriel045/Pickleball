/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./**.{php,html,js}",
    "./template-parts/*.{php,html,js}",
    "./blocks/*/**.{php,html,js}",
  ],
  theme: {
    extend: {
      fontFamily: {
        Inter: ["Inter", "sans-serif"],
      },

      colors: {
        "berkley-blue": "#0D375E",
        "caribbean-green": "#0D5E5D",
        "mustard-yellow": "#FC0",
        "rich-black": "#0B141D",
      },
      height: {},

      maxWidth: {},
    },
  },
  plugins: [],
};
