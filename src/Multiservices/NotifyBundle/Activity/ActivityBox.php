<?php
namespace Multiservices\NotifyBundle\Activity;
/*
 * Multiservices (c) 2015 - Todos los derechos reservados.
 */
use JMS\Serializer\Annotation as Serializer;
/**
 * Description of ActivityBox
 *
 * @author Rene Arias <renearias@multiservices.com.ec>
 */
class ActivityBox {
    /**
     *
     * @var string
     */
    private $title="Tareas";
    /**
     *
     * @var integer
     * 
     * @Serializer\Accessor(getter="getLength")
     */
    private $length=0;
    /**
     *
     * @var integer
     * 
     * @Serializer\Accessor(getter="getUnread")
     */
    private $unread=0;
    /**
     *
     * @var array
     * @Serializer\Type("array")
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
     * @return integer
     */
    public function getLength() {
        return $this->length;
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
     * @return \Multiservices\NotifyBundle\ActivityBox\ActivityBox
     */
    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }
    /**
     * 
     * @param integer $length
     * @return \Multiservices\NotifyBundle\ActivityBox\ActivityBox
     */
    public function setLength($length) {
        $this->length = $length;
        return $this;
    }
    /**
     * 
     * @return integer
     */
    public function getUnread() {
        return $this->unread;
    }
    /**
     * 
     * @param integer $unread
     * @return Multiservices\NotifyBundle\Activity\ActivityBox
     */
    public function setUnread($unread) {
        $this->unread = $unread;
        return $this;
    }

        /**
     * 
     * @param array $data
     * @return \Multiservices\NotifyBundle\ActivityBox\ActivityBox
     */
    public function setData($data) {
        $this->data = $data;
        return $this;
    }


    
}
