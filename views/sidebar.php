<?php

/**
 *
 * PHP version 5
 *
 * Created: 3/17/19, 1:42 PM
 *
 * LICENSE:
 *
 * @author         Jeff Behnke <code@validwebs.com>
 * @copyright  (c) 2019 ValidWebs.com
 *
 * mormvc
 * navigation.php
 */
?>
<div class="column is-3">
	<aside class="is-medium menu">
		<p class="menu-label">
			Navigation
		</p>

		<div class="field">
			<div class="control">
				<div class="level">
					<div class="level-item">
						<input class="input live-filter" type="text" placeholder="Search Navigation">
						&nbsp; <span class="tag is-dark found-items">0</span>
					</div>

				</div>
			</div>
		</div>

		<ul class="menu-list">
			<?php if ( empty( $active ) && ! isset( $_REQUEST['page'] ) ) { ?>
				<li><a href="./" class="is-active"> Home</a></li>
			<?php } else { ?>
				<li><a href="./" class=""> Home</a></li>
				<?php
			}

			if ( isset( $scheme['empty'] ) && sizeof( $scheme['empty'] ) ) { ?>
				<li><a href="?page=empty" class="is-danger"> Empty Docs
						<span class="tag is-pulled-right"><?php echo count( $scheme['empty'] ); ?></span></a>
				</li>
				<?php
			}

			if ( sizeof( $scheme ) ) {

				foreach ( (array) $scheme as $item ) {
					if ( isset( $item['slug'] ) && $item['slug'] !== 'home' ) {
						if ( $active === $item['slug'] ) {
							echo '<li><a id="' . $item['slug'] . '" href="?doc=' . $item['slug'] . '" class="is-active">' . db_page_title($item['name']) . '</a></li>';
						} else {
							echo '<li><a id="' . $item['slug'] . '" href="?doc=' . $item['slug'] . '" >' . db_page_title($item['name']) . '</a></li>';
						}
					}
				}
			}
			?>
		</ul>

	</aside>
</div>
