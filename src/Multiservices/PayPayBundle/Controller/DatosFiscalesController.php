<?php

namespace Multiservices\PayPayBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Multiservices\PayPayBundle\Entity\DatosFiscales;
use Multiservices\PayPayBundle\Form\DatosFiscalesType;

/**
 * DatosFiscales controller.
 *
 * @Route("/datosfiscales")
 */
class DatosFiscalesController extends Controller
{

    /**
     * Lists all DatosFiscales entities.
     *
     * @Route("", name="datosfiscales")
     * @Method("GET")
     */
    public function indexAction()
    {
       return $this->render('::basesmartpanelangular.html.twig');
    }

    /**
     * Lists all DatosFiscales entities.
     *
     * @Route("/api", name="datosfiscales_api", options={"expose":true})
     * @Method("GET")
     * @Template("PayPayBundle:DatosFiscales:index.html.twig")
     */
    public function indexApiAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PayPayBundle:DatosFiscales')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new DatosFiscales entity.
     *
     * @Route("/", name="datosfiscales_create", options={"expose":true})
     * @Method("POST")
     * @Template("PayPayBundle:DatosFiscales:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new DatosFiscales();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            //return $this->redirect($this->generateUrl('datosfiscales_show', array('id' => $entity->getId())));
                $response_redir=new JsonResponse();
                $response_redir->setData(array('id'=>$entity->getId()));
                $response_redir->setStatusCode(201);
                return $response_redir;
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a DatosFiscales entity.
     *
     * @param DatosFiscales $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(DatosFiscales $entity)
    {
        $form = $this->createForm(new DatosFiscalesType(), $entity, array(
            //'action' => $this->generateUrl('datosfiscales_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear'));

        return $form;
    }

    /**
     * Displays a form to create a new DatosFiscales entity.
     *
     * @Route("/new", name="datosfiscales_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
       return $this->render('::basesmartpanelangular.html.twig');
    }

    /**
     * Displays a form to create a new DatosFiscales entity.
     *
     * @Route("/api/new", name="datosfiscales_api_new", options={"expose":true})
     * @Method("GET")
     * @Template("PayPayBundle:DatosFiscales:new.html.twig")
     */
    public function newApiAction()
    {
        $entity = new DatosFiscales();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a DatosFiscales entity.
     *
     * @Route("/{id}", name="datosfiscales_show", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     */
    public function showAction($id)
    {
       return $this->render('::basesmartpanelangular.html.twig');
    }

    /**
     * Finds and displays a DatosFiscales entity.
     *
     * @Route("/api/{id}", name="datosfiscales_api_show", options={"expose":true})
     * @Method("GET")
     * @Template("PayPayBundle:DatosFiscales:show.html.twig")
     */
    public function showApiAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PayPayBundle:DatosFiscales')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DatosFiscales entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing DatosFiscales entity.
     *
     * @Route("/{id}/edit", name="datosfiscales_edit", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     */
    public function editAction($id)
    {
       return $this->render('::basesmartpanelangular.html.twig');
    }

    /**
    * Creates a form to edit a DatosFiscales entity.
    *
    * @param DatosFiscales $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(DatosFiscales $entity)
    {
        $form = $this->createForm(new DatosFiscalesType(), $entity, array(
            //'action' => $this->generateUrl('datosfiscales_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar'));

        return $form;
    }

    /**
     * Displays a form to edit an existing DatosFiscales entity.
     *
     * @Route("/api/{id}/edit", name="datosfiscales_api_edit", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     * @Template("PayPayBundle:DatosFiscales:edit.html.twig")
     */
    public function editApiAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PayPayBundle:DatosFiscales')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DatosFiscales entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }    /**
     * Edits an existing DatosFiscales entity.
     *
     * @Route("/{id}", name="datosfiscales_update", options={"expose":true})
     * @Method("PUT")
     * @Template("PayPayBundle:DatosFiscales:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PayPayBundle:DatosFiscales')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DatosFiscales entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('datosfiscales_api_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a DatosFiscales entity.
     *
     * @Route("/{id}", name="datosfiscales_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PayPayBundle:DatosFiscales')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find DatosFiscales entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('datosfiscales'));
    }

    /**
     * Creates a form to delete a DatosFiscales entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('datosfiscales_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar'))
            ->getForm()
        ;
    }
}
