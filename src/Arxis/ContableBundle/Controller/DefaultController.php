<?php

namespace Arxis\ContableBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ArxisContableBundle:Default:index.html.twig');
    }
}
