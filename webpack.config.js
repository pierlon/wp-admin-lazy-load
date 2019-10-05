/**
 * External dependencies
 */
const { BundleAnalyzerPlugin } = require( 'webpack-bundle-analyzer' );
const LiveReloadPlugin = require( 'webpack-livereload-plugin' );
const path = require( 'path' );

/**
 * WordPress dependencies
 */
const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );

const isProduction = process.env.NODE_ENV === 'production';

module.exports = {
	...defaultConfig,
	entry: {
		index: './js/src/index.js',
	},
	output: {
		path: path.resolve( __dirname, 'js/dist' ),
		filename: '[name].js',
	},
	plugins: [
		// WP_BUNDLE_ANALYZER global variable enables utility that represents bundle content
		// as convenient interactive zoomable treemap.
		process.env.WP_BUNDLE_ANALYZER && new BundleAnalyzerPlugin(),
		// WP_LIVE_RELOAD_PORT global variable changes port on which live reload works
		// when running watch mode.
		! isProduction && new LiveReloadPlugin( { port: process.env.WP_LIVE_RELOAD_PORT || 35729 } ),
	].filter( Boolean ),
};
