<?php

namespace Batna\ArchiBundle\Controller;
use Batna\ArchiBundle\Entity\ValVarEnvironnement;
use Batna\ArchiBundle\Entity\ValVarContexte;
use Batna\ArchiBundle\Entity\Environnement;
use Batna\ArchiBundle\Entity\Contexte;
use Batna\ArchiBundle\Entity\Variable;
use Batna\ArchiBundle\Form\VariableType;
use Batna\ArchiBundle\Form\ValueType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Variable controller.
 *
 */
class VariableController extends Controller {

	/**
	 * Finds and displays a Variable entity.
	 *
	 */
	public function showEnvAction($id) {
		$em = $this->getDoctrine()->getEntityManager();

		$entity = $em->getRepository('BatnaArchiBundle:Variable')->find($id);
		$entities = $em->getRepository('BatnaArchiBundle:Environnement')
				->findAll();

		if (!$entity) {
			throw $this
					->createNotFoundException('Unable to find Variable entity.');
		}

		$deleteForm = $this->createDeleteForm($id);

		return $this
				->render('BatnaArchiBundle:Variable:showEnv.html.twig',
						array('entity' => $entity, 'entities' => $entities,
								'delete_form' => $deleteForm->createView(),
						));
	}

	/**
	 * Displays a form to create a new Variable entity.
	 *
	 */
	public function newEnvAction() {
		$em = $this->getDoctrine()->getEntityManager();

		$entities = $em->getRepository('BatnaArchiBundle:Environnement')
				->findAll();

		$entity = new Variable();
		$form = $this->createForm(new VariableType(), $entity);

		return $this
				->render('BatnaArchiBundle:Variable:newEnv.html.twig',
						array('entities' => $entities, 'entity' => $entity,
								'form' => $form->createView()));
	}

	/**
	 * Creates a new Variable entity.
	 *
	 */
	public function createEnvAction() {
		$entity = new Variable();
		$request = $this->getRequest();
		$form = $this->createForm(new VariableType(), $entity);
		$form->bindRequest($request);

		$entity->setType('environnement');

		$em = $this->getDoctrine()->getEntityManager();
		$entities = $em->getRepository('BatnaArchiBundle:Environnement')
				->findAll();

		if ($form->isValid()) {
			$em = $this->getDoctrine()->getEntityManager();
			$em->persist($entity);
			$em->flush();

			return $this
					->redirect(
							$this
									->generateUrl('varEnv_show',
											array('id' => $entity->getId())));

		}

		return $this
				->render('BatnaArchiBundle:Environnement:index.html.twig',
						array('entities' => $entities, 'entity' => $entity,
								'form' => $form->createView()));
	}

	/**
	 * Displays a form to edit an existing Variable entity.
	 *
	 */
	public function editEnvAction($id) {
		$em = $this->getDoctrine()->getEntityManager();

		$entities = $em->getRepository('BatnaArchiBundle:Environnement')
				->findAll();
		$entity = $em->getRepository('BatnaArchiBundle:Variable')->find($id);

		if (!$entity) {
			throw $this
					->createNotFoundException('Unable to find Variable entity.');
		}

		$editForm = $this->createForm(new VariableType(), $entity);
		$deleteForm = $this->createDeleteForm($id);

		return $this
				->render('BatnaArchiBundle:Variable:editEnv.html.twig',
						array('entities' => $entities,
								'entity' => $entity,
								'edit_form' => $editForm->createView(),
								'delete_form' => $deleteForm->createView(),));
	}

	/**
	 * Edits an existing Variable entity.
	 *
	 */
	public function updateEnvAction($id) {
		$em = $this->getDoctrine()->getEntityManager();

		$entity = $em->getRepository('BatnaArchiBundle:Variable')->find($id);

		if (!$entity) {
			throw $this
					->createNotFoundException('Unable to find Variable entity.');
		}

		$editForm = $this->createForm(new VariableType(), $entity);
		$deleteForm = $this->createDeleteForm($id);

		$request = $this->getRequest();

		$editForm->bindRequest($request);

		if ($editForm->isValid()) {
			$em->persist($entity);
			$em->flush();

			$this->get('session')
					->setFlash('success', 'Modification prise en compte');

			return $this
					->redirect(
							$this
									->generateUrl('varEnv_edit',
											array('id' => $id)));
		}

		return $this
				->render('BatnaArchiBundle:Variable:editEnv.html.twig',
						array('entity' => $entity,
								'edit_form' => $editForm->createView(),
								'delete_form' => $deleteForm->createView(),));
	}

