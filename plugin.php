<?php
/**
 * Plugin Name: Admin Lazy Loader
 * Description: Lazy load for the WordPress admin panel.
 * Version: 1.0.0-alpha
 * Author: Pierre Gordon
 * Text Domain: admin-lazy-load
 */

namespace Pierlo\AdminLazyLoad;

// Support for site-level autoloading.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
}

$plugin = new AdminLazyLoadPlugin( new Plugin( __FILE__ ) );

add_action( 'plugins_loaded', [ $plugin, 'init' ] );
