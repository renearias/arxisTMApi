<?php

namespace Multiservices\NotifyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;


/**
 * Actividades controller.
 *  @Rest\RouteResource("Activity")
 */
class ActivityController extends FOSRestController
{


    /**
     * Lists all Activities entities.
     *
     
     * @Method("GET")
     * @Rest\View(serializerGroups={"activities"})
     */
    public function cgetAllAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $user = $this->get('security.token_storage')->getToken()->getUser();
        //var_dump($user);
        //$docente=$em->getRepository('MultiacademicoBundle:Docentes')->findByUsuario($user);
        $activities = $em->getRepository('NotifyBundle:Activity')->recentActivities();
        
     
        return array(
            'activities' => $activities,
           // 'misclubes' => $misclubes,
        );
    }
    
   
    
}
