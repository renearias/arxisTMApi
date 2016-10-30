<?php

namespace AppBundle\OAuth;

use FOS\OAuthServerBundle\Storage\GrantExtensionInterface;
use OAuth2\Model\IOAuth2Client;
use AppBundle\OAuth\FacebookClient;
use HWI\Bundle\OAuthBundle\Security\Core\User\FOSUBUserProvider;
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use OAuth2\OAuth2ServerException;
use OAuth2\OAuth2;


/**
 * Description of FacebookGrantExtension
 *
 * @author Rene Arias <renearias@arxis.la>
 */
class FacebookGrantExtension implements GrantExtensionInterface{
    
    /**
     * @var UserProviderInterface
     */
    protected $userProvider;
    /**
     * @var FacebookClient
     */
    protected $facebookClient;
    
    protected $socialDetails;
    
    public function __construct(FOSUBUserProvider $userProvider)
    {
        $this->userProvider = $userProvider;
        //$this->facebookClient = $facebook;
        $this->facebookClient = (new FacebookClient())->facebook;
        
        
    }
    public function checkGrantExtension(IOAuth2Client $client, array $inputData, array $authHeaders)
    {
        if (!isset($inputData['facebook_access_token'])) {
            return false;
        }
        
        $this->facebookClient->setDefaultAccessToken($inputData['facebook_access_token']);
        try {
            $result = $this->facebookClient->get('/me?fields=id,email,name');
            $this->socialDetails = $result;
        }catch (FacebookResponseException $e) {
          throw new OAuth2ServerException(OAuth2::HTTP_BAD_REQUEST, OAuth2::ERROR_INVALID_GRANT, $e->getMessage());
          return false;
        }
        
        $fbData =$result->getDecodedBody();
        
        if (empty($fbData) || !isset($fbData['id'])) {
            return false;
        }
        
        $user = $this->userProvider->loadUserByFacebookId($fbData['id'],$inputData['facebook_access_token']);
        
        if (null === $user) {
            throw new OAuth2ServerException(OAuth2::HTTP_BAD_REQUEST, OAuth2::ERROR_INVALID_GRANT, 'User not found.');
            return false;
        }
        
        return array(
            'data' => $user,
        );
    }
    
    
}
