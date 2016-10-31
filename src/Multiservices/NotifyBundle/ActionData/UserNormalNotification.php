<?php

namespace Multiservices\NotifyBundle\ActionData;

use Multiservices\NotifyBundle\ActionData\ActionDataInterface;

/**
 * Description of DocenteWtriteCalificacionYou
 *
 * @author Multiservices
 */
class UserNormalNotification implements ActionDataInterface{
    
    /**
     *
     * @var string
     */
    private $actionid='user_normal_notification';
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
    
    /**
     *
     * @var string
     */
    public $notificacion;
   
    
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
    
    public function getNotificacion() {
        return $this->notificacion;
    }

    public function setNotificacion($notificacion) {
        $this->notificacion = $notificacion;
        return $this;
    }
    




}
