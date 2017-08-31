<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit143653edb4f3457347d43be7ae23e974
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'Workerman\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Workerman\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit143653edb4f3457347d43be7ae23e974::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit143653edb4f3457347d43be7ae23e974::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
