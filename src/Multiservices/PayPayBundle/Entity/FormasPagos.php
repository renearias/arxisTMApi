<?php

namespace Multiservices\PayPayBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FormasPagos
 *
 * @ORM\Table(name="formas_pagos")
 * @ORM\Entity
 */
class FormasPagos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer",length=5, nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="forma_pago", type="string", length=20, nullable=false)
     */
    private $formaPago;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=256, nullable=true)
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
     * Set formaPago
     *
     * @param string $formaPago
     * @return FormasPagos
     */
    public function setFormaPago($formaPago)
    {
        $this->formaPago = $formaPago;

        return $this;
    }

    /**
     * Get formaPago
     *
     * @return string 
     */
    public function getFormaPago()
    {
        return $this->formaPago;
    }

    /**
     * Set estado
     *
     * @param string $descripcion
     * @return FormasPagos
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function __toString() {
        return $this->formaPago;
    }
}
