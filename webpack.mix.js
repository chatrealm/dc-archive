const mix = require('laravel-mix')

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

mix.js('resources/js/app.js', 'public/build')
mix.sass('resources/sass/app.scss', 'public/build')
	.options({
		postCss: [
			require('postcss-flexbugs-fixes')
		]
	})
mix.copyDirectory('resources/img', 'public/build/images')
mix.version(['public/build/images'])

mix.setPublicPath('public')
mix.version()
mix.extract()
mix.options({
	fileLoaderDirs: {
		images: 'build/images',
		fonts: 'build/fonts'
	}
})
