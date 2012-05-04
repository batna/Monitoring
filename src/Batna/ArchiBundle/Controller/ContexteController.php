<?php

namespace Batna\ArchiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Batna\ArchiBundle\Entity\Contexte;
use Batna\ArchiBundle\Form\ContexteType;

/**
 * Contexte controller.
 *
 */
class ContexteController extends Controller
{
    /**
     * Lists all Contexte entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        
        $entities = $em->getRepository('BatnaArchiBundle:Contexte')->findAll();
        $variables = $em->getRepository('BatnaArchiBundle:Variable')->findByType('contexte');

        return $this->render('BatnaArchiBundle:Contexte:index.html.twig', array(
            'entities' => $entities,
            'variables' => $variables,
        ));
    }

    /**
     * Finds and displays a Contexte entity.
     *
     */
	public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        
        $entity = $em->getRepository('BatnaArchiBundle:Contexte')->find($id);
        $variables = $em->getRepository('BatnaArchiBundle:Variable')->findByType('contexte');
        $valeurs = $em->getRepository('BatnaArchiBundle:ValVarContexte')->findByContexte($id);
        

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contexte entity.');
        }

		foreach($variables as $variable)
		{
			$varTab[$variable->getId()]['id'] = $variable->getId();
			$varTab[$variable->getId()]['name'] = $variable->getName();
			$varTab[$variable->getId()]['value'] = '';
		}
		
		foreach($valeurs as $valeur)
        {
        	$varTab[$valeur->getVariable()->getId()]['value'] = $valeur->getValue();
        }
              
        return $this->render('BatnaArchiBundle:Contexte:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $this->createDeleteForm($id)->createView(),
        	'variables'   => $varTab,
        ));
    }

    /**
     * Displays a form to create a new Contexte entity.
     *
     */
    public function newAction()
    {
        $entity = new Contexte();
        $form   = $this->createForm(new ContexteType(), $entity);

        return $this->render('BatnaArchiBundle:Contexte:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Contexte entity.
     *
     */
    public function createAction()
    {
        $entity  = new Contexte();
        $request = $this->getRequest();
        $form    = $this->createForm(new ContexteType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ctxt_show', array('id' => $entity->getId())));
            
        }

        return $this->render('BatnaArchiBundle:Contexte:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Contexte entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaArchiBundle:Contexte')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contexte entity.');
        }

        $editForm = $this->createForm(new ContexteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BatnaArchiBundle:Contexte:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Contexte entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaArchiBundle:Contexte')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contexte entity.');
        }

        $editForm   = $this->createForm(new ContexteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ctxt_edit', array('id' => $id)));
        }

        return $this->render('BatnaArchiBundle:Contexte:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Contexte entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('BatnaArchiBundle:Contexte')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Contexte entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('ctxt'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
