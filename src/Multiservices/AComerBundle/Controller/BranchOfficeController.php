<?php

namespace Multiservices\AComerBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AppBundle\Exception\InvalidFormException;
use Multiservices\AComerBundle\Entity\BranchOffice;

/**
 * BranchOffice controller.
 *
 * @Route("/branchoffice")
* @Rest\RouteResource("branchoffice")
 */
class BranchOfficeController extends FOSRestController implements ClassResourceInterface
{
    /**
     * Lists all BranchOffice entities.
     *
     * @Route("/", name="branchoffice_index")
     * @Method("GET")
     * @ApiDoc(
     *   resource = true,
     *   section="BranchOffice",
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

        $branchOffices = $em->getRepository('AComerBundle:BranchOffice')->findAll();

        //$branchOffices_datatable = $this->get("acomerbundle_datatable.branchOffices");
        //$branchOffices_datatable->buildDatatable();

        $view = $this->view($branchOffices)
            ->setTemplate('branchoffice/index.html.twig')
            ->setTemplateData([
                            'branchOffices' => $branchOffices
                             ]);
        return $branchOffices;
    }

    /**
     * Get results from BranchOffice entity.
     *
     * @Route("/results", name="branchoffice_results")
     * @Method({"GET", "POST"})
     * @ApiDoc(
     *   resource = true,
     *   section="BranchOffice",
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

        $datatable = $this->get('acomerbundle_datatable.branchOffices');
        $datatable->buildDatatable();
        $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

        return $query->getResponse();
    }

    /**
     * Finds and displays a BranchOffice entity.
     *
     * @Route("/{id}", name="branchoffice_show")
     * @Method("GET")
     * @ApiDoc(
     *   resource = true,
     *   output = "Multiservices\AComerBundle\Entity\BranchOffice",
     *   section="BranchOffice",
     *    statusCodes = {
     *      200 = "Retorna la entidad BranchOffice",
     *      404 = "Retorna cuando no se ecuentra objeto" 
     *   }
     * )
     *
     */
    public function getAction(BranchOffice $branchOffice)
    {

        $view = $this->view($branchOffice, 200)
            ->setTemplate('branchoffice/show.html.twig')
            ->setTemplateData(['branchOffice'=>$branchOffice]);
        return $this->handleView($view);
    }
    
    /**
     * Returns the required handler for this controller
     *
     * @return \AppBundle\Form\FormHandler
     */
    private function getHandler()
    {
        return $this->get('acomerbundle.form.handler.branchoffice');
    }
}
