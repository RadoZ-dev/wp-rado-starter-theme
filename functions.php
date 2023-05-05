<?php
if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Init theme main class
 */
require get_template_directory(  ) . '/vendor/autoload.php';
use RadoTheme\ThemeInit;
new ThemeInit();



