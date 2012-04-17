<?php

namespace Batna\AlerteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Batna\AlerteBundle\Entity\Seuil;
use Batna\AlerteBundle\Form\SeuilType;

/**
 * Seuil controller.
 *
 */
class SeuilController extends Controller
{
    /**
     * Lists all Seuil entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('BatnaAlerteBundle:Seuil')->findAll();

        return $this->render('BatnaAlerteBundle:Seuil:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Seuil entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaAlerteBundle:Seuil')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Seuil entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BatnaAlerteBundle:Seuil:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Seuil entity.
     *
     */
    public function newAction()
    {
        $entity = new Seuil();
        $form   = $this->createForm(new SeuilType(), $entity);

        return $this->render('BatnaAlerteBundle:Seuil:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Seuil entity.
     *
     */
    public function createAction()
    {
        $entity  = new Seuil();
        $request = $this->getRequest();
        $form    = $this->createForm(new SeuilType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('seuil_show', array('id' => $entity->getId())));
            
        }

        return $this->render('BatnaAlerteBundle:Seuil:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Seuil entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaAlerteBundle:Seuil')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Seuil entity.');
        }

        $editForm = $this->createForm(new SeuilType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BatnaAlerteBundle:Seuil:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Seuil entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaAlerteBundle:Seuil')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Seuil entity.');
        }

        $editForm   = $this->createForm(new SeuilType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('seuil_edit', array('id' => $id)));
        }

        return $this->render('BatnaAlerteBundle:Seuil:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Seuil entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('BatnaAlerteBundle:Seuil')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Seuil entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('seuil'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
