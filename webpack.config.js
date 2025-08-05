const path = require("path");

module.exports = {
  mode: "development",
  entry: "./resources/js/main.js",
  output: {
    filename: "main.js",
    path: path.resolve(__dirname, "assets/js"),
  },
  module: {
    rules: [
      // ... other rules
      {
        test: /\.js$/,
        loader: "babel-loader",
      },
    ],
  },
};