	/**
	 * Deletes a Variable entity.
	 *
	 */
	public function deleteEnvAction($id) {
		$form = $this->createDeleteForm($id);
		$request = $this->getRequest();

		$form->bindRequest($request);

		if ($form->isValid()) {
			$em = $this->getDoctrine()->getEntityManager();
			$entity = $em->getRepository('BatnaArchiBundle:Variable')
					->find($id);

			if (!$entity) {
				throw $this
						->createNotFoundException(
								'Unable to find Variable entity.');
			}

			$em->remove($entity);
			$em->flush();
		}

		return $this->redirect($this->generateUrl('env'));
	}

	/**
	 * Finds and displays a Variable entity.
	 *
	 */
	public function showConAction($id) {
		$em = $this->getDoctrine()->getEntityManager();

		$entity = $em->getRepository('BatnaArchiBundle:Variable')->find($id);
		$entities = $em->getRepository('BatnaArchiBundle:Contexte')->findAll();

		if (!$entity) {
			throw $this
					->createNotFoundException('Unable to find Variable entity.');
		}

		$deleteForm = $this->createDeleteForm($id);

		return $this
				->render('BatnaArchiBundle:Variable:showCon.html.twig',
						array('entity' => $entity, 'entities' => $entities,
								'delete_form' => $deleteForm->createView(),
						));
	}

	/**
	 * Displays a form to create a new Variable entity.
	 *
	 */
	public function newConAction() {
		$em = $this->getDoctrine()->getEntityManager();

		$entities = $em->getRepository('BatnaArchiBundle:Contexte')->findAll();

		$entity = new Variable();
		$form = $this->createForm(new VariableType(), $entity);

		return $this
				->render('BatnaArchiBundle:Variable:newCon.html.twig',
						array('entities' => $entities, 'entity' => $entity,
								'form' => $form->createView()));
	}/**/

	/**
	 * Creates a new Variable entity.
	 *
	 */
	public function createConAction() {
		$entity = new Variable();
		$request = $this->getRequest();
		$form = $this->createForm(new VariableType(), $entity);
		$form->bindRequest($request);

		$entity->setType('contexte');

		$em = $this->getDoctrine()->getEntityManager();
		$entities = $em->getRepository('BatnaArchiBundle:Contexte')->findAll();

		if ($form->isValid()) {
			$em = $this->getDoctrine()->getEntityManager();
			$em->persist($entity);
			$em->flush();

			return $this
					->redirect(
							$this
									->generateUrl('varCon_show',
											array('id' => $entity->getId())));

		}

		return $this
				->render('BatnaArchiBundle:Contexte:index.html.twig',
						array('entities' => $entities, 'entity' => $entity,
								'form' => $form->createView()));
	}

	/**
	 * Displays a form to edit an existing Variable entity.
	 *
	 */
	public function editConAction($id) {
		$em = $this->getDoctrine()->getEntityManager();

		$entities = $em->getRepository('BatnaArchiBundle:Contexte')->findAll();
		$entity = $em->getRepository('BatnaArchiBundle:Variable')->find($id);

		if (!$entity) {
			throw $this
					->createNotFoundException('Unable to find Variable entity.');
		}

		$editForm = $this->createForm(new VariableType(), $entity);
		$deleteForm = $this->createDeleteForm($id);

		return $this
				->render('BatnaArchiBundle:Variable:editCon.html.twig',
						array('entities' => $entities,
								'entity' => $entity,
								'edit_form' => $editForm->createView(),
								'delete_form' => $deleteForm->createView(),));
	}

