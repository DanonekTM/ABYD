<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8ee2a3abf659ba93b1fce56fbf82981c
{
    public static $files = array (
        'a4a119a56e50fbb293281d9a48007e0e' => __DIR__ . '/..' . '/symfony/polyfill-php80/bootstrap.php',
        '6e3fae29631ef280660b3cdad06f25a8' => __DIR__ . '/..' . '/symfony/deprecation-contracts/function.php',
    );

    public static $prefixLengthsPsr4 = array (
        'Y' => 
        array (
            'YoutubeDl\\' => 10,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Php80\\' => 23,
            'Symfony\\Component\\Process\\' => 26,
            'Symfony\\Component\\OptionsResolver\\' => 34,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'YoutubeDl\\' => 
        array (
            0 => __DIR__ . '/..' . '/norkunas/youtube-dl-php/src',
        ),
        'Symfony\\Polyfill\\Php80\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-php80',
        ),
        'Symfony\\Component\\Process\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/process',
        ),
        'Symfony\\Component\\OptionsResolver\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/options-resolver',
        ),
    );

    public static $classMap = array (
        'Stringable' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/Stringable.php',
        'ValueError' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/ValueError.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8ee2a3abf659ba93b1fce56fbf82981c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8ee2a3abf659ba93b1fce56fbf82981c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8ee2a3abf659ba93b1fce56fbf82981c::$classMap;

        }, null, ClassLoader::class);
    }
}