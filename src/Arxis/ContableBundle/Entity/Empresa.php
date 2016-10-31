<?php

namespace Arxis\ContableBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
use Arxis\ContableBundle\DBAL\Types\ClaseContribuyenteType;

/**
 * Empresa
 *
 * @ORM\Table(name="empresa", indexes={@ORM\Index(name="Empresa_RepresentanteLegal", columns={"RepresentanteLegalId"}), @ORM\Index(name="Empresa_TipoAgenteRetencion", columns={"TipoAgenteRetencionId"}), @ORM\Index(name="Empresa_TipoIdentificacion", columns={"TipoIdentificacionId"}), @ORM\Index(name="Empresa_Contador", columns={"ContadorId"}), @ORM\Index(name="Empresa_TipoPersona", columns={"TipoPersonaId"})})
 * @ORM\Entity
 */
class Empresa
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
     * @ORM\Column(name="Identificacion", type="string", length=25, nullable=false)
     */
    private $identificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="Codigo", type="string", length=3, nullable=false)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="RazonSocial", type="string", length=100, nullable=false)
     */
    private $razonsocial;

    /**
     * @var string
     *
     * @ORM\Column(name="NombreComercial", type="string", length=250, nullable=false)
     */
    private $nombrecomercial;

    /**
     * @var string
     *
     * @ORM\Column(name="Ciudad", type="string", length=100, nullable=false)
     */
    private $ciudad;

    /**
     * @var string
     *
     * @ORM\Column(name="Direccion", type="string", length=250, nullable=false)
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
     * @ORM\Column(name="Email", type="string", length=250, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="Estado", type="string", length=15, nullable=false)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="RegistroEmpresarial", type="string", length=25, nullable=false)
     */
    private $registroempresarial;

    /**
     * @var string
     *
     * @ORM\Column(name="Notas", type="text", length=65535, nullable=false)
     */
    private $notas;

    /**
     * @var string
     *
     * @ORM\Column(name="ClaseContribuyente", type="ClaseContribuyenteType", nullable=false, options={"default":"Otros"})
     * @DoctrineAssert\Enum(entity="Arxis\ContableBundle\DBAL\Types\ClaseContribuyenteType")
     */
    private $clasecontribuyente = 'Otros';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FechaInicio", type="date", nullable=false, options={"default":"2000-01-01"})
     */
    private $fechainicio = '2000-01-01';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FechaInscripcion", type="date", nullable=false, options={"default":"2000-01-01"})
     */
    private $fechainscripcion = '2000-01-01';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FechaConstitucion", type="date", nullable=false, options={"default":"2000-01-01"})
     */
    private $fechaconstitucion = '2000-01-01';

    /**
     * @var string
     *
     * @ORM\Column(name="ActividadEconomicaPrincipal", type="text", length=65535, nullable=false)
     */
    private $actividadeconomicaprincipal;

    /**
     * @var string
     *
     * @ORM\Column(name="ObligacionesTributarias", type="text", length=65535, nullable=false)
     */
    private $obligacionestributarias;

    /**
     * @var integer
     *
     * @ORM\Column(name="NumeroEstablecimientosAbiertos", type="integer", nullable=false, options={"default":"1"})
     */
    private $numeroestablecimientosabiertos = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="NumeroEstablecimientosCerrados", type="integer", nullable=false, options={"default":"0"})
     */
    private $numeroestablecimientoscerrados = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="Jurisdiccion", type="text", length=65535, nullable=false)
     */
    private $jurisdiccion;

    /**
     * @var string
     *
     * @ORM\Column(name="Resolucion", type="string", length=50, nullable=false)
     */
    private $resolucion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ContribuyenteEspecial", type="boolean", nullable=false, options={"default":false})
     */
    private $contribuyenteespecial = false;

    /**
     * @var string
     *
     * @ORM\Column(name="ClaveInterna", type="string", length=25, nullable=false, options={"default":"0000000"})
     */
    private $claveinterna = '0000000';

    /**
     * @var integer
     *
     * @ORM\Column(name="EjercicioFiscal", type="integer", nullable=false, options={"default":"2000"})
     */
    private $ejerciciofiscal = '2000';

    /**
     * @var integer
     *
     * @ORM\Column(name="PeriodoFiscal", type="integer", nullable=false, options={"default":"1"})
     */
    private $periodofiscal = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="EjerciciosHistoria", type="integer", nullable=false, options={"default":"1"})
     */
    private $ejercicioshistoria = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="PeriodosHistoria", type="integer", nullable=false, options={"default":"1"})
     */
    private $periodoshistoria = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="PeriodoInicialEjercicio", type="integer", nullable=false, options={"default":"1"})
     */
    private $periodoinicialejercicio = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="PeriodosEjercicio", type="integer", nullable=false, options={"default":"1"})
     */
    private $periodosejercicio = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="ServidorSmtpComprobantesElectronicos", type="string", length=250, nullable=false)
     */
    private $servidorsmtpcomprobanteselectronicos;

    /**
     * @var string
     *
     * @ORM\Column(name="PuertoServidorSmtpComprobantesElectronicos", type="string", length=250, nullable=true)
     */
    private $puertoservidorsmtpcomprobanteselectronicos;

    /**
     * @var string
     *
     * @ORM\Column(name="UsuarioSmtpComprobantesElectronicos", type="string", length=250, nullable=true)
     */
    private $usuariosmtpcomprobanteselectronicos;

    /**
     * @var string
     *
     * @ORM\Column(name="PasswordSmtpComprobantesElectronicos", type="string", length=250, nullable=true)
     */
    private $passwordsmtpcomprobanteselectronicos;

    /**
     * @var string
     *
     * @ORM\Column(name="EmailEmisorComprobantesElectronicos", type="string", length=250, nullable=true)
     */
    private $emailemisorcomprobanteselectronicos;

    /**
     * @var string
     *
     * @ORM\Column(name="ArchivoEmailComprobantesElectronicos", type="text", length=65535, nullable=true)
     */
    private $archivoemailcomprobanteselectronicos;

    /**
     * @var string
     *
     * @ORM\Column(name="ArchivoCertificadoComprobantesElectronicos", type="text", length=65535, nullable=true)
     */
    private $archivocertificadocomprobanteselectronicos;

    /**
     * @var string
     *
     * @ORM\Column(name="PasswordCertificadoComprobantesElectronicos", type="text", length=65535, nullable=true)
     */
    private $passwordcertificadocomprobanteselectronicos;

    /**
     * @var string
     *
     * @ORM\Column(name="TipoAmbienteComprobantesElectronicos", type="string", nullable=false, options={"default":"Pruebas"})
     */
    private $tipoambientecomprobanteselectronicos = 'Pruebas';

    /**
     * @var string
     *
     * @ORM\Column(name="TipoEmisionComprobantesElectronicos", type="string", nullable=false, options={"default":"Normal"})
     */
    private $tipoemisioncomprobanteselectronicos = 'Normal';

    /**
     * @var string
     *
     * @ORM\Column(name="TipoPublicacionComprobantesElectronicos", type="string", nullable=false, options={"default":"Local"})
     */
    private $tipopublicacioncomprobanteselectronicos = 'Local';

    /**
     * @var boolean
     *
     * @ORM\Column(name="ComprobantesElectronicos", type="boolean", nullable=false, options={"default":false})
     */
    private $comprobanteselectronicos = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ComercioExterior", type="boolean", nullable=false, options={"default":false})
     */
    private $comercioexterior = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ObligadoContabilidad", type="boolean", nullable=false, options={"default":false})
     */
    private $obligadocontabilidad = false;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FechaInicioContabilidad", type="date", nullable=true, options={"default":"2000-01-01"})
     */
    private $fechainiciocontabilidad = '2000-01-01';

    /**
     * @var integer
     *
     * @ORM\Column(name="CuentaContableCapitalId", type="integer", nullable=true)
     */
    private $cuentacontablecapitalid;

    /**
     * @var integer
     *
     * @ORM\Column(name="CuentaContableResultadoId", type="integer", nullable=true)
     */
    private $cuentacontableresultadoid;

    /**
     * @var \Contacto
     *
     * @ORM\ManyToOne(targetEntity="Contacto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ContadorId", referencedColumnName="id", nullable=false)
     * })
     */
    private $contadorid;

    /**
     * @var \Contacto
     *
     * @ORM\ManyToOne(targetEntity="Contacto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="RepresentanteLegalId", referencedColumnName="id", nullable=false)
     * })
     */
    private $representantelegalid;

    /**
     * @var \Tipoagenteretencion
     *
     * @ORM\ManyToOne(targetEntity="Tipoagenteretencion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="TipoAgenteRetencionId", referencedColumnName="id", nullable=false)
     * })
     */
    private $tipoagenteretencionid;

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
     *   @ORM\JoinColumn(name="TipoPersonaId", referencedColumnName="id")
     * })
     */
    private $tipopersonaid;  //tambien iria default 1 



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
     * Set identificacion
     *
     * @param string $identificacion
     *
     * @return Empresa
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
     * Set codigo
     *
     * @param string $codigo
     *
     * @return Empresa
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
     * Set razonsocial
     *
     * @param string $razonsocial
     *
     * @return Empresa
     */
    public function setRazonsocial($razonsocial)
    {
        $this->razonsocial = $razonsocial;

        return $this;
    }

    /**
     * Get razonsocial
     *
     * @return string
     */
    public function getRazonsocial()
    {
        return $this->razonsocial;
    }

    /**
     * Set nombrecomercial
     *
     * @param string $nombrecomercial
     *
     * @return Empresa
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
     * Set ciudad
     *
     * @param string $ciudad
     *
     * @return Empresa
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
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Empresa
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
     * @return Empresa
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
     * @return Empresa
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
     * Set estado
     *
     * @param string $estado
     *
     * @return Empresa
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set registroempresarial
     *
     * @param string $registroempresarial
     *
     * @return Empresa
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
     * Set notas
     *
     * @param string $notas
     *
     * @return Empresa
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
     * Set clasecontribuyente
     *
     * @param ClaseContribuyenteType $clasecontribuyente
     *
     * @return Empresa
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
     * Set fechainicio
     *
     * @param \DateTime $fechainicio
     *
     * @return Empresa
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
     * Set fechainscripcion
     *
     * @param \DateTime $fechainscripcion
     *
     * @return Empresa
     */
    public function setFechainscripcion($fechainscripcion)
    {
        $this->fechainscripcion = $fechainscripcion;

        return $this;
    }

    /**
     * Get fechainscripcion
     *
     * @return \DateTime
     */
    public function getFechainscripcion()
    {
        return $this->fechainscripcion;
    }

    /**
     * Set fechaconstitucion
     *
     * @param \DateTime $fechaconstitucion
     *
     * @return Empresa
     */
    public function setFechaconstitucion($fechaconstitucion)
    {
        $this->fechaconstitucion = $fechaconstitucion;

        return $this;
    }

    /**
     * Get fechaconstitucion
     *
     * @return \DateTime
     */
    public function getFechaconstitucion()
    {
        return $this->fechaconstitucion;
    }

    /**
     * Set actividadeconomicaprincipal
     *
     * @param string $actividadeconomicaprincipal
     *
     * @return Empresa
     */
    public function setActividadeconomicaprincipal($actividadeconomicaprincipal)
    {
        $this->actividadeconomicaprincipal = $actividadeconomicaprincipal;

        return $this;
    }

    /**
     * Get actividadeconomicaprincipal
     *
     * @return string
     */
    public function getActividadeconomicaprincipal()
    {
        return $this->actividadeconomicaprincipal;
    }

    /**
     * Set obligacionestributarias
     *
     * @param string $obligacionestributarias
     *
     * @return Empresa
     */
    public function setObligacionestributarias($obligacionestributarias)
    {
        $this->obligacionestributarias = $obligacionestributarias;

        return $this;
    }

    /**
     * Get obligacionestributarias
     *
     * @return string
     */
    public function getObligacionestributarias()
    {
        return $this->obligacionestributarias;
    }

    /**
     * Set numeroestablecimientosabiertos
     *
     * @param integer $numeroestablecimientosabiertos
     *
     * @return Empresa
     */
    public function setNumeroestablecimientosabiertos($numeroestablecimientosabiertos)
    {
        $this->numeroestablecimientosabiertos = $numeroestablecimientosabiertos;

        return $this;
    }

    /**
     * Get numeroestablecimientosabiertos
     *
     * @return integer
     */
    public function getNumeroestablecimientosabiertos()
    {
        return $this->numeroestablecimientosabiertos;
    }

    /**
     * Set numeroestablecimientoscerrados
     *
     * @param integer $numeroestablecimientoscerrados
     *
     * @return Empresa
     */
    public function setNumeroestablecimientoscerrados($numeroestablecimientoscerrados)
    {
        $this->numeroestablecimientoscerrados = $numeroestablecimientoscerrados;

        return $this;
    }

    /**
     * Get numeroestablecimientoscerrados
     *
     * @return integer
     */
    public function getNumeroestablecimientoscerrados()
    {
        return $this->numeroestablecimientoscerrados;
    }

    /**
     * Set jurisdiccion
     *
     * @param string $jurisdiccion
     *
     * @return Empresa
     */
    public function setJurisdiccion($jurisdiccion)
    {
        $this->jurisdiccion = $jurisdiccion;

        return $this;
    }

    /**
     * Get jurisdiccion
     *
     * @return string
     */
    public function getJurisdiccion()
    {
        return $this->jurisdiccion;
    }

    /**
     * Set resolucion
     *
     * @param string $resolucion
     *
     * @return Empresa
     */
    public function setResolucion($resolucion)
    {
        $this->resolucion = $resolucion;

        return $this;
    }

    /**
     * Get resolucion
     *
     * @return string
     */
    public function getResolucion()
    {
        return $this->resolucion;
    }

    /**
     * Set contribuyenteespecial
     *
     * @param boolean $contribuyenteespecial
     *
     * @return Empresa
     */
    public function setContribuyenteespecial($contribuyenteespecial)
    {
        $this->contribuyenteespecial = $contribuyenteespecial;

        return $this;
    }

    /**
     * Get contribuyenteespecial
     *
     * @return boolean
     */
    public function getContribuyenteespecial()
    {
        return $this->contribuyenteespecial;
    }

    /**
     * Set claveinterna
     *
     * @param string $claveinterna
     *
     * @return Empresa
     */
    public function setClaveinterna($claveinterna)
    {
        $this->claveinterna = $claveinterna;

        return $this;
    }

    /**
     * Get claveinterna
     *
     * @return string
     */
    public function getClaveinterna()
    {
        return $this->claveinterna;
    }

    /**
     * Set ejerciciofiscal
     *
     * @param integer $ejerciciofiscal
     *
     * @return Empresa
     */
    public function setEjerciciofiscal($ejerciciofiscal)
    {
        $this->ejerciciofiscal = $ejerciciofiscal;

        return $this;
    }

    /**
     * Get ejerciciofiscal
     *
     * @return integer
     */
    public function getEjerciciofiscal()
    {
        return $this->ejerciciofiscal;
    }

    /**
     * Set periodofiscal
     *
     * @param integer $periodofiscal
     *
     * @return Empresa
     */
    public function setPeriodofiscal($periodofiscal)
    {
        $this->periodofiscal = $periodofiscal;

        return $this;
    }

    /**
     * Get periodofiscal
     *
     * @return integer
     */
    public function getPeriodofiscal()
    {
        return $this->periodofiscal;
    }

    /**
     * Set ejercicioshistoria
     *
     * @param integer $ejercicioshistoria
     *
     * @return Empresa
     */
    public function setEjercicioshistoria($ejercicioshistoria)
    {
        $this->ejercicioshistoria = $ejercicioshistoria;

        return $this;
    }

    /**
     * Get ejercicioshistoria
     *
     * @return integer
     */
    public function getEjercicioshistoria()
    {
        return $this->ejercicioshistoria;
    }

    /**
     * Set periodoshistoria
     *
     * @param integer $periodoshistoria
     *
     * @return Empresa
     */
    public function setPeriodoshistoria($periodoshistoria)
    {
        $this->periodoshistoria = $periodoshistoria;

        return $this;
    }

    /**
     * Get periodoshistoria
     *
     * @return integer
     */
    public function getPeriodoshistoria()
    {
        return $this->periodoshistoria;
    }

    /**
     * Set periodoinicialejercicio
     *
     * @param integer $periodoinicialejercicio
     *
     * @return Empresa
     */
    public function setPeriodoinicialejercicio($periodoinicialejercicio)
    {
        $this->periodoinicialejercicio = $periodoinicialejercicio;

        return $this;
    }

    /**
     * Get periodoinicialejercicio
     *
     * @return integer
     */
    public function getPeriodoinicialejercicio()
    {
        return $this->periodoinicialejercicio;
    }

    /**
     * Set periodosejercicio
     *
     * @param integer $periodosejercicio
     *
     * @return Empresa
     */
    public function setPeriodosejercicio($periodosejercicio)
    {
        $this->periodosejercicio = $periodosejercicio;

        return $this;
    }

    /**
     * Get periodosejercicio
     *
     * @return integer
     */
    public function getPeriodosejercicio()
    {
        return $this->periodosejercicio;
    }

    /**
     * Set servidorsmtpcomprobanteselectronicos
     *
     * @param string $servidorsmtpcomprobanteselectronicos
     *
     * @return Empresa
     */
    public function setServidorsmtpcomprobanteselectronicos($servidorsmtpcomprobanteselectronicos)
    {
        $this->servidorsmtpcomprobanteselectronicos = $servidorsmtpcomprobanteselectronicos;

        return $this;
    }

    /**
     * Get servidorsmtpcomprobanteselectronicos
     *
     * @return string
     */
    public function getServidorsmtpcomprobanteselectronicos()
    {
        return $this->servidorsmtpcomprobanteselectronicos;
    }

    /**
     * Set puertoservidorsmtpcomprobanteselectronicos
     *
     * @param string $puertoservidorsmtpcomprobanteselectronicos
     *
     * @return Empresa
     */
    public function setPuertoservidorsmtpcomprobanteselectronicos($puertoservidorsmtpcomprobanteselectronicos)
    {
        $this->puertoservidorsmtpcomprobanteselectronicos = $puertoservidorsmtpcomprobanteselectronicos;

        return $this;
    }

    /**
     * Get puertoservidorsmtpcomprobanteselectronicos
     *
     * @return string
     */
    public function getPuertoservidorsmtpcomprobanteselectronicos()
    {
        return $this->puertoservidorsmtpcomprobanteselectronicos;
    }

    /**
     * Set usuariosmtpcomprobanteselectronicos
     *
     * @param string $usuariosmtpcomprobanteselectronicos
     *
     * @return Empresa
     */
    public function setUsuariosmtpcomprobanteselectronicos($usuariosmtpcomprobanteselectronicos)
    {
        $this->usuariosmtpcomprobanteselectronicos = $usuariosmtpcomprobanteselectronicos;

        return $this;
    }

    /**
     * Get usuariosmtpcomprobanteselectronicos
     *
     * @return string
     */
    public function getUsuariosmtpcomprobanteselectronicos()
    {
        return $this->usuariosmtpcomprobanteselectronicos;
    }

    /**
     * Set passwordsmtpcomprobanteselectronicos
     *
     * @param string $passwordsmtpcomprobanteselectronicos
     *
     * @return Empresa
     */
    public function setPasswordsmtpcomprobanteselectronicos($passwordsmtpcomprobanteselectronicos)
    {
        $this->passwordsmtpcomprobanteselectronicos = $passwordsmtpcomprobanteselectronicos;

        return $this;
    }

    /**
     * Get passwordsmtpcomprobanteselectronicos
     *
     * @return string
     */
    public function getPasswordsmtpcomprobanteselectronicos()
    {
        return $this->passwordsmtpcomprobanteselectronicos;
    }

    /**
     * Set emailemisorcomprobanteselectronicos
     *
     * @param string $emailemisorcomprobanteselectronicos
     *
     * @return Empresa
     */
    public function setEmailemisorcomprobanteselectronicos($emailemisorcomprobanteselectronicos)
    {
        $this->emailemisorcomprobanteselectronicos = $emailemisorcomprobanteselectronicos;

        return $this;
    }

    /**
     * Get emailemisorcomprobanteselectronicos
     *
     * @return string
     */
    public function getEmailemisorcomprobanteselectronicos()
    {
        return $this->emailemisorcomprobanteselectronicos;
    }

    /**
     * Set archivoemailcomprobanteselectronicos
     *
     * @param string $archivoemailcomprobanteselectronicos
     *
     * @return Empresa
     */
    public function setArchivoemailcomprobanteselectronicos($archivoemailcomprobanteselectronicos)
    {
        $this->archivoemailcomprobanteselectronicos = $archivoemailcomprobanteselectronicos;

        return $this;
    }

    /**
     * Get archivoemailcomprobanteselectronicos
     *
     * @return string
     */
    public function getArchivoemailcomprobanteselectronicos()
    {
        return $this->archivoemailcomprobanteselectronicos;
    }

    /**
     * Set archivocertificadocomprobanteselectronicos
     *
     * @param string $archivocertificadocomprobanteselectronicos
     *
     * @return Empresa
     */
    public function setArchivocertificadocomprobanteselectronicos($archivocertificadocomprobanteselectronicos)
    {
        $this->archivocertificadocomprobanteselectronicos = $archivocertificadocomprobanteselectronicos;

        return $this;
    }

    /**
     * Get archivocertificadocomprobanteselectronicos
     *
     * @return string
     */
    public function getArchivocertificadocomprobanteselectronicos()
    {
        return $this->archivocertificadocomprobanteselectronicos;
    }

    /**
     * Set passwordcertificadocomprobanteselectronicos
     *
     * @param string $passwordcertificadocomprobanteselectronicos
     *
     * @return Empresa
     */
    public function setPasswordcertificadocomprobanteselectronicos($passwordcertificadocomprobanteselectronicos)
    {
        $this->passwordcertificadocomprobanteselectronicos = $passwordcertificadocomprobanteselectronicos;

        return $this;
    }

    /**
     * Get passwordcertificadocomprobanteselectronicos
     *
     * @return string
     */
    public function getPasswordcertificadocomprobanteselectronicos()
    {
        return $this->passwordcertificadocomprobanteselectronicos;
    }

    /**
     * Set tipoambientecomprobanteselectronicos
     *
     * @param string $tipoambientecomprobanteselectronicos
     *
     * @return Empresa
     */
    public function setTipoambientecomprobanteselectronicos($tipoambientecomprobanteselectronicos)
    {
        $this->tipoambientecomprobanteselectronicos = $tipoambientecomprobanteselectronicos;

        return $this;
    }

    /**
     * Get tipoambientecomprobanteselectronicos
     *
     * @return string
     */
    public function getTipoambientecomprobanteselectronicos()
    {
        return $this->tipoambientecomprobanteselectronicos;
    }

    /**
     * Set tipoemisioncomprobanteselectronicos
     *
     * @param string $tipoemisioncomprobanteselectronicos
     *
     * @return Empresa
     */
    public function setTipoemisioncomprobanteselectronicos($tipoemisioncomprobanteselectronicos)
    {
        $this->tipoemisioncomprobanteselectronicos = $tipoemisioncomprobanteselectronicos;

        return $this;
    }

    /**
     * Get tipoemisioncomprobanteselectronicos
     *
     * @return string
     */
    public function getTipoemisioncomprobanteselectronicos()
    {
        return $this->tipoemisioncomprobanteselectronicos;
    }

    /**
     * Set tipopublicacioncomprobanteselectronicos
     *
     * @param string $tipopublicacioncomprobanteselectronicos
     *
     * @return Empresa
     */
    public function setTipopublicacioncomprobanteselectronicos($tipopublicacioncomprobanteselectronicos)
    {
        $this->tipopublicacioncomprobanteselectronicos = $tipopublicacioncomprobanteselectronicos;

        return $this;
    }

    /**
     * Get tipopublicacioncomprobanteselectronicos
     *
     * @return string
     */
    public function getTipopublicacioncomprobanteselectronicos()
    {
        return $this->tipopublicacioncomprobanteselectronicos;
    }

    /**
     * Set comprobanteselectronicos
     *
     * @param boolean $comprobanteselectronicos
     *
     * @return Empresa
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
     * Set comercioexterior
     *
     * @param boolean $comercioexterior
     *
     * @return Empresa
     */
    public function setComercioexterior($comercioexterior)
    {
        $this->comercioexterior = $comercioexterior;

        return $this;
    }

    /**
     * Get comercioexterior
     *
     * @return boolean
     */
    public function getComercioexterior()
    {
        return $this->comercioexterior;
    }

    /**
     * Set obligadocontabilidad
     *
     * @param boolean $obligadocontabilidad
     *
     * @return Empresa
     */
    public function setObligadocontabilidad($obligadocontabilidad)
    {
        $this->obligadocontabilidad = $obligadocontabilidad;

        return $this;
    }

    /**
     * Get obligadocontabilidad
     *
     * @return boolean
     */
    public function getObligadocontabilidad()
    {
        return $this->obligadocontabilidad;
    }

    /**
     * Set fechainiciocontabilidad
     *
     * @param \DateTime $fechainiciocontabilidad
     *
     * @return Empresa
     */
    public function setFechainiciocontabilidad($fechainiciocontabilidad)
    {
        $this->fechainiciocontabilidad = $fechainiciocontabilidad;

        return $this;
    }

    /**
     * Get fechainiciocontabilidad
     *
     * @return \DateTime
     */
    public function getFechainiciocontabilidad()
    {
        return $this->fechainiciocontabilidad;
    }

    /**
     * Set cuentacontablecapitalid
     *
     * @param integer $cuentacontablecapitalid
     *
     * @return Empresa
     */
    public function setCuentacontablecapitalid($cuentacontablecapitalid)
    {
        $this->cuentacontablecapitalid = $cuentacontablecapitalid;

        return $this;
    }

    /**
     * Get cuentacontablecapitalid
     *
     * @return integer
     */
    public function getCuentacontablecapitalid()
    {
        return $this->cuentacontablecapitalid;
    }

    /**
     * Set cuentacontableresultadoid
     *
     * @param integer $cuentacontableresultadoid
     *
     * @return Empresa
     */
    public function setCuentacontableresultadoid($cuentacontableresultadoid)
    {
        $this->cuentacontableresultadoid = $cuentacontableresultadoid;

        return $this;
    }

    /**
     * Get cuentacontableresultadoid
     *
     * @return integer
     */
    public function getCuentacontableresultadoid()
    {
        return $this->cuentacontableresultadoid;
    }

    /**
     * Set contadorid
     *
     * @param \Arxis\ContableBundle\Entity\Contacto $contadorid
     *
     * @return Empresa
     */
    public function setContadorid(\Arxis\ContableBundle\Entity\Contacto $contadorid)
    {
        $this->contadorid = $contadorid;

        return $this;
    }

    /**
     * Get contadorid
     *
     * @return \Arxis\ContableBundle\Entity\Contacto
     */
    public function getContadorid()
    {
        return $this->contadorid;
    }

    /**
     * Set representantelegalid
     *
     * @param \Arxis\ContableBundle\Entity\Contacto $representantelegalid
     *
     * @return Empresa
     */
    public function setRepresentantelegalid(\Arxis\ContableBundle\Entity\Contacto $representantelegalid)
    {
        $this->representantelegalid = $representantelegalid;

        return $this;
    }

    /**
     * Get representantelegalid
     *
     * @return \Arxis\ContableBundle\Entity\Contacto
     */
    public function getRepresentantelegalid()
    {
        return $this->representantelegalid;
    }

    /**
     * Set tipoagenteretencionid
     *
     * @param \Arxis\ContableBundle\Entity\Tipoagenteretencion $tipoagenteretencionid
     *
     * @return Empresa
     */
    public function setTipoagenteretencionid(\Arxis\ContableBundle\Entity\Tipoagenteretencion $tipoagenteretencionid)
    {
        $this->tipoagenteretencionid = $tipoagenteretencionid;

        return $this;
    }

    /**
     * Get tipoagenteretencionid
     *
     * @return \Arxis\ContableBundle\Entity\Tipoagenteretencion
     */
    public function getTipoagenteretencionid()
    {
        return $this->tipoagenteretencionid;
    }

    /**
     * Set tipoidentificacionid
     *
     * @param \Arxis\ContableBundle\Entity\Tipoidentificacion $tipoidentificacionid
     *
     * @return Empresa
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
     * @return Empresa
     */
    public function setTipopersonaid(\Arxis\ContableBundle\Entity\Tipopersona $tipopersonaid = null)
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
}
