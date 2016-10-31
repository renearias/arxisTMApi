<?php

namespace Multiservices\PayPayBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
use Multiservices\PayPayBundle\DBAL\Types\EstadoFacturaType;
use JMS\Serializer\Annotation as Serializer;

/**
 * Ingresos
 *
 * @ORM\Table(name="ingresos", indexes={@ORM\Index(name="cliente_id", columns={"cliente_id"}), @ORM\Index(name="collectedby", columns={"collectedby"})})
 * @ORM\Entity(repositoryClass="Multiservices\PayPayBundle\Entity\IngresosRepository")
 * @ORM\EntityListeners({"Multiservices\PayPayBundle\EventListener\IngresosListener"})
 * ORM\HasLifecycleCallbacks()
 */
class Ingresos
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
     *   @ORM\JoinColumn(name="collectedby", referencedColumnName="id")
     * })
     */
    private $collectedby;
    
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
     * @Assert\DateTime()
     */
    private $fecha;
    
    /**
     * @var float
     *
     * @ORM\Column(name="monto", type="float", precision=10, scale=2, nullable=false)
     * @Assert\NotBlank()
     * @Assert\Type(
     *     type="double",
     *     message="El valor {{ value }} debe contener 2 decimales Ej: 2.34, 5.00 "
     * )
     */
    private $monto;
    
    
    /**
     * @var float
     *
     * @ORM\Column(name="cambio", type="float", precision=10, scale=2, nullable=false)
     * 
     */
    private $cambio=0;
    
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

    /**
     * @var \Arxis\ContableBundle\Entity\Cliente
     *
     * @ORM\ManyToOne(targetEntity="\Arxis\ContableBundle\Entity\Cliente", inversedBy="pagos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cliente_id", referencedColumnName="id")
     * })
     */
    private $cliente;
    
    
    /**
     * @var \Multiservices\PayPayBundle\Entity\Facturas
     *
     * @ORM\ManyToMany(targetEntity="\Multiservices\PayPayBundle\Entity\Facturas", inversedBy="abonos")
     * @ORM\JoinTable(name="facturas_ingresos",
     *   joinColumns={
     *     @ORM\JoinColumn(name="ingreso_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="factura_id", referencedColumnName="id")
     *   }
     * )
     */
    private $facturas;
    
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
     * Set collectedby
     *
     * @param \AppBundle\Entity\Usuario $collectedby
     * @return Ingresos
     */
    public function setCollectedby(\AppBundle\Entity\Usuario $collectedby = null)
    {
        $this->collectedby = $collectedby;

        return $this;
    }

    /**
     * Get collectedby
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getCollectedby()
    {
        return $this->collectedby;
    }
    
    /**
     * Set modifiedby
     *
     * @param \AppBundle\Entity\Usuario $modifiedby
     * @return Ingresos
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
     * @return Ingresos
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
     * @return Ingresos
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
     * @return Ingresos
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
     * @return Ingresos
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
     * @return Ingresos
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
    
   
    

    /**
     * Set cliente
     *
     * @param \Arxis\ContableBundle\Entity\Cliente $cliente
     *
     * @return Ingresos
     */
    public function setCliente(\Arxis\ContableBundle\Entity\Cliente $cliente = null)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get cliente
     *
     * @return \Arxis\ContableBundle\Entity\Cliente
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Add factura
     *
     * @param \Multiservices\PayPayBundle\Entity\Facturas $factura
     *
     * @return Ingresos
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
     * Get factura
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFacturas()
    {
        return $this->facturas;
    }
    
    public function registrarPagoEnFacturas()
    {
        $saldo=$this->getMonto();
        foreach ($this->getFacturas() as &$factura)
        {
            if ($saldo>=$factura->saldoAPagar())
            {
                $saldo=$saldo-$factura->saldoAPagar();
                $factura->setCobrado($factura->getCobrado()+$factura->saldoAPagar());
                $factura->setEstado(EstadoFacturaType::PAGADA);
                $factura->setPago(New \DateTime());
                
                
            }else
            {
                $factura->setCobrado($factura->getCobrado()+$saldo);
                //$factura->setEstado(EstadoFacturaType::NOPAGADA);
                $saldo=0;
            }
        }
        $this->setCambio($saldo);
    }
    public function modificarPagoEnFacturas($montoAnterior=0)
    {
        $saldo=$this->getMonto()-$montoAnterior;
        
        foreach ($this->getFacturas() as &$factura)
        {
            if ($saldo>=$factura->saldoAPagar())
            {
                $saldo=$saldo-$factura->saldoAPagar();
                $factura->setCobrado($factura->getCobrado()+$factura->saldoAPagar());
                $factura->cambiarEstadoSiEstaPagada();
                $factura->setPago(new \DateTime());
            }else
            {
                $factura->setCobrado($factura->getCobrado()+$saldo);
                $factura->cambiarEstadoSiEstaPagada();
                $factura->setPago(new \DateTime());
                $saldo=0;
            }
        }
    }
    
    public function revertirPagoEnFacturas()
    {
        $saldo=$this->getMonto();
        foreach ($this->getFacturas() as &$factura)
        {
            if ($saldo>=$factura->getCobrado())
            {
                $factura->setCobrado(0);
                $saldo=$saldo-$factura->getCobrado();
                $factura->setEstado(EstadoFacturaType::NOPAGADA);
                $factura->setPago(null);
            }else
            {
                $factura->setCobrado($factura->getCobrado()-$saldo);
                $factura->setEstado(EstadoFacturaType::NOPAGADA);
                $factura->setPago(null);
                $saldo=0;
            }
        }
    }

    /**
     * Set cambio
     *
     * @param float $cambio
     *
     * @return Ingresos
     */
    public function setCambio($cambio)
    {
        $this->cambio = $cambio;

        return $this;
    }

    /**
     * Get cambio
     *
     * @return float
     */
    public function getCambio()
    {
        return $this->cambio;
    }
}
