<?php

/**
 *
 * PHP version 5
 *
 * Created: 3/19/19, 1:32 PM
 *
 * LICENSE:
 *
 * @author         Jeff Behnke <code@validwebs.com>
 * @copyright  (c) 2019 ValidWebs.com
 *
 * mormvc
 * functions.php
 */

/**
 *
 *
 * @author         Jeff Behnke <code@validwebs.com>
 * @copyright  (c) 2019 ValidWebs.com
 *
 * Created:    3/19/19, 2:00 PM
 *
 * @param $name
 *
 * @return mixed
 */
function cli_clean_slug( $name ) {
	return strtolower( str_replace( ' ', '_', $name ) );
}


/**
 *
 *
 * @author         Jeff Behnke <code@validwebs.com>
 * @copyright  (c) 2019 ValidWebs.com
 *
 * Created:    3/19/19, 1:59 PM
 *
 * @param $path
 */
function cli_create_dir( $path ) {

	if ( ! is_dir( $path ) ) {
		shell_exec( "mkdir -p $path" );
		shell_exec( "chmod 777 $path" );
		shell_exec( "touch $path/index.php" );
	}
}

/**
 * This function creates a full CLI command suite with
 * command arg="" --option="" -flags
 *
 * @author         Jeff Behnke <code@validwebs.com>
 * @copyright  (c) 2019 ValidWebs.com
 *
 * Created:    3/19/19, 1:53 PM
 *
 * @param $args
 *
 * @return array
 */
function cli_args_parser( $args ) {

	array_shift( $args );
	$endofoptions = false;

	$ret = array(
		'commands'  => array(),
		'options'   => array(),
		'flags'     => array(),
		'arguments' => array(),
	);

	while ( $arg = array_shift( $args ) ) {

		// if we have reached end of options,
		//we cast all remaining argvs as arguments
		if ( $endofoptions ) {
			$ret['arguments'][] = $arg;
			continue;
		}

		/**
		 * -------------------------------------------
		 * OPTIONS
		 * -------------------------------------------
		 * Is it a command? (prefixed with --)
		 */
		if ( substr( $arg, 0, 2 ) === '--' ) {

			// is it the end of options flag?
			if ( ! isset ( $arg[3] ) ) {
				$endofoptions = true; // end of options;
				continue;
			}

			$value = "";
			$com   = substr( $arg, 2 );

			// is it the syntax '--option=argument'?
			if ( strpos( $com, '=' ) ) {

				list( $com, $value ) = preg_split( "/=/", $com, 2 );

			} // is the option not followed by another option but by arguments
			elseif ( isset( $args[0] ) && strpos( $args[0], '-' ) !== 0 ) {

				// --word  with no =value creates an indefinate loop of errors.
				// This check fixes that.
				if ( isset( $args[0] ) ) {

					while ( strpos( $args[0], '-' ) !== 0 ) {
						$value .= array_shift( $args ) . ' ';
					}

					$value = rtrim( $value, ' ' );
				}
			}

			$ret['options'][ $com ] = ! empty( $value ) ? $value : true;
			continue;

		}

		/**
		 * -------------------------------------------
		 * FLAGS
		 * -------------------------------------------
		 * Is it a flag or a serial of flags? (prefixed with -)
		 */
		if ( substr( $arg, 0, 1 ) === '-' ) {

			for ( $i = 1; isset( $arg[ $i ] ); $i ++ ) {
				$ret['flags'][] = trim( $arg[ $i ] );
			}

			continue;
		}

		/**
		 * -------------------------------------------
		 * ARGUMENTS
		 * -------------------------------------------
		 * If it has an = but is not in quotes, its arguments.
		 */
		if ( strpos( $arg, '=' ) !== false ) {

			$part = explode( '=', $arg );

			if ( isset( $part[0] ) && isset( $part[1] ) && $part[1] != '' ) {
				$ret['arguments'][ trim( $part[0] ) ] = trim( $part[1] );
			} else {
				$ret['arguments'][] = trim( $arg );
			}

			continue;
		}

		/**
		 * -------------------------------------------
		 * COMMANDS
		 * -------------------------------------------
		 * finally, it is not option, nor flag, nor argument
		 */
		$ret['commands'][] = $arg;
		continue;
	}

	// We need this??
	//	if ( ! count( $ret['options'] ) && ! count( $ret['flags'] ) ) {
	//		$ret['arguments'] = array_merge( $ret['commands'], $ret['arguments'] );
	//		$ret['commands']  = array();
	//	}

	return $ret;
}

function cli_help() {
	echo '
Usage: php collect.php [command] [options] [-f] <file> [--] [args...]
   php cli.php find -h
   php cli.php debug "Is used as a appended command and outputs all args."
   php cli.php gen OR generate -h
   php cli.php convert -h
';
}


