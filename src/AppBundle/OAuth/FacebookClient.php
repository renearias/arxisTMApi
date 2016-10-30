<?php

namespace AppBundle\OAuth;

/**
 * Description of FacebookClient
 *
 * @author Rene Arias <renearias@arxis.la>
 */
use Facebook\Facebook;

class FacebookClient
{

    const FACEBOOK_APP_ID = '1614107982226472';
    const FACEBOOK_SECRET = '368802d5b4ea8e58d280c7bed37dd5f0';
    
    public function __construct() {
       $this->facebook = new Facebook(array(
          'app_id'  => self::FACEBOOK_APP_ID,
          'app_secret' => self::FACEBOOK_SECRET,
          //'default_graph_version' => 'v2.2', 
        ));
    }
    
    
}
