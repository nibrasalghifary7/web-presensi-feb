/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/views/**/*.blade.php",
    "./resources/js/**/*.js",
  ],
  theme: {
    screens: {
      mq1350: { raw: "screen and (max-width: 1350px)" },
      mq1125: { raw: "screen and (max-width: 1125px)" },
      mq1050: { raw: "screen and (max-width: 1050px)" },
      mq800: { raw: "screen and (max-width: 800px)" },
      mq750: { raw: "screen and (max-width: 750px)" },
      mq450: { raw: "screen and (max-width: 450px)" },
      lg: { raw: "screen and (max-width: 1200px)" },
    },
    extend: {},
  },
  corePlugins: {
    preflight: false,
  },
  plugins: [],
};
