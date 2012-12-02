<?php
/**
* 
*/
class BookingController extends AppController
{
	public $components = array('Session');
	public $uses = array('Airline','Airplane','Airport','Booking','City','Country','DepartAir','Flight','Passenger','Seat');

	public function index()
	{	
		if ($this->request->is('get'))
		{
			$data = $this->Session->read('Booking.Step1');
			$data2 = $this->Session->read('Booking.Step2');
			$data3 = $this->Session->read('Booking.Step3');
			$data4 = $this->Session->read('Booking.Step4');
			$data5 = $this->Session->read('Booking.Step5');
			if (isset($data5)) {
				$this->redirect(array('action' => 'complete'));
			}
			else if (isset($data4))
				$this->redirect(array('action' => 'confirm'));
			else if (isset($data3))
				$this->redirect(array('action' => 'payment'));
			else if (isset($data2))
				$this->redirect(array('action' => 'profile'));
			else if (isset($data)) 
				$this->redirect(array('action' => 'select'));
			$list_cities = $this->City->query('SELECT `id`, `name` FROM `city` AS `City`');
			$cities = array();
			foreach ($list_cities as $city) {
				array_push($cities, $city['City']['name']);
			}
			$this->set(compact('cities'));
		}
		else if ($this->request->is('post')) 
		{
			$data = $this->request->data;
			$data['Flight']['form_city_id']++;
			$data['Flight']['to_city_id']++;
			$this->Session->write('Booking.Step1', $data);
			$this->redirect(array('action' => 'select'));
		}
		
	}

