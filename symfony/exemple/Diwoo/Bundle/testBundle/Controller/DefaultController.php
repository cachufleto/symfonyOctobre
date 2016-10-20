<?php

namespace Diwoo\Bundle\testBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DiwootestBundle:Default:index.html.twig');
    }

    public function deuxAction()
    {
        return $this->render('DiwootestBundle:Test:index.html.twig');
    }
}
