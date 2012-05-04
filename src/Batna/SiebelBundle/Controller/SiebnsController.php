<?php

namespace Batna\SiebelBundle\Controller;

use Batna\SiebelBundle\Entity\Siebns;
use Batna\SiebelBundle\Entity\Gateway;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * Server controller.
 *
 */
class SiebnsController extends Controller
{
    public function indexAction($id)
    {
    	if(is_numeric($id))
    	{
    		$contenu = 'Traitage de la gateway dont l\'ID est : '.$id;
    		$em = $this->getDoctrine()->getEntityManager();
	    	$gateway = $em->getRepository('BatnaSiebelBundle:Gateway')->find($id);
	    	
	    	if ($gateway) {
	    		
	    		if(file_exists($gateway->getCurrentFile()->getPath()))
	    		{
	    			$siebns = new Siebns();
	    			$siebns->setGateway($gateway);
	    			$siebns->setFile($gateway->getCurrentFile()->getPath());
	    			$contenu = $siebns->execute($this->getDoctrine()->getEntityManager());
	    			    				
	    		}else{$contenu = 'La gateway indiquée ne pointe pas sur un fichier siebns valide : '.$gateway->getCurrentFile()->getPath();}
	    	}else{$contenu = 'Il n\'y a pas de gateway ayant l\'ID '.$id;}
    	}else{$contenu = 'l\'identifiant de gateways que vous avez saisi n\'est pas numerique, il ne peut donc pas etre traité';}
    	
        return $this->render('BatnaSiebelBundle:Siebns:index.html.twig', array(
            'contenu' => $contenu,
        ));
    }
    
    public function indexDefaultAction()
    {
    	return $this->render('BatnaSiebelBundle:Siebns:index.html.twig', array(
    			'contenu' => 'Vous devriez essayer en mettant un ID dans l\'adresse de la page'
    	));
	}

}
