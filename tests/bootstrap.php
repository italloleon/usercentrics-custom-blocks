<?php

/**
 * Bootstrap the plugin unit testing environment.
 */

// First, we need to load the composer autoloader so we can use WP_Mock and other dependencies
require_once dirname(__DIR__) . '/vendor/autoload.php';

if (!class_exists('WP_Mock\Tools\TestCase')) {
    throw new Exception('WP_Mock is not loaded. Make sure you run composer install.');
}

// Now call WP_Mock setup function
\WP_Mock::setUsePatchwork(true);
\WP_Mock::bootstrap();
