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
				$this->redirect(array('action' => 'select'));
			$data2 = $this->Session->read('Booking.Step2');
			if (isset($data2)) {
				$this->redirect(array('action' => 'profile'));
			}
			$data3 = $this->Session->read('Booking.Step3');
			if (isset($data3)) {
				$this->redirect(array('action' => 'confirm'));
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
			$data2 = $this->Session->read('Booking.Step2');
			if (isset($data2)) {
				$this->redirect(array('action' => 'profile'));
			}
			$results = $this->Flight->findAllByTypeAndForm_city_idAndTo_city_id($data['Flight']['type'], $data['Flight']['form_city_id'], $data['Flight']['to_city_id']);
			$form_city = $this->City->findById($data['Flight']['form_city_id']);
			$to_city = $this->City->findById($data['Flight']['to_city_id']);
			/*
			debug($data);
			debug($results);
			debug($form_city);
			debug($to_city);
			*/
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
		if ($this->request->is('get')) {
			$data1 = $this->Session->read('Booking.Step1');
			$data2 = $this->Session->read('Booking.Step2');
			//debug($data1);
			//debug($data2);
			if (!isset($data1) || !isset($data2)) {
				$this->redirect(array('action' => 'reset'));
			}
			//$this->set(compact('data', 'results', 'form_city', 'to_city'));
		}
		else if ($this->request->is('post')) {
			/*
			$data = $this->Session->read('Booking.Step1');
			if (isset($data)) {
				$set_data = $this->request->data;
				$this->Session->write('Booking.Step2', $set_data);
				$this->redirect(array('action' => 'profile'));
			} else {
				$this->Session->setFlash();
				$this->redirect(array('action' => ''));
			}
			*/
		}
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

	public function reset()
	{
		$this->Session->delete('Booking');
		$this->redirect(array('action' => 'index'));
	}

}