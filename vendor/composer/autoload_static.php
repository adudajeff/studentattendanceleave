<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit881affc592a79fa230846f9cec4ca067
{
    public static $prefixesPsr0 = array (
        'o' => 
        array (
            'org\\bovigo\\vfs' => 
            array (
                0 => __DIR__ . '/..' . '/mikey179/vfsstream/src/main/php',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit881affc592a79fa230846f9cec4ca067::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}