<?php
require_once 'inc/constants.php';
require_once INC . 'routes.php';

/*******************************************************/

$controller = $route['home']['controller'];
$action = $route['home']['action'];

if(isset($_GET['page'])){
    $page = htmlentities($_GET['page']);
    if(key_exists($page, $route)){
        $controller = $route[$page]['controller'];
        $action = $route[$page]['action'];
    }
}

include CONT . $controller.'.php';

/********************************************************/

$action();