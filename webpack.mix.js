const mix = require('laravel-mix')
const tailwindcss = require('tailwindcss')

mix.js('resources/assets/js/app.js', 'dist/js')
    .sass('resources/assets/scss/tailwind.scss', 'dist/css')
    .options({
        postCss: [
            tailwindcss('./tailwind.config.js')
        ],
    })

if (mix.inProduction()) {
    mix.version()
}