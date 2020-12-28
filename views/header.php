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
 * header.php
 */

/**
 * Load the scheme file so the system can process pages and data.
 */
if ( file_exists( 'scheme.json' ) ) {
	$scheme = file_get_contents( 'scheme.json' );
	$scheme = json_decode( $scheme, true );
	$active = '';
	if ( isset( $_REQUEST['doc'] ) && ! empty( strip_tags( $_REQUEST['doc'] ) ) ) {
		$active = strip_tags( $_REQUEST['doc'] );
	}
} else {
	$scheme = array();
}

$directory = '';
$url       = ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ? "https" : "http" ) . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$file_slug = '';
$file_name = '';
$directory = '';

if ( isset( $_REQUEST['doc'] ) && ! empty( strip_tags( $_REQUEST['doc'] ) ) ) {

	$requested_key = strip_tags( $_REQUEST['doc'] );
	$doc_array     = ( isset( $scheme[ $requested_key ] ) ) ? $scheme[ $requested_key ] : null;
	$file_slug     = ( isset( $doc_array['slug'] ) ) ? $doc_array['slug'] : '';
	$file_name     = ( isset( $doc_array['file_name'] ) ) ? $doc_array['file_name'] : '';
	$directory     = ( isset( $doc_array['directory'] ) ) ? $doc_array['directory'] : '';

	if ( ! is_null( $doc_array ) ) {
		$file = "templates/{$directory}/{$file_name}.php";
	} else {
		die( 'Null doc array in scheme.' );
	}

} elseif ( isset( $_REQUEST['page'] ) && ! empty( strip_tags( $_REQUEST['page'] ) ) ) {
	$page      = strip_tags( $_REQUEST['page'] );
	$file      = "views/{$page}.php";
	$file_name = ucwords( $page );
} else {
	$file      = 'views/home.php';
	$file_name = '';
}

