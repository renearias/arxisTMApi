<?php

namespace Multiservices\TaskBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Multiservices\TaskBundle\Entity\Tarea;
use Multiservices\TaskBundle\Entity\Tasktemplate;
use Multiservices\TaskBundle\Form\TareaType;
use Multiservices\TaskBundle\Form\Type\StateTaskType;
use Symfony\Component\HttpFoundation\Response;
use Multiservices\TaskBundle\TaskBox\TaskBox;
/**
 * Tarea controller.
 *
 * @Route("/tarea")
 */
class TareaController extends Controller
{

    /**
     * Lists all Tarea entities.
     *
     * @Route("", name="tarea")
     * @Method("GET")
     */
    public function indexAction()
    {
       return $this->render('::basesmartpanelangular.html.twig');
    }

    /**
     * Lists all Tarea entities.
     *
     * @Route("/api", name="tarea_api", options={"expose":true})
     * @Method("GET")
     * @Template("TaskBundle:Tarea:index.html.twig")
     */
    public function indexApiAction()
    {
        $tareaDatatable = $this->get("lex_datatables.tarea");
        $tareaDatatable->buildDatatable();
        
        return array(
           'datatable'=>$tareaDatatable,
        );
    }
    
     /**
     * Get results tarea entities.
     *
     * @Route("/results", name="tarea_results")
     *
     * @return Response
     */
    
    public function tareaResultsAction()
    {
        /**
         * @var \Sg\DatatablesBundle\Datatable\Data\DatatableData $datatable
         */
        $datatable = $this->get('lex_datatables.tarea');
         $datatable->buildDatatable();
         $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

       $function = function($qb)
        {
        
            $user = $this->get('security.token_storage')->getToken()->getUser(); 
            if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN'))
            {
//                $qb->andWhere(":user MEMBER OF casos.responsablesCaso");
//                $qb->setParameter('user',$user);
            }else
            {
                $qb->andWhere("tarea.assignedto = :user");
                $qb->setParameter('user',$user);
            } 
            
        };
        
       
        // Add the callback function as WhereResult
        //$query->addWhereResult($function);
        //Or add the callback function as WhereAll
        $query->addWhereAll($function);
        return $query->getResponse();
    }
    
    /**
     * Lists all Tareas entities.
     *
     * @Route("/inbox", name="inbox_tareas")
     * @Method("GET")
     * @Template("TaskBundle:Tarea:inbox.html.twig")
     */
    public function inboxAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $entities = $em->getRepository('TaskBundle:Tarea')->inbox($user);
        //$tempo = $this->get('timeago');
        
