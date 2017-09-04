<?php

namespace App;

class Autoloader {

    static function register() {
        spl_autoload_register(array(__CLASS__,'autoload'));
    }

    static function autoload($class) {
        if(strpos($class,'\\')) {
            $class = str_replace('\\', '/', $class);
            require '../' . $class . '.php';
        }
    }
}