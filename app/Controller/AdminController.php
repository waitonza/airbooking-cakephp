<?php
/**
* 
*/
class AdminController extends AppController
{
	public $components = array('Session','Auth');

	public $uses = array('Airline','Airplane','Airport','Booking','City','Country','DepartAir','Flight','Passenger','Seat','AdminUser');

	public function beforeFilter()
	{
		$this->Auth->allow('regis');
		$this->Auth->loginAction = array('admin' => false, 'controller' => 'admin', 'action' => 'login');
		$user = $this->Auth->user('AdminUser');
		if ($user) {
			$this->set('username', $user['username']);
			$this->layout = 'admin';
		}
	}

	public function login()
	{
		if ($this->request->is('post'))
		{
			$data = $this->request->data;
			$pass = $this->AdminUser->findByUsernameAndPassword($data['AdminUser']['username'], AuthComponent::password($data['AdminUser']['password']));
			if ($pass) {
				if ($this->Auth->login($this->request->data))
				{
					$this->redirect(array('action' => 'index'));
				}
				else
				{
					$this->Session->setFlash('คุณใส่ Username หรือ password ผิด, โปรดลองอีกครั้ง');
				}
			}
			else {
				$this->Session->setFlash('คุณใส่ Username หรือ password ผิด, โปรดลองอีกครั้ง');
			}		
				
		}
	}

	public function logout()
	{
		$this->Auth->logout();
		$this->redirect(array('action' => 'login'));
	}

