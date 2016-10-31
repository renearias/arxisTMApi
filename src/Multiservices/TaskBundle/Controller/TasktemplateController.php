<?php

namespace Multiservices\TaskBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Multiservices\TaskBundle\Entity\Tasktemplate;
use Multiservices\TaskBundle\Form\TasktemplateType;

/**
 * Tasktemplate controller.
 *
 * @Route("/tasktemplate")
 */
class TasktemplateController extends Controller
{

    /**
     * Lists all Tasktemplate entities.
     *
     * @Route("/", name="tasktemplate")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TaskBundle:Tasktemplate')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Tasktemplate entity.
     *
     * @Route("/", name="tasktemplate_create")
     * @Method("POST")
     * @Template("TaskBundle:Tasktemplate:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Tasktemplate();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tarea_new'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Tasktemplate entity.
     *
     * @param Tasktemplate $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Tasktemplate $entity)
    {
        $form = $this->createForm(new TasktemplateType(), $entity, array(
            'action' => $this->generateUrl('tasktemplate_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear'));

        return $form;
    }

    /**
     * Displays a form to create a new Tasktemplate entity.
     *
     * @Route("/new", name="tasktemplate_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Tasktemplate();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Tasktemplate entity.
     *
     * @Route("/{id}", name="tasktemplate_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TaskBundle:Tasktemplate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tasktemplate entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Tasktemplate entity.
     *
     * @Route("/{id}/edit", name="tasktemplate_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TaskBundle:Tasktemplate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tasktemplate entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Tasktemplate entity.
    *
    * @param Tasktemplate $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Tasktemplate $entity)
    {
        $form = $this->createForm(new TasktemplateType(), $entity, array(
            'action' => $this->generateUrl('tasktemplate_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar'));

        return $form;
    }
    /**
     * Edits an existing Tasktemplate entity.
     *
     * @Route("/{id}", name="tasktemplate_update")
     * @Method("PUT")
     * @Template("TaskBundle:Tasktemplate:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TaskBundle:Tasktemplate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tasktemplate entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tasktemplate_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Tasktemplate entity.
     *
     * @Route("/{id}", name="tasktemplate_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TaskBundle:Tasktemplate')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Tasktemplate entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tasktemplate'));
    }

    /**
     * Creates a form to delete a Tasktemplate entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tasktemplate_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar'))
            ->getForm()
        ;
    }
}