	public function select() 
	{
		if ($this->request->is('get')) {
			$data = $this->Session->read('Booking.Step1');
			$data2 = $this->Session->read('Booking.Step2');
			if (isset($data2)) {
				$this->redirect(array('action' => 'profile'));
			}
			$results = $this->Flight->query(
				'SELECT `id`, `departure_time`, `departure_date`, `arrival_time`, `arrival_date`, `form_city_id`, 
				`to_city_id`, `type`, `price_adult`, `price_kids`, `price_baby` 
				FROM `flight` AS `Flight` 
				WHERE `type` = "'.$data["Flight"]["type"].'" AND `form_city_id` = '.$data["Flight"]["form_city_id"].' AND `to_city_id` = '.$data["Flight"]["to_city_id"]);
			$form_city1 = $this->City->query(
				'SELECT `City`.`id`, `City`.`name`, `City`.`city_code`, `City`.`country_id`, `Country`.`id`, `Country`.`name` 
				FROM `airline_book`.`city` AS `City` 
				LEFT JOIN `airline_book`.`country` AS `Country` 
				ON (`City`.`country_id` = `Country`.`id`) WHERE `City`.`id` = '.$data["Flight"]["form_city_id"]);
			$form_city = $form_city1[0];
			$to_city1 = $this->City->query(
				'SELECT `City`.`id`, `City`.`name`, `City`.`city_code`, `City`.`country_id`, `Country`.`id`, `Country`.`name` 
				FROM `airline_book`.`city` AS `City` 
				LEFT JOIN `airline_book`.`country` AS `Country` 
				ON (`City`.`country_id` = `Country`.`id`) WHERE `City`.`id` = '.$data["Flight"]["to_city_id"]);
			$to_city = $to_city1[0];
			$this->set(compact('data', 'results', 'form_city', 'to_city'));
		}
		else if ($this->request->is('post')) {
			$data = $this->Session->read('Booking.Step1');
			if (isset($data)) {
				$set_data = $this->request->data;
				$this->Session->write('Booking.Step2', $set_data);
				$this->redirect(array('action' => 'profile'));
			} else {
				$this->Session->setFlash();
				$this->redirect(array('action' => ''));
			}
		}
	}

	public function profile()
	{
		$data1 = $this->Session->read('Booking.Step1');
		$data2 = $this->Session->read('Booking.Step2');
		if (!isset($data1) || !isset($data2)) {
			$this->redirect(array('action' => 'reset'));
		}
		if ($this->request->is('post')) {
			$set_data = $this->request->data;
			$this->Session->write('Booking.Step3', $set_data);
			$this->redirect(array('action' => 'payment'));
		}
	}

	public function payment()
	{
		$data1 = $this->Session->read('Booking.Step1');
		$data2 = $this->Session->read('Booking.Step2');
		$data3 = $this->Session->read('Booking.Step3');
		$selected = explode("_", $data2['Flight']['selected']);
		
		$flight_sel1 = $this->Flight->query(
			'SELECT `id`, `departure_time`, `departure_date`, `arrival_time`, `arrival_date`, `form_city_id`, 
			`to_city_id`, `type`, `price_adult`, `price_kids`, `price_baby` 
			FROM `flight` AS `Flight` 
			WHERE `Flight`.`id` = '.$selected[0]);
		$flight_sel = $flight_sel1[0];
		$class_sel = $selected[1];

		$form_city1 = $this->City->query(
			'SELECT `City`.`id`, `City`.`name`, `City`.`city_code`, `City`.`country_id`, `Country`.`id`, `Country`.`name` 
			FROM `airline_book`.`city` AS `City` 
			LEFT JOIN `airline_book`.`country` AS `Country` 
			ON (`City`.`country_id` = `Country`.`id`) WHERE `City`.`id` = '.$data1["Flight"]["form_city_id"]);
		$form_city = $form_city1[0];
		$to_city1 = $this->City->query(
			'SELECT `City`.`id`, `City`.`name`, `City`.`city_code`, `City`.`country_id`, `Country`.`id`, `Country`.`name` 
			FROM `airline_book`.`city` AS `City` 
			LEFT JOIN `airline_book`.`country` AS `Country` 
			ON (`City`.`country_id` = `Country`.`id`) WHERE `City`.`id` = '.$data1["Flight"]["to_city_id"]);
		$to_city = $to_city1[0];

		$form_airport = $this->Airport->query(
			'SELECT `Airport`.`id`, `Airport`.`airportName`, `Airport`.`country_id`, `Airport`.`telephone_Num`, `Country`.`id`, `Country`.`name` 
			FROM `airline_book`.`airport` AS `Airport` LEFT JOIN `airline_book`.`country` AS `Country` 
			ON (`Airport`.`country_id` = `Country`.`id`) 
			WHERE `Airport`.`country_id` = '.$form_city['City']['country_id']);
		$to_airport = $this->Airport->query(
			'SELECT `Airport`.`id`, `Airport`.`airportName`, `Airport`.`country_id`, `Airport`.`telephone_Num`, `Country`.`id`, `Country`.`name` 
			FROM `airline_book`.`airport` AS `Airport` LEFT JOIN `airline_book`.`country` AS `Country` 
			ON (`Airport`.`country_id` = `Country`.`id`) 
			WHERE `Airport`.`country_id` = '.$to_city['City']['country_id']);
		
		$to_rand_no = rand(0,count($to_airport) - 1);

		$this->set(compact('data1', 'data2', 'data3','form_city','to_city',
			'flight_sel', 'class_sel', 'price_sel', 'form_airport', 'to_airport', 'to_rand_no'));
		if (!isset($data1) || !isset($data2) || !isset($data3)) {
			$this->redirect(array('action' => 'reset'));
		}
		if ($this->request->is('post')) {
			$set_data = $this->request->data;
			$this->Session->write('Booking.Step4', $set_data);
			$this->redirect(array('action' => 'confirm'));
		}
	}

	public function confirm()
	{
		$data1 = $this->Session->read('Booking.Step1');
		$data2 = $this->Session->read('Booking.Step2');
		$data3 = $this->Session->read('Booking.Step3');
		$data4 = $this->Session->read('Booking.Step4');
		$selected = explode("_", $data2['Flight']['selected']);
		
		$flight_sel1 = $this->Flight->query(
			'SELECT `id`, `departure_time`, `departure_date`, `arrival_time`, `arrival_date`, `form_city_id`, 
			`to_city_id`, `type`, `price_adult`, `price_kids`, `price_baby` 
			FROM `flight` AS `Flight` 
			WHERE `Flight`.`id` = '.$selected[0]);
		$flight_sel = $flight_sel1[0];
		$class_sel = $selected[1];

		$form_city1 = $this->City->query(
			'SELECT `City`.`id`, `City`.`name`, `City`.`city_code`, `City`.`country_id`, `Country`.`id`, `Country`.`name` 
			FROM `airline_book`.`city` AS `City` 
			LEFT JOIN `airline_book`.`country` AS `Country` 
			ON (`City`.`country_id` = `Country`.`id`) WHERE `City`.`id` = '.$data1["Flight"]["form_city_id"]);
		$form_city = $form_city1[0];
		$to_city1 = $this->City->query(
			'SELECT `City`.`id`, `City`.`name`, `City`.`city_code`, `City`.`country_id`, `Country`.`id`, `Country`.`name` 
			FROM `airline_book`.`city` AS `City` 
			LEFT JOIN `airline_book`.`country` AS `Country` 
			ON (`City`.`country_id` = `Country`.`id`) WHERE `City`.`id` = '.$data1["Flight"]["to_city_id"]);
		$to_city = $to_city1[0];

		$form_airport = $this->Airport->query(
			'SELECT `Airport`.`id`, `Airport`.`airportName`, `Airport`.`country_id`, `Airport`.`telephone_Num`, `Country`.`id`, `Country`.`name` 
			FROM `airline_book`.`airport` AS `Airport` LEFT JOIN `airline_book`.`country` AS `Country` 
			ON (`Airport`.`country_id` = `Country`.`id`) 
			WHERE `Airport`.`country_id` = '.$form_city['City']['country_id']);
		$to_airport = $this->Airport->query(
			'SELECT `Airport`.`id`, `Airport`.`airportName`, `Airport`.`country_id`, `Airport`.`telephone_Num`, `Country`.`id`, `Country`.`name` 
			FROM `airline_book`.`airport` AS `Airport` LEFT JOIN `airline_book`.`country` AS `Country` 
			ON (`Airport`.`country_id` = `Country`.`id`) 
			WHERE `Airport`.`country_id` = '.$to_city['City']['country_id']);

		$this->set(compact('data1', 'data2', 'data3', 'data4','form_city','to_city',
			'flight_sel', 'class_sel', 'price_sel', 'form_airport', 'to_airport', 'to_rand_no'));
		if (!isset($data1) || !isset($data2) || !isset($data3) || !isset($data4)) {
			$this->redirect(array('action' => 'reset'));
		}
		if ($this->request->is('post')) {
			$this->Passenger->query(
				'INSERT INTO `passenger` (`name`, `sex`, `passTel_num`, `email`, `age`) 
				VALUES ("'.$data3['Passenger']['name'].'", "'.$data3['Passenger']['sex'].'", '.
					$data3['Passenger']['passTel_num'].', "'.$data3['Passenger']['email'].'",'.
					$data3['Passenger']['age'].')');
			$last_obj = $this->Passenger->query(
				'SELECT `id` 
				FROM `passenger` AS `Passenger` 
				WHERE `id` 
				ORDER BY `id` DESC 
				LIMIT 1');
			$last_insert_id = $last_obj[0]['Passenger']['id'];
			$booking_data = array();
			$booking_data['Booking']['passenger_id'] = $last_insert_id;
			$booking_data['Booking']['flight_id'] = $flight_sel['Flight']['id'];
			$booking_data['Booking']['adult_count'] = $data1['Booking']['adult_count'];
			$booking_data['Booking']['kids_count'] = $data1['Booking']['kids_count'];
			$booking_data['Booking']['baby_count'] = $data1['Booking']['baby_count'];
			$booking_data['Booking']['seat_type'] = $class_sel;
			$booking_data['Booking']['payment_method'] = $data4['Payment']['method'];
			$booking_data['Booking']['credit_no'] = $data4['Payment']['credit_no'];
			$booking_data['Booking']['paypal_email'] = $data4['Payment']['paypal_email'];
			$booking_data['Booking']['total_price'] = $data4['Payment']['total_payment'];
			debug($booking_data);
			$this->Booking->query(
				'INSERT INTO `booking` (`passenger_id`, `flight_id`, `adult_count`, `kids_count`, `baby_count`, `seat_type`, `payment_method`, `credit_no`, `paypal_email`, `total_price`) 
				VALUES ('.$booking_data['Booking']['passenger_id'].','.$booking_data['Booking']['flight_id'].','.$booking_data['Booking']['adult_count'].','.$booking_data['Booking']['kids_count'].','.
					$booking_data['Booking']['baby_count'].', "'.$booking_data['Booking']['seat_type'].'", "'.$booking_data['Booking']['payment_method'].'", "'.$booking_data['Booking']['credit_no'].'", "'.
					$booking_data['Booking']['paypal_email'].'", '.$booking_data['Booking']['total_price'].')');

			$this->Session->write('Booking.Step5', 'ok');
			$this->redirect(array('action' => 'complete'));
		}
	}


	public function complete()
	{
		$data1 = $this->Session->read('Booking.Step1');
		$data2 = $this->Session->read('Booking.Step2');
		$data3 = $this->Session->read('Booking.Step3');
		$data4 = $this->Session->read('Booking.Step4');
		if ($this->request->is('post') || (!isset($data1) || !isset($data2) || !isset($data3) || !isset($data4))) {
			$this->redirect(array('action' => 'reset'));
		}
	}

	public function reset()
	{
		$this->Session->delete('Booking');
		$this->redirect(array('action' => 'index'));
	}

}