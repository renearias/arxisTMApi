<?php
 
namespace AppBundle\Places;

use Symfony\Component\HttpFoundation\Response;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface as GuzzleClientInterface;
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
     * Public Key del api
     * @var string
     */
    private $key="AIzaSyDloqho8mEB0qfUEg2C-rkjjgrOFtfpwaU";

    /**
     * Formato de presentacion, por defecto es json
     * Puede ser json o xml
     * @var string
     */
    private $object="json";

    /**
     * URL base para consultas al api
     * @var string
     */
    private $uri="https://maps.googleapis.com/maps/api/place/";

    /**
     * Tipo de consultas al api
     * Pueden ser: nearbysearch, details o geocode
     * @var
     */
    private $searchType;

    /**
     * Metodo request, por defecto GET
     * @var string
     */
    private $method="GET";

    /**
     * Tipo de establecimiento que se desea buscar
     * Puede ser: food o restaurant
     * @var string
     */
    private $type="food";


    /**
     * @return mixed
     */
    public function getSearchType()
    {
        return $this->searchType;
    }

    /**
     * @param mixed $searchType
     */
    public function setSearchType($searchType)
    {
        $this->searchType = $searchType;
    }


    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * @return string
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * @param string $object
     */
    public function setObject($object)
    {
        $this->object = $object;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param string $url
     */
    public function setUri($uri)
    {
        $this->url = $uri;
    }


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
    
    public function doRequest( $uri)
    {
        
        /*$requestOptions = array(
            'cookies' => $cookies,
            'allow_redirects' => false,
            'auth' => $this->auth,
        );*/
        
        // Let BrowserKit handle redirects
        try {
            $response = $this->getClient()->request($this->getMethod(), $uri);
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

    /**
     * Devuelve la URL armada para busquedas por latitud, longitud y radio
     *
     * @param $lat
     * @param $lng
     * @param $radius
     *
     * @return string
     */
    public function getUrl($lat,$lng,$radius){
        $this->setSearchType("nearbysearch");

        $clientUri =
            $this->getUri()
            .$this->getSearchType()."/"
            .$this->getObject()
            ."?location=".$lat.",".$lng
            ."&radius=".$radius
            ."&types=".$this->getType()
            ."&name=cruise"
            ."&key=".$this->getKey();

        return $clientUri;
    }

    /**
     * Devuelve la url armada para busqueda de detalle, consultando por el placeId
     *
     * @param $placeId
     * @return string
     */
    public function getUrlByPlaceId($placeId){
        $this->setSearchType("details");

        $clientUri =
            $this->getUri()
            .$this->getObject()
            ."?placeid=".$placeId
            ."&key=".$this->getKey();

        return $clientUri;
    }
    
}
