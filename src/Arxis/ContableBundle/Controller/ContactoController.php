<?php

namespace Arxis\ContableBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AppBundle\Exception\InvalidFormException;
use Arxis\ContableBundle\Entity\Contacto;
use Arxis\ContableBundle\Form\ContactoType;

/**
 * Contacto controller.
 *
* @Rest\RouteResource("contacto")
 */
class ContactoController extends FOSRestController implements ClassResourceInterface
{
    /**
     * Lists all Contacto entities.
     *
     * @ApiDoc(
     *   resource = true,
     *   section="Contacto",
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

        $contactos = $em->getRepository('ArxisContableBundle:Contacto')->findAll();

        //$contactos_datatable = $this->get("arxiscontablebundle_datatable.contactos");
        //$contactos_datatable->buildDatatable();

        $view = $this->view($contactos)
            ->setTemplate('contacto/index.html.twig')
            ->setTemplateData([
                            'contactos' => $contactos
                             ]);
        return $contactos;
    }

    /**
     * Get results from Contacto entity.
     *
     * @ApiDoc(
     *   resource = true,
     *   section="Contacto",
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

        $datatable = $this->get('arxiscontablebundle_datatable.contactos');
        $datatable->buildDatatable();
        $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

        return $query->getResponse();
    }

    /**
     * Crea una nueva Contacto entidad.
     *
     * @ApiDoc(
     *   resource = true,
     *   section="Contacto",
     *   input = {
     *              "class"= "Arxis\ContableBundle\Form\ContactoType",
     *              "name"= ""
     *            },
     *   output = "Arxis\ContableBundle\Entity\Contacto",
     *    statusCodes = {
     *      201 = "Retorna cuando se crea un nuevo Contacto",
     *      400 = "Returna cuando el formulario contiene errores" 
     *   }
     * )
     * @Rest\View(
     *   template = "contacto/new.html.twig",
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
            $contacto = $this->getHandler()->post(
                new Contacto(),
                $request->request->all()
            );
            $routeOptions = array(
                //'contacto'        => $contacto->getId(),
                'id'        => $contacto->getId(),
                //'_format'    => $request->get('_format'),
            );
            return $this->handleView($this->view($routeOptions, Response::HTTP_CREATED));
            /*return $this->routeRedirectView(
                'get_contacto',
                $routeOptions,
                Response::HTTP_CREATED
            );*/
        } catch (InvalidFormException $e) {
            return $e->getForm();
        }
    }

    /**
     * Finds and displays a Contacto entity.
     *
     * @ApiDoc(
     *   resource = true,
     *   output = "Arxis\ContableBundle\Entity\Contacto",
     *   section="Contacto",
     *    statusCodes = {
     *      200 = "Retorna la entidad Contacto",
     *      404 = "Retorna cuando no se ecuentra objeto" 
     *   }
     * )
     *
     */
    public function getAction(Contacto $contacto)
    {
        
        $view = $this->view($contacto, 200)
            ->setTemplate('contacto/show.html.twig')
            ->setTemplateData(['contacto'=>$contacto]);
        return $this->handleView($view);
    }

    /**
     * Replaces an existing Contacto entity.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = {
     *              "class"= "Arxis\ContableBundle\Form\ContactoType",
     *              "name"= ""
     *            },
     *   output = "Arxis\ContableBundle\Entity\Contacto",
     *   section="Contacto",
     *    statusCodes = {
     *      201="Retorna cuando Contacto ha sido creado exitosamente",
     *      204="Retorna cuando un existente Contacto ha sido actualizado exitosamente",
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
        $contacto = $em->getRepository('ArxisContableBundle:Contacto')->find($id);

        try {
            if ($contacto === null) {
                $statusCode = Response::HTTP_CREATED;
                $contacto = $this->getHandler()->post(
                    new Contacto(),
                    $request->request->all()
                );
            } else {
                $statusCode = Response::HTTP_NO_CONTENT;
                $contacto = $this->getHandler()->put(
                    $contacto,
                    $request->request->all()
                );
            }
            $routeOptions = array(
                'contacto'        => $contacto->getId(),
                '_format'   => $request->get('_format')
            );
            return $this->routeRedirectView('get_contacto', $routeOptions, $statusCode);
        } catch (InvalidFormException $e) {
            return $e->getForm();
        }
    }

    /**
     * Updates an existing Contacto entity.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = {
     *              "class"= "Arxis\ContableBundle\Form\ContactoType",
     *              "name"= ""
     *            },
     *   output = "Arxis\ContableBundle\Entity\Contacto",
     *   section="Contacto",
     *    statusCodes = {
     *      204="Returned when an existing Contacto has been successfully updated",
     *      400="Returned when the posted data is invalid",
     *      404="Returned when trying to update a non existent Contacto"
     *   }
     * )
     * @Rest\View()
     * @param Request $request
     * @param Contacto $contacto
     * @return FormTypeInterface[]|\FOS\RestBundle\View\View|null
     */
    public function patchAction(Request $request, Contacto $contacto)
    {
        

        try {
            $contacto = $this->getHandler()->patch(
                $contacto,
                $request->request->all()
            );
            $routeOptions = array(
                'contacto'        => $contacto->getId(),
                '_format'   => $request->get('_format')
            );
            return $this->routeRedirectView('get_contacto', $routeOptions, Response::HTTP_NO_CONTENT);
        } catch (InvalidFormException $e) {
            return $e->getForm();
        }
    }

    /**
     * Deletes a Contacto entity.
     *
     * @ApiDoc(
     *      resource = true,
     *      section="Contacto",
     *      statusCodes = {
     *         204="Retorna cuando Contacto existente  ha sido eliminado completamente",
     *         404="Retorna cuando intenta eliminar una Contacto no existente"
     *      }
     *  )
     *
     */
    public function deleteAction(Request $request, Contacto $contacto)
    {
        $this->getHandler()->delete($contacto);

        return $this->routeRedirectView('get_contactos', array(), Response::HTTP_NO_CONTENT);
    }

       
    /**
     * Returns the required handler for this controller
     *
     * @return \AppBundle\Form\FormHandler
     */
    private function getHandler()
    {
        return $this->get('arxiscontablebundle.form.handler.contacto');
    }
}
