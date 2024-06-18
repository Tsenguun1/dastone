<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInita42559b6eeb426885b0aff54e1547879
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInita42559b6eeb426885b0aff54e1547879', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInita42559b6eeb426885b0aff54e1547879', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInita42559b6eeb426885b0aff54e1547879::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
