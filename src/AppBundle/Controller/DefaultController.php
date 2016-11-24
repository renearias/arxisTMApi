<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Places\GooglePlacesClient;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        
        /*$clientManager = $this->get('fos_oauth_server.client_manager.default');
        $client = $clientManager->createClient();
        $client->setName('test4');
        $client->setRedirectUris(array('http://localhost/arxisTMApi/'));
        $client->setAllowedGrantTypes(array('token', 'authorization_code', 'password','http://localhost/arxisTMApi/'));
        $clientManager->updateClient($client);*/
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }
    
    /**
     * @Route("/hola", name="hola")
     */
    public function hola(){

        $client = new GooglePlacesClient();
        $client->setType("food");

        $result = $client->doRequest($client->getUrl(-34.603861,-58.38612699999999,500));

        return $result;
    }
}
