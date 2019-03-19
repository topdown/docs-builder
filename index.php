<?php

if ( file_exists( 'config.php' ) ) {
	include_once 'config.php';
} else {
	die( "\nYou are missing the config.php please create one.\nSee the example-config.php\n\n" );
}

include_once 'views/header.php';
?>

	<section class="section">
		<div class="container">
			<div class="columns">
				<?php include_once 'views/sidebar.php' ?>

				<?php include_once 'views/body.php' ?>
			</div>
		</div>
	</section>
<?php include_once 'views/footer.php' ?>