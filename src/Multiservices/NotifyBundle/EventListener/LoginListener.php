<?php

/*
 * Todos los derechos reservados
 */

/**
 * Description of LoginListener
 *
 * @author Ren eArias
 */
namespace Multiservices\NotifyBundle\EventListener;
 
use Symfony\Component\Security\Core\AuthenticationEvents;
use Symfony\Component\Security\Core\Event\AuthenticationEvent;

use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Multiservices\NotifyBundle\ActionData\UserInitSession;


 
class LoginListener implements EventSubscriberInterface
{
    /**
     * @var string
     */
    protected $locale;
 
 
    /**
     * @var SecurityContext
     */
    protected $securityContext;
    /**
     * @var ContainerInterface
     */
    protected $container;


    /**
     * @param SecurityContext $securityContext
     * @param Router $router The router
     */
    public function __construct(TokenStorage $securityContext, ContainerInterface $container)
    {
        $this->securityContext = $securityContext;
        $this->container=$container;
  
    }
    
    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            //FOSUserEvents::SECURITY_IMPLICIT_LOGIN => 'handle',
            AuthenticationEvents::AUTHENTICATION_SUCCESS=>'registrarLogin',
           
            //SecurityEvents::INTERACTIVE_LOGIN => 'handle'
        );
    }
 
    public function registrarLogin(AuthenticationEvent $event)
    {
       $token = $event->getAuthenticationToken();
      
       $user = $token->getUser();
       //var_dump($user);
       if ($user instanceof \Multiservices\ArxisBundle\Entity\Usuario)
       {
        $registrador=$this->container->get('activityregistrador');
        $datainitsesion=new UserInitSession();
        $datainitsesion->setUsuario($user->getName());
        $datainitsesion->setUid($user->getId());
        $datainitsesion->setUrlUser($this->container->get('router')->generate('perfil_user', array(
                                                                                                 'id' => $user->getId())));
       
        $registrador->registrar('user_init_session', $user,"",$datainitsesion);
       }
      
 
    }
    
     
}
