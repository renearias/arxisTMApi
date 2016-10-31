<?php

namespace Multiservices\PayPayBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Impuestos
 *
 * @ORM\Table(name="impuestos")
 * @ORM\Entity
 */
class Impuestos
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=20, nullable=true)
     */
    private $nombre;

    /**
     * @var float
     *
     * @ORM\Column(name="valor", type="float", precision=10, scale=0, nullable=false)
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="borrado", type="string", length=1, nullable=false)
     */
    private $borrado;

    /**
     * @var integer
     *
     * @ORM\Column(name="codimpuesto", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codimpuesto;



    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Impuestos
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
     * Set valor
     *
     * @param float $valor
     * @return Impuestos
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return float 
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set borrado
     *
     * @param string $borrado
     * @return Impuestos
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
     * Get codimpuesto
     *
     * @return integer 
     */
    public function getCodimpuesto()
    {
        return $this->codimpuesto;
    }
}