	/**
	 * Edits an existing Variable entity.
	 *
	 */
	public function updateConAction($id) {
		$em = $this->getDoctrine()->getEntityManager();

		$entity = $em->getRepository('BatnaArchiBundle:Variable')->find($id);

		if (!$entity) {
			throw $this
					->createNotFoundException('Unable to find Variable entity.');
		}

		$editForm = $this->createForm(new VariableType(), $entity);
		$deleteForm = $this->createDeleteForm($id);

		$request = $this->getRequest();

		$editForm->bindRequest($request);

		if ($editForm->isValid()) {
			$em->persist($entity);
			$em->flush();

			$this->get('session')
					->setFlash('success', 'Modification prise en compte');

			return $this
					->redirect(
							$this
									->generateUrl('varCon_edit',
											array('id' => $id)));
		}

		return $this
				->render('BatnaArchiBundle:Variable:editCon.html.twig',
						array('entity' => $entity,
								'edit_form' => $editForm->createView(),
								'delete_form' => $deleteForm->createView(),));
	}

	/**
	 * Deletes a Variable entity.
	 *
	 */
	public function deleteConAction($id) {
		$form = $this->createDeleteForm($id);
		$request = $this->getRequest();

		$form->bindRequest($request);

		if ($form->isValid()) {
			$em = $this->getDoctrine()->getEntityManager();
			$entity = $em->getRepository('BatnaArchiBundle:Variable')->find($id);

			if (!$entity) {throw $this->createNotFoundException('Unable to find Variable entity.');}

			$em->remove($entity);
			$em->flush();
		}

		return $this->redirect($this->generateUrl('ctxt'));
	}

	private function createDeleteForm($id) {
		return $this->createFormBuilder(array('id' => $id))
				->add('id', 'hidden')->getForm();
	}

	/**
	 * Displays a form to edit an existing Value of Variable entity for a specific environnement.
	 *
	 */
	public function editValEnvAction($env, $var) {
		$em = $this->getDoctrine()->getEntityManager();

		$env = $em->getRepository('BatnaArchiBundle:Environnement')->find($env);
		$var = $em->getRepository('BatnaArchiBundle:Variable')->find($var);
		$val = $em->getRepository('BatnaArchiBundle:ValVarEnvironnement')
				->findOneBy(array('environnement'=>$env->getId(), 'variable'=>$var->getId()));
				
		if (!$env) {throw $this->createNotFoundException('Unable to find Environnement entity.');}
		if (!$var) {throw $this->createNotFoundException('Unable to find Variable entity.');}
		if (!$val) {
			$val = new ValVarEnvironnement();
			$val->setEnvironnement($env);
			$val->setVariable($var);
		}

		$editForm = $this->createForm(new ValueType(), $val);
		
		$deleteForm = $this->createDeleteForm($val);

		return $this
				->render('BatnaArchiBundle:Variable:editValEnv.html.twig',
						array('entity' => $env,
								'env' => $env,
								'var' => $var,
								'val' => $val,
								'edit_form' => $editForm->createView(),
								'delete_form' => $deleteForm->createView(),));
	}

	/**
	 * Edits an existing Variable entity.
	 *
	 */
	public function updateValEnvAction($env, $var) {
		$em = $this->getDoctrine()->getEntityManager();
		$request = $this->getRequest();
		
		$env = $em->getRepository('BatnaArchiBundle:Environnement')->find($env);
		
		$var = $em->getRepository('BatnaArchiBundle:Variable')
						->find($var);
		
		$envs= $em->getRepository('BatnaArchiBundle:Environnement')
						->findAll();
		
		$val = $em->getRepository('BatnaArchiBundle:ValVarEnvironnement')
						->findOneBy(array('environnement'=>$env->getId(), 'variable'=>$var->getId()));
		
		if (!$env) {throw $this->createNotFoundException('Unable to find Environnement entity.');}
		if (!$var) {throw $this->createNotFoundException('Unable to find Variable entity.');}
		if (!$val) {
		    $val = new ValVarEnvironnement();
		    $val->setEnvironnement($env);
		    $val->setVariable($var);
		}
		
		$editForm = $this->createForm(new ValueType(), $val);
		$deleteForm = $this->createDeleteForm($val);
		
		$editForm->bindRequest($request);
		
		$att = $request->request->get('batna_archibundle_valuetype');
		$valeur = $att['value'];
		
		$val->setValue($valeur);
		
		if ($editForm->isValid()) {
		    $em->persist($val);
		    $em->flush();
		
		    $this->get('session')->setFlash('success', 'Modification prise en compte');
		
		    return $this->redirect($this->generateUrl('varValEnv_edit', array('env' => $env->getId(), 'var'=>$var->getId())));
		}
		
		return $this
				->render('BatnaArchiBundle:Variable:editEnv.html.twig',
						array('entity' => $env, 'entities' => $envs,
								'edit_form' => $editForm->createView(),
								'delete_form' => $deleteForm->createView(),));
	}

