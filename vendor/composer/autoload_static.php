<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1f050627cbfe80abc4a03a15b705a7f9
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1f050627cbfe80abc4a03a15b705a7f9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1f050627cbfe80abc4a03a15b705a7f9::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit1f050627cbfe80abc4a03a15b705a7f9::$classMap;

        }, null, ClassLoader::class);
    }
}
