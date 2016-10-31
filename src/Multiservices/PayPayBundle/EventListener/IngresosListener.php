<?php

/*
 * Todos los derechos reservados
 */
namespace Multiservices\PayPayBundle\EventListener;
/**
 * Description of IngresosListener
 *
 * @author Rene Arias
 */

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Multiservices\PayPayBundle\Entity\Ingresos;

 
class IngresosListener 
{
    /**
     * @var TokenStorage
     */
    protected $tokenStorage;
    /**
     * @var ContainerInterface
     */
    protected $container;


    /**
     * @param TokenStorage $securityContext
     * @param Router $router The router
     */
    public function __construct(TokenStorage $tokenStorage, ContainerInterface $container)
    {
        $this->tokenStorage = $tokenStorage;
        $this->container=$container;
  
    }
    
    public function prePersist(Ingresos $ingreso, LifecycleEventArgs $args)
    {
            $user = $this->tokenStorage->getToken()->getUser();
            //$ingreso->registrarPagoEnFacturas();
            $ingreso->setCollectedby($user);
            
    }
    
    public function preUpdate(Ingresos $ingreso, PreUpdateEventArgs $args)
    {
            $user = $this->tokenStorage->getToken()->getUser();
            $change=$args->getEntityChangeSet();
            if (isset($change['monto']))
            {
                $oldmonto=$args->getOldValue('monto');
                $ingreso->modificarPagoEnFacturas($oldmonto);
            }
            $ingreso->setModifiedby($user);
    }
    
    public function preRemove(Ingresos $ingreso, LifecycleEventArgs $args)
    {
            $ingreso->revertirPagoEnFacturas();
    }
     
}
