<?php

/**
 *
 * PHP version 5
 *
 * Created: 3/18/19, 12:42 PM
 *
 * LICENSE:
 *
 * @author         Jeff Behnke <code@validwebs.com>
 * @copyright  (c) 2019 ValidWebs.com
 *
 * mormvc
 * empty.php
 */


?>
	<p>
		The following Document files (.md) are <strong>empty</strong> and should be updated.
	</p>

<?php

if ( isset( $scheme['empty'] ) && sizeof( $scheme['empty'] ) ) {

	echo '<ol>';
	foreach ( $scheme['empty'] as $slug => $item ) {

		if(isset($item['path'])) {
			echo '<li>' . $item['path'] . '</li>';
		} else {
			// This should not happen.
			echo '<li>Missing Path</li>';
		}
	}
	echo '</ol>';
}

?>