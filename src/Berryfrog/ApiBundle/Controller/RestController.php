<?php

namespace Berryfrog\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RestController extends Controller {

	/**
	 * db object
	 */
	private $_repository;
	
	public function getMeasurementAction($type,$filter,$filtervalue){

		$this->_repository = $this->getDoctrine()->getRepository('BerryfrogApiBundle:Api');
		
		switch ($type) {
			case 'currentvalues':
				$return = $this->_getCurrentValues();
				break;
			case 'datetimerange';
				$return = $this->_getRangeValues($filter,$filtervalue);
				break;
			case 'sensors';
				$return = $this->_getSensorIds();
				break;
			default:
				$return = null;
				break;
		}
		
		return $return;
	}
	/**
	 * Method for to get current values from sensor
	 * 
	 * @return array one db object result
	 */
	private function _getCurrentValues() {
		
		$db = $this->_repository->createQueryBuilder('m');
		$db->setMaxResults(1);
		$db->orderBy('m.id','desc');
		
		return $db->getQuery()->getSingleResult();
		
	}
	
	/**
	 * Method for to get a range of values from sensor
	 *
	 * @return array one db object result
	 */
	private function _getRangeValues() {
	
		$db = $this->_repository->createQueryBuilder('r')
			->where('r.addDatetime > :date')
			->setParameter('date', '2017-03-14 20:59:34')
			->orderBy('r.addDatetime','desc');
	
		return $db->getQuery()->getResult();
	
	}
	/**
	 * Method for to get a range of values from sensor
	 *
	 * @return array one db object result
	 */
	private function _getSensorIds() {
	
		$db = $this->_repository->createQueryBuilder('s');
		$db->select('s.transmitterId');
		$db->groupBy('s.transmitterId');
		
		return $db->getQuery()->getResult();
	
	}
}