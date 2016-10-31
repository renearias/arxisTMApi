<?php

namespace Multiservices\PayPayBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AppBundle\Exception\InvalidFormException;
use Multiservices\PayPayBundle\Entity\Facturas;
use Multiservices\PayPayBundle\Form\FacturasType;

/**
 * Facturas controller.
 *
* @Rest\RouteResource("factura")
 */
class FacturasController extends FOSRestController implements ClassResourceInterface
{
    /**
     * Lists all Facturas entities.
     *
     * @ApiDoc(
     *   resource = true,
     *   section="Facturas",
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

        $facturas = $em->getRepository('PayPayBundle:Facturas')->findAll();

        //$facturas_datatable = $this->get("paypaybundle_datatable.facturas");
        //$facturas_datatable->buildDatatable();

        $view = $this->view($facturas)
            ->setTemplate('facturas/index.html.twig')
            ->setTemplateData([
                            'facturas' => $facturas
                             ]);
        return $facturas;
    }

    /**
     * Get results from Facturas entity.
     *
     * @ApiDoc(
     *   resource = true,
     *   section="Facturas",
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

        $datatable = $this->get('paypaybundle_datatable.facturas');
        $datatable->buildDatatable();
        $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

        return $query->getResponse();
    }

    /**
     * Crea una nueva Facturas entidad.
     *
     * @ApiDoc(
     *   resource = true,
     *   section="Facturas",
     *   input = {
     *              "class"= "Multiservices\PayPayBundle\Form\FacturasType",
     *              "name"= ""
     *            },
     *   output = "Multiservices\PayPayBundle\Entity\Facturas",
     *    statusCodes = {
     *      201 = "Retorna cuando se crea un nuevo Facturas",
     *      400 = "Returna cuando el formulario contiene errores" 
     *   }
     * )
     * @Rest\View(
     *   template = "facturas/new.html.twig",
     *   statusCode = Response::HTTP_BAD_REQUEST
     * )
     *
     * @param Request $request the request object
     *
     * @return FormTypeInterface[]|View
     */
    public function postAction(Request $request)
    {

        try {
            $factura = $this->getHandler()->post(
                new Facturas(),
                $request->request->all()
            );
            $routeOptions = array(
                //'factura'        => $factura->getId(),
                'id'        => $factura->getId(),
                //'_format'    => $request->get('_format'),
            );
            return $this->handleView($this->view($routeOptions, Response::HTTP_CREATED));
            /*return $this->routeRedirectView(
                'get_factura',
                $routeOptions,
                Response::HTTP_CREATED
            );*/
        } catch (InvalidFormException $e) {
            return $e->getForm();
        }
    }

    /**
     * Finds and displays a Facturas entity.
     *
     * @ApiDoc(
     *   resource = true,
     *   output = "Multiservices\PayPayBundle\Entity\Facturas",
     *   section="Facturas",
     *    statusCodes = {
     *      200 = "Retorna la entidad Facturas",
     *      404 = "Retorna cuando no se ecuentra objeto" 
     *   }
     * )
     *
     */
    public function getAction(Facturas $factura)
    {
        
        $view = $this->view($factura, 200)
            ->setTemplate('facturas/show.html.twig')
            ->setTemplateData(['factura'=>$factura]);
        return $this->handleView($view);
    }

    /**
     * Replaces an existing Facturas entity.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = {
     *              "class"= "Multiservices\PayPayBundle\Form\FacturasType",
     *              "name"= ""
     *            },
     *   output = "Multiservices\PayPayBundle\Entity\Facturas",
     *   section="Facturas",
     *    statusCodes = {
     *      201="Retorna cuando Facturas ha sido creado exitosamente",
     *      204="Retorna cuando un existente Facturas ha sido actualizado exitosamente",
     *      400="Retorna cuando la data del formulario es invalida"
     *   }
     * )
     * @Rest\View()
     * @param Request $request
     * @param integer $id
     * @return FormTypeInterface[]|\FOS\RestBundle\View\View|null
     */
    public function putAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $factura = $em->getRepository('PayPayBundle:Facturas')->find($id);

        try {
            if ($factura === null) {
                $statusCode = Response::HTTP_CREATED;
                $factura = $this->getHandler()->post(
                    new Facturas(),
                    $request->request->all()
                );
            } else {
                $statusCode = Response::HTTP_NO_CONTENT;
                $factura = $this->getHandler()->put(
                    $factura,
                    $request->request->all()
                );
            }
            $routeOptions = array(
                'factura'        => $factura->getId(),
                '_format'   => $request->get('_format')
            );
            return $this->routeRedirectView('get_factura', $routeOptions, $statusCode);
        } catch (InvalidFormException $e) {
            return $e->getForm();
        }
    }

    /**
     * Updates an existing Facturas entity.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = {
     *              "class"= "Multiservices\PayPayBundle\Form\FacturasType",
     *              "name"= ""
     *            },
     *   output = "Multiservices\PayPayBundle\Entity\Facturas",
     *   section="Facturas",
     *    statusCodes = {
     *      204="Returned when an existing Facturas has been successfully updated",
     *      400="Returned when the posted data is invalid",
     *      404="Returned when trying to update a non existent Facturas"
     *   }
     * )
     * @Rest\View()
     * @param Request $request
     * @param Facturas $factura
     * @return FormTypeInterface[]|\FOS\RestBundle\View\View|null
     */
    public function patchAction(Request $request, Facturas $factura)
    {
        

        try {
            $factura = $this->getHandler()->patch(
                $factura,
                $request->request->all()
            );
            $routeOptions = array(
                'factura'        => $factura->getId(),
                '_format'   => $request->get('_format')
            );
            return $this->routeRedirectView('get_factura', $routeOptions, Response::HTTP_NO_CONTENT);
        } catch (InvalidFormException $e) {
            return $e->getForm();
        }
    }

    /**
     * Deletes a Facturas entity.
     *
     * @ApiDoc(
     *      resource = true,
     *      section="Facturas",
     *      statusCodes = {
     *         204="Retorna cuando Facturas existente  ha sido eliminado completamente",
     *         404="Retorna cuando intenta eliminar una Facturas no existente"
     *      }
     *  )
     *
     */
    public function deleteAction(Request $request, Facturas $factura)
    {
        $this->getHandler()->delete($factura);

        return $this->routeRedirectView('get_facturas', array(), Response::HTTP_NO_CONTENT);
    }

       
    /**
     * Returns the required handler for this controller
     *
     * @return \AppBundle\Form\FormHandler
     */
    private function getHandler()
    {
        return $this->get('paypaybundle.form.handler.facturas');
    }
}
