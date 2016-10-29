<?php
// src/Acme/ApiBundle/Entity/Client.php

namespace AppBundle\Entity;

use FOS\OAuthServerBundle\Entity\Client as BaseClient;
use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Client
 *
 * @author Rene Arias <renearias@arxis.la>
 */


/**
 * @ORM\Entity
 * @ORM\Table("oauth2_clients")
 */
class Client extends BaseClient
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Client
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
