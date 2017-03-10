<?php

namespace Berryfrog\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RestController extends Controller {

	/**
	 * db object
	 */
	private $_repository;
	
	public function getMeasurementAction($param){

		$this->_repository = $this->getDoctrine()->getRepository('BerryfrogApiBundle:Api');
		
		switch ($param) {
			case 'currentvalues':
				$return = $this->_getCurrentValues();
				break;
			default:
				$return = null;
		}
		
		//$user = $this->getDoctrine()->getRepository('BerryfrogApiBundle:Api')->findAll();
		
		return $return;
	}
	
	private function _getCurrentValues() {
		
		$db = $this->_repository->createQueryBuilder('m');
		$db->setMaxResults(1);
		$db->orderBy('m.id','desc');
		
		return $db->getQuery()->getSingleResult();
		
	}
}