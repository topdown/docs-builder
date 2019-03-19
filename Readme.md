#Docs Builder

###What it does.
This tool will crawl through your project and build a collection of all written documentation (ReadMe's) from your project.

From this a website is generated in the build path.


###Install
clone this repo to your project.

No need to run composer because the vendor is already included since it only is for parsing Markdown.

###Features


###Usage
You can generate the docs site with the following command in your terminal.

```bash
 php collect.php
```

This will scan one directory back `../` for all __.md__ files and generate templates to load via the package that is output in the build path.

The build path will be `build/{slug}/` and {slug} is generated from your config.php `DOCS_NAME`.

The command will try to create the build path and chmod it to `777`.
If this does not happen on your system you will have to run the commands
```bash
mkdir build
chmod 777 build
```

Your __config.php__ should look like the following or see the __example-config.php__

```php
// DOCS_NAME is Required
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

```
Local relative links like cli/readme.md will be converted to ?doc=cli_readme

The output in the terminal will look like the following
```bash
Running setup/cleanup.
Build Path: build/morvc/ 

-------------------------------------------------------
Collection Starting
-------------------------------------------------------
-------------------------------------------------------
Processed (.md) files.
-------------------------------------------------------
+ core/security/README.md
+ core/security/validators/readme.md
+ core/versioning/readme.md
+ core/spec_templates/readme.md
+ cli/readme.md
+ readme.md
+ hooks/v1/api/readme.md
+ hooks/v1/api/example-commands/readme.md
+ hooks/Readme.md
+ test_suite/readme.md
+ customize.md
-------------------------------------------------------
Empty (.md) files.
-------------------------------------------------------
core/uploader/README.md
web/readme.md
-------------------------------------------------------
11 files processed and 2 files were empty.
-------------------------------------------------------
-------------------------------------------------------
Copying required files to build path.
-------------------------------------------------------
-------------------------------------------------------
Generation Completed.
-------------------------------------------------------
```

See the screenshot.jpg for the generated site.