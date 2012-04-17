<?php

namespace Batna\SiebelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Batna\SiebelBundle\Entity\ComponentGroup;
use Batna\SiebelBundle\Form\ComponentGroupType;

/**
 * ComponentGroup controller.
 *
 */
class ComponentGroupController extends Controller
{
    /**
     * Lists all ComponentGroup entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('BatnaSiebelBundle:ComponentGroup')->findAll();

        return $this->render('BatnaSiebelBundle:ComponentGroup:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a ComponentGroup entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaSiebelBundle:ComponentGroup')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ComponentGroup entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BatnaSiebelBundle:ComponentGroup:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new ComponentGroup entity.
     *
     */
    public function newAction()
    {
        $entity = new ComponentGroup();
        $form   = $this->createForm(new ComponentGroupType(), $entity);

        return $this->render('BatnaSiebelBundle:ComponentGroup:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new ComponentGroup entity.
     *
     */
    public function createAction()
    {
        $entity  = new ComponentGroup();
        $request = $this->getRequest();
        $form    = $this->createForm(new ComponentGroupType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cg_show', array('id' => $entity->getId())));
            
        }

        return $this->render('BatnaSiebelBundle:ComponentGroup:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing ComponentGroup entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaSiebelBundle:ComponentGroup')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ComponentGroup entity.');
        }

        $editForm = $this->createForm(new ComponentGroupType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BatnaSiebelBundle:ComponentGroup:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing ComponentGroup entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaSiebelBundle:ComponentGroup')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ComponentGroup entity.');
        }

        $editForm   = $this->createForm(new ComponentGroupType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cg_edit', array('id' => $id)));
        }

        return $this->render('BatnaSiebelBundle:ComponentGroup:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ComponentGroup entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('BatnaSiebelBundle:ComponentGroup')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ComponentGroup entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('cg'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
