<?php

namespace Arxis\ContableBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comprobantediario
 *
 * @ORM\Table(name="comprobantediario", indexes={@ORM\Index(name="ComprobanteDiario_Establecimiento", columns={"EstablecimientoId"}), @ORM\Index(name="ComprobanteDiario_TipoComprobanteDiario", columns={"TipoComprobanteDiarioId"}), @ORM\Index(name="ComprobanteDiario_Documento", columns={"DocumentoId"}), @ORM\Index(name="ComprobanteDiario_EstadoDocumento", columns={"EstadoDocumentoId"})})
 * @ORM\Entity
 */
class Comprobantediario
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
     * @var \DateTime
     *
     * @ORM\Column(name="Fecha", type="datetime", nullable=false, options={"default":"2000-01-01 00:00:00"})
     */
    private $fecha = '2000-01-01 00:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FechaEmision", type="date", nullable=false, options={"default":"2000-01-01"})
     */
    private $fechaemision = '2000-01-01';

    /**
     * @var string
     *
     * @ORM\Column(name="Serie", type="string", length=10, nullable=false, options={"default":"001001"})
     */
    private $serie = '001001';

    /**
     * @var integer
     *
     * @ORM\Column(name="Numero", type="integer", nullable=false, options={"default":0,"unsigned":true})
     */
    private $numero = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="Referencia", type="string", length=250, nullable=true)
     */
    private $referencia;

    /**
     * @var string
     *
     * @ORM\Column(name="Notas", type="text", length=65535, nullable=true)
     */
    private $notas;

    /**
     * @var decimal
     *
     * @ORM\Column(name="Debe", type="decimal", precision=12, scale=2, nullable=false, options={"default":"0.00"})
     */
    private $debe = 0.00;

    /**
     * @var decimal
     *
     * @ORM\Column(name="Haber", type="decimal", precision=12, scale=2, nullable=false, options={"default":"0.00"})  
     *
     */
    private $haber = 0.00;

    /**
     * @var string
     *
     * @ORM\Column(name="Concepto", type="string", length=250, nullable=false)
     */
    private $concepto;

    /**
     * @var \Documento
     *
     * @ORM\ManyToOne(targetEntity="Documento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="DocumentoId", referencedColumnName="id", nullable=false)
     * })
     */
    private $documentoid; //deberia estar a 1 hay que ver

    /**
     * @var \Establecimiento
     *
     * @ORM\ManyToOne(targetEntity="Establecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="EstablecimientoId", referencedColumnName="id", nullable=false)
     * })
     */
    private $establecimientoid;  //debera ser igual a uno

    /**
     * @var \Estadodocumento
     *
     * @ORM\ManyToOne(targetEntity="Estadodocumento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="EstadoDocumentoId", referencedColumnName="id", nullable=false)
     * })
     */
    private $estadodocumentoid;

    /**
     * @var \Tipocomprobantediario
     *
     * @ORM\ManyToOne(targetEntity="Tipocomprobantediario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="TipoComprobanteDiarioId", referencedColumnName="id", nullable=false)
     * })
     */
    private $tipocomprobantediarioid;



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
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Comprobantediario
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
     * Set fechaemision
     *
     * @param \DateTime $fechaemision
     *
     * @return Comprobantediario
     */
    public function setFechaemision($fechaemision)
    {
        $this->fechaemision = $fechaemision;

        return $this;
    }

    /**
     * Get fechaemision
     *
     * @return \DateTime
     */
    public function getFechaemision()
    {
        return $this->fechaemision;
    }

    /**
     * Set serie
     *
     * @param string $serie
     *
     * @return Comprobantediario
     */
    public function setSerie($serie)
    {
        $this->serie = $serie;

        return $this;
    }

    /**
     * Get serie
     *
     * @return string
     */
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * Set numero
     *
     * @param integer $numero
     *
     * @return Comprobantediario
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return integer
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set referencia
     *
     * @param string $referencia
     *
     * @return Comprobantediario
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
     * Set notas
     *
     * @param string $notas
     *
     * @return Comprobantediario
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
     * Set debe
     *
     * @param string $debe
     *
     * @return Comprobantediario
     */
    public function setDebe($debe)
    {
        $this->debe = $debe;

        return $this;
    }

    /**
     * Get debe
     *
     * @return string
     */
    public function getDebe()
    {
        return $this->debe;
    }

    /**
     * Set haber
     *
     * @param string $haber
     *
     * @return Comprobantediario
     */
    public function setHaber($haber)
    {
        $this->haber = $haber;

        return $this;
    }

    /**
     * Get haber
     *
     * @return string
     */
    public function getHaber()
    {
        return $this->haber;
    }

    /**
     * Set concepto
     *
     * @param string $concepto
     *
     * @return Comprobantediario
     */
    public function setConcepto($concepto)
    {
        $this->concepto = $concepto;

        return $this;
    }

    /**
     * Get concepto
     *
     * @return string
     */
    public function getConcepto()
    {
        return $this->concepto;
    }

    /**
     * Set documentoid
     *
     * @param \Arxis\ContableBundle\Entity\Documento $documentoid
     *
     * @return Comprobantediario
     */
    public function setDocumentoid(\Arxis\ContableBundle\Entity\Documento $documentoid)
    {
        $this->documentoid = $documentoid;

        return $this;
    }

    /**
     * Get documentoid
     *
     * @return \Arxis\ContableBundle\Entity\Documento
     */
    public function getDocumentoid()
    {
        return $this->documentoid;
    }

    /**
     * Set establecimientoid
     *
     * @param \Arxis\ContableBundle\Entity\Establecimiento $establecimientoid
     *
     * @return Comprobantediario
     */
    public function setEstablecimientoid(\Arxis\ContableBundle\Entity\Establecimiento $establecimientoid)
    {
        $this->establecimientoid = $establecimientoid;

        return $this;
    }

    /**
     * Get establecimientoid
     *
     * @return \Arxis\ContableBundle\Entity\Establecimiento
     */
    public function getEstablecimientoid()
    {
        return $this->establecimientoid;
    }

    /**
     * Set estadodocumentoid
     *
     * @param \Arxis\ContableBundle\Entity\Estadodocumento $estadodocumentoid
     *
     * @return Comprobantediario
     */
    public function setEstadodocumentoid(\Arxis\ContableBundle\Entity\Estadodocumento $estadodocumentoid)
    {
        $this->estadodocumentoid = $estadodocumentoid;

        return $this;
    }

    /**
     * Get estadodocumentoid
     *
     * @return \Arxis\ContableBundle\Entity\Estadodocumento
     */
    public function getEstadodocumentoid()
    {
        return $this->estadodocumentoid;
    }

    /**
     * Set tipocomprobantediarioid
     *
     * @param \Arxis\ContableBundle\Entity\Tipocomprobantediario $tipocomprobantediarioid
     *
     * @return Comprobantediario
     */
    public function setTipocomprobantediarioid(\Arxis\ContableBundle\Entity\Tipocomprobantediario $tipocomprobantediarioid)
    {
        $this->tipocomprobantediarioid = $tipocomprobantediarioid;

        return $this;
    }

    /**
     * Get tipocomprobantediarioid
     *
     * @return \Arxis\ContableBundle\Entity\Tipocomprobantediario
     */
    public function getTipocomprobantediarioid()
    {
        return $this->tipocomprobantediarioid;
    }
}
