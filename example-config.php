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
define( 'DOCS_NAME', 'mORMvc' );

define( 'STRIP_FROM_TITLES', array( 'Readme', 'ReadMe', 'README' ) );

// Below here is only used for generating
define( 'DB_SKIP_PATHS', array(
	basename( realpath( __DIR__ ) ), // This one makes sure that this generators readme is skipped.
	'vendor',
	'node_modules',
	'bower_components',
	'OLD',
	'old',
	'notify',
	'indemna'
) );
define( 'DB_TRIM_PATH', '/Users/jeff/www/mormvc/' );

/**
 * Clean text from titles if you so choose.
 * This affects navigation link names and page titles.
 *
 * @author         Jeff Behnke <code@validwebs.com>
 * @copyright  (c) 2009 - 2019 ValidWebs.com
 *
 * Created:     2019-04-03, 19:16
 *
 * @param $title
 *
 * @return mixed
 */
function db_page_title( $title ) {

	if ( defined( 'STRIP_FROM_TITLES' ) && is_array( STRIP_FROM_TITLES ) ) {

		foreach ( STRIP_FROM_TITLES as $str ) {
			// Don't strip if the only text is Readme
			if ( strtolower( $title ) !== 'readme.md' && strtolower( $title ) !== 'readme' ) {
				$title = str_replace( $str, '', $title );
			}
		}
	}

	return str_replace(array('.md', '.MD'), '', $title);
}

// End config-example.php