	public function change_pass()
	{
		$user = $this->Auth->user('AdminUser');
		$user_find1 = $this->AdminUser->query(
			'SELECT `id`, `username`, `password` 
			FROM `admin_user` AS `AdminUser` 
			WHERE `username` 
			IN ("'.$user['username'].'", "'.AuthComponent::password($user['password']).'")');
		$user_find = $user_find1[0];
		if ($this->request->is('get')) {
			$this->request->data['AdminUser']['id'] = $user_find['AdminUser']['id'];
		} else {
			if (AuthComponent::password($this->request->data['AdminUser']['oldpassword']) == $user_find['AdminUser']['password']) {
				if (empty($this->request->data['AdminUser']['password']) || $this->request->data['AdminUser']['password'] != $this->request->data['AdminUser']['repassword'])
				{
					$this->request->data['AdminUser']['oldpassword'] = '';
					$this->request->data['AdminUser']['password'] = '';
					$this->request->data['AdminUser']['repassword'] = '';
					$this->Session->setFlash('คุณใส่ password ไม่ตรงกัน');
					return;
				}

				$this->request->data['AdminUser']['password'] = AuthComponent::password($this->request->data['AdminUser']['password']);

				if ($this->AdminUser->save($this->request->data))
				{
					$this->Session->setFlash('ข้อมูลถูกปรับปรุงเรียบร้อยแล้ว');
					$this->redirect(array('action' => 'index'));
				}
				else
				{
					$this->request->data['AdminUser']['oldpassword'] = '';
					$this->request->data['AdminUser']['password'] = '';
					$this->request->data['AdminUser']['repassword'] = '';
					$this->Session->setFlash('ไม่สามารถลงทะเบียนได้ กรุณาตรวจสอบข้อมูลอีกครั้ง');
				}
			} else {
				$this->request->data['AdminUser']['oldpassword'] = '';
				$this->request->data['AdminUser']['password'] = '';
				$this->request->data['AdminUser']['repassword'] = '';
				$this->Session->setFlash('คุณใส่ password เก่าไม่ถูกต้อง');
			}
		}
	}
	
	public function index()
	{
		$this->paginate = array(
			'limit' => 15
			);
		$bookings = $this->paginate('Booking');
		for ($i = 0; $i < count($bookings); $i++) {
			$form_city1 = $this->City->query(
				'SELECT `City`.`id`, `City`.`name`, `City`.`city_code`, `City`.`country_id`, `Country`.`id`, `Country`.`name` 
				FROM `airline_book`.`city` AS `City` 
				LEFT JOIN `airline_book`.`country` AS `Country` 
				ON (`City`.`country_id` = `Country`.`id`) WHERE `City`.`id` = '.$bookings[$i]["Flight"]["form_city_id"]);
			$bookings[$i]['Form_city'] = $form_city1[0];
			$to_city1 = $this->City->query(
				'SELECT `City`.`id`, `City`.`name`, `City`.`city_code`, `City`.`country_id`, `Country`.`id`, `Country`.`name` 
				FROM `airline_book`.`city` AS `City` 
				LEFT JOIN `airline_book`.`country` AS `Country` 
				ON (`City`.`country_id` = `Country`.`id`) WHERE `City`.`id` = '.$bookings[$i]["Flight"]["to_city_id"]);
			$bookings[$i]['To_city'] = $to_city1[0];
		}
		$this->set(compact('bookings'));
	}

	public function flight_manager() {
		$this->paginate = array(
			'limit' => 15
			);
		$flights = $this->paginate('Flight');
		for ($i = 0; $i < count($flights); $i++) {
			$form_city1 = $this->City->query(
				'SELECT `City`.`id`, `City`.`name`, `City`.`city_code`, `City`.`country_id`, `Country`.`id`, `Country`.`name` 
				FROM `airline_book`.`city` AS `City` 
				LEFT JOIN `airline_book`.`country` AS `Country` 
				ON (`City`.`country_id` = `Country`.`id`) WHERE `City`.`id` = '.$flights[$i]["Flight"]["form_city_id"]);
			$flights[$i]['Form_city'] = $form_city1[0];
			$to_city1 = $this->City->query(
				'SELECT `City`.`id`, `City`.`name`, `City`.`city_code`, `City`.`country_id`, `Country`.`id`, `Country`.`name` 
				FROM `airline_book`.`city` AS `City` 
				LEFT JOIN `airline_book`.`country` AS `Country` 
				ON (`City`.`country_id` = `Country`.`id`) WHERE `City`.`id` = '.$flights[$i]["Flight"]["to_city_id"]);
			$flights[$i]['To_city'] = $to_city1[0];
		}
		//debug($flights);
		$this->set(compact('flights'));
	}

	public function flight_create() {
		$list_cities = $this->City->query('SELECT `id`, `name` FROM `city` AS `City`');
		$cities = array();
		foreach ($list_cities as $city) {
			array_push($cities, $city['City']['name']);
		}
		$this->set(compact('cities'));
		if ($this->request->is('post')) {
			$data = $this->request->data;
			
			$departure_time = $data['Flight']['departure_time']['hour'].':'.$data['Flight']['departure_time']['min'].':00';
			$departure_date = $data['Flight']['departure_date']['year'].'-'.$data['Flight']['departure_date']['month'].'-'.$data['Flight']['departure_date']['day'];
			$arrival_time = $data['Flight']['arrival_time']['hour'].':'.$data['Flight']['arrival_time']['min'].':00';
			$arrival_date = $data['Flight']['arrival_date']['year'].'-'.$data['Flight']['arrival_date']['month'].'-'.$data['Flight']['arrival_date']['day'];
			$data['Flight']['form_city_id'] = $data['Flight']['form_city_id'] + 1;
			$data['Flight']['to_city_id'] = $data['Flight']['to_city_id'] + 1;
			$this->Flight->query(
				'INSERT INTO `flight` (`departure_time`, `departure_date`, `arrival_time`, `arrival_date`, `form_city_id`, `to_city_id`, `type`, `price_adult`, `price_kids`, `price_baby`) 
				VALUES ("'.$departure_time.'", "'.$departure_date.'", "'.$arrival_time.'", "'.$arrival_date.'", '.$data['Flight']['form_city_id'].', '.$data['Flight']['to_city_id'].', "'.$data['Flight']['type'].'", '.
					$data['Flight']['price_adult'].', '.$data['Flight']['price_kids'].', '.$data['Flight']['price_baby'].')');
			$this->redirect(array('action' => 'flight_manager'));
		}
	}

	public function flight_edit($id = null) {
		if (isset($id)) {
			$list_cities = $this->City->query('SELECT `id`, `name` FROM `city` AS `City`');
			$cities = array();
			foreach ($list_cities as $city) {
				array_push($cities, $city['City']['name']);
			}
			$this->set(compact('cities'));
			if ($this->request->is('get')) {
				$data = $this->Flight->findById($id);
				$data['Flight']['form_city_id'] = $data['Flight']['form_city_id'] - 1;
				$data['Flight']['to_city_id'] = $data['Flight']['to_city_id'] - 1;
				$this->request->data = $data;
			} else if ($this->request->is('post')) {

				$data = $this->request->data;
				$departure_time = $data['Flight']['departure_time']['hour'].':'.$data['Flight']['departure_time']['min'].':00';
				$departure_date = $data['Flight']['departure_date']['year'].'-'.$data['Flight']['departure_date']['month'].'-'.$data['Flight']['departure_date']['day'];
				$arrival_time = $data['Flight']['arrival_time']['hour'].':'.$data['Flight']['arrival_time']['min'].':00';
				$arrival_date = $data['Flight']['arrival_date']['year'].'-'.$data['Flight']['arrival_date']['month'].'-'.$data['Flight']['arrival_date']['day'];
				$data['Flight']['form_city_id'] = $data['Flight']['form_city_id'] + 1;
				$data['Flight']['to_city_id'] = $data['Flight']['to_city_id'] + 1;
				
				$this->Flight->query(
				'UPDATE `flight` 
				SET `departure_time` = "'. $departure_time .'",
				 `departure_date` = "'.$departure_date.'", 
				 `arrival_time` = "'. $arrival_time .'", 
				 `arrival_date` = "'. $arrival_date .'", 
				 `form_city_id` = '.$data['Flight']['form_city_id'].', 
				 `to_city_id` = '.$data['Flight']['to_city_id'].', 
				 `type` = "'.$data['Flight']['type'].'", 
				 `price_adult` = '.$data['Flight']['price_adult'].', 
				 `price_kids` = '.$data['Flight']['price_kids'].', 
				 `price_baby` = '.$data['Flight']['price_baby'].', 
				 `id` = '.$data['Flight']['id'].' 
				 WHERE `flight`.`id` = '.$data['Flight']['id']);


				$this->redirect(array('action' => 'flight_manager'));

			}
		}
		else {
			$this->redirect(array('action' => 'flight_manager'));
		}
	}

	public function flight_delete($id = null) {
		if (isset($id)) {
			if ($this->request->is('get')) {
				$this->redirect(array('action' => 'flight_manager'));
			} else if ($this->request->is('post')) {
				$this->Flight->query('DELETE `Flight` FROM `flight` AS `Flight` WHERE `id` = '.$id);
				$this->redirect(array('action' => 'flight_manager'));
			}
		}
		else {
			$this->redirect(array('action' => 'flight_manager'));
		}
	}

	public function regis()
	{
		if ($this->request->is('post')) {
			if (empty($this->request->data['AdminUser']['password']) || $this->request->data['AdminUser']['password'] != $this->request->data['AdminUser']['repassword'])
			{
				$this->request->data['AdminUser']['password'] = '';
				$this->request->data['AdminUser']['repassword'] = '';
				$this->Session->setFlash('คุณใส่ password ไม่ตรงกัน');
				return;
			}

			$this->request->data['AdminUser']['password'] = AuthComponent::password($this->request->data['AdminUser']['password']);

			if ($this->AdminUser->save($this->request->data))
			{
				$this->Session->setFlash('การลงทะเบียนเสร็จสิ้น');
				$this->redirect(array('action' => 'login'));
			}
			else
			{
				$this->request->data['AdminUser']['password'] = '';
				$this->request->data['AdminUser']['repassword'] = '';
				$this->Session->setFlash('ไม่สามารถลงทะเบียนได้ กรุณาตรวจสอบข้อมูลอีกครั้ง');
			}
			
		}
	}


}