<?php

namespace Multiservices\PayPayBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proveedores
 *
 * @ORM\Table(name="proveedores")
 * @ORM\Entity
 */
class Proveedores
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="ruc", type="string", length=13, nullable=false)
     */
    private $ruc;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=50, nullable=false)
     */
    private $direccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="codprovincia", type="integer", nullable=false)
     */
    private $codprovincia;

    /**
     * @var string
     *
     * @ORM\Column(name="ciudad", type="string", length=35, nullable=false)
     */
    private $ciudad;

    /**
     * @var integer
     *
     * @ORM\Column(name="codentidad", type="integer", nullable=true)
     */
    private $codentidad;

    /**
     * @var string
     *
     * @ORM\Column(name="cuentabancaria", type="string", length=20, nullable=true)
     */
    private $cuentabancaria;

    /**
     * @var string
     *
     * @ORM\Column(name="codpostal", type="string", length=5, nullable=true)
     */
    private $codpostal;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=14, nullable=false)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="movil", type="string", length=14, nullable=false)
     */
    private $movil;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=35, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="web", type="string", length=45, nullable=true)
     */
    private $web;

    /**
     * @var string
     *
     * @ORM\Column(name="borrado", type="string", length=1, nullable=true)
     */
    private $borrado;

    /**
     * @var integer
     *
     * @ORM\Column(name="codproveedor", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codproveedor;



    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Proveedores
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
     * Set ruc
     *
     * @param string $ruc
     * @return Proveedores
     */
    public function setRuc($ruc)
    {
        $this->ruc = $ruc;

        return $this;
    }

    /**
     * Get ruc
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
     * @return Proveedores
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
     * Set codprovincia
     *
     * @param integer $codprovincia
     * @return Proveedores
     */
    public function setCodprovincia($codprovincia)
    {
        $this->codprovincia = $codprovincia;

        return $this;
    }

    /**
     * Get codprovincia
     *
     * @return integer 
     */
    public function getCodprovincia()
    {
        return $this->codprovincia;
    }

    /**
     * Set ciudad
     *
     * @param string $ciudad
     * @return Proveedores
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
     * Set codentidad
     *
     * @param integer $codentidad
     * @return Proveedores
     */
    public function setCodentidad($codentidad)
    {
        $this->codentidad = $codentidad;

        return $this;
    }

    /**
     * Get codentidad
     *
     * @return integer 
     */
    public function getCodentidad()
    {
        return $this->codentidad;
    }

    /**
     * Set cuentabancaria
     *
     * @param string $cuentabancaria
     * @return Proveedores
     */
    public function setCuentabancaria($cuentabancaria)
    {
        $this->cuentabancaria = $cuentabancaria;

        return $this;
    }

    /**
     * Get cuentabancaria
     *
     * @return string 
     */
    public function getCuentabancaria()
    {
        return $this->cuentabancaria;
    }

    /**
     * Set codpostal
     *
     * @param string $codpostal
     * @return Proveedores
     */
    public function setCodpostal($codpostal)
    {
        $this->codpostal = $codpostal;

        return $this;
    }

    /**
     * Get codpostal
     *
     * @return string 
     */
    public function getCodpostal()
    {
        return $this->codpostal;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Proveedores
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set movil
     *
     * @param string $movil
     * @return Proveedores
     */
    public function setMovil($movil)
    {
        $this->movil = $movil;

        return $this;
    }

    /**
     * Get movil
     *
     * @return string 
     */
    public function getMovil()
    {
        return $this->movil;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Proveedores
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
     * Set web
     *
     * @param string $web
     * @return Proveedores
     */
    public function setWeb($web)
    {
        $this->web = $web;

        return $this;
    }

    /**
     * Get web
     *
     * @return string 
     */
    public function getWeb()
    {
        return $this->web;
    }

    /**
     * Set borrado
     *
     * @param string $borrado
     * @return Proveedores
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
     * Get codproveedor
     *
     * @return integer 
     */
    public function getCodproveedor()
    {
        return $this->codproveedor;
    }
}
