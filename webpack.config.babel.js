import path from 'path'

import ExtractTextPlugin from 'extract-text-webpack-plugin'
import ManifestPlugin from 'webpack-manifest-plugin'
import webpack from 'webpack'

export default function ({
	prod = false
} = {}) {
	return {
		entry: {
			app: ['./resources/assets/js/app.js', './resources/assets/sass/app.scss']
		},
		output: {
			filename: prod ? '[name].[chunkhash].bundle.js' : '[name].js',
			path: path.resolve(__dirname, './public/assets'),
			publicPath: '/assets/',
			chunkFilename: prod ? '[name].[id].[chunkhash].js' : '[name].[id].js'
		},
		resolve: {
			alias: {
				// Latest jQuery
				jquery: require.resolve('jquery'),
				// Include template compiler
				vue: 'vue/dist/vue.js'
			}
		},
		module: {
			rules: [
				{
					test: /\.vue$/,
					loader: 'vue'
				},
				{
					// JS
					test: /\.js$/,
					exclude: /node_modules/,
					loader: 'babel'
				},
				{
					// Sass
					test: /\.scss$/,
					// Disable sass minification so css-loader handles it
					loader: ExtractTextPlugin.extract([
						'css',
						'postcss',
						{
							loader: 'sass',
							query: {
								outputStyle: 'nested'
							}
						}
					])
				},
				{
					// Images and other shenaniganiganidingdongs
					test: /\.(png|jpe?g|gif|svg|woff2?|eot|ttf|otf)(\?.*)?$/,
					loader: 'url',
					query: {
						limit: 10000,
						name: prod ? '[name].[hash:7].[ext]' : '[name].[ext]'
					}
				},
				{
					test: /\.js$/,
					exclude: /foundation\.core\.js$/,
					include: path.resolve(__dirname, 'node_modules/foundation-sites'),
					loaders: [
						{
							loader: 'imports',
							query: {
								jQuery: 'jquery',
								Foundation: 'foundation-sites/js/foundation.core'
							}
						},
						'babel'
					]
				},
				{
					test: /foundation\.core\.js$/,
					include: path.resolve(__dirname, 'node_modules/foundation-sites'),
					loaders: [
						{
							loader: 'imports',
							query: {
								jQuery: 'jquery'
							}
						},
						{
							loader: 'exports',
							query: 'window.Foundation'
						},
						'babel'
					]
				}
			]
		},
		plugins: ([
			// Global Plugins
			new webpack.LoaderOptionsPlugin({
				options: {
					babel: {
						presets: [
							['latest', {
								es2015: {modules: false}
							}]
						],
						plugins: ['transform-runtime']
					},
					postcss: () => {
						return [
							require('postcss-flexbugs-fixes')
						]
					}
				}
			}),
			new ExtractTextPlugin(prod ? '[name].[contenthash].css' : '[name].css')
		]).concat(prod ? [
			// Production Plugins
		] : [
			// Development Plugins
		])
	}
}
