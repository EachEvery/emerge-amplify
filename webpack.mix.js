const mix = require("laravel-mix");
const tailwindcss = require("tailwindcss");
let path = require("path");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

Mix.listen("configReady", function(config) {
    const rules = config.module.rules;
    const targetRegex = /(\.(png|jpe?g|gif)$|^((?!font).)*\.svg$)/;

    for (let rule of rules) {
        if (rule.test.toString() == targetRegex.toString()) {
            rule.exclude = /\.svg$/;
            break;
        }
    }
});

mix.webpackConfig({
    module: {
        rules: [
            {
                test: /\.svg$/,
                use: [
                    {
                        loader: "html-loader",
                        options: {
                            minimize: true
                        }
                    }
                ]
            }
        ]
    }
});

mix.js("resources/js/app.js", "public/js")
    .js("resources/js/emerge/emerge.js", "public/js")
    .sass("resources/sass/app.scss", "public/css")
    .version()
    .options({
        processCssUrls: false,
        postCss: [tailwindcss("./tailwind.js")]
    })
    .webpackConfig({
        resolve: {
            modules: [
                "node_modules",
                path.resolve(__dirname, "resources/js"),
                path.resolve(__dirname, "resources/svg")
            ]
        }
    });
