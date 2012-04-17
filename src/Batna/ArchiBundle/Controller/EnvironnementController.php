<?php

namespace Batna\ArchiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Batna\ArchiBundle\Entity\Environnement;
use Batna\ArchiBundle\Form\EnvironnementType;

/**
 * Environnement controller.
 *
 */
class EnvironnementController extends Controller
{
    /**
     * Lists all Environnement entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        
        $entities = $em->getRepository('BatnaArchiBundle:Environnement')->findAll();
        $variables = $em->getRepository('BatnaArchiBundle:Variable')->findByType('environnement');

        return $this->render('BatnaArchiBundle:Environnement:index.html.twig', array(
            'entities' => $entities,
        	'variables'=> $variables,
        ));
    }

    /**
     * Finds and displays a Environnement entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaArchiBundle:Environnement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Environnement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BatnaArchiBundle:Environnement:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Environnement entity.
     *
     */
    public function newAction()
    {
        $entity = new Environnement();
        $form   = $this->createForm(new EnvironnementType(), $entity);

        return $this->render('BatnaArchiBundle:Environnement:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Environnement entity.
     *
     */
    public function createAction()
    {
        $entity  = new Environnement();
        $request = $this->getRequest();
        $form    = $this->createForm(new EnvironnementType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('env_show', array('id' => $entity->getId())));
            
        }

        return $this->render('BatnaArchiBundle:Environnement:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Environnement entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaArchiBundle:Environnement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Environnement entity.');
        }

        $editForm = $this->createForm(new EnvironnementType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BatnaArchiBundle:Environnement:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Environnement entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaArchiBundle:Environnement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Environnement entity.');
        }

        $editForm   = $this->createForm(new EnvironnementType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('env_edit', array('id' => $id)));
        }

        return $this->render('BatnaArchiBundle:Environnement:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Environnement entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('BatnaArchiBundle:Environnement')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Environnement entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('env'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
