<?php

namespace Sami\Bundle\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TestController extends Controller
{
    public function indexAction()
    {
        return $this->render('SamiBlogBundle:Test:index.html.twig');
    }
}
