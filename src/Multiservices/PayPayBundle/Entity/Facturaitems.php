<?php

namespace Multiservices\PayPayBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Facturaitems
 *
 * @ORM\Table(name="facturaitems")
 * @ORM\Entity
 */
class Facturaitems
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
     * @var Facturas
     *
     * @ORM\ManyToOne(targetEntity="Facturas", inversedBy="items")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idfactura", referencedColumnName="id")
     * })
     */
    private $idfactura;

    /**
     * @var integer
     *
     * @ORM\Column(name="userid", type="integer", nullable=true,options={"unsigned":true})
     */
    private $userid;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=true)
     */
    private $descripcion;

    /**
     * @var decimal
     *
     * @ORM\Column(name="cantidad", type="decimal", precision=10, scale=2, nullable=false,options={"default":"0.00"})
     */
    private $cantidad = '0.00';
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="punitario", type="decimal", precision=10, scale=2, nullable=false,options={"default":"0.00"})
     */
    private $punitario = '0.00';
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="descuento", type="decimal", precision=10, scale=2, nullable=false,options={"default":"0.00"})
     */
    private $descuento = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo", type="integer", nullable=true)
     */
    private $tipo;

    /**
     * @var integer
     *
     * @ORM\Column(name="idalmacen", type="integer", nullable=false)
     */
    private $idalmacen=0;

    /**
     * @var integer
     *
     * @ORM\Column(name="unidades", type="integer", nullable=false,options={"default":1})
     */
    private $unidades = '1';

    /**
     * @var Productos
     *
     * @ORM\ManyToOne(targetEntity="Productos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idproducto", referencedColumnName="id")
     * })
     */
    private $idproducto;

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
     * Set userid
     *
     * @param integer $userid
     * @return Facturaitems
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;

        return $this;
    }

    /**
     * Get userid
     *
     * @return integer 
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Facturaitems
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

    /**
     * Set cantidad
     *
     * @param string $cantidad
     * @return Facturaitems
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return string 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set punitario
     *
     * @param string $punitario
     * @return Facturaitems
     */
    public function setPunitario($punitario)
    {
        $this->punitario = $punitario;

        return $this;
    }

    /**
     * Get punitario
     *
     * @return string 
     */
    public function getPunitario()
    {
        return $this->punitario;
    }

    /**
     * Set tipo
     *
     * @param integer $tipo
     * @return Facturaitems
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return integer 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set idalmacen
     *
     * @param integer $idalmacen
     * @return Facturaitems
     */
    public function setIdalmacen($idalmacen)
    {
        $this->idalmacen = $idalmacen;

        return $this;
    }

    /**
     * Get idalmacen
     *
     * @return integer 
     */
    public function getIdalmacen()
    {
        return $this->idalmacen;
    }

    /**
     * Set unidades
     *
     * @param integer $unidades
     * @return Facturaitems
     */
    public function setUnidades($unidades)
    {
        $this->unidades = $unidades;

        return $this;
    }

    /**
     * Get unidades
     *
     * @return integer 
     */
    public function getUnidades()
    {
        return $this->unidades;
    }

    /**
     * Set idfactura
     *
     * @param \Multiservices\PayPayBundle\Entity\Facturas $idfactura
     * @return Facturaitems
     */
    public function setIdfactura(\Multiservices\PayPayBundle\Entity\Facturas $idfactura = null)
    {
        $this->idfactura = $idfactura;

        return $this;
    }

    /**
     * Get idfactura
     *
     * @return \Multiservices\PayPayBundle\Entity\Facturas 
     */
    public function getIdfactura()
    {
        return $this->idfactura;
    }

    /**
     * Set idproducto
     *
     * @param \Multiservices\PayPayBundle\Entity\Productos $idproducto
     * @return Facturaitems
     */
    public function setIdproducto(\Multiservices\PayPayBundle\Entity\Productos $idproducto = null)
    {
        $this->idproducto = $idproducto;

        return $this;
    }

    /**
     * Get idproducto
     *
     * @return \Multiservices\PayPayBundle\Entity\Productos 
     */
    public function getIdproducto()
    {
        return $this->idproducto;
    }
    
    public function getValorDescuento()
    {
        $valor=$this->cantidad*$this->punitario;
        return $valor*($this->descuento/100);
    }
    
    public function getTotal()
    {
        $valor=$this->cantidad*$this->punitario;
        return $valor;
    }

    /**
     * Set descuento
     *
     * @param decimal $descuento
     *
     * @return Facturaitems
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;

        return $this;
    }

    /**
     * Get descuento
     *
     * @return decimal
     */
    public function getDescuento()
    {
        return $this->descuento;
    }
}
