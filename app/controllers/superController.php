<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 13/10/2016
 * Time: 13:02
 */

function render($layaut, $var = [])
{
    extract($var);
    ob_start();
    include VUE . "$layaut.tpl.php";
    $content = ob_get_contents();
    ob_clean();

    //echo $content;
    include VUE . 'template.tpl.php';
}

function session($actif = true)
{
    session_start();

    if(!$actif){
        unset($_SESSION['auteur']);
        session_destroy();
        session_start();
    }

    if(!isset($_SESSION['auteur'])){
        header('Location:?page=connexion');
    }

}


