const path = require('path')
const ExtractTextPlugin = require('extract-text-webpack-plugin')
const WebpackAssetsManifest = require('webpack-assets-manifest')
const webpack = require('webpack')

module.exports = ({
	prod = false
} = {}) => {
	return {
		entry: {
			app: ['./resources/assets/js/app.js', './resources/assets/sass/app.scss']
		},
		output: {
			filename: prod ? '[name].[chunkhash].js' : '[name].js',
			path: path.resolve(__dirname, './public/build'),
			publicPath: '/build/',
			chunkFilename: prod ? '[name].[id].[chunkhash].js' : '[name].[id].js'
		},
		resolve: {
			alias: {
				// Include template compiler
				vue$: 'vue/dist/vue.esm.js'
			},
			extensions: [".js", ".vue"]
		},
		module: {
			rules: [
				{ // vue files
					test: /\.vue$/,
					loader: 'vue-loader'
				},
				{ // JS
					test: /\.js$/,
					exclude: /node_modules/,
					loader: 'babel-loader'
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
			new webpack.DefinePlugin({
				'typeof window': JSON.stringify('object'),
				'process.env': {
					NODE_ENV: JSON.stringify(prod ? 'production' : 'development')
				}
			})
		]).concat(prod ? [
			// Production Plugins
			new WebpackAssetsManifest({
				output: '../mix-manifest.json',
				publicPath: true,
				customize(key, value, originalValue, manifest) {
					return {
						key: manifest.getPublicPath(key),
						value
					}
				}
			})
		] : [
			// Development Plugins
		])
	}
}