        return array(
            'entities' => $entities,
        );
    }
    
    /**
     * Lists all Tareas entities.
     *
     * @Route("/api/activities/activity-tasks.{_format}", name="activity-tasks", options={"expose":true})
     * @Method("GET")
     */
    public function inboxApiAction($_format='')
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $entities = $em->getRepository('TaskBundle:Tarea')->inbox($user);

        $taskBox=new TaskBox();
        $taskBox->setData($entities);
        $serializer = $this->get('jms_serializer');
        $dataTaskBox=$serializer->serialize($taskBox, 'json');

        $response=new JsonResponse();
        $response->setData(json_decode($dataTaskBox));
        return $response;
    }
    
    
    /**
     * Creates a new Tarea entity.
     *
     * @Route("/", name="tarea_create", options={"expose":true})
     * @Method("POST")
     * @Template("TaskBundle:Tarea:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Tarea();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            //$usr= $this->get('security.context')->getToken()->get();
            $usr= $this->get('security.token_storage')->getToken()->getUser();
            $entity->setCreatedby($usr);
            $em->persist($entity);
            $em->flush();

            //return $this->redirect($this->generateUrl('tarea_show', array('id' => $entity->getId())));
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
     * Creates a form to create a Tarea entity.
     *
     * @param Tarea $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Tarea $entity)
    {
        $form = $this->createForm(new TareaType(), $entity, array(
            //'action' => $this->generateUrl('tarea_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear'));

        return $form;
    }

    /**
     * Displays a form to create a new Tarea entity.
     *
     * @Route("/new", name="tarea_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
       return $this->render('::basesmartpanelangular.html.twig');
    }

    /**
     * Displays a form to create a new Tarea entity.
     *
     * @Route("/api/new", name="tarea_api_new", options={"expose":true})
     * @Method("GET")
     * @Template("TaskBundle:Tarea:new.html.twig")
     */
    public function newApiAction()
    {
        $entity = new Tarea();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Tarea entity.
     *
     * @Route("/{id}", name="tarea_show", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     */
    public function showAction($id)
    {
       return $this->render('::basesmartpanelangular.html.twig');
    }

    /**
     * Finds and displays a Tarea entity.
     *
     * @Route("/api/{id}", name="tarea_api_show", options={"expose":true})
     * @Method("GET")
     * @Template("TaskBundle:Tarea:show.html.twig")
     */
    public function showApiAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TaskBundle:Tarea')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tarea entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
  * Finds and displays a Tarea entity.
  *
     * @Route("/takstemplate/getTemplate/{id}", name="tarea_getTemplate", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    
      public function getTemplateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TaskBundle:Tasktemplate')->find($id);
          $array=array();
          $array['id']= $entity->getId();
          
          $array['tarea']= $entity->getTarea();
          $array['descripcion']= $entity->getDescripcion();
       // if (!$entity) {
       //     throw $this->createNotFoundException('Unable to find Tarea entity.');
      //  }
        
  //you can return result as JSON
   
    $response=new Response(json_encode($array));
   
    $response->headers->set('Content-Type', 'application/json');
    
  //you can return result as JSON
  return $response; 
    }

   
    
  /**
  * Finds and displays a Tarea entity.
  *
  * @Route("/{id}/finish", name="tarea_finish", options={"expose":true})
  * @Method("GET")
  * @return Response
  */
    
  public function finishAction(Request $request, $id)
    {
        $isAjax = $request->isXmlHttpRequest();

        if ($isAjax) {

            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TaskBundle:Tarea')->find($id);
            if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tarea entity.');
            }
            $entity->setState(StateTaskType::FINALIZADA);
            $usr= $this->get('security.token_storage')->getToken()->getUser();
            //$entity=new Tarea();
            $entity->setFinishby($usr);
            $entity->setFinished(New \Datetime());
            $em->flush();

            return $this->redirect($this->generateUrl('tarea_api_show', array('id' => $id)));
            //return new Response("Success", 200);
        }

        return new Response("Bad Request", 400);
    }
    /**
     * Displays a form to edit an existing Tarea entity.
     *
     * @Route("/{id}/edit", name="tarea_edit", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     */
    public function editAction($id)
    {
       return $this->render('::basesmartpanelangular.html.twig');
    }

    /**
    * Creates a form to edit a Tarea entity.
    *
    * @param Tarea $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Tarea $entity)
    {
        $form = $this->createForm(new TareaType(), $entity, array(
            //'action' => $this->generateUrl('tarea_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar'));

        return $form;
    }

    /**
     * Displays a form to edit an existing Tarea entity.
     *
     * @Route("/api/{id}/edit", name="tarea_api_edit", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     * @Template("TaskBundle:Tarea:edit.html.twig")
     */
    public function editApiAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TaskBundle:Tarea')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tarea entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }    /**
     * Edits an existing Tarea entity.
     *
     * @Route("/{id}", name="tarea_update", options={"expose":true})
     * @Method("PUT")
     * @Template("TaskBundle:Tarea:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TaskBundle:Tarea')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tarea entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tarea_api_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    
    /**
     * Deletes a Tarea entity.
     *
     * @Route("/{id}", name="tarea_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TaskBundle:Tarea')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Tarea entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tarea'));
    }

    /**
     * Creates a form to delete a Tarea entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tarea_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar'))
            ->getForm()
        ;
    }
}
