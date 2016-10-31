<?php

namespace Multiservices\PayPayBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Embalajes
 *
 * @ORM\Table(name="embalajes")
 * @ORM\Entity
 */
class Embalajes
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=30, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="borrado", type="string", length=1, nullable=false)
     */
    private $borrado;

    /**
     * @var integer
     *
     * @ORM\Column(name="codembalaje", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codembalaje;



    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Embalajes
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set borrado
     *
     * @param string $borrado
     * @return Embalajes
     */
    public function setBorrado($borrado)
    {
        $this->borrado = $borrado;

        return $this;
    }

    /**
     * Get borrado
     *
     * @return string 
     */
    public function getBorrado()
    {
        return $this->borrado;
    }

    /**
     * Get codembalaje
     *
     * @return integer 
     */
    public function getCodembalaje()
    {
        return $this->codembalaje;
    }
}
