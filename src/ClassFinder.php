<?php

namespace Incraigulous\AdminZone;

class ClassFinder
{
    private static $composer = null;
    private static $classes  = [];

    public function __construct()
    {
        self::$composer = null;
        self::$classes  = [];

        self::$composer = require app_path() . '/vendor/autoload.php';

        if (false === empty(self::$composer)) {
            self::$classes  = array_keys(self::$composer->getClassMap());
        }
    }

    public function getClasses()
    {
        $allClasses = [];

        if (false === empty(self::$classes)) {
            foreach (self::$classes as $class) {
                $allClasses[] = '\\' . $class;
            }
        }

        return $allClasses;
    }

    public function getClassesByNamespace($namespace)
    {
        if (0 !== strpos($namespace, '\\')) {
            $namespace = '\\' . $namespace;
        }

        $termUpper = strtoupper($namespace);
        return array_filter($this->getClasses(), function($class) use ($termUpper) {
            $className = strtoupper($class);
            if (
                0 === strpos($className, $termUpper) and
                false === strpos($className, strtoupper('Abstract')) and
                false === strpos($className, strtoupper('Interface'))
            ){
                return $class;
            }
            return false;
        });
    }

    public function getClassesWithTerm($term)
    {
        $termUpper = strtoupper($term);
        return array_filter($this->getClasses(), function($class) use ($termUpper) {
            $className = strtoupper($class);
            if (
                false !== strpos($className, $termUpper) and
                false === strpos($className, strtoupper('Abstract')) and
                false === strpos($className, strtoupper('Interface'))
            ){
                return $class;
            }
            return false;
        });
    }
}