// Next and Previous navigations
if ( isset( $_REQUEST['doc'] ) ) {
	$key = $_REQUEST['doc'];
} else {
	$key = '';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo DOCS_NAME; ?> Documentation</title>
	<link rel="icon" type="image/png" sizes="32x32" href="src/favicon.png">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
	<link rel='stylesheet' href='https://unpkg.com/bulma@0.7.4/css/bulma.min.css'>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<link rel='stylesheet' href="src/prism.css">
	<link rel="stylesheet" href="src/cheatsheet.css">
	<style type="text/css">
        .menu-label:not(:last-child) {
            margin-left:   10px;
            font-weight:   bold;
            font-size:     1.5rem;
            margin-bottom: 0;
            color:         #333;
        }

        #return-to-top, #go_to_current_item {
            position:              fixed;
            bottom:                80px;
            right:                 20px;
            background:            rgb(0, 0, 0);
            background:            rgba(0, 0, 0, 0.7);
            width:                 50px;
            height:                50px;
            display:               block;
            text-decoration:       none;
            -webkit-border-radius: 35px;
            -moz-border-radius:    35px;
            border-radius:         35px;
            display:               none;
            -webkit-transition:    all 0.3s linear;
            -moz-transition:       all 0.3s ease;
            -ms-transition:        all 0.3s ease;
            -o-transition:         all 0.3s ease;
            transition:            all 0.3s ease;
            z-index:               1000;
        }

        #return-to-top i, #go_to_current_item i {
            color:              #fff;
            margin:             0;
            position:           relative;
            left:               16px;
            top:                13px;
            font-size:          19px;
            -webkit-transition: all 0.3s ease;
            -moz-transition:    all 0.3s ease;
            -ms-transition:     all 0.3s ease;
            -o-transition:      all 0.3s ease;
            transition:         all 0.3s ease;
        }

        #return-to-top:hover, #go_to_current_item:hover {
            background: rgba(0, 0, 0, 0.9);
        }

        #go_to_current_item {
            display: inline-block;
            bottom:  20px;
            right:   20px;
        }

        #go_to_current_item i {
            top: 16px;
        }

        /*#return-to-top:hover i {
			color: #fff;
		}*/

        .menu-list a.is-danger {
            background-color: #ff3860;
            color:            #fff;
        }

        .next-prev-nav {
            width: inherit;
        }

        .next-prev-nav .box {
            width: inherit;
        }

        .body-content-container {
            position: relative;
        }

        .next-link, .previous-link {
            position:              fixed;
            top:                   35%;
            height:                90px;
            width:                 45px;
            border-radius:         90px 0 0 90px;
            -moz-border-radius:    90px 0 0 90px;
            -webkit-border-radius: 90px 0 0 90px;
            background:            #333;
            color:                 #fff;
            z-index:               1;
            font-size:             28px;
            text-align:            center;
            vertical-align:        middle;
            line-height:           90px;
            opacity:               .75;
        }

        .next-link {
            right: 0;
        }

        .previous-link {
            left:                  0;
            border-radius:         0 90px 90px 0;
            -moz-border-radius:    0 90px 90px 0;
            -webkit-border-radius: 0 90px 90px 0;
        }

        .next-link i, .previous-link i {
            z-index: 2;
        }

        .previous-link i {
            margin-right: 10px;
        }

        .next-link i {
            margin-left: 10px;
        }

        @media print {

            body, html {
                background: #fff;
            }

            .hero .tags,
            .title-block,
            .file-info-block,
            .column.is-3,
            .previous-link,
            .next-link,
            .help-link,
            #go_to_current_item,
            #return-to-top,
            footer.footer .tags {
                display: none;
            }

            #return-to-top {
                display: none !important;
            }

            .hero.is-primary {
                background: #fff;
                color:      #000;
            }

            .hero.is-primary .title {
                color: #000;
            }

            .hero .container {
                text-align: center;
            }

            .hero .level-left {
                align-items:     center;
                justify-content: center;
                display:         block;
                width:           100%;
                margin:          10px auto;
            }

            body .section {
                padding: 0 1.5rem 3rem 1.5rem;
            }

            .hero .level-right {
                display: none;
            }

            .hero .title {
                display:    block;
                width:      100%;
                text-align: center;
            }

            .hero-body {
                flex-grow:   0;
                flex-shrink: 0;
                padding:     0;
            }

            .body-content {
                display: block;
                width:   100%;
                margin:  0;
                float:   none;
            }

            .column.is-9 {
                width:        100%;
                margin-left:  auto;
                margin-right: auto;
            }

            h1 {
                font-size: 20px !important;
            }

            h2 {
                font-size: 18px !important;
            }

            h3 {
                font-size: 16px !important;
            }

            h4 {
                font-size: 14px !important;
            }

            h5, h6 {
                font-size: 12px !important;
            }

            p, li {
                font-size: 12px !important;
            }

            h2 {
                page-break-before: auto;
            }

            h1, h3, h4 {
                page-break-after: avoid;
            }

            pre, blockquote {
                page-break-inside: avoid;
            }

            .box {
                background-color: #fff;
                border-radius:    0;
                box-shadow:       none;
                color:            #222;
                padding:          .8rem;
            }

            code[class*="language-"], pre[class*="language-"] {
                font-size:        12px;
                white-space:      pre-wrap;
                background-color: #2d2d2d !important;
            }

            :not(pre) > code[class*="language-"], pre[class*="language-"] {
                background-color: #2d2d2d !important;
                white-space:      pre-wrap;
            }

            pre[class*="language-"] {
                background-color: #2d2d2d !important;
                padding:          1em;
                margin:           .5em 0;
                white-space:      pre-wrap; /* css-3 */
                white-space:      -moz-pre-wrap; /* Mozilla, since 1999 */
                white-space:      -o-pre-wrap; /* Opera 7 */
                word-wrap:        break-word; /* Internet Explorer 5.5+ */
                white-space:      pre-wrap;
            }
        }
	</style>

	<script type="text/javascript" src="src/jquery.js"></script>

	<script type="text/javascript">

		jQuery( document ).ready( function ( $ ) {

			// function checkOffset() {
			// 	if ( $( '.next-prev-nav' ).offset().top + $( '.next-prev-nav' ).height() >= $( '.footer' ).offset().top - 10 ) {
			// 		$( '.next-prev-nav' ).css( 'position', 'absolute' );
			// 		$( '.next-prev-nav' ).css( 'bottom', '-65px' );
			// 	}
			//
			// 	if ( $( document ).scrollTop() + window.innerHeight < $( '.footer' ).offset().top ) {
			// 		$( '.next-prev-nav' ).css( 'position', 'fixed' );
			// 		$( '.next-prev-nav' ).css( 'bottom', '0' );
			// 	} // restore when you scroll up
			// }
			//
			// $( document ).scroll( function () {
			// 	checkOffset();
			// } );

			document.onkeydown = function ( event ) {

				//console.log( event.which );

				if ( event.altKey && event.which === 37 ) {

					var previous_link = $( '.previous-link' ).parent( 'a' ).attr( "href" );
					//console.log(link);

					if ( previous_link !== undefined ) {
						window.location.replace( previous_link );
					}
				}

				if ( event.altKey && event.which === 39 ) {

					var next_link = $( '.next-link' ).parent( 'a' ).attr( "href" );
					//console.log(link);
					if ( next_link !== undefined ) {
						window.location.replace( next_link );
					}
				}

			};

			// ===== Scroll to Top ====
			$( window ).scroll( function () {
				if ( $( this ).scrollTop() >= 50 ) {        // If page is scrolled more than 50px
					$( '#return-to-top' ).fadeIn( 200 );    // Fade in the arrow
				} else {
					$( '#return-to-top' ).fadeOut( 200 );   // Else fade out the arrow
				}
			} );

			$( '#return-to-top' ).click( function () {      // When arrow is clicked
				$( 'body,html' ).animate( {
					scrollTop: 0                       // Scroll to top of body
				}, 500 );
			} );

			var body = $( '.body-content' );
			// Fix image paths.
			body.find( 'img' ).each( function () {

				if ( location.hostname === this.hostname || !this.hostname.length ) {
					var old_src = $( this ).attr( 'src' );
					if ( old_src !== undefined ) {

						$( this ).attr( 'src', 'templates/<?php echo $directory; ?>/' + old_src );

						var new_src = $( this ).attr( 'src' );

						console.log( old_src, new_src );
					}
				}
			} );

			// Replace links with something we can use.
			body.find( 'a' ).each( function () {

				if ( location.hostname === this.hostname || !this.hostname.length ) {

					var old_ref = $( this ).attr( 'href' );

					if ( old_ref !== undefined ) {
						var slug = old_ref.split( '/' ).join( '_' ).replace( /\.[^/.]+$/, "" );

						// Only change if its a local .md file link.
						if ( old_ref.indexOf( '.md' ) !== -1 ) {
							$( this ).attr( 'href', '?doc=' + slug );
						}

						var new_ref = $( this ).attr( 'href' );

						console.log( old_ref, new_ref );
					}
				}
			} );

			$( 'a[href*="#"]' ).on( 'click', function ( e ) {

				e.preventDefault();

				var el = $( this ).attr( 'href' );

				console.log( $( el ) );

				$( 'html, body' ).animate(
					{
						scrollTop: $( el ).offset().top - 20,
					},
					500,
					'linear'
				)
			} );

			var filter = $( ".live-filter" );

			filter.focus();

			// Add the terms.
			$( '.menu-list li' ).each( function () {
				$( this ).attr( 'data-search-term', $( this ).text().toLowerCase() );
			} );

			var count = 0;

			filter.on( 'keyup', function () {

				count = 0;

				var searchTerm = $( this ).val().toLowerCase();

				$( '.menu-list li' ).each( function () {

					if ( $( this ).filter( '[data-search-term *= ' + searchTerm + ']' ).length > 0 || searchTerm.length < 1 ) {

						if ( searchTerm.length < 1 ) {
							count = 0;
						} else {
							count = count + 1;
						}
						$( '.found-items' ).text( count );

						$( this ).show();
					} else {

						$( this ).hide();
					}

				} );

			} );
		} );
	</script>
</head>
<body>
<section class="hero is-primary">
	<div class="hero-body">
		<div class="container content">

			<div class="level">
				<div class="level-left">
					<div class="level-item">
						<h1 class="title">
							<i class="is-small fas fa-code"></i> <?php echo DOCS_NAME; ?> Documentation</h1>
					</div>
				</div>

				<div class="level-right">
					<div class="level-item">
						<div class="control is-pulled-right">
							<div class="tags has-addons">
								<span class="tag is-dark">Documents</span>
								<span class="tag is-success"><?php echo count( $scheme ); ?></span>
							</div>

							<?php if ( isset( $scheme['empty'] ) ) { ?>
								<div class="tags has-addons">
									<span class="tag is-dark">Empty Docs</span>
									<span class="tag is-danger"><?php echo count( $scheme['empty'] ); ?></span>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>
<!-- Return to Top -->
<a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>

<?php if ( isset( $_REQUEST['doc'] ) ) { ?>
	<a title="Go to Current" href="#<?php echo $_REQUEST['doc'] ?>" id="go_to_current_item"><i class="fa fa-chevron-down"></i></a>
<?php } ?>
