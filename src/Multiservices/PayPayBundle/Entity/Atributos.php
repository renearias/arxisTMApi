<?php

namespace Multiservices\PayPayBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Atributos
 *
 * @ORM\Table(name="atributos")
 * @ORM\Entity
 */
class Atributos
{
    /**
     * @var string
     *
     * @ORM\Column(name="atributo", type="string", length=100)
     */
    private $atributo;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set atributo
     *
     * @param string $atributo
     * @return Atributos
     */
    public function setAtributo($atributo)
    {
        $this->atributo = $atributo;

        return $this;
    }

    /**
     * Get atributo
     *
     * @return string 
     */
    public function getAtributo()
    {
        return $this->atributo;
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
}
