<?php

namespace Batna\SiebelBundle\Controller;

use Batna\ToolsBundle\Entity\DocumentRepository;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Batna\SiebelBundle\Entity\Gateway;
use Batna\ToolsBundle\Entity\Document;
use Batna\SiebelBundle\Form\GatewayType;

/**
 * Gateway controller.
 *
 */
class GatewayController extends Controller
{
    /**
     * Lists all Gateway entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('BatnaSiebelBundle:Gateway')->findAll();

        return $this->render('BatnaSiebelBundle:Gateway:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Gateway entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaSiebelBundle:Gateway')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Gateway entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BatnaSiebelBundle:Gateway:show.html.twig', array(
            'entity'      => $entity,
        	//'configurations'=>$configurations,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Gateway entity.
     *
     */
    public function newAction()
    {
        $entity = new Gateway();
        $form   = $this->createForm(new GatewayType(), $entity);

        return $this->render('BatnaSiebelBundle:Gateway:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Gateway entity.
     *
     */
    public function createAction()
    {
        $entity  = new Gateway();
        $request = $this->getRequest();
        $form    = $this->createForm(new GatewayType(), $entity);
        $form->bindRequest($request);
        
                
        $file = $form['currentFile'];
        
        //var_dump($file);
        $dir = '/home/sentenza/workspace/Monitoring/web/upload/archi/gateways/';
         
        $new_filename = 'siebns'.$entity->getName().'.'.date('Ymd', filemtime($file->getData())).'.'.md5($file->getData()).'.dat';
        
        //echo (is_file($file->getData()))?'Le fichier est réel : '.$dir.$new_filename:'Le fichier est faux : '.$dir.$new_filename;
        
        //echo $dir.$new_filename;
        
        
        if ($form->isValid()) {
        	echo '*** on est valide ***';
        	
        	$form['currentFile']->getData()->move($dir, $new_filename);
        	
        	//echo '*** '.$form['currentFile']->getClientOriginalName().' ***';
        	
        	
        	$doc = new Document();
        	$doc->setName($new_filename);
        	$doc->setClientFileName($file->getName());
        	$doc->setPath($dir);
        	
        	$entity->setCurrentFile($dir.$new_filename);
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($doc);
            $entity->setCurrentFile($doc);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('gtw_show', array('id' => $entity->getId())));
            
        }

        return $this->render('BatnaSiebelBundle:Gateway:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Gateway entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaSiebelBundle:Gateway')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Gateway entity.');
        }

        $editForm = $this->createForm(new GatewayType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BatnaSiebelBundle:Gateway:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Gateway entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BatnaSiebelBundle:Gateway')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Gateway entity.');
        }

        $editForm   = $this->createForm(new GatewayType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('gtw_edit', array('id' => $id)));
        }

        return $this->render('BatnaSiebelBundle:Gateway:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Gateway entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('BatnaSiebelBundle:Gateway')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Gateway entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('gtw'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
