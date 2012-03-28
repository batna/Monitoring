<?php

namespace Batna\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Batna\UserBundle\Entity\User;
use Batna\UserBundle\Form\UserType;

/**
 * User controller.
 *
 */
class UserController extends Controller
{
    /**
     * Lists all User entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('BatnaUserBundle:User')->findAll();

        return $this->render('BatnaUserBundle:User:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a User entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $user = $em->getRepository('BatnaUserBundle:User')->find($id);
        $groups = $em->getRepository('BatnaUserBundle:Group')->findAll();
        $roles = $em->getRepository('BatnaUserBundle:Role')->findAll();
        
        if (!$user) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BatnaUserBundle:User:show.html.twig', array(
            'entity'      => $user,
            'delete_form' => $deleteForm->createView(),
            'groups'	  => $groups,
            'roles'	  	  => $roles,
        	'customGroupRoles'=>$this->getCustomGroupRoles($user),
        	'customRoles' =>$this->getCustomRoles($user),

        ));
    }

    /**
     * Displays a form to create a new User entity.
     *
     */
    public function newAction()
    {
        $entity = new User();
        $form   = $this->createForm(new UserType(), $entity);

        return $this->render('BatnaUserBundle:User:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new User entity.
     *
     */
    public function createAction()
    {
        $entity  = new User();
        $request = $this->getRequest();
        $form    = $this->createForm(new UserType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('user_show', array('id' => $entity->getId())));
            
        }

        return $this->render('BatnaUserBundle:User:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing User entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaUserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $editForm = $this->createForm(new UserType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BatnaUserBundle:User:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing User entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaUserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $editForm   = $this->createForm(new UserType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('user_edit', array('id' => $id)));
        }

        return $this->render('BatnaUserBundle:User:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a User entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('BatnaUserBundle:User')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find User entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('user'));
    }
    
    public function addRoleAction($id)
    {
    	
    	$request = $this->getRequest();
    	
    	$id = $request->get('id');
    	$role = $request->get('role');
    	
    	$em = $this->getDoctrine()->getEntityManager();
    	
    	$user = $em->getRepository('BatnaUserBundle:User')->find($id);
    	$groups = $em->getRepository('BatnaUserBundle:Group')->findAll();
    	$roles = $em->getRepository('BatnaUserBundle:Role')->findAll();
    	 
    	if (!$user) {
    		throw $this->createNotFoundException('Unable to find User entity.');
    	}
    	    	
    	$user->addRole($role);
    	
    	$em->persist($user);
    	$em->flush();
    	
    	$deleteForm = $this->createDeleteForm($id);
    	
    	return $this->render('BatnaUserBundle:User:show.html.twig', array(
    			'entity'      => $user,
    			'delete_form'  => $deleteForm->createView(),
    			'groups'	=> $groups,
    			'roles'	=> $roles,
	        	'customGroupRoles'=>$this->getCustomGroupRoles($user),
	        	'customRoles' =>$this->getCustomRoles($user),
    	));/**/
    }
    
    public function addGroupAction($id)
    {
    	 
    	$request = $this->getRequest();
    	 
    	$id = $request->get('id');
    	$group = $request->get('group');
    	
    	$em = $this->getDoctrine()->getEntityManager();
    	 
    	$user = $em->getRepository('BatnaUserBundle:User')->find($id);
		$group = $em->getRepository('BatnaUserBundle:Group')->find($group);
		$groups = $em->getRepository('BatnaUserBundle:Group')->findAll();
		$roles = $em->getRepository('BatnaUserBundle:Role')->findAll();
		 
		
    	if (!$user) {
    		throw $this->createNotFoundException('Unable to find User entity.');
    	}
    	if (!$user) {
    		throw $this->createNotFoundException('Unable to find Group entity.');
    	}
    	
    	$user->addGroup($group);
    	 
    	$em->persist($user);
    	$em->flush();
    	 
    	$deleteForm = $this->createDeleteForm($id);
    	 
    	return $this->render('BatnaUserBundle:User:show.html.twig', array(
    			'entity'      => $user,
    			'delete_form'  => $deleteForm->createView(),
    			'groups'	  => $groups,
    			'roles'	  => $roles,
	        	'customGroupRoles'=>$this->getCustomGroupRoles($user),
	        	'customRoles' =>$this->getCustomRoles($user),
    	));/**/
    }
    
    public function removeGroupAction($id)
    {
    	 
    	$request = $this->getRequest();
    	 
    	$id = $request->get('id');
    	$group = $request->get('group');
    	
    	$em = $this->getDoctrine()->getEntityManager();
    	 
    	$user = $em->getRepository('BatnaUserBundle:User')->find($id);
		$group = $em->getRepository('BatnaUserBundle:Group')->find($group);
		$groups = $em->getRepository('BatnaUserBundle:Group')->findAll();
		$roles = $em->getRepository('BatnaUserBundle:Role')->findAll();
		 
		
    	if (!$user) {
    		throw $this->createNotFoundException('Unable to find User entity.');
    	}
    	if (!$user) {
    		throw $this->createNotFoundException('Unable to find Group entity.');
    	}
    	
    	$user->removeGroup($group);
    	 
    	$em->persist($user);
    	$em->flush();
    	 
    	$deleteForm = $this->createDeleteForm($id);
    	 
    	return $this->render('BatnaUserBundle:User:show.html.twig', array(
    			'entity'      => $user,
    			'delete_form'  => $deleteForm->createView(),
    			'groups'	  => $groups,
    			'roles'	  => $roles,
	        	'customGroupRoles'=>$this->getCustomGroupRoles($user),
	        	'customRoles' =>$this->getCustomRoles($user),
    	));/**/
    }
    
    public function removeRoleAction($id)
    {
    	 
    	$request = $this->getRequest();
    	 
    	$id = $request->get('id');
    	$role = $request->get('role');
    	
    	$em = $this->getDoctrine()->getEntityManager();
    	 
    	$user = $em->getRepository('BatnaUserBundle:User')->find($id);
		$groups = $em->getRepository('BatnaUserBundle:Group')->findAll();
		$roles = $em->getRepository('BatnaUserBundle:Role')->findAll();
		 
		
    	if (!$user) {
    		throw $this->createNotFoundException('Unable to find User entity.');
    	}
    	
    	$user->removeRole($role);
    	 
    	$em->persist($user);
    	$em->flush();
    	 
    	$deleteForm = $this->createDeleteForm($id);
    	 
    	return $this->render('BatnaUserBundle:User:show.html.twig', array(
    			'entity'      => $user,
    			'delete_form'  => $deleteForm->createView(),
    			'groups'	  => $groups,
    			'roles'	  => $roles,
	        	'customGroupRoles'=>$this->getCustomGroupRoles($user),
	        	'customRoles' =>$this->getCustomRoles($user),
    	));/**/
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
    private function getCustomGroupRoles($user)
    {   	
    	$userGroupes = $user->getGroups();
    	$userRoles = $user->getRoles();
    	$userGroupsRoles = array();
    	
    	foreach($userGroupes as $userGroupe)
    	{
    		$groupRoles = $userGroupe->getRoles();
    		foreach($groupRoles as $groupRole)
    		{
    			$userGroupsRoles[] = $groupRole;
    		}
    	}
    	
    	return array_unique($userGroupsRoles);
    }
    
    private function getCustomRoles($user)
    {
		$userGroupsRoles = $this->getCustomGroupRoles($user);
    	$customRoles = array();
    	$userRoles = $user->getRoles();
    	 
    	foreach($userRoles as $userRole)
    	{
    		if(in_array($userRole, $userGroupsRoles))
    		{
    			$customGroupRoles[] = $userRole;
    		}
    		else {
    			$customRoles[] = $userRole;
    		}
    	}
    	
    	return $customRoles;
    }
}



















