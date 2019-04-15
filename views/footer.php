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

	<div class="container">

		<nav class="level">
			<div class="level-item has-text-centered">
				&copy;<?php echo date( 'Y' ) ?> &nbsp; <a class="has-text-dark" target="_blank" style="padding-right: 10px;" href="//validwebs.com">ValidWebs </a>
			</div>


			<?php if ( isset( $scheme['empty'] ) ) { ?>
				<div class="level-item has-text-centered">
					<div class="tags has-addons">
						<span class="tag is-dark">Empty Docs</span>
						<span class="tag is-danger"><?php echo count( $scheme['empty'] ); ?></span>
					</div>
				</div>
			<?php } ?>

			<div class="level-item has-text-centered">
				<div class="tags has-addons">
					<span class="tag is-dark">Documents</span>
					<span class="tag is-success"><?php echo count( $scheme ); ?></span>
				</div>
			</div>


			<div class="level-item has-text-centered">
				<a title="GitHub Repository" target="_blank" class="has-text-dark" href="//github.com/topdown/docs-builder"><i class="fab fa-github fa-2x"></i></a>
			</div>

		</nav>

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

