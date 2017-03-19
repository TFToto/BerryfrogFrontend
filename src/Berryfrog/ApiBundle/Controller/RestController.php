<?php

namespace Berryfrog\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RestController extends Controller {

	/**
	 * db object
	 */
	private $_repository;

	public function getMeasurementAction($type) {
		
		$this->_repository = $this->getDoctrine()->getRepository('BerryfrogApiBundle:Api');
		
		switch ($type) {
			case 'currentvalues':
				$return = $this->_getCurrentValues();
				break;
			case 'datetimerange';
				$return = $this->_getRangeValues();
				break;
			case 'last24hours';
				$return = $this->_getlast24Hours();
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
		
		$db = $this->_repository->createQueryBuilder('m')
			->setMaxResults(1)
			->orderBy('m.id','desc');
		
		return $db->getQuery()->getSingleResult();
		
	}
	/**
	 * Method for to get the last 24 hours of values from sensor
	 *
	 * @return array one db object result
	 */
	private function _getlast24Hours() {
		
		$date = date('Y-m-d H:i:s', strtotime('-24 hour'));
		$db = $this->_repository->createQueryBuilder('r')
			->where('r.addDatetime > :date')
			->setParameter('date', $date)
			->orderBy('r.addDatetime','asc');	
	
	
		return $db->getQuery()->getResult();
	
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
	
		$db = $this->_repository->createQueryBuilder('s')
			->select('s.transmitterId')
			->groupBy('s.transmitterId');
		
		return $db->getQuery()->getResult();
	
	}
}