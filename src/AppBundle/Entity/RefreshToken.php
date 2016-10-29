<?php
// src/Acme/ApiBundle/Entity/RefreshToken.php

namespace AppBundle\Entity;

use FOS\OAuthServerBundle\Entity\RefreshToken as BaseRefreshToken;
use Doctrine\ORM\Mapping as ORM;

/**
 * Description of RefreshToken
 *
 * @author Rene Arias <renearias@arxis.la>
 */


/**
 * @ORM\Entity
 * @ORM\Table("oauth2_refresh_tokens")
 */
class RefreshToken extends BaseRefreshToken
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $client;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Usuario")
     */
    protected $user;
}
