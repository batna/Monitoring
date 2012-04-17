<?php

namespace Batna\AlerteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Batna\AlerteBundle\Entity\Diffusion;
use Batna\AlerteBundle\Form\DiffusionType;

/**
 * Diffusion controller.
 *
 */
class DiffusionController extends Controller
{
    /**
     * Lists all Diffusion entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('BatnaAlerteBundle:Diffusion')->findAll();

        return $this->render('BatnaAlerteBundle:Diffusion:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Diffusion entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaAlerteBundle:Diffusion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Diffusion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BatnaAlerteBundle:Diffusion:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Diffusion entity.
     *
     */
    public function newAction()
    {
        $entity = new Diffusion();
        $form   = $this->createForm(new DiffusionType(), $entity);

        return $this->render('BatnaAlerteBundle:Diffusion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Diffusion entity.
     *
     */
    public function createAction()
    {
        $entity  = new Diffusion();
        $request = $this->getRequest();
        $form    = $this->createForm(new DiffusionType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('diff_show', array('id' => $entity->getId())));
            
        }

        return $this->render('BatnaAlerteBundle:Diffusion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Diffusion entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaAlerteBundle:Diffusion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Diffusion entity.');
        }

        $editForm = $this->createForm(new DiffusionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BatnaAlerteBundle:Diffusion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Diffusion entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaAlerteBundle:Diffusion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Diffusion entity.');
        }

        $editForm   = $this->createForm(new DiffusionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('diff_edit', array('id' => $id)));
        }

        return $this->render('BatnaAlerteBundle:Diffusion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Diffusion entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('BatnaAlerteBundle:Diffusion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Diffusion entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('diff'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
