<?php

namespace Multiservices\TaskBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tasktemplate
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Tasktemplate
{
    
    
      public function __toString()
    {
       return $this->tarea;
    }
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="tarea", type="string", length=255)
     */
    private $tarea;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;

   

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set tarea
     *
     * @param string $tarea
     * @return Tasktemplate
     */
    public function setTarea($tarea)
    {
        $this->tarea = $tarea;

        return $this;
    }

    /**
     * Get tarea
     *
     * @return string 
     */
    public function getTarea()
    {
        return $this->tarea;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Tasktemplate
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

  
    
    
 
}
