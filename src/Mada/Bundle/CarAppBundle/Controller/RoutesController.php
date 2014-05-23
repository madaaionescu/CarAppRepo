<?php

namespace Mada\Bundle\CarAppBundle\Controller;

use Mada\Bundle\CarAppBundle\Entity\Feedback;
use Mada\Bundle\CarAppBundle\Entity\Routes;
use Mada\Bundle\CarAppBundle\Form\FeedbackType;
use Mada\Bundle\CarAppBundle\Form\RoutesType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

/**
 * Routes controller.
 *
 * @Route("/routes")
 */
class RoutesController extends Controller
{

    /**
     * Lists all Routes entities.
     *
     * @Route("/", name="routes")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MadaCarAppBundle:Routes')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Routes entity.
     *
     * @Route("/", name="routes_create")
     * @Method("POST")
     * @Template("MadaCarAppBundle:Routes:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Routes();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('routes_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Routes entity.
    *
    * @param Routes $entity The entity
    *
    * @return Form The form
    */
    private function createCreateForm(Routes $entity)
    {
        $form = $this->createForm(new RoutesType(), $entity, array(
            'action' => $this->generateUrl('routes_create'),
            'method' => 'POST',
            'em' => $this->getDoctrine()->getManager(),
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Routes entity.
     *
     * @Route("/new", name="routes_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Routes();
        
        $user = $this->get('security.context')->getToken()->getUser(); // user autentificat
        $entity->setOwner($user); 
        
        $form   = $this->createCreateForm($entity);
        
        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }
    
    /**
    * Creates a form to create a Feedback entity.
    *
    * @param Feedback $entity The entity
    *
    * @return Form The form
    */
    private function createFeedbackForm(Feedback $entity)
    {
        $form = $this->createForm(new FeedbackType(), $entity, array(
            'action' => $this->generateUrl('feedback_create'),
            'method' => 'POST',
            'em' => $this->getDoctrine()->getManager(),
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Finds and displays a Routes entity.
     *
     * @Route("/{id}", name="routes_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MadaCarAppBundle:Routes')->find($id); // ruta
       
        $feedback = new Feedback($entity->getId());
        $user = $this->get('security.context')->getToken()->getUser(); // user autentificat
        $entity->setOwner($user);
        
        
        $feedbackForm   = $this->createFeedbackForm($feedback);
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Routes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'feedbackForm'        => $feedbackForm->createView(), 
        );
    }

    /**
     * Displays a form to edit an existing Routes entity.
     *
     * @Route("/{id}/edit", name="routes_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MadaCarAppBundle:Routes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Routes entity.');
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
    * Creates a form to edit a Routes entity.
    *
    * @param Routes $entity The entity
    *
    * @return Form The form
    */
    private function createEditForm(Routes $entity)
    {
        $form = $this->createForm(new RoutesType(), $entity, array(
            'action' => $this->generateUrl('routes_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            'em' => $this->getDoctrine()->getManager(),
            
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Routes entity.
     *
     * @Route("/{id}", name="routes_update")
     * @Method("PUT")
     * @Template("MadaCarAppBundle:Routes:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MadaCarAppBundle:Routes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Routes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('routes_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Routes entity.
     *
     * @Route("/{id}", name="routes_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MadaCarAppBundle:Routes')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Routes entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('routes'));
    }

    /**
     * Creates a form to delete a Routes entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('routes_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
