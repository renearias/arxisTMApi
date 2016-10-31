<?php

namespace Arxis\ContableBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
use Arxis\ContableBundle\DBAL\Types\EstadoEstablecimientoType;

/**
 * Establecimiento
 *
 * @ORM\Table(name="establecimiento", indexes={@ORM\Index(name="Establecimiento_Empresa", columns={"EmpresaId"})})
 * @ORM\Entity
 */
class Establecimiento
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
     * @ORM\Column(name="Codigo", type="string", length=3, nullable=false)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="NombreComercial", type="string", length=250, nullable=false)
     */
    private $nombrecomercial;

    /**
     * @var string
     *
     * @ORM\Column(name="Numero", type="string", length=3, nullable=false, options={"default":"001"})
     */
    private $numero = '001';

    /**
     * @var string
     *
     * @ORM\Column(name="Direccion", type="text", length=65535, nullable=false)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="Telefonos", type="string", length=100, nullable=false)
     */
    private $telefonos;

    /**
     * @var string
     *
     * @ORM\Column(name="Email", type="string", length=100, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="Ciudad", type="string", length=100, nullable=false)
     */
    private $ciudad;

    /**
     * @var string
     *
     * @ORM\Column(name="ActividadesEconomicas", type="text", length=65535, nullable=false)
     */
    private $actividadeseconomicas;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FechaInicio", type="date", nullable=false, options={"default":"2000-01-01"})
     */
    private $fechainicio = '2000-01-01';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FechaCierre", type="date", nullable=false, options={"default":"2000-01-01"})
     */
    private $fechacierre = '2000-01-01';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FechaReinicio", type="date", nullable=false, options={"default":"2000-01-01"})
     */
    private $fechareinicio = '2000-01-01';

    /**
     * @var string
     *
     * @ORM\Column(name="Estado", type="EstadoEstablecimientoType", nullable=false, options={"default":"Abierto"})
     * @DoctrineAssert\Enum(entity="Arxis\ContableBundle\DBAL\Types\EstadoEstablecimientoType")
     */
    private $estado = 'Abierto';

    /**
     * @var string
     *
     * @ORM\Column(name="Notas", type="text", length=65535, nullable=true)
     */
    private $notas;

    /**
     * @var string
     *
     * @ORM\Column(name="Logo", type="blob", length=65535, nullable=true)
     */
    private $logo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ComprobantesElectronicos", type="boolean", nullable=true, options={"default":false})
     */
    private $comprobanteselectronicos = false;

    /**
     * @var \Establecimiento
     *
     * @ORM\ManyToOne(targetEntity="Establecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="EmpresaId", referencedColumnName="id", nullable=false)
     * })
     */
    private $empresaid;



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
     * @return Establecimiento
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
     * Set nombrecomercial
     *
     * @param string $nombrecomercial
     *
     * @return Establecimiento
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
     * Set numero
     *
     * @param string $numero
     *
     * @return Establecimiento
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Establecimiento
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
     * Set telefonos
     *
     * @param string $telefonos
     *
     * @return Establecimiento
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
     * Set email
     *
     * @param string $email
     *
     * @return Establecimiento
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
     * Set ciudad
     *
     * @param string $ciudad
     *
     * @return Establecimiento
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
     * Set actividadeseconomicas
     *
     * @param string $actividadeseconomicas
     *
     * @return Establecimiento
     */
    public function setActividadeseconomicas($actividadeseconomicas)
    {
        $this->actividadeseconomicas = $actividadeseconomicas;

        return $this;
    }

    /**
     * Get actividadeseconomicas
     *
     * @return string
     */
    public function getActividadeseconomicas()
    {
        return $this->actividadeseconomicas;
    }

    /**
     * Set fechainicio
     *
     * @param \DateTime $fechainicio
     *
     * @return Establecimiento
     */
    public function setFechainicio($fechainicio)
    {
        $this->fechainicio = $fechainicio;

        return $this;
    }

    /**
     * Get fechainicio
     *
     * @return \DateTime
     */
    public function getFechainicio()
    {
        return $this->fechainicio;
    }

    /**
     * Set fechacierre
     *
     * @param \DateTime $fechacierre
     *
     * @return Establecimiento
     */
    public function setFechacierre($fechacierre)
    {
        $this->fechacierre = $fechacierre;

        return $this;
    }

    /**
     * Get fechacierre
     *
     * @return \DateTime
     */
    public function getFechacierre()
    {
        return $this->fechacierre;
    }

    /**
     * Set fechareinicio
     *
     * @param \DateTime $fechareinicio
     *
     * @return Establecimiento
     */
    public function setFechareinicio($fechareinicio)
    {
        $this->fechareinicio = $fechareinicio;

        return $this;
    }

    /**
     * Get fechareinicio
     *
     * @return \DateTime
     */
    public function getFechareinicio()
    {
        return $this->fechareinicio;
    }

    /**
     * Set estado
     *
     * @param EstadoEstablecimientoType $estado
     *
     * @return Establecimiento
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return EstadoEstablecimientoType
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set notas
     *
     * @param string $notas
     *
     * @return Establecimiento
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
     * Set logo
     *
     * @param string $logo
     *
     * @return Establecimiento
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set comprobanteselectronicos
     *
     * @param boolean $comprobanteselectronicos
     *
     * @return Establecimiento
     */
    public function setComprobanteselectronicos($comprobanteselectronicos)
    {
        $this->comprobanteselectronicos = $comprobanteselectronicos;

        return $this;
    }

    /**
     * Get comprobanteselectronicos
     *
     * @return boolean
     */
    public function getComprobanteselectronicos()
    {
        return $this->comprobanteselectronicos;
    }

    /**
     * Set empresaid
     *
     * @param \Arxis\ContableBundle\Entity\Establecimiento $empresaid
     *
     * @return Establecimiento
     */
    public function setEmpresaid(\Arxis\ContableBundle\Entity\Establecimiento $empresaid)
    {
        $this->empresaid = $empresaid;

        return $this;
    }

    /**
     * Get empresaid
     *
     * @return \Arxis\ContableBundle\Entity\Establecimiento
     */
    public function getEmpresaid()
    {
        return $this->empresaid;
    }
}
