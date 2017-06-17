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
			case 'datetimerange':
				$return = $this->_getRangeValues();
				break;
			case 'last24hours':
				$return = $this->_getlast24Hours();
				break;
			case 'last7days':
				$return = $this->_getlastXDays(7);
				break;
			case 'last30days':
				$return = $this->_getlastXDays(30);
				break;
			case 'sensors':
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
	 * Method for to get the last 7 days of values from sensor
	 *
	 * @return array one db object result
	 */
	private function _getlastXDays($days) {
		
		//$logger = $this->get('logger');
		//$logger->info('We just go the logger');
		
		$result = array();
		$day_i = $days;

		for ($i = 1; $i <= $days; $i++) { 
			
			$db = $this->_repository->createQueryBuilder('r');
			$db->select('
				min(r.tempDhtHic) as mintemp_dht_hic,
				max(r.tempDhtHic) as maxtemp_dht_hic,
				avg(r.tempDhtHic) as avgtemp_dht_hic,
				min(r.tempDhtHif) as mintemp_dht_hif,
				max(r.tempDhtHif) as maxtemp_dht_hif,
				avg(r.tempDhtHif) as avgtemp_dht_hif,
				min(r.humidityDht) as minhumidity_dht,
				max(r.humidityDht) as maxhumidity_dht,
				avg(r.humidityDht) as avghumidity_dht,
				min(r.pressureBmp) as minpressure_bmp,
				max(r.pressureBmp) as maxpressure_bmp,
				avg(r.pressureBmp) as avgpressure_bmp,
				min(r.tempBmp) as mintemp_bmp,
				max(r.tempBmp) as maxtemp_bmp,
				avg(r.tempBmp) as avgtemp_bmp,
				min(r.addDatetime) as mindatetime,
				max(r.addDatetime) as maxdatetime
			');

			$greater_date = date('Y-m-d 00:00:00', strtotime('-'.$day_i.' day'));
			$less_date = date('Y-m-d 23:59:59', strtotime('-'.$day_i.' day'));
				
			$db->setParameter('greaterdate', $greater_date);
			$db->setParameter('lessdate', $less_date);
			$db->where('r.addDatetime < :lessdate AND r.addDatetime > :greaterdate');
			
			$db->orderBy('r.addDatetime','asc');
			
			//$logger->debug('datas'.print_r($db->getQuery()->getResult(),true));
			
			$data = $db->getQuery()->getResult();
			
			if($data[0]['maxtemp_dht_hic'] > 60 || $data[0]['maxtemp_bmp'] > 60) {
				//continue;
			}
			
			if($data[0]['mintemp_dht_hic'] < -50 || $data[0]['mintemp_bmp'] < -50) {
				continue;
			}
			$datas = array(
				'mintemp_dht_hic' => number_format($data[0]['mintemp_dht_hic'],2),
				'maxtemp_dht_hic' => number_format($data[0]['maxtemp_dht_hic'],2),
				'avgtemp_dht_hic' => number_format($data[0]['avgtemp_dht_hic'],2),
				'mintemp_dht_hif' => number_format($data[0]['mintemp_dht_hif'],2),
				'maxtemp_dht_hif' => number_format($data[0]['maxtemp_dht_hif'],2),
				'avgtemp_dht_hif' => number_format($data[0]['avgtemp_dht_hif'],2),
				'minhumidity_dht' => number_format($data[0]['minhumidity_dht'],2),
				'maxhumidity_dht' => number_format($data[0]['maxhumidity_dht'],2),
				'avghumidity_dht' => number_format($data[0]['avghumidity_dht'],2),
				'minpressure_bmp' => number_format($data[0]['minpressure_bmp'],2),
				'maxpressure_bmp' => number_format($data[0]['maxpressure_bmp'],2),
				'avgpressure_bmp' => number_format($data[0]['avgpressure_bmp'],2),
				'mintemp_bmp' => number_format($data[0]['mintemp_bmp'],2),
				'maxtemp_bmp' => number_format($data[0]['maxtemp_bmp'],2),
				'avgtemp_bmp' => number_format($data[0]['avgtemp_bmp'],2),
				'datetime_from' => $data[0]['mindatetime'],
				'datetime_to' => $data[0]['maxdatetime'],
				'dateday' => date("d.m.", strtotime($data[0]['mindatetime']))
			);

			//Return only valid temperatures in range of -50 to +60 °C
			if(
				number_format($data[0]['maxtemp_dht_hic'],2) < 60 && 
				number_format($data[0]['maxtemp_bmp'],2) < 60 && 
				number_format($data[0]['maxtemp_dht_hic'],2) > -50 && 
				number_format($data[0]['maxtemp_bmp'],2) > -50
			) {
				array_push($result,$datas);
			}

			$day_i = $day_i -1;

		}

		return $result;
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