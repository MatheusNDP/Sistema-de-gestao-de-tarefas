<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2df9414c1519332fcd3e4425ce06303e
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'Laboratorio\\SistemaDeGestaoDeTarefas\\' => 37,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Laboratorio\\SistemaDeGestaoDeTarefas\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit2df9414c1519332fcd3e4425ce06303e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2df9414c1519332fcd3e4425ce06303e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit2df9414c1519332fcd3e4425ce06303e::$classMap;

        }, null, ClassLoader::class);
    }
}
