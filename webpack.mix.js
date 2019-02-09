const path = require('path')
const mix = require('laravel-mix')
require('laravel-mix-svg-sprite')

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

mix.js(['resources/js/polyfill.js', 'resources/js/app.js'], 'public/build/app.js')
mix.sass('resources/sass/app.scss', 'public/build')
	.options({
		postCss: [
			require('postcss-flexbugs-fixes')
		]
	})
mix.copyDirectory('resources/img', 'public/build/images')
const svgFontsPath = 'node_modules/@fortawesome/fontawesome-free/svgs'
mix.svgSprite(svgFontsPath, 'build/icons.svg')
// resources/icons is added later
mix.version(['public/build/images'])

mix.setPublicPath('public')
mix.version()
mix.extract()
mix.options({
	fileLoaderDirs: {
		images: 'build/images',
		fonts: 'build/fonts'
	},
	babelConfig: {
		presets: [
			[
				'@babel/preset-env',
				{
					modules: false,
					useBuiltIns: 'usage'
				}
			]
		]
	},
	postCss: [
		require('postcss-flexbugs-fixes')()
	]
})

Mix.listen('init', () => {
	// make sure called absolutely last
	Mix.listen('configReady', config => {
		// No compiler needed
		delete config.resolve.alias['vue$']

		// Add resources/icons to svg-sprite
		const svgFontsFullPath = path.resolve(Mix.paths.rootPath, svgFontsPath)
		const extraSVGPaths = [
			path.resolve(Mix.paths.rootPath, 'resources/icons')
		]
		config.module.rules.forEach(rule => {
			if (rule.include && Array.isArray(rule.include) && rule.include.includes(svgFontsFullPath)) {
				rule.include.push(...extraSVGPaths)
			}
			if (rule.exclude && Array.isArray(rule.exclude) && rule.exclude.includes(svgFontsFullPath)) {
				rule.exclude.push(...extraSVGPaths)
			}
		})
	})
})
