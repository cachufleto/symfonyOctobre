<?php

namespace Diwoo\Bundle\CmsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DiwooCmsBundle:Default:index.html.twig');
    }
}
