<?php

namespace Arxis\ContableBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AppBundle\Exception\InvalidFormException;
use Arxis\ContableBundle\Entity\Cliente;
use Arxis\ContableBundle\Form\ClienteType;

/**
 * Cliente controller.
 *
* @Rest\RouteResource("cliente")
 */
class ClienteController extends FOSRestController implements ClassResourceInterface
{
    /**
     * Lists all Cliente entities.
     *
     * @ApiDoc(
     *   resource = true,
     *   section="Cliente",
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

        $clientes = $em->getRepository('ArxisContableBundle:Cliente')->findAll();

        /*$clientes_datatable = $this->get("arxiscontablebundle_datatable.clientes");
        $clientes_datatable->buildDatatable();
        $query = $this->get('sg_datatables.query')->getQueryFrom($clientes_datatable);

    	return $query->getResponse();*/

        $view = $this->view($clientes)
            ->setTemplate('cliente/index.html.twig')
            ->setTemplateData([
                            'clientes' => $clientes
                             ]);
        return $clientes;
    }
    
    /**
     * Lists all Cliente entities simple.
     *
     * @ApiDoc(
     *   resource = true,
     *   section="Cliente",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when not found"
     *   }
     * )
     *
     * @Rest\View()
     *
     */
    public function simpleAction()
    {
        $em = $this->getDoctrine()->getManager();

        $clientes = $em->getRepository('ArxisContableBundle:Cliente')->clientesSimple();

        /*$clientes_datatable = $this->get("arxiscontablebundle_datatable.clientes");
        $clientes_datatable->buildDatatable();
        $query = $this->get('sg_datatables.query')->getQueryFrom($clientes_datatable);

    	return $query->getResponse();*/

        $view = $this->view($clientes)
            ->setTemplate('cliente/index.html.twig')
            ->setTemplateData([
                            'clientes' => $clientes
                             ]);
        return $clientes;
    }
    
       /**
     * Get results from Contacto entity.
     *
     * @ApiDoc(
     *   resource = true,
     *   section="Cliente",
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

        $datatable = $this->get('arxiscontablebundle_datatable.clientes');
        $datatable->buildDatatable();
        $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

        return $query->getResponse();
    }
    
    /**
     * Crea una nueva Cliente entidad.
     *
     * @ApiDoc(
     *   resource = true,
     *   section="Cliente",
     *   input = {
     *              "class"= "Arxis\ContableBundle\Form\ClienteType",
     *              "name"= ""
     *            },
     *   output = "Arxis\ContableBundle\Entity\Cliente",
     *    statusCodes = {
     *      201 = "Retorna cuando se crea un nuevo Cliente",
     *      400 = "Returna cuando el formulario contiene errores" 
     *   }
     * )
     * @Rest\View(
     *   template = "cliente/new.html.twig",
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
            $cliente = $this->getHandler()->post(
                new Cliente(),
                $request->request->all()
            );
            $routeOptions = array(
                'id'        => $cliente->getId(),
                //'_format'    => $request->get('_format'),
            );
            return $this->handleView($this->view($routeOptions, Response::HTTP_CREATED));
            /*return $this->routeRedirectView(
                'get_cliente',
                $routeOptions,
                Response::HTTP_CREATED
            );*/
        } catch (InvalidFormException $e) {
            return $e->getForm();
        }
    }

    /**
     * Finds and displays a Cliente entity.
     *
     * @ApiDoc(
     *   resource = true,
     *   output = "Arxis\ContableBundle\Entity\Cliente",
     *   section="Cliente",
     *    statusCodes = {
     *      200 = "Retorna la entidad Cliente",
     *      404 = "Retorna cuando no se ecuentra objeto" 
     *   }
     * )
     *
     */
    public function getAction(Cliente $cliente)
    {
        
        $view = $this->view($cliente, 200)
            ->setTemplate('cliente/show.html.twig')
            ->setTemplateData(['cliente'=>$cliente]);
        return $this->handleView($view);
    }

    /**
     * Replaces an existing Cliente entity.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = {
     *              "class"= "Arxis\ContableBundle\Form\ClienteType",
     *              "name"= ""
     *            },
     *   output = "Arxis\ContableBundle\Entity\Cliente",
     *   section="Cliente",
     *    statusCodes = {
     *      201="Retorna cuando Cliente ha sido creado exitosamente",
     *      204="Retorna cuando un existente Cliente ha sido actualizado exitosamente",
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
        $cliente = $em->getRepository('ArxisContableBundle:Cliente')->find($id);

        try {
            if ($cliente === null) {
                $statusCode = Response::HTTP_CREATED;
                $cliente = $this->getHandler()->post(
                    new Cliente(),
                    $request->request->all()
                );
            } else {
                $statusCode = Response::HTTP_NO_CONTENT;
                $cliente = $this->getHandler()->put(
                    $cliente,
                    $request->request->all()
                );
            }
            $routeOptions = array(
                'cliente'        => $cliente->getId(),
                '_format'   => $request->get('_format')
            );
            return $this->routeRedirectView('get_cliente', $routeOptions, $statusCode);
        } catch (InvalidFormException $e) {
            return $e->getForm();
        }
    }

    /**
     * Updates an existing Cliente entity.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = {
     *              "class"= "Arxis\ContableBundle\Form\ClienteType",
     *              "name"= ""
     *            },
     *   output = "Arxis\ContableBundle\Entity\Cliente",
     *   section="Cliente",
     *    statusCodes = {
     *      204="Returned when an existing Cliente has been successfully updated",
     *      400="Returned when the posted data is invalid",
     *      404="Returned when trying to update a non existent Cliente"
     *   }
     * )
     * @Rest\View()
     * @param Request $request
     * @param Cliente $cliente
     * @return FormTypeInterface[]|\FOS\RestBundle\View\View|null
     */
    public function patchAction(Request $request, Cliente $cliente)
    {
        

        try {
            $cliente = $this->getHandler()->patch(
                $cliente,
                $request->request->all()
            );
            $routeOptions = array(
                'cliente'        => $cliente->getId(),
                '_format'   => $request->get('_format')
            );
            return $this->routeRedirectView('get_cliente', $routeOptions, Response::HTTP_NO_CONTENT);
        } catch (InvalidFormException $e) {
            return $e->getForm();
        }
    }

    /**
     * Deletes a Cliente entity.
     *
     * @ApiDoc(
     *      resource = true,
     *      section="Cliente",
     *      statusCodes = {
     *         204="Retorna cuando Cliente existente  ha sido eliminado completamente",
     *         404="Retorna cuando intenta eliminar una Cliente no existente"
     *      }
     *  )
     *
     */
    public function deleteAction(Request $request, Cliente $cliente)
    {
        $this->getHandler()->delete($cliente);

        return $this->routeRedirectView('get_clientes', array(), Response::HTTP_NO_CONTENT);
    }

       
    /**
     * Returns the required handler for this controller
     *
     * @return \AppBundle\Form\FormHandler
     */
    private function getHandler()
    {
        return $this->get('arxiscontablebundle.form.handler.cliente');
    }
}
