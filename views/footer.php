<?php

/**
 *
 * PHP version 5
 *
 * Created: 3/17/19, 1:37 PM
 *
 * LICENSE:
 *
 * @author         Jeff Behnke <code@validwebs.com>
 * @copyright  (c) 2019 ValidWebs.com
 *
 * mormvc
 * footer.php
 */
?>
<footer class="footer">

	<?php //include_once 'extras.php'?>
	<hr>

	<div class="columns is-mobile is-centered">
		<div class="field is-grouped is-grouped-multiline">
			<div class="control">
				<div class="tags has-addons">
					<a class="tag is-link" href="https://validwebs.com">ValidWebs</a>
					<span class="tag is-info">&copy;<?php echo date( 'Y' ) ?></span>
				</div>
			</div>

			<?php if ( isset( $scheme['empty'] ) ) { ?>
				<div class="control is-pulled-right ">

					<div class="tags has-addons">
						<span class="tag is-dark">Empty Docs</span>
						<span class="tag is-danger"><?php echo count( $scheme['empty'] ); ?></span>
					</div>

				</div>
			<?php } ?>

			<div class="control is-pulled-right ">
				<div class="tags has-addons">
					<span class="tag is-dark">Documents</span>
					<span class="tag is-success"><?php echo count( $scheme ); ?></span>
				</div>
			</div>
		</div>
	</div>

</footer>
<script src='src/prism.js'></script>
<script>
  window.addEventListener( 'resize', () => {
	  const divs = document.querySelectorAll( ".menu-list" );
	  if ( window.innerWidth < 768 ) {
		  divs.forEach( div => div.classList.add( "tags" ) );
	  }
	  else {
		  divs.forEach( div => div.classList.remove( "tags" ) );
	  }
  } );
</script>
</body>
</html>

