<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LogoutListener
 *
 * @author Multiservices
 */
namespace Multiservices\NotifyBundle\EventListener;

use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;
use Symfony\Component\Security\Core\SecurityContext;

class LogoutListener implements LogoutSuccessHandlerInterface {

  private $security;  

  public function __construct(SecurityContext $security) {
    $this->security = $security;
  }

  public function onLogoutSuccess(Request $request) {
     $user = $this->security->getToken()->getUser();

     //add code to handle $user here
     //...

     $response =  RedirectResponse($this->router->generate('login'));

    return $response;
  }
}
