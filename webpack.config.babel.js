import path from 'path'

import ExtractTextPlugin from 'extract-text-webpack-plugin'
import ManifestPlugin from 'webpack-manifest-plugin'
import webpack from 'webpack'

const babelSettings = {
	babelrc: false,
	presets: [
		['env', {
			targets: {
				browsers: '> 1%, last 2 versions, Firefox ESR'
			},
			modules: false
		}]
	],
	plugins: ['transform-runtime']
}

const defaultDefine = {
	'typeof window': JSON.stringify('object'),
}

const prodDefine = {
	'process.env.NODE_ENV': 'production'
}

const devDefine = {
	'process.env.NODE_ENV': 'development'
}

export default function ({
	prod = false
} = {}) {
	const define = Object.assign({}, defaultDefine, prod ? prodDefine : devDefine)

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
				// Include template compiler
				vue$: 'vue/dist/vue.js'
			},
			extensions: [".js", ".vue"]
		},
		module: {
			rules: [
				{ // vue files
					test: /\.vue$/,
					loader: 'vue-loader',
					options: {
						loaders: {
							js: [{
								loader: 'babel-loader',
								options: babelSettings
							}]
						}
					}
				},
				{ // JS
					test: /\.js$/,
					exclude: /node_modules/,
					loader: 'babel-loader',
					options: babelSettings
				},
				{ // Sass
					test: /\.scss$/,
					// Disable sass minification so css-loader handles it
					loader: ExtractTextPlugin.extract([
						'css-loader',
						'postcss-loader',
						{
							loader: 'sass-loader',
							options: {
								outputStyle: 'nested'
							}
						}
					])
				},
				{ // Images and other shenaniganiganidingdongs
					test: /\.(png|jpe?g|gif|svg|woff2?|eot|ttf|otf)(\?.*)?$/,
					loader: 'url',
					options: {
						limit: 10000,
						name: prod ? '[name].[hash:7].[ext]' : '[name].[ext]'
					}
				}
			]
		},
		devtool: prod ? '' : 'cheap-module-eval-source-map',
		plugins: ([
			// Global Plugins
			new ExtractTextPlugin(prod ? '[name].[contenthash].css' : '[name].css'),
			new webpack.DefinePlugin(define),
			new webpack.NormalModuleReplacementPlugin(/^he$/, path.resolve(__dirname, 'resources/assets/js/_hack_for_he.js'))
		]).concat(prod ? [
			// Production Plugins
		] : [
			// Development Plugins
		])
	}
}
