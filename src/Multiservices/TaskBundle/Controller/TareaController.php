<?php

namespace Multiservices\TaskBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AppBundle\Exception\InvalidFormException;
use Multiservices\TaskBundle\Entity\Tarea;
use Multiservices\TaskBundle\Form\TareaType;

/**
 * Tarea controller.
 *
 * @Rest\RouteResource("tarea")
 */
class TareaController extends FOSRestController implements ClassResourceInterface
{

    /**
     * Lists all Tarea entities.
     *
     * @ApiDoc(
     *   resource = true,
     *   section="Tarea",
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

        $tareas = $em->getRepository('TaskBundle:Tarea')->findAll();

        //$tareas_datatable = $this->get("taskbundle_datatable.tareas");
        //$tareas_datatable->buildDatatable();

        $view = $this->view($tareas)
            ->setTemplate('TaskBundle:Tarea:index.html.twig')
            ->setTemplateData([
                            'tareas' => $tareas
                             ]);
        return $tareas;
    }

    /**
     * Get results from Tarea entity.
     *
     * @ApiDoc(
     *   resource = true,
     *   section="Tarea",
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

        $datatable = $this->get('taskbundle_datatable.tareas');
        $datatable->buildDatatable();
        $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

        return $query->getResponse();
    }

    /**
     * Crea una nueva Tarea entidad.
     *
     * @ApiDoc(
     *   resource = true,
     *   section="Tarea",
     *   input = {
     *              "class"= "Multiservices\TaskBundle\Form\TareaType",
     *              "name"= ""
     *            },
     *   output = "Multiservices\TaskBundle\Entity\Tarea",
     *    statusCodes = {
     *      201 = "Retorna cuando se crea un nuevo Tarea",
     *      400 = "Returna cuando el formulario contiene errores" 
     *   }
     * )
     * @Rest\View(
     *   template = "tarea/new.html.twig",
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
            $tarea = $this->getHandler()->post(
                new Tarea(),
                $request->request->all()
            );
            $routeOptions = array(
                //'tarea'        => $tarea->getId(),
                'id'        => $tarea->getId(),
                //'_format'    => $request->get('_format'),
            );
            return $this->handleView($this->view($routeOptions, Response::HTTP_CREATED));
            /*return $this->routeRedirectView(
                'get_tarea',
                $routeOptions,
                Response::HTTP_CREATED
            );*/
        } catch (InvalidFormException $e) {
            return $e->getForm();
        }
    }

    /**
     * Finds and displays a Tarea entity.
     *
     * @ApiDoc(
     *   resource = true,
     *   output = "Multiservices\TaskBundle\Entity\Tarea",
     *   section="Tarea",
     *    statusCodes = {
     *      200 = "Retorna la entidad Tarea",
     *      404 = "Retorna cuando no se ecuentra objeto" 
     *   }
     * )
     *
     */
    public function getAction(Tarea $tarea)
    {
        
        $view = $this->view($tarea, 200)
            ->setTemplate('TaskBundle:Tarea:show.html.twig')
            ->setTemplateData(['tarea'=>$tarea]);
        return $this->handleView($view);
    }

    /**
     * Replaces an existing Tarea entity.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = {
     *              "class"= "Multiservices\TaskBundle\Form\TareaType",
     *              "name"= ""
     *            },
     *   output = "Multiservices\TaskBundle\Entity\Tarea",
     *   section="Tarea",
     *    statusCodes = {
     *      201="Retorna cuando Tarea ha sido creado exitosamente",
     *      204="Retorna cuando un existente Tarea ha sido actualizado exitosamente",
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
        $tarea = $em->getRepository('TaskBundle:Tarea')->find($id);

        try {
            if ($tarea === null) {
                $statusCode = Response::HTTP_CREATED;
                $tarea = $this->getHandler()->post(
                    new Tarea(),
                    $request->request->all()
                );
            } else {
                $statusCode = Response::HTTP_NO_CONTENT;
                $tarea = $this->getHandler()->put(
                    $tarea,
                    $request->request->all()
                );
            }
            $routeOptions = array(
                'tarea'        => $tarea->getId(),
                '_format'   => $request->get('_format')
            );
            return $this->routeRedirectView('get_tarea', $routeOptions, $statusCode);
        } catch (InvalidFormException $e) {
            return $e->getForm();
        }
    }

    /**
     * Updates an existing Tarea entity.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = {
     *              "class"= "Multiservices\TaskBundle\Form\TareaType",
     *              "name"= ""
     *            },
     *   output = "Multiservices\TaskBundle\Entity\Tarea",
     *   section="Tarea",
     *    statusCodes = {
     *      204="Returned when an existing Tarea has been successfully updated",
     *      400="Returned when the posted data is invalid",
     *      404="Returned when trying to update a non existent Tarea"
     *   }
     * )
     * @Rest\View()
     * @param Request $request
     * @param Tarea $tarea
     * @return FormTypeInterface[]|\FOS\RestBundle\View\View|null
     */
    public function patchAction(Request $request, Tarea $tarea)
    {
        

        try {
            $tarea = $this->getHandler()->patch(
                $tarea,
                $request->request->all()
            );
            $routeOptions = array(
                'tarea'        => $tarea->getId(),
                '_format'   => $request->get('_format')
            );
            return $this->routeRedirectView('get_tarea', $routeOptions, Response::HTTP_NO_CONTENT);
        } catch (InvalidFormException $e) {
            return $e->getForm();
        }
    }

    /**
     * Deletes a Tarea entity.
     *
     * @ApiDoc(
     *      resource = true,
     *      section="Tarea",
     *      statusCodes = {
     *         204="Retorna cuando Tarea existente  ha sido eliminado completamente",
     *         404="Retorna cuando intenta eliminar una Tarea no existente"
     *      }
     *  )
     *
     */
    public function deleteAction(Request $request, Tarea $tarea)
    {
        $this->getHandler()->delete($tarea);

        return $this->routeRedirectView('get_tarea', array(), Response::HTTP_NO_CONTENT);
    }

       
    /**
     * Returns the required handler for this controller
     *
     * @return \AppBundle\Form\FormHandler
     */
    private function getHandler()
    {
        return $this->get('taskbundle.form.handler.tarea');
    }
}
