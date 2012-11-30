<?php
/**
* 
*/
class AdminController extends AppController
{
	public $components = array('Session','Auth');

	public $uses = array('AdminUser');

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
			if ($this->Auth->login($this->request->data))
			{
				$this->redirect(array('action' => 'index'));
			}
			else
			{
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
		$user_find = $this->AdminUser->findByUsername($user);
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

	}

	public function list_booking() {

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