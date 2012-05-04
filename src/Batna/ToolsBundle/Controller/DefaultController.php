<?php

namespace Batna\ToolsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('BatnaToolsBundle:Default:index.html.twig', array('name' => $name));
    }
}
