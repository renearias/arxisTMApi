<?php

/*
 *  Todos los derechos reservados
 */
namespace Arxis\ContableBundle\Entity;

use Doctrine\ORM\Mapping as ORM ;
use Arxis\ContableBundle\Entity\Contacto;

/**
 * Description of Cliente
 *
 * @author Rene Arias <renearias@arxis.la>
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Arxis\ContableBundle\Repository\ClienteRepository")
 * 
 */
class Cliente extends Contacto{
    
     /** 
      * @ORM\OneToMany(targetEntity="\Multiservices\PayPayBundle\Entity\Facturas", mappedBy="idcliente")
      * 
      */
    private $facturas;
    
     /**
     * Constructor
     */
    public function __construct()
    {
        $this->facturas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pagos = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
     /** 
      * @ORM\OneToMany(targetEntity="\Multiservices\PayPayBundle\Entity\Ingresos", mappedBy="cliente")
      * 
      */
    private $pagos;
    
    /**
     * Add factura
     *
     * @param \Multiservices\PayPayBundle\Entity\Facturas $factura
     *
     * @return Contacto
     */
    public function addFactura(\Multiservices\PayPayBundle\Entity\Facturas $factura)
    {
        $this->facturas[] = $factura;

        return $this;
    }

    /**
     * Remove factura
     *
     * @param \Multiservices\PayPayBundle\Entity\Facturas $factura
     */
    public function removeFactura(\Multiservices\PayPayBundle\Entity\Facturas $factura)
    {
        $this->facturas->removeElement($factura);
    }

    /**
     * Get facturas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFacturas()
    {
        return $this->facturas;
    }

    /**
     * Add pago
     *
     * @param \Multiservices\PayPayBundle\Entity\Ingresos $pago
     *
     * @return Contacto
     */
    public function addPago(\Multiservices\PayPayBundle\Entity\Ingresos $pago)
    {
        $this->pagos[] = $pago;

        return $this;
    }

    /**
     * Remove pago
     *
     * @param \Multiservices\PayPayBundle\Entity\Ingresos $pago
     */
    public function removePago(\Multiservices\PayPayBundle\Entity\Ingresos $pago)
    {
        $this->pagos->removeElement($pago);
    }

    /**
     * Get pagos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPagos()
    {
        return $this->pagos;
    }
}
