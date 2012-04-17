<?php

namespace Batna\SiebelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Batna\SiebelBundle\Entity\Component;
use Batna\SiebelBundle\Form\ComponentType;

/**
 * Component controller.
 *
 */
class ComponentController extends Controller
{
    /**
     * Lists all Component entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('BatnaSiebelBundle:Component')->findAll();

        return $this->render('BatnaSiebelBundle:Component:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Component entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaSiebelBundle:Component')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Component entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BatnaSiebelBundle:Component:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Component entity.
     *
     */
    public function newAction()
    {
        $entity = new Component();
        $form   = $this->createForm(new ComponentType(), $entity);

        return $this->render('BatnaSiebelBundle:Component:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Component entity.
     *
     */
    public function createAction()
    {
        $entity  = new Component();
        $request = $this->getRequest();
        $form    = $this->createForm(new ComponentType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cmp_show', array('id' => $entity->getId())));
            
        }

        return $this->render('BatnaSiebelBundle:Component:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Component entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaSiebelBundle:Component')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Component entity.');
        }

        $editForm = $this->createForm(new ComponentType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BatnaSiebelBundle:Component:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Component entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaSiebelBundle:Component')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Component entity.');
        }

        $editForm   = $this->createForm(new ComponentType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cmp_edit', array('id' => $id)));
        }

        return $this->render('BatnaSiebelBundle:Component:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Component entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('BatnaSiebelBundle:Component')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Component entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('cmp'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
    public function addParameterAction($id)
    {
		$em = $this->getDoctrine()->getEntityManager();
	
		$component = $em->getRepository('BatnaSiebelBundle:Component')->find($id);
	
		if (!$component) {
			throw $this->createNotFoundException('Unable to find Component entity.');
		}
	
		$editForm   = $this->createForm(new ComponentType(), $component);
		$deleteForm = $this->createDeleteForm($id);
	
		$request = $this->getRequest();
		$parameter = $request->get('parameter');
		$value = $request->get('value');
	
		$component->addParameter(array($parameter, $value));
	
		$em->persist($component);
		$em->flush();
	
		return $this->render('BatnaSiebelBundle:Component:show.html.twig', array(
            'entity'      => $component,
            'delete_form' => $deleteForm->createView(),

        ));
    }
    
    public function removeParameterAction($id)
    {
		$em = $this->getDoctrine()->getEntityManager();
	
		$component = $em->getRepository('BatnaSiebelBundle:Component')->find($id);
	
		if (!$component) {
			throw $this->createNotFoundException('Unable to find Component entity.');
		}
	
		$editForm   = $this->createForm(new ComponentType(), $component);
		$deleteForm = $this->createDeleteForm($id);
	
		$request = $this->getRequest();
		$parameter = $request->get('param');
		$value = $request->get('value');
		$paramtab = array($parameter, $value);
	
		$component->removeParameter($paramtab);
	
		$em->persist($component);
		$em->flush();
	
		return $this->render('BatnaSiebelBundle:Component:show.html.twig', array(
            'entity'      => $component,
            'delete_form' => $deleteForm->createView(),

        ));
    }
}
