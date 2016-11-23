<?php

namespace Multiservices\AComerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AComerBundle:Default:index.html.twig');
    }
}
