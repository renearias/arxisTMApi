<?php
/**
 * Created by PhpStorm.
 * User: waular
 * Date: 15/11/2016
 * Time: 05:20 PM
 */

namespace Multiservices\AComerBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Locations
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Serializer\ExclusionPolicy("all")
 */
class Locations {

    public function __toString()
    {
        return $this->location;
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255)
     * @Serializer\Expose()
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     * @Serializer\Expose()
     */
    private $description;

    /**
     * @var Locations
     *
     * @ORM\ManyToOne(targetEntity="Locations", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     * @Serializer\Expose()
     **/
    private $parent;

    /**
     * @var string
     *
     * @ORM\Column(name="data", type="json_array", nullable=true)
     * @Serializer\Expose()
     */
    private $data;

    /**
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param string $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return Locations
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param Locations $parent
     */
    public function setParent(Locations $parent)
    {
        $this->parent = $parent;
    }



}

?> 