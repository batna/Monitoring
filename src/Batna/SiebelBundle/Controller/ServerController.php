<?php

namespace Batna\SiebelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Batna\SiebelBundle\Entity\Server;
use Batna\SiebelBundle\Form\ServerType;

/**
 * Server controller.
 *
 */
class ServerController extends Controller
{
    /**
     * Lists all Server entities.
     *
     */
    public function indexAction($es='all')
    {
    	$em = $this->getDoctrine()->getEntityManager();
    	
    	$entities = $em->getRepository('BatnaSiebelBundle:Server')->findAll();

    	echo 'jusqu\'ici tout va bien';
    	if(is_numeric($es))
    	{
    		echo 'premier cas';
    		$entities = $em->getRepository('BatnaSiebelBundle:Server')->findByEnterprise($es);
    		$es = $em->getRepository('BatnaSiebelBundle:Enterprise')->find($es);
    	
    	}
    	else
    	{
    		echo 'deuxieme cas';
    		$entities = $em->getRepository('BatnaSiebelBundle:Server')->findAll();
    		
    		$es = false;
    	}
    	
    	
    	echo 'encore bon';
    	$servers = $entities;
    	    	    		
        return $this->render('BatnaSiebelBundle:Server:index.html.twig', array(
            'entities' => $entities,
        	'es' => $es,
        ));
    }

    /**
     * Finds and displays a Server entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        
        $entity = $em->getRepository('BatnaSiebelBundle:Server')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Server entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BatnaSiebelBundle:Server:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Server entity.
     *
     */
    public function newAction()
    {
        $entity = new Server();
        $form   = $this->createForm(new ServerType(), $entity);

        return $this->render('BatnaSiebelBundle:Server:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Server entity.
     *
     */
    public function createAction()
    {
        $entity  = new Server();
        $request = $this->getRequest();
        $form    = $this->createForm(new ServerType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ss_show', array('id' => $entity->getId())));
            
        }

        return $this->render('BatnaSiebelBundle:Server:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Server entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaSiebelBundle:Server')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Server entity.');
        }

        $editForm = $this->createForm(new ServerType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BatnaSiebelBundle:Server:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Server entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaSiebelBundle:Server')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Server entity.');
        }

        $editForm   = $this->createForm(new ServerType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ss_edit', array('id' => $id)));
        }

        return $this->render('BatnaSiebelBundle:Server:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Server entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('BatnaSiebelBundle:Server')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Server entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('ss'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
