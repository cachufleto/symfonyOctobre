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

        //echo $content;
        include VUE . 'template.tpl.php';
    }

    public function session()
    {
        session_start();
        session_regenerate_id(true);
    }

    public function  sessionDestroy(){
        session_unset();
        session_destroy();
        $this->session();
    }
}
