<?php

namespace Multiservices\AComerBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AppBundle\Exception\InvalidFormException;
use Multiservices\AComerBundle\Entity\Restaurant;
use Symfony\Component\HttpFoundation\Response;

/**
 * Restaurant controller.
 *
* @Rest\RouteResource("restaurant")
 */
class RestaurantController extends FOSRestController implements ClassResourceInterface
{
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
    public function searchAction($lat,$lng,$radio)
    {
        $serializer = $this->get('serializer');

        $constant_km= 0.00909090909091;
        $km= $constant_km*$radio;

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
        $branchOffice=array();
        if(count($query->getResult())>0){
            $branchOffice = array("restaurants"=>$query->getResult(),"count"=>count($query->getResult()));
        }


        $reports = $serializer->serialize($branchOffice, 'json');

        $response = new Response($reports);

        $response->headers->set('Content-Type', 'application/json');

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
