<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb87e06abd0fd15c28ccf9093c8282684
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitb87e06abd0fd15c28ccf9093c8282684::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb87e06abd0fd15c28ccf9093c8282684::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb87e06abd0fd15c28ccf9093c8282684::$classMap;

        }, null, ClassLoader::class);
    }
}
