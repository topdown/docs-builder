<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf0fb004957e3ac235257c1b3cdeae414
{
    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'ParsedownExtra' => 
            array (
                0 => __DIR__ . '/..' . '/erusev/parsedown-extra',
            ),
            'Parsedown' => 
            array (
                0 => __DIR__ . '/..' . '/erusev/parsedown',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInitf0fb004957e3ac235257c1b3cdeae414::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}