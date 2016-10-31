<?php

namespace Multiservices\PayPayBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AppBundle\Exception\InvalidFormException;
use Multiservices\PayPayBundle\Entity\FormasPagos;
use Multiservices\PayPayBundle\Form\FormasPagosType;

/**
 * FormasPagos controller.
 *
* @Rest\RouteResource("formaspago")
 */
class FormasPagosController extends FOSRestController implements ClassResourceInterface
{
    /**
     * Lists all FormasPagos entities.
     *
     * @ApiDoc(
     *   resource = true,
     *   section="FormasPagos",
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

        $formasPagos = $em->getRepository('PayPayBundle:FormasPagos')->findAll();

        //$formasPagos_datatable = $this->get("paypaybundle_datatable.formasPagos");
        //$formasPagos_datatable->buildDatatable();

        $view = $this->view($formasPagos)
            ->setTemplate('formaspagos/index.html.twig')
            ->setTemplateData([
                            'formasPagos' => $formasPagos
                             ]);
        return $formasPagos;
    }

    /**
     * Get results from FormasPagos entity.
     *
     * @ApiDoc(
     *   resource = true,
     *   section="FormasPagos",
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

        $datatable = $this->get('paypaybundle_datatable.formasPagos');
        $datatable->buildDatatable();
        $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

        return $query->getResponse();
    }

    /**
     * Crea una nueva FormasPagos entidad.
     *
     * @ApiDoc(
     *   resource = true,
     *   section="FormasPagos",
     *   input = {
     *              "class"= "Multiservices\PayPayBundle\Form\FormasPagosType",
     *              "name"= ""
     *            },
     *   output = "Multiservices\PayPayBundle\Entity\FormasPagos",
     *    statusCodes = {
     *      201 = "Retorna cuando se crea un nuevo FormasPagos",
     *      400 = "Returna cuando el formulario contiene errores" 
     *   }
     * )
     * @Rest\View(
     *   template = "formaspagos/new.html.twig",
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
            $formasPago = $this->getHandler()->post(
                new FormasPagos(),
                $request->request->all()
            );
            $routeOptions = array(
                //'formasPago'        => $formasPago->getId(),
                'id'        => $formasPago->getId(),
                //'_format'    => $request->get('_format'),
            );
            return $this->handleView($this->view($routeOptions, Response::HTTP_CREATED));
            /*return $this->routeRedirectView(
                'get_formasPago',
                $routeOptions,
                Response::HTTP_CREATED
            );*/
        } catch (InvalidFormException $e) {
            return $e->getForm();
        }
    }

    /**
     * Finds and displays a FormasPagos entity.
     *
     * @ApiDoc(
     *   resource = true,
     *   output = "Multiservices\PayPayBundle\Entity\FormasPagos",
     *   section="FormasPagos",
     *    statusCodes = {
     *      200 = "Retorna la entidad FormasPagos",
     *      404 = "Retorna cuando no se ecuentra objeto" 
     *   }
     * )
     *
     */
    public function getAction(FormasPagos $formasPago)
    {
        
        $view = $this->view($formasPago, 200)
            ->setTemplate('formaspagos/show.html.twig')
            ->setTemplateData(['formasPago'=>$formasPago]);
        return $this->handleView($view);
    }

    /**
     * Replaces an existing FormasPagos entity.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = {
     *              "class"= "Multiservices\PayPayBundle\Form\FormasPagosType",
     *              "name"= ""
     *            },
     *   output = "Multiservices\PayPayBundle\Entity\FormasPagos",
     *   section="FormasPagos",
     *    statusCodes = {
     *      201="Retorna cuando FormasPagos ha sido creado exitosamente",
     *      204="Retorna cuando un existente FormasPagos ha sido actualizado exitosamente",
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
        $formasPago = $em->getRepository('PayPayBundle:FormasPagos')->find($id);

        try {
            if ($formasPago === null) {
                $statusCode = Response::HTTP_CREATED;
                $formasPago = $this->getHandler()->post(
                    new FormasPagos(),
                    $request->request->all()
                );
            } else {
                $statusCode = Response::HTTP_NO_CONTENT;
                $formasPago = $this->getHandler()->put(
                    $formasPago,
                    $request->request->all()
                );
            }
            $routeOptions = array(
                'formasPago'        => $formasPago->getId(),
                '_format'   => $request->get('_format')
            );
            return $this->routeRedirectView('get_formasPago', $routeOptions, $statusCode);
        } catch (InvalidFormException $e) {
            return $e->getForm();
        }
    }

    /**
     * Updates an existing FormasPagos entity.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = {
     *              "class"= "Multiservices\PayPayBundle\Form\FormasPagosType",
     *              "name"= ""
     *            },
     *   output = "Multiservices\PayPayBundle\Entity\FormasPagos",
     *   section="FormasPagos",
     *    statusCodes = {
     *      204="Returned when an existing FormasPagos has been successfully updated",
     *      400="Returned when the posted data is invalid",
     *      404="Returned when trying to update a non existent FormasPagos"
     *   }
     * )
     * @Rest\View()
     * @param Request $request
     * @param FormasPagos $formasPago
     * @return FormTypeInterface[]|\FOS\RestBundle\View\View|null
     */
    public function patchAction(Request $request, FormasPagos $formasPago)
    {
        

        try {
            $formasPago = $this->getHandler()->patch(
                $formasPago,
                $request->request->all()
            );
            $routeOptions = array(
                'formasPago'        => $formasPago->getId(),
                '_format'   => $request->get('_format')
            );
            return $this->routeRedirectView('get_formasPago', $routeOptions, Response::HTTP_NO_CONTENT);
        } catch (InvalidFormException $e) {
            return $e->getForm();
        }
    }

    /**
     * Deletes a FormasPagos entity.
     *
     * @ApiDoc(
     *      resource = true,
     *      section="FormasPagos",
     *      statusCodes = {
     *         204="Retorna cuando FormasPagos existente  ha sido eliminado completamente",
     *         404="Retorna cuando intenta eliminar una FormasPagos no existente"
     *      }
     *  )
     *
     */
    public function deleteAction(Request $request, FormasPagos $formasPago)
    {
        $this->getHandler()->delete($formasPago);

        return $this->routeRedirectView('get_formaspagos', array(), Response::HTTP_NO_CONTENT);
    }

       
    /**
     * Returns the required handler for this controller
     *
     * @return \AppBundle\Form\FormHandler
     */
    private function getHandler()
    {
        return $this->get('paypaybundle.form.handler.formaspagos');
    }
}
