<?php

namespace Batna\ArchiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Batna\ArchiBundle\Entity\Host;
use Batna\ArchiBundle\Form\HostType;

/**
 * Host controller.
 *
 */
class HostController extends Controller
{
    /**
     * Lists all Host entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('BatnaArchiBundle:Host')->findAll();

        return $this->render('BatnaArchiBundle:Host:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Host entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaArchiBundle:Host')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Host entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BatnaArchiBundle:Host:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Host entity.
     *
     */
    public function newAction()
    {
        $entity = new Host();
        $form   = $this->createForm(new HostType(), $entity);

        return $this->render('BatnaArchiBundle:Host:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Host entity.
     *
     */
    public function createAction()
    {
        $entity  = new Host();
        $request = $this->getRequest();
        $form    = $this->createForm(new HostType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('host_show', array('id' => $entity->getId())));
            
        }

        return $this->render('BatnaArchiBundle:Host:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Host entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaArchiBundle:Host')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Host entity.');
        }

        $editForm = $this->createForm(new HostType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BatnaArchiBundle:Host:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Host entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaArchiBundle:Host')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Host entity.');
        }

        $editForm   = $this->createForm(new HostType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('host_edit', array('id' => $id)));
        }

        return $this->render('BatnaArchiBundle:Host:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Host entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('BatnaArchiBundle:Host')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Host entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('host'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
