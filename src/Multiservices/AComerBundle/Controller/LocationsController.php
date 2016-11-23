<?php

namespace Multiservices\AComerBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AppBundle\Exception\InvalidFormException;
use Multiservices\AComerBundle\Entity\Locations;

/**
 * Locations controller.
 *
* @Rest\RouteResource("location")
 */
class LocationsController extends FOSRestController implements ClassResourceInterface
{
    /**
     * Lists all Locations entities.
     *
     * @ApiDoc(
     *   resource = true,
     *   section="Locations",
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

        $locations = $em->getRepository('AComerBundle:Locations')->findAll();

        //$locations_datatable = $this->get("acomerbundle_datatable.locations");
        //$locations_datatable->buildDatatable();

        $view = $this->view($locations)
            ->setTemplate('locations/index.html.twig')
            ->setTemplateData([
                            'locations' => $locations
                             ]);
        return $locations;
    }

    /**
     * Get results from Locations entity.
     *
     * @ApiDoc(
     *   resource = true,
     *   section="Locations",
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

        $datatable = $this->get('acomerbundle_datatable.locations');
        $datatable->buildDatatable();
        $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

        return $query->getResponse();
    }

    /**
     * Finds and displays a Locations entity.
     *
     * @ApiDoc(
     *   resource = true,
     *   output = "Multiservices\AComerBundle\Entity\Locations",
     *   section="Locations",
     *    statusCodes = {
     *      200 = "Retorna la entidad Locations",
     *      404 = "Retorna cuando no se ecuentra objeto" 
     *   }
     * )
     *
     */
    public function getAction(Locations $location)
    {

        $view = $this->view($location, 200)
            ->setTemplate('locations/show.html.twig')
            ->setTemplateData(['location'=>$location]);
        return $this->handleView($view);
    }
    
    /**
     * Returns the required handler for this controller
     *
     * @return \AppBundle\Form\FormHandler
     */
    private function getHandler()
    {
        return $this->get('acomerbundle.form.handler.locations');
    }
}
