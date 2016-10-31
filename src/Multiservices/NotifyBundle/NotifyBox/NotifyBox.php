<?php
namespace Multiservices\NotifyBundle\NotifyBox;
/*
 * Multiservices (c) 2015 - Todos los derechos reservados.
 */
use JMS\Serializer\Annotation as Serializer;
/**
 * Description of TaskBox
 *
 * @author Rene Arias <renearias@multiservices.com.ec>
 */
class NotifyBox extends \Multiservices\NotifyBundle\Activity\ActivityBox
{
    /**
     *
     * @var string
     */
    private $title="Notificaciones";
    /**
     *
     * @var array
     * @Serializer\Type("array<Multiservices\NotifyBundle\Entity\Notificaciones>")
     */
    private $data;
    /**
     * 
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }
    /**
     * 
     * @return array
     */
    public function getData() {
        return $this->data;
    }
    /**
     * 
     * @param string $title
     * @return \Multiservices\NotifyBundle\NotifyBox\NotifyBox
     */
    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }
    /**
     * 
     * @param array $data
     * @return \Multiservices\NotifyBundle\NotifyBox\NotifyBox
     */
    public function setData($data) {
        $this->data = $data;
        return $this;
    }
    public function getUnread() {
        $u=0;
        foreach ($this->data as $notificacion)
        {
            if (!$notificacion->isRead())
            {$u++;}
        }
        return $u;
    }
    

    
}
