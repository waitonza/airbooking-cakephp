<?php
/**
* 
*/
class BookingController extends AppController
{
	public $uses = array('Airline','Airplane','Airport','Booking','City','Country','DepartAir','Flight','Passenger','Seat');

	public function index()
	{
		if ($this->request->is('post')) {
			debug($this->request->data);
		}
		$cities = $this->City->find('list');
		$this->set(compact('cities'));
	}

}