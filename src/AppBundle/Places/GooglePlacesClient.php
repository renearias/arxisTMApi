<?php
 
namespace AppBundle\Places;

use Symfony\Component\HttpFoundation\Response;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface as GuzzleClientInterface;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;



/**
 * Description of GooglePlacesClient
 *
 * @author Rene Arias <renearias@arxis.la>
 */
class GooglePlacesClient {
    
    protected $client;
    private $headers = array();
    private $auth = null;
    /**
     * 
     * @param GuzzleClientInterface $client
     * @return $this
     */
    public function setClient(GuzzleClientInterface $client)
    {
        $this->client = $client;
        return $this;
    }
    /**
     * 
     * @return type
     */
    public function getClient()
    {
        if (!$this->client) {
            $this->client = new GuzzleClient(array('defaults' => array('allow_redirects' => false, 'cookies' => false)));
        }
        return $this->client;
    }
    
    public function doRequest($method, $uri)
    {
        
        /*$requestOptions = array(
            'cookies' => $cookies,
            'allow_redirects' => false,
            'auth' => $this->auth,
        );*/
        
        // Let BrowserKit handle redirects
        try {
            $response = $this->getClient()->request($method, $uri);
        } catch (RequestException $e) {
            $response = $e->getResponse();
            if (null === $response) {
                throw $e;
            }
        }
        return $this->createResponse($response);
    }
    
    protected function createResponse(ResponseInterface $response)
    {
        //var_dump($response->getHeaders());
        //return new Response($response->getBody()->getContents(), $response->getStatusCode(), $response->getHeaders());
        return new Response($response->getBody()->getContents(), Response::HTTP_OK, ['content-type' => 'application/json']);
    }
    
}
