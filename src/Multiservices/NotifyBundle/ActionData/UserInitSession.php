<?php

namespace Multiservices\NotifyBundle\ActionData;

use Multiservices\NotifyBundle\ActionData\ActionDataInterface;

/**
 * Description of DocenteWtriteCalificacionYou
 *
 * @author Multiservices
 */
class UserInitSession implements ActionDataInterface{
    
    /**
     *
     * @var string
     */
    private $actionid='user_init_session';
    /**
     *
     * @var string
     */
    public $usuario;
    
     /**
     *
     * @var integer
     */
    public $uid;
    
    /**
     *
     * @var string
     */
    public $urlUser;
   
    
    public function getActionid() {
        return $this->actionid;
    }

    public function getUsuario() {
        return $this->usuario;
    }

  

    public function setActionid($actionid) {
        $this->actionid = $actionid;
        return $this;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
        return $this;
    }
    
    public function getUid() {
        return $this->uid;
    }

    public function setUid($uid) {
        $this->uid = $uid;
        return $this;
    }

    public function getUrlUser() {
        return $this->urlUser;
    }

    public function setUrlUser($urlUser) {
        $this->urlUser = $urlUser;
        return $this;
    }



}
