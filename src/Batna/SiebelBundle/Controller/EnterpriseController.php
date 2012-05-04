<?php

namespace Batna\SiebelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Batna\SiebelBundle\Entity\Enterprise;
use Batna\SiebelBundle\Form\EnterpriseType;

/**
 * Enterprise controller.
 *
 */
class EnterpriseController extends Controller
{
    /**
     * Lists all Enterprise entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('BatnaSiebelBundle:Enterprise')->findAll();

        return $this->render('BatnaSiebelBundle:Enterprise:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Enterprise entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaSiebelBundle:Enterprise')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Enterprise entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BatnaSiebelBundle:Enterprise:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Enterprise entity.
     *
     */
    public function newAction()
    {
        $entity = new Enterprise();
        $form   = $this->createForm(new EnterpriseType(), $entity);

        return $this->render('BatnaSiebelBundle:Enterprise:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Enterprise entity.
     *
     */
    public function createAction()
    {
        $entity  = new Enterprise();
        $request = $this->getRequest();
        $form    = $this->createForm(new EnterpriseType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('es_show', array('id' => $entity->getId())));
            
        }

        return $this->render('BatnaSiebelBundle:Enterprise:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Enterprise entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaSiebelBundle:Enterprise')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Enterprise entity.');
        }

        $editForm = $this->createForm(new EnterpriseType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BatnaSiebelBundle:Enterprise:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Enterprise entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaSiebelBundle:Enterprise')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Enterprise entity.');
        }

        $editForm   = $this->createForm(new EnterpriseType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('es_edit', array('id' => $id)));
        }

        return $this->render('BatnaSiebelBundle:Enterprise:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Enterprise entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('BatnaSiebelBundle:Enterprise')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Enterprise entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('es'));
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
	
		$enterprise = $em->getRepository('BatnaSiebelBundle:Enterprise')->find($id);
	
		if (!$enterprise) {
			throw $this->createNotFoundException('Unable to find Enterprise entity.');
		}
	
		$editForm   = $this->createForm(new EnterpriseType(), $enterprise);
		$deleteForm = $this->createDeleteForm($id);
	
		$request = $this->getRequest();
		$parameter = $request->get('parameter');
		$value = $request->get('value');
	
		$enterprise->addParameter(array($parameter, $value));
	
		$em->persist($enterprise);
		$em->flush();
	
		return $this->render('BatnaSiebelBundle:Enterprise:show.html.twig', array(
            'entity'      => $enterprise,
            'delete_form' => $deleteForm->createView(),

        ));
    }
    
    public function removeParameterAction($id)
    {
		$em = $this->getDoctrine()->getEntityManager();
	
		$enterprise = $em->getRepository('BatnaSiebelBundle:Enterprise')->find($id);
	
		if (!$enterprise) {
			throw $this->createNotFoundException('Unable to find Enterprise entity.');
		}
	
		$editForm   = $this->createForm(new EnterpriseType(), $enterprise);
		$deleteForm = $this->createDeleteForm($id);
	
		$request = $this->getRequest();
		$parameter = $request->get('param');
		$value = $request->get('value');
		$paramtab = array($parameter, $value);
	
		$enterprise->removeParameter($paramtab);
	
		$em->persist($enterprise);
		$em->flush();
	
		return $this->render('BatnaSiebelBundle:Enterprise:show.html.twig', array(
            'entity'      => $enterprise,
            'delete_form' => $deleteForm->createView(),

        ));
    }
}
