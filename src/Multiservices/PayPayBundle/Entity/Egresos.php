<?php

namespace Multiservices\PayPayBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
/**
 * Egresos
 *
 * @ORM\Table(name="egresos", indexes={@ORM\Index(name="paidby", columns={"paidby"})})
 * @ORM\Entity(repositoryClass="Multiservices\PayPayBundle\Entity\EgresosRepository")
 */
class Egresos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false,options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="paidby", referencedColumnName="id")
     * })
     */
    private $paidby;
    
    /**
     * @var \AppBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="modifiedby", referencedColumnName="id")
     * })
     */
    private $modifiedby;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    
    private $fecha;
    
    /**
     * @var float
     *
     * @ORM\Column(name="monto", type="float", precision=10, scale=0, nullable=false)
     */
    private $monto;
    
    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=256, nullable=true)
     */
    private $descripcion;

    /**
     * @var \Multiservices\PayPayBundle\Entity\FormasPagos
     *
     * @ORM\ManyToOne(targetEntity="\Multiservices\PayPayBundle\Entity\FormasPagos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="forma_pago_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $formaPago;

    /**
     * @var string
     *
     * @ORM\Column(name="referencia", type="string", length=50, nullable=true)
     */
    private $referencia;

    
    public function __construct() {       
       $this->fecha=New \DateTime();
    }
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
     * Set paidby
     *
     * @param \AppBundle\Entity\Usuario $paidby
     * @return Egresos
     */
    public function setPaidby(\AppBundle\Entity\Usuario $paidby = null)
    {
        $this->paidby = $paidby;

        return $this;
    }

    /**
     * Get paidby
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getPaidby()
    {
        return $this->paidby;
    }
    
    /**
     * Set modifiedby
     *
     * @param \AppBundle\Entity\Usuario $modifiedby
     * @return Egresos
     */
    public function setModifiedby(\AppBundle\Entity\Usuario $modifiedby = null)
    {
        $this->modifiedby = $modifiedby;

        return $this;
    }

    /**
     * Get modifiedby
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getModifiedby()
    {
        return $this->modifiedby;
    }
    /**
   
   /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Egresos
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }    

    /**
     * Set monto
     *
     * @param float $monto
     * @return Egresos
     */
    public function setMonto($monto)
    {
        $this->monto = $monto;

        return $this;
    }

    /**
     * Get monto
     *
     * @return float 
     */
    public function getMonto()
    {
        return $this->monto;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Egresos
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
     * Set formaPago
     *
     * @param \Multiservices\PayPayBundle\Entity\FormasPagos $formaPago
     * @return Egresos
     */
    public function setFormaPago(\Multiservices\PayPayBundle\Entity\FormasPagos $formaPago = null)
    {
        $this->formaPago= $formaPago;

        return $this;
    }

    /**
     * Get formaPago
     *
     * @return \Multiservices\PayPayBundle\Entity\FormasPagos 
     */
    public function getFormaPago()
    {
        return $this->formaPago;
    }

    /**
     * Set referencia
     *
     * @param string $referencia
     * @return Egresos
     */
    public function setReferencia($referencia)
    {
    	$this->referencia = $referencia;
    
    	return $this;
    }
    
    /**
     * Get referencia
     *
     * @return string
     */
    public function getReferencia()
    {
    	return $this->referencia;
    }   
    
}
