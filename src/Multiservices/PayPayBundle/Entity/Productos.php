<?php

namespace Multiservices\PayPayBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Productos
 *
 * @ORM\Table(name="productos", indexes={@ORM\Index(name="IDX_9C6F8597CD242A00", columns={"codfamilia"})})
 * @ORM\Entity
 */
class Productos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="referencia", type="string", length=20, nullable=true)
     */
    private $referencia;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false)
     */
    private $descripcion;

    /**
     * @var float
     *
     * @ORM\Column(name="impuesto", type="float", precision=10, scale=0, nullable=true)
     */
    private $impuesto;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_corta", type="string", length=30, nullable=true)
     */
    private $descripcionCorta;

    /**
     * @var \Multiservices\PayPayBundle\Entity\Ubicaciones
     *
     * @ORM\ManyToOne(targetEntity="Multiservices\PayPayBundle\Entity\Ubicaciones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="codubicacion", referencedColumnName="id")
     * })
     */
   
    private $codubicacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="stock", type="integer", nullable=false)
     */
    private $stock;

    /**
     * @var integer
     *
     * @ORM\Column(name="stock_minimo", type="integer", nullable=true)
     */
    private $stockMinimo;

    /**
     * @var string
     *
     * @ORM\Column(name="aviso_minimo", type="string", length=1, nullable=true)
     */
    private $avisoMinimo;

    /**
     * Los tipos pueden ser bien, servicio o pension anotado espo para que mas adelante sea un enum
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", nullable=false)
     */
    private $tipo;
    /**
     * @var string
     *
     * @ORM\Column(name="datos_producto", type="string", length=200, nullable=true)
     */
    private $datosProducto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_alta", type="date", nullable=true)
     */
    private $fechaAlta;

    /**
     * @var integer
     *
     * @ORM\Column(name="codembalaje", type="integer", nullable=true)
     */
    private $codembalaje;

    /**
     * @var integer
     *
     * @ORM\Column(name="unidades_caja", type="integer", nullable=true)
     */
    private $unidadesCaja;

    /**
     * @var string
     *
     * @ORM\Column(name="precio_ticket", type="string", length=1, nullable=true)
     */
    private $precioTicket;

    /**
     * @var string
     *
     * @ORM\Column(name="modificar_ticket", type="string", length=1, nullable=true)
     */
    private $modificarTicket;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", nullable=true)
     */
    private $observaciones;

    /**
     * @var float
     *
     * @ORM\Column(name="precio_compra", type="float", precision=10, scale=0, nullable=true)
     */
    private $precioCompra;

    /**
     * @var float
     *
     * @ORM\Column(name="precio_almacen", type="float", precision=10, scale=0, nullable=true)
     */
    private $precioAlmacen;

    /**
     * @var float
     *
     * @ORM\Column(name="precio_tienda", type="float", precision=10, scale=0, nullable=true)
     */
    private $precioTienda;

    /**
     * @var float
     *
     * @ORM\Column(name="precio_pvp", type="float", precision=10, scale=0, nullable=true)
     */
    private $precioPvp;

    /**
     * @var float
     *
     * @ORM\Column(name="precio_iva", type="float", precision=10, scale=0, nullable=true)
     */
    private $precioIva;

    /**
     * @var string
     *
     * @ORM\Column(name="codigobarras", type="string", length=15, nullable=true)
     */
    private $codigobarras;

    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", length=200, nullable=true)
     */
    private $imagen;

    /**
     * @var string
     *
     * @ORM\Column(name="borrado", type="string", length=1, nullable=true)
     */
    private $borrado;



    /**
     * @var \Multiservices\PayPayBundle\Entity\Proveedores
     *
     * @ORM\ManyToOne(targetEntity="Multiservices\PayPayBundle\Entity\Proveedores")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="codproveedor1", referencedColumnName="codproveedor")
     * })
     */
    private $codproveedor1;

    /**
     * @var \Multiservices\PayPayBundle\Entity\Proveedores
     *
     * @ORM\ManyToOne(targetEntity="Multiservices\PayPayBundle\Entity\Proveedores")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="codproveedor2", referencedColumnName="codproveedor")
     * })
     */
    private $codproveedor2;

    /**
     * @var \Multiservices\PayPayBundle\Entity\Familias
     *
     * @ORM\ManyToOne(targetEntity="Multiservices\PayPayBundle\Entity\Familias")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="codfamilia", referencedColumnName="id")
     * })
     */
    private $codfamilia;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Multiservices\PayPayBundle\Entity\Atributos")
     * @ORM\JoinTable(name="articulo_atributos",
     *   joinColumns={
     *     @ORM\JoinColumn(name="articulo_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="atributo_id", referencedColumnName="id")
     *   }
     * )
     */
    private $atributos;

    public function __construct() {
        $this->codfamilia = new \Doctrine\Common\Collections\ArrayCollection();
        $this->productosdetail = new \Doctrine\Common\Collections\ArrayCollection();
        $this->atributos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->fechaAlta = new \DateTime();
    }
 
    

 
    public function setAtributos($atributos) {
    $this->atributos = $atributos;
    }
    /**
    * Get atributos
    *
    * @return Doctrine\Common\Collections\Collection
    */
    public function getarticuloatributos()
    {
    return $this->atributos;
    }
    /**
    * Get atributos
    * @inheritDoc
    * @return Doctrine\Common\Collections\Collection
    */
    public function getAtributos()
    {
        //return array('Atributo_articulo');
        return $this->atributos->toArray();    //IMPORTANTE: el mecanismo de seguridad de Sf2 requiere ésto como un array
    }
    
    /**
     * Add atributos
     *
     * @param \Multiservices\PayPayBundle\Entity\Atributos $articuloatributos
     * @return articulo
     */
    public function addAtributo(\Multiservices\PayPayBundle\Entity\Atributos $articuloatributos)
    {
        $this->atributos[] = $articuloatributos;

        return $this;
    }

    /**
     * Remove atributos
     *
     * @param \Multiservices\PayPayBundle\Entity\Atributos $articuloatributos
     */
    public function removeAtributo(\Multiservices\PayPayBundle\Entity\Atributos $articuloatributos)
    {
        $this->atributos->removeElement($articuloatributos);
    }
 
 
 
    /**
     * Set codfamilia
     *
     * @param \Multiservices\PayPayBundle\Entity\Familias $codfamilia
     * @return Productos
     */
    public function setCodfamilia($codfamilia)
    {
        $this->codfamilia = $codfamilia;

        return $this;
    }

    /**
     * Get codfamilia
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getCodfamilia()
    {
        return $this->codfamilia;
    }

    /**
     * Set referencia
     *
     * @param string $referencia
     * @return Productos
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return Productos
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
     * Set impuesto
     *
     * @param float $impuesto
     * @return Productos
     */
    public function setImpuesto($impuesto)
    {
        $this->impuesto = $impuesto;

        return $this;
    }

    /**
     * Get impuesto
     *
     * @return float 
     */
    public function getImpuesto()
    {
        return $this->impuesto;
    }

    /**
     * Set codproveedor1
     *
     * @param integer $codproveedor1
     * @return Productos
     */
    public function setCodproveedor1($codproveedor1)
    {
        $this->codproveedor1 = $codproveedor1;

        return $this;
    }

    /**
     * Get codproveedor1
     *
     * @return integer 
     */
    public function getCodproveedor1()
    {
        return $this->codproveedor1;
    }

    /**
     * Set codproveedor2
     *
     * @param integer $codproveedor2
     * @return Productos
     */
    public function setCodproveedor2($codproveedor2)
    {
        $this->codproveedor2 = $codproveedor2;

        return $this;
    }

    /**
     * Get codproveedor2
     *
     * @return integer 
     */
    public function getCodproveedor2()
    {
        return $this->codproveedor2;
    }

    /**
     * Set descripcionCorta
     *
     * @param string $descripcionCorta
     * @return Productos
     */
    public function setDescripcionCorta($descripcionCorta)
    {
        $this->descripcionCorta = $descripcionCorta;

        return $this;
    }

    /**
     * Get descripcionCorta
     *
     * @return string 
     */
    public function getDescripcionCorta()
    {
        return $this->descripcionCorta;
    }

    /**
     * Set codubicacion
     *
     * @param integer $codubicacion
     * @return Productos
     */
    public function setCodubicacion($codubicacion)
    {
        $this->codubicacion = $codubicacion;

        return $this;
    }

    /**
     * Get codubicacion
     *
     * @return integer 
     */
    public function getCodubicacion()
    {
        return $this->codubicacion;
    }

    /**
     * Set stock
     *
     * @param integer $stock
     * @return Productos
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock
     *
     * @return integer 
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set stockMinimo
     *
     * @param integer $stockMinimo
     * @return Productos
     */
    public function setStockMinimo($stockMinimo)
    {
        $this->stockMinimo = $stockMinimo;

        return $this;
    }

    /**
     * Get stockMinimo
     *
     * @return integer 
     */
    public function getStockMinimo()
    {
        return $this->stockMinimo;
    }

    /**
     * Set avisoMinimo
     *
     * @param string $avisoMinimo
     * @return Productos
     */
    public function setAvisoMinimo($avisoMinimo)
    {
        $this->avisoMinimo = $avisoMinimo;

        return $this;
    }

    /**
     * Get avisoMinimo
     *
     * @return string 
     */
    public function getAvisoMinimo()
    {
        return $this->avisoMinimo;
    }

    /**
     * Set datosProducto
     *
     * @param string $datosProducto
     * @return Productos
     */
    public function setDatosProducto($datosProducto)
    {
        $this->datosProducto = $datosProducto;

        return $this;
    }

    /**
     * Get datosProducto
     *
     * @return string 
     */
    public function getDatosProducto()
    {
        return $this->datosProducto;
    }

    /**
     * Set fechaAlta
     *
     * @param \DateTime $fechaAlta
     * @return Productos
     */
    public function setFechaAlta($fechaAlta)
    {
        $this->fechaAlta = $fechaAlta;

        return $this;
    }

    /**
     * Get fechaAlta
     *
     * @return \DateTime 
     */
    public function getFechaAlta()
    {
        return $this->fechaAlta;
    }

    /**
     * Set codembalaje
     *
     * @param integer $codembalaje
     * @return Productos
     */
    public function setCodembalaje($codembalaje)
    {
        $this->codembalaje = $codembalaje;

        return $this;
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

    /**
     * Set unidadesCaja
     *
     * @param integer $unidadesCaja
     * @return Productos
     */
    public function setUnidadesCaja($unidadesCaja)
    {
        $this->unidadesCaja = $unidadesCaja;

        return $this;
    }

    /**
     * Get unidadesCaja
     *
     * @return integer 
     */
    public function getUnidadesCaja()
    {
        return $this->unidadesCaja;
    }

    /**
     * Set precioTicket
     *
     * @param string $precioTicket
     * @return Productos
     */
    public function setPrecioTicket($precioTicket)
    {
        $this->precioTicket = $precioTicket;

        return $this;
    }

    /**
     * Get precioTicket
     *
     * @return string 
     */
    public function getPrecioTicket()
    {
        return $this->precioTicket;
    }

    /**
     * Set modificarTicket
     *
     * @param string $modificarTicket
     * @return Productos
     */
    public function setModificarTicket($modificarTicket)
    {
        $this->modificarTicket = $modificarTicket;

        return $this;
    }

    /**
     * Get modificarTicket
     *
     * @return string 
     */
    public function getModificarTicket()
    {
        return $this->modificarTicket;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return Productos
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string 
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set precioCompra
     *
     * @param float $precioCompra
     * @return Productos
     */
    public function setPrecioCompra($precioCompra)
    {
        $this->precioCompra = $precioCompra;

        return $this;
    }

    /**
     * Get precioCompra
     *
     * @return float 
     */
    public function getPrecioCompra()
    {
        return $this->precioCompra;
    }

    /**
     * Set precioAlmacen
     *
     * @param float $precioAlmacen
     * @return Productos
     */
    public function setPrecioAlmacen($precioAlmacen)
    {
        $this->precioAlmacen = $precioAlmacen;

        return $this;
    }

    /**
     * Get precioAlmacen
     *
     * @return float 
     */
    public function getPrecioAlmacen()
    {
        return $this->precioAlmacen;
    }

    /**
     * Set precioTienda
     *
     * @param float $precioTienda
     * @return Productos
     */
    public function setPrecioTienda($precioTienda)
    {
        $this->precioTienda = $precioTienda;

        return $this;
    }

    /**
     * Get precioTienda
     *
     * @return float 
     */
    public function getPrecioTienda()
    {
        return $this->precioTienda;
    }

    /**
     * Set precioPvp
     *
     * @param float $precioPvp
     * @return Productos
     */
    public function setPrecioPvp($precioPvp)
    {
        $this->precioPvp = $precioPvp;

        return $this;
    }

    /**
     * Get precioPvp
     *
     * @return float 
     */
    public function getPrecioPvp()
    {
        return $this->precioPvp;
    }

    /**
     * Set precioIva
     *
     * @param float $precioIva
     * @return Productos
     */
    public function setPrecioIva($precioIva)
    {
        $this->precioIva = $precioIva;

        return $this;
    }

    /**
     * Get precioIva
     *
     * @return float 
     */
    public function getPrecioIva()
    {
        return $this->precioIva;
    }

    /**
     * Set codigobarras
     *
     * @param string $codigobarras
     * @return Productos
     */
    public function setCodigobarras($codigobarras)
    {
        $this->codigobarras = $codigobarras;

        return $this;
    }

    /**
     * Get codigobarras
     *
     * @return string 
     */
    public function getCodigobarras()
    {
        return $this->codigobarras;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     * @return Productos
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get imagen
     *
     * @return string 
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set borrado
     *
     * @param string $borrado
     * @return Productos
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    public function aumentarStock($cantidad)
    {
        $this->setStock($this->stock+$cantidad);
    }
    public function reducirStock($cantidad)
    {
        $this->setStock($this->stock-$cantidad);
    }
    
    
    public function __toString()
    {
    return $this->getDescripcion();
    }

    /**
     * Set Tipo
     *
     * @param string $tipo
     *
     * @return Productos
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get Tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }
}
