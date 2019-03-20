<?php

/**
 *
 * PHP version 5
 *
 * Created: 3/17/19, 10:04 AM
 *
 * LICENSE:
 *
 * @author         Jeff Behnke <code@validwebs.com>
 * @copyright  (c) 2019 ValidWebs.com
 *
 *
 * collect.php
 */

// Only command line
if ( php_sapi_name() == 'cli' ) {

	if ( file_exists( 'config.php' ) ) {
		include_once 'config.php';
	} else {
		die( "\nYou are missing the config.php please create one.\nSee the example-config.php\n\n" );
	}

	include_once 'functions.php';

	include_once 'vendor/autoload.php';

	echo "\nRunning setup/cleanup.\n";

	$build_path = 'build';

	cli_create_dir( $build_path );

	if ( ! dir( $build_path ) ) {
		fwrite( STDERR, "[ ERROR ]: The build path does not exist. $build_path \n" );
		die( 'Please create it and chmod to 777' );
	}

		$name      = DOCS_NAME;
		$slug      = cli_clean_slug( $name );
		$full_path = $build_path . '/' . $slug;

		// We can't use the function because it will create and index that cp can't overwrite later.
		if(! is_dir($full_path)) {
			shell_exec("mkdir $full_path");
		}

		cli_create_dir( $full_path . '/templates' );
		cli_create_dir( $full_path . '/views' );
		cli_create_dir( $full_path . '/src' );
		//cli_create_dir( $full_path . '/vendor' );

		define( 'DB_BUILD_PATH', $full_path );

		fwrite( STDOUT, "Build Path: $full_path/ \n\n" );

		cli_lines( 'Collection Starting' );

		cli_generate_docs( true );

		cli_lines( 'Copying required files to build path.' );
		shell_exec( "cp -a views/. $full_path/views/" );
		shell_exec( "cp -a src/. $full_path/src/" );
		//shell_exec( "cp -a vendor/. $full_path/vendor/" );
		shell_exec( "cp index.php $full_path/index.php" );
		shell_exec( "cp config.php $full_path/config.php" );

		cli_lines( 'Generation Completed.' );
		exit;

} else {
	die( 'This is a command line tool only.<br />Please to the provided documentation on the home page.' );
}
// End collect.php