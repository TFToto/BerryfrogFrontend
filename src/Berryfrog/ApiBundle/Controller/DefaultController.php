<?php

namespace Berryfrog\ApiBundle\Controller;

use Berryfrog\ApiBundle\Entity\Api;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
//use FOS\RestBundle\Controller\FOSRestController;

//class DefaultController extends Controller
class DefaultController extends Controller
{
    /**
     * @Route("/webapi")
     */
    public function indexAction()
    {
    	$measurements = $this->getDoctrine()
    		->getRepository('BerryfrogApiBundle:Api')
    		->findAll();
    	
    	return $this->render('BerryfrogApiBundle:Default:index.html.twig', array('result'=>$measurements));
    }
}
