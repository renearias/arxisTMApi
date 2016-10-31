<?php

namespace Multiservices\PayPayBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AppBundle\Exception\InvalidFormException;
use Multiservices\PayPayBundle\Entity\Ingresos;
use Multiservices\PayPayBundle\Form\IngresosType;

/**
 * Ingresos controller.
 *
* @Rest\RouteResource("ingreso")
 */
class IngresosController extends FOSRestController implements ClassResourceInterface
{
    /**
     * Lists all Ingresos entities.
     *
     * @ApiDoc(
     *   resource = true,
     *   section="Ingresos",
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

        $ingresos = $em->getRepository('PayPayBundle:Ingresos')->findAll();

        //$ingresos_datatable = $this->get("paypaybundle_datatable.ingresos");
        //$ingresos_datatable->buildDatatable();

        $view = $this->view($ingresos)
            ->setTemplate('ingresos/index.html.twig')
            ->setTemplateData([
                            'ingresos' => $ingresos
                             ]);
        return $ingresos;
    }

    /**
     * Get results from Ingresos entity.
     *
     * @ApiDoc(
     *   resource = true,
     *   section="Ingresos",
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

        $datatable = $this->get('paypaybundle_datatable.ingresos');
        $datatable->buildDatatable();
        $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

        return $query->getResponse();
    }

    /**
     * Crea una nueva Ingresos entidad.
     *
     * @ApiDoc(
     *   resource = true,
     *   section="Ingresos",
     *   input = {
     *              "class"= "Multiservices\PayPayBundle\Form\IngresosType",
     *              "name"= ""
     *            },
     *   output = "Multiservices\PayPayBundle\Entity\Ingresos",
     *    statusCodes = {
     *      201 = "Retorna cuando se crea un nuevo Ingresos",
     *      400 = "Returna cuando el formulario contiene errores" 
     *   }
     * )
     * @Rest\View(
     *   template = "ingresos/new.html.twig",
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
            $ingreso = $this->getHandler()->post(
                new Ingresos(),
                $request->request->all()
            );
            $routeOptions = array(
                //'ingreso'        => $ingreso->getId(),
                'id'        => $ingreso->getId(),
                //'_format'    => $request->get('_format'),
            );
            return $this->handleView($this->view($routeOptions, Response::HTTP_CREATED));
            /*return $this->routeRedirectView(
                'get_ingreso',
                $routeOptions,
                Response::HTTP_CREATED
            );*/
        } catch (InvalidFormException $e) {
            return $e->getForm();
        }
    }

    /**
     * Finds and displays a Ingresos entity.
     *
     * @ApiDoc(
     *   resource = true,
     *   output = "Multiservices\PayPayBundle\Entity\Ingresos",
     *   section="Ingresos",
     *    statusCodes = {
     *      200 = "Retorna la entidad Ingresos",
     *      404 = "Retorna cuando no se ecuentra objeto" 
     *   }
     * )
     *
     */
    public function getAction(Ingresos $ingreso)
    {
        
        $view = $this->view($ingreso, 200)
            ->setTemplate('ingresos/show.html.twig')
            ->setTemplateData(['ingreso'=>$ingreso]);
        return $this->handleView($view);
    }

    /**
     * Replaces an existing Ingresos entity.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = {
     *              "class"= "Multiservices\PayPayBundle\Form\IngresosType",
     *              "name"= ""
     *            },
     *   output = "Multiservices\PayPayBundle\Entity\Ingresos",
     *   section="Ingresos",
     *    statusCodes = {
     *      201="Retorna cuando Ingresos ha sido creado exitosamente",
     *      204="Retorna cuando un existente Ingresos ha sido actualizado exitosamente",
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
        $ingreso = $em->getRepository('PayPayBundle:Ingresos')->find($id);

        try {
            if ($ingreso === null) {
                $statusCode = Response::HTTP_CREATED;
                $ingreso = $this->getHandler()->post(
                    new Ingresos(),
                    $request->request->all()
                );
            } else {
                $statusCode = Response::HTTP_NO_CONTENT;
                $ingreso = $this->getHandler()->put(
                    $ingreso,
                    $request->request->all()
                );
            }
            $routeOptions = array(
                'ingreso'        => $ingreso->getId(),
                '_format'   => $request->get('_format')
            );
            return $this->routeRedirectView('get_ingreso', $routeOptions, $statusCode);
        } catch (InvalidFormException $e) {
            return $e->getForm();
        }
    }

    /**
     * Updates an existing Ingresos entity.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = {
     *              "class"= "Multiservices\PayPayBundle\Form\IngresosType",
     *              "name"= ""
     *            },
     *   output = "Multiservices\PayPayBundle\Entity\Ingresos",
     *   section="Ingresos",
     *    statusCodes = {
     *      204="Returned when an existing Ingresos has been successfully updated",
     *      400="Returned when the posted data is invalid",
     *      404="Returned when trying to update a non existent Ingresos"
     *   }
     * )
     * @Rest\View()
     * @param Request $request
     * @param Ingresos $ingreso
     * @return FormTypeInterface[]|\FOS\RestBundle\View\View|null
     */
    public function patchAction(Request $request, Ingresos $ingreso)
    {
        

        try {
            $ingreso = $this->getHandler()->patch(
                $ingreso,
                $request->request->all()
            );
            $routeOptions = array(
                'ingreso'        => $ingreso->getId(),
                '_format'   => $request->get('_format')
            );
            return $this->routeRedirectView('get_ingreso', $routeOptions, Response::HTTP_NO_CONTENT);
        } catch (InvalidFormException $e) {
            return $e->getForm();
        }
    }

    /**
     * Deletes a Ingresos entity.
     *
     * @ApiDoc(
     *      resource = true,
     *      section="Ingresos",
     *      statusCodes = {
     *         204="Retorna cuando Ingresos existente  ha sido eliminado completamente",
     *         404="Retorna cuando intenta eliminar una Ingresos no existente"
     *      }
     *  )
     *
     */
    public function deleteAction(Request $request, Ingresos $ingreso)
    {
        $this->getHandler()->delete($ingreso);

        return $this->routeRedirectView('get_ingresos', array(), Response::HTTP_NO_CONTENT);
    }

       
    /**
     * Returns the required handler for this controller
     *
     * @return \AppBundle\Form\FormHandler
     */
    private function getHandler()
    {
        return $this->get('paypaybundle.form.handler.ingresos');
    }
}
