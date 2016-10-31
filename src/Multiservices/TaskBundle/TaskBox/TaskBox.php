<?php
namespace Multiservices\TaskBundle\TaskBox;
/*
 * Multiservices (c) 2015 - Todos los derechos reservados.
 */
use JMS\Serializer\Annotation as Serializer;
/**
 * Description of TaskBox
 *
 * @author Rene Arias <renearias@multiservices.com.ec>
 */
class TaskBox {
    /**
     *
     * @var string
     */
    private $title="Tareas";
    /**
     *
     * @var integer
     */
    private $length=0;
    /**
     *
     * @var array
     * @Serializer\Type("array<Multiservices\TaskBundle\Entity\Tarea>")
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
     * @return \Multiservices\TaskBundle\TaskBox\TaskBox
     */
    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }
    /**
     * 
     * @param integer $length
     * @return \Multiservices\TaskBundle\TaskBox\TaskBox
     */
    public function setLength($length) {
        $this->length = $length;
        return $this;
    }
    /**
     * 
     * @param array $data
     * @return \Multiservices\TaskBundle\TaskBox\TaskBox
     */
    public function setData($data) {
        $this->data = $data;
        return $this;
    }


    
}
