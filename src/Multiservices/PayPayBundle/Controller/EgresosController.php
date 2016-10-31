<?php

namespace Multiservices\PayPayBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Multiservices\PayPayBundle\Entity\Egresos;
use Multiservices\PayPayBundle\Form\EgresosType;

/**
 * Egresos controller.
 *
 * @Route("/egresos")
 */
class EgresosController extends Controller
{

    /**
     * Lists all Egresos entities.
     *
     * @Route("", name="egresos")
     * @Method("GET")
     */
    public function indexAction()
    {
       return $this->render('::basesmartpanelangular.html.twig');
    }

    /**
     * Lists all Egresos entities.
     *
     * @Route("/api", name="egresos_api", options={"expose":true})
     * @Method("GET")
     * @Template("PayPayBundle:Egresos:index.html.twig")
     */
    public function indexApiAction()
    {
       $egresosDatatable = $this->get("paypay_datatables.egresos");
        $egresosDatatable->buildDatatable();
        return array(
           'datatable'=>$egresosDatatable,
        );
    }
    /**
     * Lists all Egresos entities.
     *
     * @Route("/inbox", name="inbox_egresos")
     * @Method("GET")
     * @Template("PayPayBundle:Egresos:inbox.html.twig")
     */
    public function inboxAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $entities = $em->getRepository('PayPayBundle:Egresos')->inbox($user);
        
        return array(
            'entities' => $entities,
        );
    }
    /**
     * Get results Egresos entities.
     *
     * @Route("/results", name="egresos_results")
     *
     * @return Response
     */
    public function egresosResultsAction()
    {
    	/**
    	 * @var \Sg\DatatablesBundle\Datatable\Data\DatatableData $datatable
    	 */
    	$datatable = $this->get('paypay_datatables.egresos');
    	$datatable->buildDatatable();
    	$query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

    	return $query->getResponse();
    }
    /**
     * Creates a new Egresos entity.
     *
     * @Route("/", name="egresos_create", options={"expose":true})
     * @Method("POST")
     * @Template("PayPayBundle:Egresos:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Egresos();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        $usr= $this->get('security.token_storage')->getToken()->getUser();
        $entity->setPaidby($usr);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            //return $this->redirect($this->generateUrl('egresos_show', array('id' => $entity->getId())));
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
     * Creates a form to create a Egresos entity.
     *
     * @param Egresos $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Egresos $entity)
    {
        $form = $this->createForm(new EgresosType(), $entity, array(
            //'action' => $this->generateUrl('egresos_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear'));

        return $form;
    }

    /**
     * Displays a form to create a new Egresos entity.
     *
     * @Route("/new", name="egresos_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
       return $this->render('::basesmartpanelangular.html.twig');
    }

    /**
     * Displays a form to create a new Egresos entity.
     *
     * @Route("/api/new", name="egresos_api_new", options={"expose":true})
     * @Method("GET")
     * @Template("PayPayBundle:Egresos:new.html.twig")
     */
    public function newApiAction()
    {
        $entity = new Egresos();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Egresos entity.
     *
     * @Route("/{id}", name="egresos_show", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     */
    public function showAction($id)
    {
       return $this->render('::basesmartpanelangular.html.twig');
    }

    /**
     * Finds and displays a Egresos entity.
     *
     * @Route("/api/{id}", name="egresos_api_show", options={"expose":true})
     * @Method("GET")
     * @Template("PayPayBundle:Egresos:show.html.twig")
     */
    public function showApiAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PayPayBundle:Egresos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Egresos entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Egresos entity.
     *
     * @Route("/{id}/edit", name="egresos_edit", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     */
    public function editAction($id)
    {
       return $this->render('::basesmartpanelangular.html.twig');
    }

    /**
    * Creates a form to edit a Egresos entity.
    *
    * @param Egresos $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Egresos $entity)
    {
        $form = $this->createForm(new EgresosType(), $entity, array(
            //'action' => $this->generateUrl('egresos_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar'));

        return $form;
    }

    /**
     * Displays a form to edit an existing Egresos entity.
     *
     * @Route("/api/{id}/edit", name="egresos_api_edit", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     * @Template("PayPayBundle:Egresos:edit.html.twig")
     */
    public function editApiAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PayPayBundle:Egresos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Egresos entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }    /**
     * Edits an existing Egresos entity.
     *
     * @Route("/{id}", name="egresos_update", options={"expose":true})
     * @Method("PUT")
     * @Template("PayPayBundle:Egresos:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PayPayBundle:Egresos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Egresos entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        $usr= $this->get('security.token_storage')->getToken()->getUser();

        if ($editForm->isValid()) {
            $entity->setModifiedby($usr);
            $em->flush();

            return $this->redirect($this->generateUrl('egresos_api_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Egresos entity.
     *
     * @Route("/{id}", name="egresos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PayPayBundle:Egresos')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Egresos entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('egresos'));
    }

    /**
     * Creates a form to delete a Egresos entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('egresos_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar'))
            ->getForm()
        ;
    }
}
