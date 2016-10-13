<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 13/10/2016
 * Time: 14:53
 */

spl_autoload_register(function ($class) {

    if(file_exists(__NAMESPACE__ . $class . '.php')){
        include __NAMESPACE__ . $class . '.php';
    } else if(file_exists($class . '.php')){
        include $class . '.php';
    } else {
        throw new Exception("La class '$class' est introuvable");
    }
});