<?php

namespace Arxis\ContableBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tipoidentificacion
 *
 * @ORM\Table(name="tipoidentificacion")
 * @ORM\Entity
 */
class Tipoidentificacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Codigo", type="string", length=2, nullable=false)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="Nombre", type="string", length=50, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="CodigoCompraATS", type="string", length=2, nullable=false)
     */
    private $codigocompraats;

    /**
     * @var string
     *
     * @ORM\Column(name="CodigoVentaATS", type="string", length=2, nullable=false)
     */
    private $codigoventaats;



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
     * Set codigo
     *
     * @param string $codigo
     *
     * @return Tipoidentificacion
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Tipoidentificacion
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
     * Set codigocompraats
     *
     * @param string $codigocompraats
     *
     * @return Tipoidentificacion
     */
    public function setCodigocompraats($codigocompraats)
    {
        $this->codigocompraats = $codigocompraats;

        return $this;
    }

    /**
     * Get codigocompraats
     *
     * @return string
     */
    public function getCodigocompraats()
    {
        return $this->codigocompraats;
    }

    /**
     * Set codigoventaats
     *
     * @param string $codigoventaats
     *
     * @return Tipoidentificacion
     */
    public function setCodigoventaats($codigoventaats)
    {
        $this->codigoventaats = $codigoventaats;

        return $this;
    }

    /**
     * Get codigoventaats
     *
     * @return string
     */
    public function getCodigoventaats()
    {
        return $this->codigoventaats;
    }
}
