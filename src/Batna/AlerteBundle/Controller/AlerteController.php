<?php

namespace Batna\AlerteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Batna\AlerteBundle\Entity\Alerte;
use Batna\AlerteBundle\Form\AlerteType;

/**
 * Alerte controller.
 *
 */
class AlerteController extends Controller
{
    /**
     * Lists all Alerte entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('BatnaAlerteBundle:Alerte')->findAll();

        return $this->render('BatnaAlerteBundle:Alerte:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Alerte entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaAlerteBundle:Alerte')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Alerte entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BatnaAlerteBundle:Alerte:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Alerte entity.
     *
     */
    public function newAction()
    {
        $entity = new Alerte();
        $form   = $this->createForm(new AlerteType(), $entity);

        return $this->render('BatnaAlerteBundle:Alerte:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Alerte entity.
     *
     */
    public function createAction()
    {
        $entity  = new Alerte();
        $request = $this->getRequest();
        $form    = $this->createForm(new AlerteType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('alert_show', array('id' => $entity->getId())));
            
        }

        return $this->render('BatnaAlerteBundle:Alerte:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Alerte entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaAlerteBundle:Alerte')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Alerte entity.');
        }

        $editForm = $this->createForm(new AlerteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BatnaAlerteBundle:Alerte:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Alerte entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaAlerteBundle:Alerte')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Alerte entity.');
        }

        $editForm   = $this->createForm(new AlerteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('alert_edit', array('id' => $id)));
        }

        return $this->render('BatnaAlerteBundle:Alerte:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Alerte entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('BatnaAlerteBundle:Alerte')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Alerte entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('alert'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
