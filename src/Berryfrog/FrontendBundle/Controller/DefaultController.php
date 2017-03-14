<?php
/**
 * @package     Berryfrog
 * @subpackage  controller
 *
 * @copyright Copyright (C) 2016-2017 by teglo. All rights reserved.
 * @license https://github.com/TFToto/BerryfrogFrontend/blob/master/LICENSE
 */

namespace Berryfrog\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
    	return $this->render('default/index.html.twig', array(
    			'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
    	));
    }
}
