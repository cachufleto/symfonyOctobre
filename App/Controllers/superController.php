<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 13/10/2016
 * Time: 13:02
 */

namespace App\Controllers;

class superController
{

    public function render($layaut, $var = [])
    {
        extract($var);
        ob_start();
        include VUE . "$layaut.tpl.php";
        $content = ob_get_contents();
        ob_clean();

        $info = date('Y/M/D');
        $content = str_replace('{{info}}', $info, $content);

        //echo $content;
        include VUE . 'template.tpl.php';
    }

    public function testPost()
    {
        var_dump($_SESSION);
        var_dump($_POST);
        if ($_POST){
            if( isset($_POST[$_SESSION['oldToken']]) &&
                $_POST[$_SESSION['oldToken']] === $_SESSION['oldSession']){
            return true;
            }
        }
        return false;
    }

    public function getToken()
    {
        return 'token' . rand(124,875);
    }

    public function session()
    {
        session_start();
        $_SESSION['oldToken'] = $_SESSION['newToken'];
        $_SESSION['oldSession'] = $_SESSION['newSession'];

        session_regenerate_id(true);
        $_SESSION['newToken'] = $this->getToken();
        $_SESSION['newSession'] = session_id();
    }

    public function  sessionDestroy(){
        session_unset();
        session_destroy();
        $this->session();
    }
}
