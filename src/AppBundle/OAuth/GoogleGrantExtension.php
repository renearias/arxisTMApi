<?php

namespace AppBundle\OAuth;

use FOS\OAuthServerBundle\Storage\GrantExtensionInterface;
use OAuth2\Model\IOAuth2Client;
use AppBundle\OAuth\FacebookClient;
use HWI\Bundle\OAuthBundle\Security\Core\User\FOSUBUserProvider;
use Facebook\Facebook;
use Google_Client;
use Google_Service_Drive;
//use Facebook\Exceptions\FacebookResponseException;
use OAuth2\OAuth2ServerException;
use OAuth2\OAuth2;


/**
 * Description of FacebookGrantExtension
 *
 * @author Rene Arias <renearias@arxis.la>
 */
class GoogleGrantExtension implements GrantExtensionInterface{
    
    /**
     * @var UserProviderInterface
     */
    protected $userProvider;
    /**
     * @var Google_Client
     */
    protected $googleClient;
    
    protected $socialDetails;
    
    public function __construct(FOSUBUserProvider $userProvider)
    {
        $this->userProvider = $userProvider;
        //$this->facebookClient = $facebook;
        $client = new Google_Client();
        $client->setClientId("490253814290-517cfmsaph7bme72juf94jt50p1ctqe7.apps.googleusercontent.com");
        $client->setClientSecret("qbdCaAbvOYWtM1XM9jqrAa6v");
        //$client->setAuthConfig('client_secrets.json');
        $client->addScope('email');
        $client->addScope('profile');
        $client->addScope(Google_Service_Drive::DRIVE);
        //$client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/oauth2/v2/auth');
        $this->googleClient = $client;
        
        
    }
    public function checkGrantExtension(IOAuth2Client $client, array $inputData, array $authHeaders)
    {
        if (!isset($inputData['google_access_token'])) {
            return false;
        }
        $ticket=$this->googleClient->verifyIdToken($inputData['google_access_token']);
        if ($ticket) {
            $data = $ticket->getAttributes();
            $googleId=$data['payload']['sub']; // user ID
           //token vale 
            $this->googleClient->setAccessToken($inputData['google_access_token']);
            //$this->googleClient->
            $result = $data;
            $this->socialDetails = $result;
        }else
        {
            throw new OAuth2ServerException(OAuth2::HTTP_BAD_REQUEST, OAuth2::ERROR_INVALID_GRANT, 'invalid google token');
           
        }
        
        $fbData =$result->getDecodedBody();
        
        if (empty($fbData) || !isset($fbData['id'])) {
            return false;
        }
        
        $user = $this->userProvider->loadUserByGoogleId($googleId,$inputData['google_access_token']);
        
        if (null === $user) {
            throw new OAuth2ServerException(OAuth2::HTTP_BAD_REQUEST, OAuth2::ERROR_INVALID_GRANT, 'User not found.');
            return false;
        }
        
        return array(
            'data' => $user,
        );
    }
    
    
}
