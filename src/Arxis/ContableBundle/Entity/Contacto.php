<?php

namespace Arxis\ContableBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
use Arxis\ContableBundle\DBAL\Types\ClaseContribuyenteType;
use Arxis\ContableBundle\Entity\Cliente;

/**
 * Contacto
 *
 * @ORM\Table(name="contacto", indexes={@ORM\Index(name="Contacto_TipoIdentificacion", columns={"TipoIdentificacionId"}), @ORM\Index(name="Contacto_TipoPersona", columns={"TipoPersonaId"})})
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"contacto" = "Contacto", "cliente" = "Cliente"})
 */
class Contacto  ///Anteriormente se llamaba Contacto renombrada asi para compatibilidad
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
     * @var integer
     *
     * @ORM\Column(name="PaisId", type="integer", nullable=true)
     */
    private $paisid;

    /**
     * @var string
     *
     * @ORM\Column(name="Codigo", type="string", length=15, nullable=false)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="Identificacion", type="string", length=15, nullable=false)
     */
    private $identificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="Nombre", type="string", length=50, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="Direccion", type="string", length=250, nullable=false)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="NombreComercial", type="string", length=50, nullable=false)
     */
    private $nombrecomercial;

    /**
     * @var string
     *
     * @ORM\Column(name="Telefonos", type="string", length=50, nullable=false)
     */
    private $telefonos;

    /**
     * @var string
     *
     * @ORM\Column(name="Ciudad", type="string", length=50, nullable=false)
     */
    private $ciudad;

    /**
     * @var string
     *
     * @ORM\Column(name="Fax", type="string", length=50, nullable=false)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="Pais", type="string", length=25, nullable=true)
     */
    private $pais;

    /**
     * @var string
     *
     * @ORM\Column(name="Contacto", type="string", length=50, nullable=false)
     */
    private $contacto;

    /**
     * @var string
     *
     * @ORM\Column(name="RegistroEmpresarial", type="string", length=15, nullable=false)
     */
    private $registroempresarial;

    /**
     * @var string
     *
     * @ORM\Column(name="Email", type="string", length=250, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="ActividadEconomica", type="text", length=65535, nullable=true)
     */
    private $actividadeconomica;

    /**
     * @var string
     *
     * @ORM\Column(name="ClaseContribuyente", type="ClaseContribuyenteType", nullable=false, options={"default":"Otros"})
     * @DoctrineAssert\Enum(entity="Arxis\ContableBundle\DBAL\Types\ClaseContribuyenteType")
     */
    private $clasecontribuyente = 'Otros';

    /**
     * @var string
     *
     * @ORM\Column(name="Notas", type="text", length=65535, nullable=true)
     */
    private $notas;

    /**
     * @var string
     *
     * @ORM\Column(name="Cliente", type="string", length=1, nullable=false)
     */
    private $cliente;

    /**
     * @var string
     *
     * @ORM\Column(name="Proveedor", type="string", length=1, nullable=false)
     */
    private $proveedor;

    /**
     * @var string
     *
     * @ORM\Column(name="Vendedor", type="string", length=1, nullable=false)
     */
    private $vendedor;

    /**
     * @var string
     *
     * @ORM\Column(name="Empleado", type="string", length=1, nullable=false)
     */
    private $empleado;

    /**
     * @var string
     *
     * @ORM\Column(name="Transportista", type="string", length=1, nullable=false)
     */
    private $transportista;

    /**
     * @var string
     *
     * @ORM\Column(name="Recaudador", type="string", length=1, nullable=false)
     */
    private $recaudador;

    /**
     * @var \Tipoidentificacion
     *
     * @ORM\ManyToOne(targetEntity="Tipoidentificacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="TipoIdentificacionId", referencedColumnName="id", nullable=false)
     * })
     */
    private $tipoidentificacionid;

    /**
     * @var \Tipopersona
     *
     * @ORM\ManyToOne(targetEntity="Tipopersona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="TipoPersonaId", referencedColumnName="id", nullable=false)
     * })
     */
    private $tipopersonaid;
    
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
     * Set paisid
     *
     * @param integer $paisid
     *
     * @return Contacto
     */
    public function setPaisid($paisid)
    {
        $this->paisid = $paisid;

        return $this;
    }

    /**
     * Get paisid
     *
     * @return integer
     */
    public function getPaisid()
    {
        return $this->paisid;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     *
     * @return Contacto
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
     * Set identificacion
     *
     * @param string $identificacion
     *
     * @return Contacto
     */
    public function setIdentificacion($identificacion)
    {
        $this->identificacion = $identificacion;

        return $this;
    }

    /**
     * Get identificacion
     *
     * @return string
     */
    public function getIdentificacion()
    {
        return $this->identificacion;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Contacto
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
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Contacto
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set nombrecomercial
     *
     * @param string $nombrecomercial
     *
     * @return Contacto
     */
    public function setNombrecomercial($nombrecomercial)
    {
        $this->nombrecomercial = $nombrecomercial;

        return $this;
    }

    /**
     * Get nombrecomercial
     *
     * @return string
     */
    public function getNombrecomercial()
    {
        return $this->nombrecomercial;
    }

    /**
     * Set telefonos
     *
     * @param string $telefonos
     *
     * @return Contacto
     */
    public function setTelefonos($telefonos)
    {
        $this->telefonos = $telefonos;

        return $this;
    }

    /**
     * Get telefonos
     *
     * @return string
     */
    public function getTelefonos()
    {
        return $this->telefonos;
    }

    /**
     * Set ciudad
     *
     * @param string $ciudad
     *
     * @return Contacto
     */
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get ciudad
     *
     * @return string
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set fax
     *
     * @param string $fax
     *
     * @return Contacto
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set pais
     *
     * @param string $pais
     *
     * @return Contacto
     */
    public function setPais($pais)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get pais
     *
     * @return string
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Set contacto
     *
     * @param string $contacto
     *
     * @return Contacto
     */
    public function setContacto($contacto)
    {
        $this->contacto = $contacto;

        return $this;
    }

    /**
     * Get contacto
     *
     * @return string
     */
    public function getContacto()
    {
        return $this->contacto;
    }

    /**
     * Set registroempresarial
     *
     * @param string $registroempresarial
     *
     * @return Contacto
     */
    public function setRegistroempresarial($registroempresarial)
    {
        $this->registroempresarial = $registroempresarial;

        return $this;
    }

    /**
     * Get registroempresarial
     *
     * @return string
     */
    public function getRegistroempresarial()
    {
        return $this->registroempresarial;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Contacto
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set actividadeconomica
     *
     * @param string $actividadeconomica
     *
     * @return Contacto
     */
    public function setActividadeconomica($actividadeconomica)
    {
        $this->actividadeconomica = $actividadeconomica;

        return $this;
    }

    /**
     * Get actividadeconomica
     *
     * @return string
     */
    public function getActividadeconomica()
    {
        return $this->actividadeconomica;
    }

    /**
     * Set clasecontribuyente
     *
     * @param ClaseContribuyenteType $clasecontribuyente
     *
     * @return Contacto
     */
    public function setClasecontribuyente($clasecontribuyente)
    {
        $this->clasecontribuyente = $clasecontribuyente;

        return $this;
    }

    /**
     * Get clasecontribuyente
     *
     * @return ClaseContribuyenteType
     */
    public function getClasecontribuyente()
    {
        return $this->clasecontribuyente;
    }

    /**
     * Set notas
     *
     * @param string $notas
     *
     * @return Contacto
     */
    public function setNotas($notas)
    {
        $this->notas = $notas;

        return $this;
    }

    /**
     * Get notas
     *
     * @return string
     */
    public function getNotas()
    {
        return $this->notas;
    }

    /**
     * Set cliente
     *
     * @param string $cliente
     *
     * @return Contacto
     */
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get cliente
     *
     * @return string
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set proveedor
     *
     * @param string $proveedor
     *
     * @return Contacto
     */
    public function setProveedor($proveedor)
    {
        $this->proveedor = $proveedor;

        return $this;
    }

    /**
     * Get proveedor
     *
     * @return string
     */
    public function getProveedor()
    {
        return $this->proveedor;
    }

    /**
     * Set vendedor
     *
     * @param string $vendedor
     *
     * @return Contacto
     */
    public function setVendedor($vendedor)
    {
        $this->vendedor = $vendedor;

        return $this;
    }

    /**
     * Get vendedor
     *
     * @return string
     */
    public function getVendedor()
    {
        return $this->vendedor;
    }

    /**
     * Set empleado
     *
     * @param string $empleado
     *
     * @return Contacto
     */
    public function setEmpleado($empleado)
    {
        $this->empleado = $empleado;

        return $this;
    }

    /**
     * Get empleado
     *
     * @return string
     */
    public function getEmpleado()
    {
        return $this->empleado;
    }

    /**
     * Set transportista
     *
     * @param string $transportista
     *
     * @return Contacto
     */
    public function setTransportista($transportista)
    {
        $this->transportista = $transportista;

        return $this;
    }

    /**
     * Get transportista
     *
     * @return string
     */
    public function getTransportista()
    {
        return $this->transportista;
    }

    /**
     * Set recaudador
     *
     * @param string $recaudador
     *
     * @return Contacto
     */
    public function setRecaudador($recaudador)
    {
        $this->recaudador = $recaudador;

        return $this;
    }

    /**
     * Get recaudador
     *
     * @return string
     */
    public function getRecaudador()
    {
        return $this->recaudador;
    }

    /**
     * Set tipoidentificacionid
     *
     * @param \Arxis\ContableBundle\Entity\Tipoidentificacion $tipoidentificacionid
     *
     * @return Contacto
     */
    public function setTipoidentificacionid(\Arxis\ContableBundle\Entity\Tipoidentificacion $tipoidentificacionid)
    {
        $this->tipoidentificacionid = $tipoidentificacionid;

        return $this;
    }

    /**
     * Get tipoidentificacionid
     *
     * @return \Arxis\ContableBundle\Entity\Tipoidentificacion
     */
    public function getTipoidentificacionid()
    {
        return $this->tipoidentificacionid;
    }

    /**
     * Set tipopersonaid
     *
     * @param \Arxis\ContableBundle\Entity\Tipopersona $tipopersonaid
     *
     * @return Contacto
     */
    public function setTipopersonaid(\Arxis\ContableBundle\Entity\Tipopersona $tipopersonaid)
    {
        $this->tipopersonaid = $tipopersonaid;

        return $this;
    }

    /**
     * Get tipopersonaid
     *
     * @return \Arxis\ContableBundle\Entity\Tipopersona
     */
    public function getTipopersonaid()
    {
        return $this->tipopersonaid;
    }

    
    
    public function __toString() {
        return $this->nombre;
    }
}