	/**
	 * Displays a form to edit an existing Value of Variable entity for a specific context.
	 *
	 */
	public function editValConAction($con, $var) {
		$em = $this->getDoctrine()->getEntityManager();

		$con = $em->getRepository('BatnaArchiBundle:Contexte')->find($con);
		$var = $em->getRepository('BatnaArchiBundle:Variable')->find($var);
		$val = $em->getRepository('BatnaArchiBundle:ValVarContexte')
				->findOneBy(array('contexte'=>$con->getId(), 'variable'=>$var->getId()));
				
		if (!$con) {throw $this->createNotFoundException('Unable to find Contexte entity.');}
		if (!$var) {throw $this->createNotFoundException('Unable to find Variable entity.');}
		if (!$val) {
			$val = new ValVarContexte();
			$val->setContexte($con);
			$val->setVariable($var);
		}

		$editForm = $this->createForm(new ValueType(), $val);
		
		$deleteForm = $this->createDeleteForm($val);

		return $this
				->render('BatnaArchiBundle:Variable:editValCon.html.twig',
						array('entity' => $con,
								'con' => $con,
								'var' => $var,
								'val' => $val,
								'edit_form' => $editForm->createView(),
								'delete_form' => $deleteForm->createView(),));
	}

	/**
	 * Edits an existing Variable entity.
	 *
	 */
	public function updateValConAction($con, $var) {
		$em = $this->getDoctrine()->getEntityManager();
		$request = $this->getRequest();
		
		$con = $em->getRepository('BatnaArchiBundle:Contexte')->find($con);
		
		$var = $em->getRepository('BatnaArchiBundle:Variable')
						->find($var);
		
		$cons= $em->getRepository('BatnaArchiBundle:Contexte')
						->findAll();
		
		$val = $em->getRepository('BatnaArchiBundle:ValVarContexte')
						->findOneBy(array('contexte'=>$con->getId(), 'variable'=>$var->getId()));
		
		if (!$con) {throw $this->createNotFoundException('Unable to find Contexte entity.');}
		if (!$var) {throw $this->createNotFoundException('Unable to find Variable entity.');}
		if (!$val) {
		    $val = new ValVarContexte();
		    $val->setContexte($con);
		    $val->setVariable($var);
		}
		
		$editForm = $this->createForm(new ValueType(), $val);
		$deleteForm = $this->createDeleteForm($val);
		
		$editForm->bindRequest($request);
		
		$att = $request->request->get('batna_archibundle_valuetype');
		$valeur = $att['value'];
		
		$val->setValue($valeur);
		
		if ($editForm->isValid()) {
		    $em->persist($val);
		    $em->flush();
		
		    $this->get('session')->setFlash('success', 'Modification prise en compte');
		
		    return $this->redirect($this->generateUrl('varValCon_edit', array('con' => $con->getId(), 'var'=>$var->getId())));
		}
		
		return $this
				->render('BatnaArchiBundle:Variable:editCon.html.twig',
						array('entity' => $con, 'entities' => $cons,
								'edit_form' => $editForm->createView(),
								'delete_form' => $deleteForm->createView(),));
	}
}
