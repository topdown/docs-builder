<?php

/**
 *
 * PHP version 5
 *
 * Created: 3/17/19, 1:45 PM
 *
 * LICENSE:
 *
 * @author         Jeff Behnke <code@validwebs.com>
 * @copyright  (c) 2019 ValidWebs.com
 *
 * mormvc
 * body.php
 */

$keys = array_keys( $scheme );
$i    = array_search( $key, $keys );

$home = array_keys( $keys, 'home' );

if ( in_array( 'home', $keys ) ) {
	if ( isset( $home[0] ) ) {
		// Remove the home slug.
		unset( $keys[ $home[0] ] );
		// Renumber the array
		$keys = array_values( $keys );
	}
}

// If we are on home we need the first key.
if ( empty( $key ) ) {
	$next_key = ( isset( $keys[0] ) ) ? $keys[0] : null;
} else {
	$next_key = ( isset( $keys[ $i + 1 ] ) ) ? $keys[ $i + 1 ] : null;
}

$prev_key = ( isset( $keys[ $i - 1 ] ) ) ? $keys[ $i - 1 ] : null;

if ( ! is_null( $prev_key ) ) { ?>
	<a class="previous-link" title="Previous" href="?doc=<?php echo $prev_key; ?>"><span class="previous-link"><i class="fa fa-chevron-left"></i></span></a>
	<?php
}

if ( ! is_null( $next_key ) && $next_key !== 'empty' ) {
	?>
	<a class="next-link" title="Next" href="?doc=<?php echo $next_key; ?>"><span class="next-link"><i class="fa fa-chevron-right"></i></span></a>
	<?php
	// If we are on the last doc key go to empty if it exists.
} elseif ( ! is_null( $next_key ) && $next_key === 'empty' ) {
	?>
	<a class="next-link" title="Next" href="?page=empty"><span class="next-link"><i class="fa fa-chevron-right"></i></span></a>
	<?php
}

if ( ! file_exists( $file ) ) {
	$title = '404 Not Found';
} else {
	$title = ucwords( str_replace( '_', ' ', $file_name ) );
}
if ( empty( $title ) ) {
	$title = 'Home';
}
?>

<div class="column is-9">
	<div class="content is-medium body-content-container">
		<div class="level">
			<div class="level-left">
				<div class="level-item">
					<h3 class="title is-3">
						<i class="is-small fas fa-code"></i> <?php echo db_page_title( $title ); ?>
					</h3>
				</div>
			</div>

			<div class="level-right">
				<div class="level-item">

				</div>
			</div>
		</div>

		<?php if ( isset( $scheme[ $file_slug ] ) && isset( $scheme[ $file_slug ]['origin'] ) ) { ?>
			<div class="box">
				<div class="level">
					<div class="level-left">
						<div class="level-item">
							<div class="control">
								<div class="tags has-addons">
									<span class="tag is-dark">Path </span>
									<span class="tag is-info"><?php echo $scheme[ $file_slug ]['origin'] ?></span>
								</div>
							</div>
						</div>
					</div>
					<div class="level-right">
						<div class="level-item">
							<div class="control is-pulled-right ">
								<div class="tags has-addons">
									<span class="tag is-dark">Size </span>
									<span class="tag is-info"><?php echo $scheme[ $file_slug ]['size'] ?></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>

		<div class="box body-content">

			<?php
			if ( file_exists( $file ) ) {
				include_once $file;
			} else {
				include_once 'views/404.php';
			}
			?>
		</div>

		<!--<div class="box next-prev-nav">
			<nav class="pagination is-rounded" role="navigation" aria-label="pagination">

			</nav>
		</div>-->


	</div>
</div>

<!--<h4 id="const" class="title is-3">const</h4>
<article class="message is-primary">
	<span class="icon has-text-primary"> <i class="fab fa-js"></i> </span>
	<div class="message-body">
		Block-scoped. Cannot be re-assigned. Not immutable.
	</div>
</article>
<pre><code class="language-javascript">const test = 'test';</code></pre>
</div>
<div class="box">
<h4 id="let" class="title is-3">let</h4>
<article class="message is-primary">
	<span class="icon has-text-primary"> <i class="fas fa-info-circle"></i> </span>
	<div class="message-body">
		Block-scoped. Can be re-assigned.
	</div>
</article>
<pre><code class="language-javascript">let i = 0;</code></pre>
</div>

<h3 class="title is-3">More to Come...</h3>

<div class="box">
<h4 id="lorem" class="title is-4">More to come...</h4>
<article class="message is-primary">
	<span class="icon has-text-primary"> <i class="fas fa-info-circle"></i> </span>
	<div class="message-body">
		Lorem ipsum dolor sit amet, mea ne viderer veritus menandri, id scaevola gloriatur instructior sit.
	</div>
</article>
<pre><code class="language-javascript">let i = 0;</code></pre>
</div>-->


