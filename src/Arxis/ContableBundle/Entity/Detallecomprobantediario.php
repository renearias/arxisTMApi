<?php

namespace Arxis\ContableBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Detallecomprobantediario
 *
 * @ORM\Table(name="detallecomprobantediario", indexes={@ORM\Index(name="DetalleComprobanteDiario_ComprobanteDiario", columns={"ComprobanteDiarioId"}), @ORM\Index(name="DetalleComprobanteDiario_CuentaContable", columns={"CuentaContableId"})})
 * @ORM\Entity
 */
class Detallecomprobantediario
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
     * @ORM\Column(name="Concepto", type="string", length=250, nullable=false)
     */
    private $concepto;

    /**
     * @var string
     *
     * @ORM\Column(name="NumeroDocumento", type="string", length=250, nullable=true)
     */
    private $numerodocumento;

    /**
     * @var float
     *
     * @ORM\Column(name="Debe", type="decimal", precision=12, scale=2, nullable=false, options={"default":"0.00"})
     */
    private $debe = '0.00';

    /**
     * @var float
     *
     * @ORM\Column(name="Haber", type="decimal", precision=12, scale=2, nullable=false, options={"default":"0.00"})
     */
    private $haber = '0.00';

    /**
     * @var \Comprobantediario
     *
     * @ORM\ManyToOne(targetEntity="Comprobantediario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ComprobanteDiarioId", referencedColumnName="id", nullable=false)
     * })
     */
    private $comprobantediarioid;

    /**
     * @var \Cuentacontable
     *
     * @ORM\ManyToOne(targetEntity="Cuentacontable")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CuentaContableId", referencedColumnName="id", nullable=false)
     * })
     */
    private $cuentacontableid;



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
     * Set concepto
     *
     * @param string $concepto
     *
     * @return Detallecomprobantediario
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
     * Set numerodocumento
     *
     * @param string $numerodocumento
     *
     * @return Detallecomprobantediario
     */
    public function setNumerodocumento($numerodocumento)
    {
        $this->numerodocumento = $numerodocumento;

        return $this;
    }

    /**
     * Get numerodocumento
     *
     * @return string
     */
    public function getNumerodocumento()
    {
        return $this->numerodocumento;
    }

    /**
     * Set debe
     *
     * @param string $debe
     *
     * @return Detallecomprobantediario
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
     * @return Detallecomprobantediario
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
     * Set comprobantediarioid
     *
     * @param \Arxis\ContableBundle\Entity\Comprobantediario $comprobantediarioid
     *
     * @return Detallecomprobantediario
     */
    public function setComprobantediarioid(\Arxis\ContableBundle\Entity\Comprobantediario $comprobantediarioid)
    {
        $this->comprobantediarioid = $comprobantediarioid;

        return $this;
    }

    /**
     * Get comprobantediarioid
     *
     * @return \Arxis\ContableBundle\Entity\Comprobantediario
     */
    public function getComprobantediarioid()
    {
        return $this->comprobantediarioid;
    }

    /**
     * Set cuentacontableid
     *
     * @param \Arxis\ContableBundle\Entity\Cuentacontable $cuentacontableid
     *
     * @return Detallecomprobantediario
     */
    public function setCuentacontableid(\Arxis\ContableBundle\Entity\Cuentacontable $cuentacontableid)
    {
        $this->cuentacontableid = $cuentacontableid;

        return $this;
    }

    /**
     * Get cuentacontableid
     *
     * @return \Arxis\ContableBundle\Entity\Cuentacontable
     */
    public function getCuentacontableid()
    {
        return $this->cuentacontableid;
    }
}
