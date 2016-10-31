<?php

namespace Multiservices\PayPayBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AppBundle\Exception\InvalidFormException;
use Multiservices\PayPayBundle\Entity\Productos;
use Multiservices\PayPayBundle\Form\ProductosType;

/**
 * Productos controller.
 *
* @Rest\RouteResource("producto")
 */
class ProductosController extends FOSRestController implements ClassResourceInterface
{
    /**
     * Lists all Productos entities.
     *
     * @ApiDoc(
     *   resource = true,
     *   section="Productos",
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

        $productos = $em->getRepository('PayPayBundle:Productos')->findAll();

        //$productos_datatable = $this->get("paypaybundle_datatable.productos");
        //$productos_datatable->buildDatatable();

        $view = $this->view($productos)
            ->setTemplate('productos/index.html.twig')
            ->setTemplateData([
                            'productos' => $productos
                             ]);
        return $productos;
    }

    /**
     * Get results from Productos entity.
     *
     * @ApiDoc(
     *   resource = true,
     *   section="Productos",
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

        $datatable = $this->get('paypaybundle_datatable.productos');
        $datatable->buildDatatable();
        $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

        return $query->getResponse();
    }

    /**
     * Crea una nueva Productos entidad.
     *
     * @ApiDoc(
     *   resource = true,
     *   section="Productos",
     *   input = {
     *              "class"= "Multiservices\PayPayBundle\Form\ProductosType",
     *              "name"= ""
     *            },
     *   output = "Multiservices\PayPayBundle\Entity\Productos",
     *    statusCodes = {
     *      201 = "Retorna cuando se crea un nuevo Productos",
     *      400 = "Returna cuando el formulario contiene errores" 
     *   }
     * )
     * @Rest\View(
     *   template = "productos/new.html.twig",
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
            $producto = $this->getHandler()->post(
                new Productos(),
                $request->request->all()
            );
            $routeOptions = array(
                //'producto'        => $producto->getId(),
                'id'        => $producto->getId(),
                //'_format'    => $request->get('_format'),
            );
            return $this->handleView($this->view($routeOptions, Response::HTTP_CREATED));
            /*return $this->routeRedirectView(
                'get_producto',
                $routeOptions,
                Response::HTTP_CREATED
            );*/
        } catch (InvalidFormException $e) {
            return $e->getForm();
        }
    }

    /**
     * Finds and displays a Productos entity.
     *
     * @ApiDoc(
     *   resource = true,
     *   output = "Multiservices\PayPayBundle\Entity\Productos",
     *   section="Productos",
     *    statusCodes = {
     *      200 = "Retorna la entidad Productos",
     *      404 = "Retorna cuando no se ecuentra objeto" 
     *   }
     * )
     *
     */
    public function getAction(Productos $producto)
    {
        
        $view = $this->view($producto, 200)
            ->setTemplate('productos/show.html.twig')
            ->setTemplateData(['producto'=>$producto]);
        return $this->handleView($view);
    }

    /**
     * Replaces an existing Productos entity.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = {
     *              "class"= "Multiservices\PayPayBundle\Form\ProductosType",
     *              "name"= ""
     *            },
     *   output = "Multiservices\PayPayBundle\Entity\Productos",
     *   section="Productos",
     *    statusCodes = {
     *      201="Retorna cuando Productos ha sido creado exitosamente",
     *      204="Retorna cuando un existente Productos ha sido actualizado exitosamente",
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
        $producto = $em->getRepository('PayPayBundle:Productos')->find($id);

        try {
            if ($producto === null) {
                $statusCode = Response::HTTP_CREATED;
                $producto = $this->getHandler()->post(
                    new Productos(),
                    $request->request->all()
                );
            } else {
                $statusCode = Response::HTTP_NO_CONTENT;
                $producto = $this->getHandler()->put(
                    $producto,
                    $request->request->all()
                );
            }
            $routeOptions = array(
                'producto'        => $producto->getId(),
                '_format'   => $request->get('_format')
            );
            return $this->routeRedirectView('get_producto', $routeOptions, $statusCode);
        } catch (InvalidFormException $e) {
            return $e->getForm();
        }
    }

    /**
     * Updates an existing Productos entity.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = {
     *              "class"= "Multiservices\PayPayBundle\Form\ProductosType",
     *              "name"= ""
     *            },
     *   output = "Multiservices\PayPayBundle\Entity\Productos",
     *   section="Productos",
     *    statusCodes = {
     *      204="Returned when an existing Productos has been successfully updated",
     *      400="Returned when the posted data is invalid",
     *      404="Returned when trying to update a non existent Productos"
     *   }
     * )
     * @Rest\View()
     * @param Request $request
     * @param Productos $producto
     * @return FormTypeInterface[]|\FOS\RestBundle\View\View|null
     */
    public function patchAction(Request $request, Productos $producto)
    {
        

        try {
            $producto = $this->getHandler()->patch(
                $producto,
                $request->request->all()
            );
            $routeOptions = array(
                'producto'        => $producto->getId(),
                '_format'   => $request->get('_format')
            );
            return $this->routeRedirectView('get_producto', $routeOptions, Response::HTTP_NO_CONTENT);
        } catch (InvalidFormException $e) {
            return $e->getForm();
        }
    }

    /**
     * Deletes a Productos entity.
     *
     * @ApiDoc(
     *      resource = true,
     *      section="Productos",
     *      statusCodes = {
     *         204="Retorna cuando Productos existente  ha sido eliminado completamente",
     *         404="Retorna cuando intenta eliminar una Productos no existente"
     *      }
     *  )
     *
     */
    public function deleteAction(Request $request, Productos $producto)
    {
        $this->getHandler()->delete($producto);

        return $this->routeRedirectView('get_productos', array(), Response::HTTP_NO_CONTENT);
    }

       
    /**
     * Returns the required handler for this controller
     *
     * @return \AppBundle\Form\FormHandler
     */
    private function getHandler()
    {
        return $this->get('paypaybundle.form.handler.productos');
    }
}
