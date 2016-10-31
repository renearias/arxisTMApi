<?php
namespace Multiservices\NotifyBundle\Servicios;

use Doctrine\ORM\EntityManager;
use Multiservices\NotifyBundle\Entity\Activity;
use Multiservices\NotifyBundle\Entity\Actions;

/**
 * Description of timeago
 *
 * @author Rene Arias <renearias@multiservices.com.ec>
 */

class ActivityRegistrador
{
    private $entityManager;
    
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    
    function crearActividad($accion,$user,$message="",$data=null)
    {
       $em=$this->entityManager;
       $actividad=New Activity();
       $actividad->setActionid($em->getRepository('NotifyBundle:Actions')->find($accion));
       $actividad->setUid($user);
        $actividad->setUsername("U");
       $actividad->setUtype(1);
       
       
       $actividad->setTimestamp(time());
      
       $realip=  $this->getRealIP();
       
       $actividad->setHostname($realip);
       $actividad->setVariables($data);
       
       if ($message!=="")
       {    
        $actividad->setMessage($message);
       }else
       {
           $actividad->setMessage($this->crearMensaje($actividad));
       }
       
       return $actividad;
    }
    
    function registrar($accion,$user,$message="",$data=null)
    {
       $em=$this->entityManager;
       $actividad=$this->crearActividad($accion,$user,$message,$data);
       $em->persist($actividad);
       $em->flush();
    }
       

    
    function getRealIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
        return $_SERVER['HTTP_CLIENT_IP'];
       
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
   
    return $_SERVER['REMOTE_ADDR'];
    } 
    
    function crearMensaje(Activity $activity)
    {
        
        
            $parameters=$activity->getActionid()->getParameters();
          if (isset($parameters['vars'])&&(!empty($parameters['vars'])))
          {
              $vars=$activity->getActionid()->getParameters()['vars'];
              $message=$activity->getActionid()->getLabel();
              foreach ($vars as $var)
              {
                 if (isset($activity->getVariables()->$var))
                 {
                     $message=str_replace('%'.$var.'%', $activity->getVariables()->$var,$message);
                 }
              }
              return $message;
              
          }
          else
          {
          return str_replace('%title%', '<strong>'.$activity->getUid().'</strong>',$activity->getActionid());
          }
          
      
        
    }
}

