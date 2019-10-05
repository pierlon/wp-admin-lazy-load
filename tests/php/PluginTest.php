<?php

namespace Pierlo\AdminLazyLoadTest;

use WP_Mock;
use Pierlo\AdminLazyLoad\Plugin;

/**
 * Test the WordPress plugin abstraction.
 */
class PluginTest extends TestCase {

	/**
	 * Test the plugin setup.
	 *
	 * @covers \Pierlo\AdminLazyLoad\Plugin::__construct()
	 * @covers \Pierlo\AdminLazyLoad\Plugin::file()
	 * @covers \Pierlo\AdminLazyLoad\Plugin::dir()
	 */
	public function test_plugin_init() {
		WP_Mock::userFunction( 'wp_upload_dir' )
			->once()
			->with( null, false );

		$plugin = new Plugin( '/absolute/path/to/plugin.php' );

		$this->assertEquals( '/absolute/path/to/plugin.php', $plugin->file() );
		$this->assertEquals( '/absolute/path/to', $plugin->dir() );
	}

	/**
	 * Test the plugin setup.
	 *
	 * @covers \Pierlo\AdminLazyLoad\Plugin::basename()
	 */
	public function test_basename() {
		// Is there a way to do this using withArgs() and andReturnValues()?
		$mock = WP_Mock::userFunction( 'plugin_basename' )->twice();

		$mock->with( '/any/random/file.js' )->andReturn( 'plugins/any/random/file.js' );

		$plugin = new Plugin( '/path/to/plugin/file.php' );

		$this->assertEquals(
			'plugins/any/random/file.js',
			$plugin->basename( '/any/random/file.js' ),
			'Asks WP API to return the basename for a file'
		);

		$mock->with( '/path/to/plugin/file.php' )->andReturn( 'plugins/plugin/file.php' );

		$this->assertEquals(
			'plugins/plugin/file.php',
			$plugin->basename(),
			'Defaults to the main plugin file for the basename'
		);
	}

}
