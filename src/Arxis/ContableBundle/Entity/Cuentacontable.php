<?php

namespace Arxis\ContableBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
use Arxis\ContableBundle\DBAL\Types\CuentaContableType;

/**
 * Cuentacontable
 *
 * @ORM\Table(name="cuentacontable", indexes={@ORM\Index(name="CuentaContable_parent", columns={"parent_id"})})
 * @ORM\Entity
 */
class Cuentacontable
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
     * @ORM\Column(name="Codigo", type="string", length=50, nullable=false)
     */
    private $codigo;

    /**
     * @var integer
     *
     * @ORM\Column(name="Nivel", type="integer", nullable=false)
     */
    private $nivel;

    /**
     * @var string
     *
     * @ORM\Column(name="Nombre", type="string", length=512, nullable=false)
     */
    private $nombre;

    /**
     * @var CuentaContableType
     *
     * @ORM\Column(name="Tipo", type="CuentaContableType", nullable=false, options={"default":"Activo"})
     * @DoctrineAssert\Enum(entity="Arxis\ContableBundle\DBAL\Types\CuentaContableType")     
     */
    private $tipo = 'Activo';

    /**
     * @var string
     *
     * @ORM\Column(name="Balance", type="decimal", precision=12, scale=2, nullable=false, options={"default":0.00})
     */
    private $balance = 0.00;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FechaUltimaTransaccion", type="date", nullable=false, options={"default":"2000-01-01"})
     */
    private $fechaultimatransaccion = '2000-01-01';

    /**
     * @var string
     *
     * @ORM\Column(name="MontoUltimaTransaccion", type="decimal", precision=12, scale=2, nullable=false, options={"default":0.00})
     */
    private $montoultimatransaccion = 0.00;

    /**
     * @var GeneroCuentaContableType
     *
     * @ORM\Column(name="Genero", type="GeneroCuentaContableType", nullable=false, options={"default":"Grupo"})
     * @DoctrineAssert\Enum(entity="Arxis\ContableBundle\DBAL\Types\GeneroCuentaContableType")
     */
    private $genero = 'Grupo';

    /**
     * @var string
     *
     * @ORM\Column(name="Bloqueada", type="boolean", nullable=false, options={"default":false})
     */
    private $bloqueada = false;

    /**
     * @var NaturalezaCuentaContableType
     *
     * @ORM\Column(name="Naturaleza", type="NaturalezaCuentaContableType", nullable=false, options={"default":"Deudora"})
     * @DoctrineAssert\Enum(entity="Arxis\ContableBundle\DBAL\Types\NaturalezaCuentaContableType")
     */
    private $naturaleza = 'Deudora';

    /**
     * @var boolean
     *
     * @ORM\Column(name="Tercero", type="boolean", nullable=false, options={"default":false})
     */
    private $tercero = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="CentroCosto", type="boolean", nullable=true, options={"default":false})
     */
    private $centrocosto = false;

    /**
     * @var \Cuentacontable
     *
     * @ORM\ManyToOne(targetEntity="Cuentacontable", inversedBy="children", cascade={"remove"})

     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     * })
     */
    private $parent;

    /**
     * 
     * @ORM\OneToMany(targetEntity="Cuentacontable", mappedBy="parent", cascade={"remove"})
     * 
     */

    private $children;
    
    public function __construct() {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set codigo
     *
     * @param string $codigo
     *
     * @return Cuentacontable
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
     * Set nivel
     *
     * @param integer $nivel
     *
     * @return Cuentacontable
     */
    public function setNivel($nivel)
    {
        $this->nivel = $nivel;

        return $this;
    }

    /**
     * Get nivel
     *
     * @return integer
     */
    public function getNivel()
    {
        return $this->nivel;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Cuentacontable
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
     * Set tipo
     *
     * @param CuentaContableType $tipo
     *
     * @return Cuentacontable
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return CuentaContableType
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set balance
     *
     * @param string $balance
     *
     * @return Cuentacontable
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * Get balance
     *
     * @return string
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Set fechaultimatransaccion
     *
     * @param \DateTime $fechaultimatransaccion
     *
     * @return Cuentacontable
     */
    public function setFechaultimatransaccion($fechaultimatransaccion)
    {
        $this->fechaultimatransaccion = $fechaultimatransaccion;

        return $this;
    }

    /**
     * Get fechaultimatransaccion
     *
     * @return \DateTime
     */
    public function getFechaultimatransaccion()
    {
        return $this->fechaultimatransaccion;
    }

    /**
     * Set montoultimatransaccion
     *
     * @param string $montoultimatransaccion
     *
     * @return Cuentacontable
     */
    public function setMontoultimatransaccion($montoultimatransaccion)
    {
        $this->montoultimatransaccion = $montoultimatransaccion;

        return $this;
    }

    /**
     * Get montoultimatransaccion
     *
     * @return string
     */
    public function getMontoultimatransaccion()
    {
        return $this->montoultimatransaccion;
    }

    /**
     * Set genero
     *
     * @param GeneroCuentaContableType $genero
     *
     * @return Cuentacontable
     */
    public function setGenero($genero)
    {
        $this->genero = $genero;

        return $this;
    }

    /**
     * Get genero
     *
     * @return GeneroCuentaContableType
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * Set bloqueada
     *
     * @param boolean $bloqueada
     *
     * @return Cuentacontable
     */
    public function setBloqueada($bloqueada)
    {
        $this->bloqueada = $bloqueada;

        return $this;
    }

    /**
     * Get bloqueada
     *
     * @return boolean
     */
    public function getBloqueada()
    {
        return $this->bloqueada;
    }

    /**
     * Set naturaleza
     *
     * @param NaturalezaCuentaContableType $naturaleza
     *
     * @return Cuentacontable
     */
    public function setNaturaleza($naturaleza)
    {
        $this->naturaleza = $naturaleza;

        return $this;
    }

    /**
     * Get naturaleza
     *
     * @return NaturalezaCuentaContableType
     */
    public function getNaturaleza()
    {
        return $this->naturaleza;
    }

    /**
     * Set tercero
     *
     * @param boolean $tercero
     *
     * @return Cuentacontable
     */
    public function setTercero($tercero)
    {
        $this->tercero = $tercero;

        return $this;
    }

    /**
     * Get tercero
     *
     * @return boolean
     */
    public function getTercero()
    {
        return $this->tercero;
    }

    /**
     * Set centrocosto
     *
     * @param boolean $centrocosto
     *
     * @return Cuentacontable
     */
    public function setCentrocosto($centrocosto)
    {
        $this->centrocosto = $centrocosto;

        return $this;
    }

    /**
     * Get centrocosto
     *
     * @return boolean
     */
    public function getCentrocosto()
    {
        return $this->centrocosto;
    }

    /**
     * Set parent
     *
     * @param \Arxis\ContableBundle\Entity\Cuentacontable $parent
     *
     * @return Cuentacontable
     */
    public function setParent(\Arxis\ContableBundle\Entity\Cuentacontable $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Arxis\ContableBundle\Entity\Cuentacontable
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add child
     *
     * @param \Arxis\ContableBundle\Entity\Cuentacontable $child
     *
     * @return Cuentacontable
     */
    public function addChild(\Arxis\ContableBundle\Entity\Cuentacontable $child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param \Arxis\ContableBundle\Entity\Cuentacontable $child
     */
    public function removeChild(\Arxis\ContableBundle\Entity\Cuentacontable $child)
    {
        $this->children->removeElement($child);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }
}
