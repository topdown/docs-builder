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
 * home.php
 */
?>

<h3>Features</h3>
<ul>
	<li>Live list search</li>
	<li>Shows current files original path</li>
	<li>Shows a list of (.md) files missing content.</li>
	<li>Next and Previous with key commands <code>alt+right arrow or alt+left arrow</code></li>
	<li>Scroll to current in the navigation "Useful for large lists"</li>
	<li>Document count badges for both good docs and empty docs.</li>
</ul>

<p>This tool will crawl through your project and build a collection of all written documentation (ReadMe's) from your project.</p>
<p>From this a website is generated in the build path.</p>
<p>You can generate them with the following command in your terminal.</p>
<pre><code class="language-bash"> php collect.php</code></pre>
<p>This will scan one directory back <code>../</code> for all
	<strong>.md</strong> files and generate templates to load via the package that is output in the build path.</p>
<p>The build path will be <code>build/{slug}/</code> and {slug} is generated from your config.php <code>DOCS_NAME</code>.
</p>
<p>The command will try to create the build path and chmod it to
	<code>777</code>. If this does not happen on your system you will have to run the commands</p>
<pre><code class="language-bash">mkdir build
chmod 777 build</code></pre>
<p>Your <strong>config.php</strong> should look like the following or see the <strong>example-config.php</strong></p>
<pre><code class="language-php">// DOCS_NAME is Required
define( 'DOCS_NAME', 'mORvc' );

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
</code></pre>
<p>Local relative links like cli/readme.md will be converted to ?doc=cli_readme</p>        </div>

