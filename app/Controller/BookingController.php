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
			if (isset($data)) 
			{
				$this->redirect(array('action' => 'select'));
			}
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
			debug($data);
			$result = $this->Flight->findAllByTypeAndFromcityIdAndTocityId($data['Flight']['type'], $data['Flight']['form_city_id'], $data['Flight']['to_city_id']);
			debug($result);
		}
		else if ($this->request->is('post')){

		}

	}

	public function profile()
	{
		
	}

	public function confirm()
	{

	}

	public function payment()
	{

	}

	public function complete()
	{
		
	}

}