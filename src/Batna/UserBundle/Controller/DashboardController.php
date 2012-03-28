<?php

namespace Batna\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DashboardController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('BatnaUserBundle:Dashboard:index.html.twig');
    }
}
