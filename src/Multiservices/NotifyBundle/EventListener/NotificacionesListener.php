<?php

/*
 * Todos los derechos reservados
 */

/**
 * Description of LogoutListener
 *
 * @author Rene Arias
 */
namespace Multiservices\NotifyBundle\EventListener;

use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Multiservices\NotifyBundle\Entity\Notificaciones;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Multiservices\NotifyBundle\Servicios\Notificador;

/**
 * Description of CalificacionesListener
 *
 * @author Rene Arias
 */
class NotificacionesListener  {
    
   
    protected $container;
    private $notificacionesPorSubir=[];

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    
    public function preFlush(Notificaciones $notificacion, PreFlushEventArgs $event) {
        
        $this->notificacionesPorSubir[]=$notificacion;
    }
   
    
    public function postFlush(PostFlushEventArgs $args)
    {
         if (!empty($this->notificacionesPorSubir)) {
             $firebase = $this->container->get('kreait_firebase.connection.main');
              Notificador::notificarBulkFirebase($this->notificacionesPorSubir, $firebase);
             /*$em = $args->getEntityManager();
             foreach ($this->notificacionesPorSubir as $notificacion) {
                $notificacion->setSincronizada(true);
            }*/
            $this->notificacionPorSubir=[];
            //$em->flush();
        }
    }
}
