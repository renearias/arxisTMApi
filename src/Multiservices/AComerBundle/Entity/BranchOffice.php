<?php
/**
 * User: waular
 */

namespace Multiservices\AComerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BranchOffice
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class BranchOffice {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Locations")
     * @ORM\JoinColumn(name="location", referencedColumnName="id")
     **/
    private $location;

    /**
     * @ORM\ManyToOne(targetEntity="Restaurant")
     * @ORM\JoinColumn(name="restaurant", referencedColumnName="id")
     **/
    private $restaurant;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="text")
     */
    private $address;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float" )
     */
    private $latitude;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float" )
     */
    private $longitude;


    /**
     * @var string
     *
     * @ORM\Column(name="hour_hand", type="json_array", nullable=true)
     */
    private $hourHand;

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getHourHand()
    {
        return $this->hourHand;
    }

    /**
     * @param string $hourHand
     */
    public function setHourHand($hourHand)
    {
        $this->hourHand = $hourHand;
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
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return mixed
     */
    public function getRestaurant()
    {
        return $this->restaurant;
    }

    /**
     * @param mixed $restaurant
     */
    public function setRestaurant($restaurant)
    {
        $this->restaurant = $restaurant;
    }




}


?> 