<?php

namespace Multiservices\AComerBundle\Controller;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Multiservices\AComerBundle\Entity\Restaurant;
use Multiservices\AComerBundle\Entity\BranchOffice;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Places\GooglePlacesClient;

/**
 * Restaurant controller.
 *
* @Rest\RouteResource("restaurant")
 */
class RestaurantController extends FOSRestController implements ClassResourceInterface
{

    /**
     * Constante para calcular grados por kilometro
     * Equivale a la cantidad de grados en un kilometro
     * @var float
     */
    private $GR_BY_KM=0.00909090909091;

    /**
     * Lists all Restaurant entities.
     *
     * @ApiDoc(
     *   resource = true,
     *   section="Restaurant",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when not found"
     *   }
     * )
     *
     * @Rest\View()
     *
     */
    public function cgetAction()
    {
        $em = $this->getDoctrine()->getManager();

        $restaurants = $em->getRepository('AComerBundle:Restaurant')->findAll();

        //$restaurants_datatable = $this->get("acomerbundle_datatable.restaurants");
        //$restaurants_datatable->buildDatatable();

        $view = $this->view($restaurants)
            ->setTemplate('restaurant/index.html.twig')
            ->setTemplateData([
                            'restaurants' => $restaurants
                             ]);
        return $restaurants;
    }

    /**
     * Get results from Restaurant entity.
     *
     * @ApiDoc(
     *   resource = true,
     *   section="Restaurant",
     *   filters={
     *      {"name"="search[value]", "dataType"="string", "default"="", "required":true},
     *      {"name"="draw", "dataType"="integer"}
     *   },
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when not found"
     *   }
     * )
     *
     * @Rest\View()
     *
     */
    public function resultsAction(Request $request)
    {

        $datatable = $this->get('acomerbundle_datatable.restaurants');
        $datatable->buildDatatable();
        $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

        return $query->getResponse();
    }


    /**
     * Get results from Restaurant entity.
     *
     * @ApiDoc(
     *   resource = true,
     *   section="Restaurant",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when not found"
     *   }
     * 
     * )
     * @Rest\RequestParam(name="lat", default="0", description="latitude")
     * @Rest\RequestParam(name="lng", default="0", description="longitude")
     * @Rest\RequestParam(name="radio", default="500", description="radio in meters")
     * @Rest\View()
     *
     */
    public function postSearchAction(ParamFetcher $paramFetcher)
    {
        $serializer = $this->get('serializer');
        $lat = $paramFetcher->get('lat');
        $lng = $paramFetcher->get('lng');
        $radio = $paramFetcher->get('radio');
        $reports = $serializer->serialize($this->getRestaurant($lat,$lng,$radio), 'json');

        $response = new Response($reports);

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
    
    private function getRestaurant($lat,$lng,$radio){
        $response=array();

        $radio_km= $radio/1000;
        $km= $this->GR_BY_KM*$radio_km;

        $lat_min = $lat - $km;
        $lat_max = $lat + $km;

        $lng_min = $lng - $km;
        $lng_max = $lng + $km;

        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery(
            'SELECT bo
                FROM AComerBundle:BranchOffice bo
                WHERE bo.latitude >= :lat_min
                AND bo.latitude <= :lat_max
                AND bo.longitude >= :lng_min
                AND bo.longitude <= :lng_max
                ORDER BY bo.id ASC'
        )->setParameter('lat_min', $lat_min)
            ->setParameter('lat_max', $lat_max)
            ->setParameter('lng_min', $lng_min)
            ->setParameter('lng_max', $lng_max);


        if(count($query->getResult())>0){
            $response["restaurants"] = $query->getResult();
        }else{
            $client = new GooglePlacesClient();
            $client->setType("food");

            $req = $client->doRequest($client->getUrl($lat,$lng,$radio));
            
            $deserealize= json_decode($req->getContent(),true);
            if(strtoupper($deserealize["status"])=="OK"){
                $restaurantList=array();
                foreach($deserealize["results"] as $result){
                    $branchOffice = $this->getDoctrine()
                        ->getRepository('AComerBundle:BranchOffice')
                        ->findOneBy(array("placeId"=>$result["place_id"]));

                    if (!$branchOffice) {
                        $branchOffice= new BranchOffice();

                        $branchOffice->setAddress($result["vicinity"]);

                        $restaurant = $this->getDoctrine()
                            ->getRepository('AComerBundle:Restaurant')
                            ->findOneBy(array("name"=>$result["name"]));

                        if (!$restaurant) {
                            $restaurant = new Restaurant();
                            $restaurant->setName($result["name"]);
                        }

                        $branchOffice->setRestaurant($restaurant);
                        $branchOffice->setPlaceId($result["place_id"]);
                        $branchOffice->setLatitude($result["geometry"]["location"]["lat"]);
                        $branchOffice->setLongitude($result["geometry"]["location"]["lng"]);

                        $em->persist($branchOffice);
                        $em->flush();
                    }

                    array_push($restaurantList,$branchOffice);
                }
                $response["restaurants"]= $restaurantList;
            }
        }

        return $response;
    }

    /**
     * Finds and displays a Restaurant entity.
     *
     * @ApiDoc(
     *   resource = true,
     *   output = "Multiservices\AComerBundle\Entity\Restaurant",
     *   section="Restaurant",
     *    statusCodes = {
     *      200 = "Retorna la entidad Restaurant",
     *      404 = "Retorna cuando no se ecuentra objeto" 
     *   }
     * )
     *
     */
    public function getAction(Restaurant $restaurant)
    {

        $view = $this->view($restaurant, 200)
            ->setTemplate('restaurant/show.html.twig')
            ->setTemplateData(['restaurant'=>$restaurant]);
        return $this->handleView($view);
    }
    
    /**
     * Returns the required handler for this controller
     *
     * @return \AppBundle\Form\FormHandler
     */
    private function getHandler()
    {
        return $this->get('acomerbundle.form.handler.restaurant');
    }
}
