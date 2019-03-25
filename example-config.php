<?php

/**
 *
 * PHP version 5
 *
 * Created: 3/19/19, 11:51 AM
 *
 * LICENSE:
 *
 * @author         Jeff Behnke <code@validwebs.com>
 * @copyright  (c) 2019 ValidWebs.com
 *
 * mormvc
 * config-example.php
 */

// These are only examples

// DOCS_NAME is Required
define( 'DOCS_NAME', 'mORvc' );

// Each crawl will look for an src directory to copy over to the document templates.
// This "should" load images properly that were included in the repo.
define('SRC_DIR', 'src');

// Below here is only used for generating
define( 'DB_SKIP_PATHS', array(
	// The following line makes sure that this generators readme is skipped.
	basename( realpath( __DIR__ ) ),
	'vendor',
	'node_modules',
	'bower_components',
	'OLD',
	'old',
	'notify',
	'indemna'
) );
define( 'DB_TRIM_PATH', '/Users/jeff/www/mormvc/' );

// End config-example.php