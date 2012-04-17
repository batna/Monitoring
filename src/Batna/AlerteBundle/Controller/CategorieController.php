<?php

namespace Batna\AlerteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Batna\AlerteBundle\Entity\Categorie;
use Batna\AlerteBundle\Form\CategorieType;

/**
 * Categorie controller.
 *
 */
class CategorieController extends Controller
{
    /**
     * Lists all Categorie entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        
        $entities = $em->getRepository('BatnaAlerteBundle:Categorie')->findAll();

        return $this->render('BatnaAlerteBundle:Categorie:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Categorie entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaAlerteBundle:Categorie')->find($id);
        $seuils = $em->getRepository('BatnaAlerteBundle:Seuil')->findByCategorie($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Categorie entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BatnaAlerteBundle:Categorie:show.html.twig', array(
        	'seuils'	  => $seuils,
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Categorie entity.
     *
     */
    public function newAction()
    {
        $entity = new Categorie();
        $form   = $this->createForm(new CategorieType(), $entity);

        return $this->render('BatnaAlerteBundle:Categorie:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Categorie entity.
     *
     */
    public function createAction()
    {
        $entity  = new Categorie();
        $request = $this->getRequest();
        $form    = $this->createForm(new CategorieType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cat_show', array('id' => $entity->getId())));
            
        }

        return $this->render('BatnaAlerteBundle:Categorie:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Categorie entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaAlerteBundle:Categorie')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Categorie entity.');
        }

        $editForm = $this->createForm(new CategorieType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BatnaAlerteBundle:Categorie:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Categorie entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaAlerteBundle:Categorie')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Categorie entity.');
        }

        $editForm   = $this->createForm(new CategorieType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cat_edit', array('id' => $id)));
        }

        return $this->render('BatnaAlerteBundle:Categorie:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Categorie entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('BatnaAlerteBundle:Categorie')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Categorie entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('cat'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