function cli_rsearch( $folder, $pattern_array ) {

	$ignores = DB_SKIP_PATHS;
	$trim    = DB_TRIM_PATH;
	$return  = array();
	$iti     = new RecursiveDirectoryIterator( $folder );

	/** @var RecursiveDirectoryIterator $file */
	foreach ( new RecursiveIteratorIterator( $iti ) as $key => $file ) {

		$skip = false;

		foreach ( $ignores as $ignore ) {
			//if (strstr($string, $url)) { // mine version
			if ( strpos( $file, $ignore ) !== false ) {
				$skip = true;
			}
		}

		if ( $skip === false ) {
			$ext = $file->getExtension();

			if ( in_array( strtolower( $ext ), $pattern_array ) ) {
				$trimmed = str_replace( $trim, '', $file->getRealPath() );

				$return[ $trimmed ] = $file->getRealPath();
			}
		}
	}

	return $return;
}

function cli_lines( $words = '' ) {
	echo "-------------------------------------------------------\n";
	if ( ! empty( $words ) ) {
		fwrite( STDOUT, $words );
		cli_nl();
		echo "-------------------------------------------------------\n";
	}
}

/**
 * Create a new line.
 *
 * @author         Jeff Behnke <code@validwebs.com>
 * @copyright  (c) 2009-17 ValidWebs.com
 *
 * Created:    2/8/18, 10:09 AM
 *
 */
function cli_nl() {
	echo "\n";
}

/**
 *
 *
 * @author         Jeff Behnke <code@validwebs.com>
 * @copyright  (c) 2019 ValidWebs.com
 *
 * Created:    3/19/19, 2:25 PM
 *
 * @param bool $save
 */
function cli_generate_docs( $save = false ) {
	$path    = realpath( '../' );
	$files   = array();
	$results = cli_rsearch( $path, array( 'md' ) );
	//pretty_dump( $results );


	//echo "\n";

	if ( count( $results ) > 0 ) {
		$Parsedown = new ParsedownExtra();

		//echo "\n\n";
		//$tbl = new \Console_Table();
		//		$tbl->setHeaders(
		//			array( 'N', 'Path', 'Slug - $build_path/{slug}.php', 'Size' )
		//		);

		$empty_info = array();
		$empty_rows = array();
		$info       = array();
		$i          = 1;
		$e          = 1;

		foreach ( $results as $key => $file_path ) {

			$bsize = filesize( $file_path );
			// Fix file path for text and linking
			$file_path = str_replace( '../../', '', $file_path );
			$path      = str_replace( DB_TRIM_PATH, '', rtrim( $key, '/' ) );
			$slug      = str_replace( array( '/', '.md' ), array( '_', '' ), $path );
			$name      = trim( ucwords( strtolower( str_replace( '_', ' ', $slug ) ) ) );
			$name      = trim( str_replace( '.md', '', $name ) );
			$slug      = trim( strtolower( $slug ) );

			if ( $bsize !== 0 ) {

				$info[ $slug ]['path'] = trim( $key );
				$info[ $slug ]['slug'] = $slug;
				$info[ $slug ]['name'] = $name;

				$size                  = cli_human_filesize( $bsize );
				$info[ $slug ]['size'] = $size;

				//$tbl->addRow( array( $i ++, $key, $slug, $size ) );

				if ( $save === true ) {

					$markdown = file_get_contents( $file_path );

					$html = $Parsedown->text( $markdown );

					file_put_contents( DB_BUILD_PATH . '/templates/' . strtolower( $slug ) . '.php', $html );
				}
			} else {
				$empty_info[ $slug ]['path'] = trim( $key );
				$empty_info[ $slug ]['slug'] = $slug;
				$empty_info[ $slug ]['name'] = $name;

				$empty_rows[] = array( $e ++, $key, $slug, '0.0B' );
			}
		}

		if ( sizeof( $info ) ) {
			cli_lines( 'Processed (.md) files.' );
			foreach ( $info as $item ) {
				echo '+ ' . $item['path'] . "\n";
			}
		}

		if ( sizeof( $empty_rows ) ) {


			//$tbl->addSeparator();
			//$tbl->addRow( array( '', 'EMPTY FILES', 'EMPTY FILES', '' ) );
			//$tbl->addSeparator();

			cli_lines( 'Empty (.md) files.' );

			foreach ( $empty_info as $empty ) {
				//$tbl->addRow( $empty_row );
				echo $empty['path'] . "\n";
			}
		}

		cli_lines( count( $info ) . ' files processed and ' . count( $empty_info ) . ' files were empty.' );
		//echo $tbl->getTable();

		if ( $save === true ) {
			$info = $info + array( 'empty' => $empty_info );
			file_put_contents( DB_BUILD_PATH . '/templates/scheme.json', json_encode( $info ) );
		}
		//echo "\n\n";
	}
}

function cli_human_filesize( $bytes, $decimals = 1 ) {
	$sz     = 'BKMGTP';
	$factor = floor( ( strlen( $bytes ) - 1 ) / 3 );

	return sprintf( "%.{$decimals}f", $bytes / pow( 1024, $factor ) ) . @$sz[ $factor ];
}

// End functions.php