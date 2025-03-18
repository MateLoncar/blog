<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit26be0859707d2232185c0a12a0c2b003
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
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit26be0859707d2232185c0a12a0c2b003::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit26be0859707d2232185c0a12a0c2b003::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit26be0859707d2232185c0a12a0c2b003::$classMap;

        }, null, ClassLoader::class);
    }
}
