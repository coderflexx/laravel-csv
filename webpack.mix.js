const mix = require('laravel-mix')
const tailwindcss = require('tailwindcss')

mix.setPublicPath('./resources')
    .js('resources/assets/js/app.js', 'resources/dist/js')
    .sass('resources/assets/scss/tailwind.scss', 'resources/dist/css')
    .options({
        postCss: [
            tailwindcss('./tailwind.config.js')
        ],
    })

if (mix.inProduction()) {
    mix.version()
}