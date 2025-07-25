/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./**.{php,html,js}",
    "./template-parts/*.{php,html,js}",
    "./blocks/*/**.{php,html,js}",
    "./woocommerce/*/**.{php,html,js}",
    "./inc/*/**.{php,html,js}",
  ],
  theme: {
    extend: {
      fontFamily: {
        Roboto: ["Roboto", "sans-serif"],
        DM_Sans: ["DM_Sans", "sans-serif"],
      },

      colors: {
        "berkley-blue": "#0D375E",
        "caribbean-green": "#0D5E5D",
        "mustard-yellow": "#FC0",
        "rich-black": "#0B141D",
        "gray-paragraph": "#475467",
        "bright-blue": "#5DADF8",
      },
      height: {},

      maxWidth: {},
    },
  },
  plugins: [],
};
