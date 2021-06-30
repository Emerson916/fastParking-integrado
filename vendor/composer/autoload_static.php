<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0f3910d1818d5f99c939027cb900ab4c
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0f3910d1818d5f99c939027cb900ab4c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0f3910d1818d5f99c939027cb900ab4c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit0f3910d1818d5f99c939027cb900ab4c::$classMap;

        }, null, ClassLoader::class);
    }
}