<?php

namespace Batna\SiebelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Batna\SiebelBundle\Entity\NamedSubsystem;
use Batna\SiebelBundle\Form\NamedSubsystemType;

/**
 * NamedSubsystem controller.
 *
 */
class NamedSubsystemController extends Controller
{
    /**
     * Lists all NamedSubsystem entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
		echo 'tvb1';
        $entities = $em->getRepository('BatnaSiebelBundle:NamedSubsystem')->findAll();
        echo 'tvb2';
        return $this->render('BatnaSiebelBundle:NamedSubsystem:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a NamedSubsystem entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaSiebelBundle:NamedSubsystem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NamedSubsystem entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BatnaSiebelBundle:NamedSubsystem:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new NamedSubsystem entity.
     *
     */
    public function newAction()
    {
        $entity = new NamedSubsystem();
        $form   = $this->createForm(new NamedSubsystemType(), $entity);

        return $this->render('BatnaSiebelBundle:NamedSubsystem:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new NamedSubsystem entity.
     *
     */
    public function createAction()
    {
        $entity  = new NamedSubsystem();
        $request = $this->getRequest();
        $form    = $this->createForm(new NamedSubsystemType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ns_show', array('id' => $entity->getId())));
            
        }

        return $this->render('BatnaSiebelBundle:NamedSubsystem:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing NamedSubsystem entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaSiebelBundle:NamedSubsystem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NamedSubsystem entity.');
        }

        $editForm = $this->createForm(new NamedSubsystemType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BatnaSiebelBundle:NamedSubsystem:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing NamedSubsystem entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaSiebelBundle:NamedSubsystem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NamedSubsystem entity.');
        }

        $editForm   = $this->createForm(new NamedSubsystemType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ns_edit', array('id' => $id)));
        }

        return $this->render('BatnaSiebelBundle:NamedSubsystem:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a NamedSubsystem entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('BatnaSiebelBundle:NamedSubsystem')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find NamedSubsystem entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('ns'));
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
	
		$namedSubsystem = $em->getRepository('BatnaSiebelBundle:NamedSubsystem')->find($id);
	
		if (!$namedSubsystem) {
			throw $this->createNotFoundException('Unable to find NamedSubsystem entity.');
		}
	
		$editForm   = $this->createForm(new NamedSubsystemType(), $namedSubsystem);
		$deleteForm = $this->createDeleteForm($id);
	
		$request = $this->getRequest();
		$parameter = $request->get('parameter');
		$value = $request->get('value');
		$namedSubsystem->addParameter(array($parameter, $value));
	
		$em->persist($namedSubsystem);
		$em->flush();
	
		return $this->render('BatnaSiebelBundle:NamedSubsystem:show.html.twig', array(
            'entity'      => $namedSubsystem,
            'delete_form' => $deleteForm->createView(),

        ));
    }
    
    public function removeParameterAction($id)
    {
		$em = $this->getDoctrine()->getEntityManager();
	
		$namedSubsystem = $em->getRepository('BatnaSiebelBundle:NamedSubsystem')->find($id);
	
		if (!$namedSubsystem) {
			throw $this->createNotFoundException('Unable to find NamedSubsystem entity.');
		}
	
		$editForm   = $this->createForm(new NamedSubsystemType(), $namedSubsystem);
		$deleteForm = $this->createDeleteForm($id);
	
		$request = $this->getRequest();
		$parameter = $request->get('param');
		$value = $request->get('value');
		$paramtab = array($parameter, $value);
	
		$namedSubsystem->removeParameter($paramtab);
	
		$em->persist($namedSubsystem);
		$em->flush();
	
		return $this->render('BatnaSiebelBundle:NamedSubsystem:show.html.twig', array(
            'entity'      => $namedSubsystem,
            'delete_form' => $deleteForm->createView(),

        ));
    }
}
