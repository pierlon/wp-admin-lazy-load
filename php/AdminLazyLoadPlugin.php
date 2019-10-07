<?php

namespace Pierlo\AdminLazyLoad;

/**
 * Plugin Router
 */
class AdminLazyLoadPlugin {

	/**
	 * Plugin interface.
	 *
	 * @var Plugin
	 */
	protected $plugin;

	/**
	 * Setup the plugin instance.
	 *
	 * @param Plugin $plugin Instance of the plugin abstraction.
	 */
	public function __construct( $plugin ) {
		$this->plugin = $plugin;
	}

	/**
	 * Hook into WP.
	 *
	 * @return void
	 */
	public function init() {
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
	}

	/**
	 * Transform images on supported pages to support lazyloading on the fly.
	 *
	 * @param string $hook Hook suffix for the current admin page.
	 */
	public function admin_enqueue_scripts( $hook ) {
		// List of pages we support.
		$hooks = array(
			'plugin-install.php',
			'post.php',
			'themes.php',
			'theme-install.php',
			'upload.php',
		);

		// Stop if we don't support this page.
		if ( ! in_array( $hook, $hooks, true ) ) {
			return;
		} elseif ( 'post.php' === $hook ) {
			$is_block_editor = use_block_editor_for_post( get_post() );
			$is_editing = isset( $GLOBALS['action'] ) && 'edit' === $GLOBALS['action'];

			// Only handle when a post is being edited via the Block editor.
			if ( ! ( $is_editing && $is_block_editor ) ) {
				return;
			}
		}

		// Data to be passed to the frontend.
		$data = array(
			'page' => substr( $hook, 0, -4 ),
		);

		if ( 'post.php' === $hook ) {
			$data['page'] .= '-edit-blocks';
		}

		// Automatically load dependencies and version.
		wp_enqueue_script(
			'pierlo-admin-lazy-load-js',
			$this->plugin->asset_url( 'js/dist/index.js' ),
			array(),
			$this->plugin->asset_version(),
			true
		);

		wp_localize_script( 'pierlo-admin-lazy-load-js', 'adminLazyLoad', $data );
	}

}
