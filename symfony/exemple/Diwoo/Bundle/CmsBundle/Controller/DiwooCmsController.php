<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 25/10/2016
 * Time: 14:50
 */

namespace Diwoo\Bundle\CmsBundle\Controller;


class DiwooCmsController extends Controller
{

    public function getViewPath(){
        $trace = debug_backtrace();
        $actionName = ($trace[1]['function'] === 'autoRender')? $trace[2]['function'] : $trace[1]['function'];
        $actionName = empty($actionName) ? 'global' : $actionName;
        $actionName = current($actionName);

        $controllerName = explode('\\', $actionName);
        $controllerName = end($controllerName);

    }

    public function autoRender(){

    }

}