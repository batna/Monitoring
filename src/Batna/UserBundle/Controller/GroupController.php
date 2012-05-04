<?php

namespace Batna\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Batna\UserBundle\Entity\Group;
use Batna\UserBundle\Form\GroupType;

/**
 * Group controller.
 *
 */
class GroupController extends Controller
{
    /**
     * Lists all Group entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $groups = $em->getRepository('BatnaUserBundle:Group')->findAll();

        return $this->render('BatnaUserBundle:Group:list.html.twig', array(
            'groups' => $groups
        ));
    }

    /**
     * Finds and displays a Group entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaUserBundle:Group')->find($id);
        $roles = $em->getRepository('BatnaUserBundle:Role')->findAll();
        
    	if (!$entity) {
            throw $this->createNotFoundException('Unable to find Group entity.');
        }
        if (!$roles) {
            throw $this->createNotFoundException('Unable to find Role entities.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BatnaUserBundle:Group:show.html.twig', array(
            'group'      => $entity,
            'delete_form' => $deleteForm->createView(),	
			'roles'		=> $roles,
        ));
    }

    /**
     * Displays a form to create a new Group entity.
     *
     */
    public function newAction()
    {
        $entity = new Group('');
        $form   = $this->createForm(new GroupType(), $entity);

        return $this->render('BatnaUserBundle:Group:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Group entity.
     *
     */
    public function createAction()
    {
        $entity  = new Group('');
        $request = $this->getRequest();
        $form    = $this->createForm(new GroupType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('group_show', array('id' => $entity->getId())));
            
        }

        return $this->render('BatnaUserBundle:Group:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Group entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaUserBundle:Group')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Group entity.');
        }

        $editForm = $this->createForm(new GroupType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BatnaUserBundle:Group:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Group entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaUserBundle:Group')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Group entity.');
        }

        $editForm   = $this->createForm(new GroupType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('group_edit', array('id' => $id)));
        }

        return $this->render('BatnaUserBundle:Group:list.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Group entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('BatnaUserBundle:Group')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Group entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('group'));
    }
    
    public function addRoleAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $group = $em->getRepository('BatnaUserBundle:Group')->find($id);
        $roles = $em->getRepository('BatnaUserBundle:Role')->findAll();
        
        if (!$group) {
            throw $this->createNotFoundException('Unable to find Group entity.');
        }

        $editForm   = $this->createForm(new GroupType(), $group);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();
		$role = $request->get('role');
        
        $group->addRole($role);
        
        $em->persist($group);
        $em->flush();

        return $this->render('BatnaUserBundle:Group:show.html.twig', array(
            'group'      => $group,
            'roles'      => $roles,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    public function removeRoleAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $group = $em->getRepository('BatnaUserBundle:Group')->find($id);
        $roles = $em->getRepository('BatnaUserBundle:Role')->findAll();
        
        if (!$group) {
            throw $this->createNotFoundException('Unable to find Group entity.');
        }

        $editForm   = $this->createForm(new GroupType(), $group);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();
		$role = $request->get('role');
        
        $group->removeRole($role);
        
        $em->persist($group);
        $em->flush();

        return $this->render('BatnaUserBundle:Group:show.html.twig', array(
            'group'      => $group,
            'roles'      => $roles,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
