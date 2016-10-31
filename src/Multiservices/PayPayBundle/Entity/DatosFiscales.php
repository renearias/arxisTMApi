<?php

namespace Multiservices\PayPayBundle\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Mapping as ORM;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * DatosFiscales
 *
 * @ORM\Table(name="datos_fiscales")
 * @ORM\Entity(repositoryClass="Multiservices\PayPayBundle\Entity\DatosFiscalesRepository")
 */
class DatosFiscales
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
     * @var string
     *
     * @ORM\Column(name="razon_social", type="string", length=256, nullable=false)
     */
    private $razonSocial;
    
    /**
     * @var string
     *
     * @ORM\Column(name="nombre_comercial", type="string", length=256, nullable=false)
     */
    private $nombreComercial;
    
    /**
     * @var string
     *
     * @ORM\Column(name="ruc", type="string", length=13, nullable=false)
     */
    private $ruc;
    
    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=256, nullable=false)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="obligado_contabilidad", type="string", length=2, nullable=false)
     */
    private $obligadoContabilidad;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="ambiente", type="integer", nullable=false,options={"unsigned"=true})     
     */
    private $ambiente;
    
    /**
     * @var string
     *
     * @ORM\Column(name="serie", type="string", length=6, nullable=false)
     */
    private $serie;
    
    /**
     * @var string
     *
     * @ORM\Column(name="certificado", type="string", length=256, nullable=false)
     */
    private $certificado;
    
    /**
     * @Assert\File(maxSize="50000")
     */
    private $archivoCertificado;
    
    /**
     * @var string
     *
     * @ORM\Column(name="clave", type="string", length=20, nullable=false)
     */
    private $clave;
    
    
    public function __construct() {       
       
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
     * Set razonSocial
     *
     * @param string $razonSocial
     * @return DatosFiscales
     */
    public function setRazonSocial($razonSocial)
    {
    	$this->razonSocial = $razonSocial;
    
    	return $this;
    }
    
    /**
     * Get razonSocial
     *
     * @return string
     */
    public function getRazonSocial()
    {
    	return $this->razonSocial;
    }   

    /**
     * Set nombreComercial
     *
     * @param string $nombreComercial
     * @return DatosFiscales
     */
    public function setNombreComercial($nombreComercial)
    {
    	$this->nombreComercial = $nombreComercial;
    
    	return $this;
    }
    
    /**
     * Get nombreComercial
     *
     * @return string
     */
    public function getNombreComercial()
    {
    	return $this->nombreComercial;
    }   
    
    /**
     * Set ruc
     *
     * @param string $ruc
     * @return DatosFiscales
     */
    public function setRuc($ruc)
    {
    	$this->ruc = $ruc;
    
    	return $this;
    }
    
    /**
     * Get rucl
     *
     * @return string
     */
    public function getRuc()
    {
    	return $this->ruc;
    }
    
    /**
     * Set direccion
     *
     * @param string $direccion
     * @return DatosFiscales
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
     * Set obligadoContabilidad
     *
     * @param string $obligadoContabilidad
     * @return DatosFiscales
     */
    public function setObligadoContabilidad($obligadoContabilidad)
    {
    	$this->obligadoContabilidad = $obligadoContabilidad;
    
    	return $this;
    }
    
    /**
     * Get obligadoContabilidad
     *
     * @return string
     */
    public function getObligadoContabilidad()
    {
    	return $this->obligadoContabilidad;
    }
    
    /**
     * Set ambiente
     *
     * @param integer $ambiente
     * @return DatosFiscales
     */
    public function setAmbiente($ambiente)
    {
    	$this->ambiente = $ambiente;
    
    	return $this;
    }
    
    /**
     * Get ambiente
     *
     * @return integer
     */
    public function getAmbiente()
    {
    	return $this->ambiente;
    }
    
    /**
     * Set serie
     *
     * @param string $serie
     * @return DatosFiscales
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
    
    public function getAbsoluteCertificado()
    {
    	return null === $this->certificado
    	? null
    	: $this->getCertificadoRootDir().'/'.$this->certificado;
    }
    
    public function getCertificado()
    {
    	return $this->certificado;    	
    }
    
    protected function getCertificadoRootDir()
    {
    	return __DIR__.'/../P12';
    }   
    
    /**
     * Sets archivoCertificado.
     *
     * @param UploadedFile $archivoCertificado
     */
    public function setArchivoCertificado(UploadedFile $archivoCertificado = null)
    {
    	$this->archivoCertificado = $archivoCertificado;
    }
    
    /**
     * Get archivoCertificado.
     *
     * @return UploadedFile
     */
    public function getArchivoCertificado()
    {
    	return $this->archivoCertificado;
    }
    
    public function upload()
    {
    	// the file property can be empty if the field is not required
    	if (null === $this->getArchivoCertificado()) {
    		return;
    	}
    
    	$this->getArchivoCertificado()->move(
    			$this->getCertificadoRootDir(),
    			$this->getArchivoCertificado()->getClientOriginalName()
    	);
    
    	if(isset($this->certificado) && $this->certificado!=""){
    		unlink($this->getAbsoluteCertificado());
    	}
    	
    	$this->certificado = $this->getArchivoCertificado()->getClientOriginalName();    
    	
    	$this->file = null;
    }
    
    /**
     * Set clave
     *
     * @param string $clave
     * @return DatosFiscales
     */
    public function setClave($clave)
    {
    	$this->clave = $clave;
    
    	return $this;
    }
    
    /**
     * Get clave
     *
     * @return string
     */
    public function getClave()
    {
    	return $this->clave;
    }
    
}
