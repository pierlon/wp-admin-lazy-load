<?php

namespace Pierlo\AdminLazyLoadTest;

use WP_Mock\Tools\TestCase as WP_Mock_TestCase;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

/**
 * Our basic test case.
 */
class TestCase extends WP_Mock_TestCase {

	// For marking assertions met.
	use MockeryPHPUnitIntegration;

}
