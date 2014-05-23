<?php

namespace Mada\Bundle\CarAppBundle\Controller;

use Mada\Bundle\CarAppBundle\Entity\Feedback;
use Mada\Bundle\CarAppBundle\Form\FeedbackType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Feedback controller.
 *
 * @Route("/feedback")
 */
class FeedbackController extends Controller
{

      /**
     * Lists all Feedback entities for one specific route.
     *
     * @Route("/listRoute/{routeId}", name="list_route_feedback")
     * @Method("GET")
     * @Template("MadaCarAppBundle:Feedback:index.html.twig")
     */
    public function listAction($routeId)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MadaCarAppBundle:Feedback')->findBy(array("routeId"=>$routeId),array("id"=>"DESC"),10);
        
        return array(
            'entities' => $entities,
        );
    }
    
    /**
     * Lists all Feedback entities.
     *
     * @Route("/", name="feedback")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MadaCarAppBundle:Feedback')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Feedback entity.
     *
     * @Route("/", name="feedback_create")
     * @Method("POST")
     * @Template("MadaCarAppBundle:Feedback:new.html.twig")
     */
    public function createAction(Request $request)
    {   
        try{
        // preluam requestul si accesam parametrii care i-am trimis prin formular
        $routeId = $request->request->get("mada_bundle_carappbundle_feedback")['routeId'];
        
        // var_dump($request->request->all()); die;
        
        $entity = new Feedback($routeId);
        
        $form = $this->createCreateForm($entity);
        
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
                // aici construim raspunsul
            //return $this->redirect($this->generateUrl('feedback_show', array('id' => $entity->getId())));
            return new JsonResponse(array('status'=>'SUCCESS', 'msg'=>"Feedback-ul a fost adaugat :)"), 200);
        }

            return new JsonResponse(array('status'=>'FAIL', 'msg'=>$form->getErrorsAsString()), 400);
        }catch(\Exception $e){
            return new JsonResponse(array('status'=>'FAIL', 'msg'=>$e->getMessage()), 500);
        }
    }

    /**
    * Creates a form to create a Feedback entity.
    *
    * @param Feedback $entity The entity
    *
    * @return Form The form
    */
    private function createCreateForm(Feedback $entity)
    {
        $form = $this->createForm(new FeedbackType(), $entity, array(
            'action' => $this->generateUrl('feedback_create'),
            'method' => 'POST',
            'em' => $this->getDoctrine()->getManager(),
        ));

        $form->add('button', 'button', array('label' => 'Create', 'attr'=>array('onclick'=>'submitNewFeedback()')));

        return $form;
    }

    /**
     * Displays a form to create a new Feedback entity.
     *
     * @Route("/new/routeid/{routeId}", name="feedback_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($routeId)
    {
        
        $entity = new Feedback($routeId);
        
        $user = $this->get('security.context')->getToken()->getUser(); // user autentificat
        $entity->setOwner($user);
        
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Feedback entity.
     *
     * @Route("/{id}", name="feedback_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MadaCarAppBundle:Feedback')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Feedback entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Feedback entity.
     *
     * @Route("/{id}/edit", name="feedback_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MadaCarAppBundle:Feedback')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Feedback entity.');
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
    * Creates a form to edit a Feedback entity.
    *
    * @param Feedback $entity The entity
    *
    * @return Form The form
    */
    private function createEditForm(Feedback $entity)
    {
        $form = $this->createForm(new FeedbackType(), $entity, array(
            'action' => $this->generateUrl('feedback_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Feedback entity.
     *
     * @Route("/{id}", name="feedback_update")
     * @Method("PUT")
     * @Template("MadaCarAppBundle:Feedback:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MadaCarAppBundle:Feedback')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Feedback entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('feedback_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Feedback entity.
     *
     * @Route("/{id}", name="feedback_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MadaCarAppBundle:Feedback')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Feedback entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('feedback'));
    }

    /**
     * Creates a form to delete a Feedback entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('feedback_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
