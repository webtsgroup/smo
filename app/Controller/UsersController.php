<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class UsersController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array('User');

/**
 * Displays a view
 *
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	public function index() {
		$conditions = array();
		if(!$this->SAS)
		{
			$conditions['conditions'] = array('account_id' => $this->ACCOUNT);
		}
		$results = $this->User->find('all',array(
			$conditions
		));
		//debug($results);
		$this->set(compact('results'));
	}
	public function add() {
		if(!empty($this->data))
		{
			$data = $this->data;
			$result = array(
				'success' => false,
				'data' => array(),
				'message' => ''
			);
			$error = true ;
			if($data['email'] != '')
			{
				$error = false;
			}
			if(!$this->LIB->validateEmail($data['email']) || $this->checkUser($data['email']) > 0)
			{
				$error = true;
			}
			if($error)
			{
				$result['message'] = 'Data not save';
			}
			else
			{
				$data['pass'] = md5($data['pass']);
				$data['account_id'] = $this->ACCOUNT;
				$dataUser['User'] = $data;
				$this->User->create();
				$this->User->save($dataUser);
				$variable = $this->User->getLastInsertId();
				if(is_numeric($variable))
				{
					$dataUser['id'] = $variable;
					$result = array(
						'success' => true,
						'data' => $dataUser,
						'message' => 'Data saved'
					);
				}
				else
				{
					$result['message'] = 'Data not save';
				}
			}
			echo json_encode($result);
			exit;
		}
		$action = 'add';
		$result = array();
		$this->set(compact('result','action'));
	}
	public function edit($id) {
		$result = $this->User->find('first',array(
			'conditions' => array('id' => $id)
		));
		$result = $result['User'];
		$action = 'edit';
		$onchange = "updateField('User',$id,this.id,this.value);";
		$this->set(compact('result','action','onchange','id'));
		$this->render('add');
	}
	public function changePass($id)
	{
		$result = array(
				'success' => false,
				'data' => array(),
				'message' => ''
			);
		if(!empty($this->data))
		{
			$data = $this->data;
			if($this->checkPass($id,$data['old_pass']) > 0)
			{
				if($data['pass'] == $data['re_pass'])
				{
					$this->User->id = $id;
					$this->User->saveField('pass',md5($data['pass']));
					$result['success'] = true;
					$result['message'] = 'Updated';
				}
				else
				{
					$result['message'] = 'Password does not match';
				}
			}
			else
			{
				$result['message'] = 'Password incorrect';
			}
		}
		echo json_encode($result);
		exit;
	}
	public function checkPass($id,$pass)
	{
		$check = $this->User->find('count',array(
			'conditions' => array('id' => $id,'pass' => md5($pass))
		));
		return $check;
	}
	public function checkUser($email)
	{
		$check = $this->User->find('count',array(
			'conditions' => array('email' => $email)
		));
		return $check;
	}
	public function login(){	
		if(!empty($this->data))
		{
			$result = $this->defaultAjaxResult;
			$result['reload'] = false;
			$data = $this->data;
			$check = $this->User->find('count',array(
				'conditions' => array('email' => $data['email'],'pass' => md5($data['pass']))
			));
			$tmpUser = array();
			if($check > 0)
			{
				$tmpUser['username'] = $data['email'];
				$tmpUser['password'] = $data['pass'];
			}
			if($this->Auth->login($tmpUser))
			{
				$result['success'] = true;
				$result['message'] = 'Login successful. Redirecting...';
				$result['reload'] = true;
			}
			else
			{
				$result['message'] = 'Email or Password does not match';
			}
			/*if($check > 0)
			{
				
				$result['success'] = true;
				$result['message'] = 'Login success';
				//$this->Auth->login = true;
				//$this->Auth->user('email',$data['email']);
			}
			else
			{
				$result['message'] = 'Email or Password does not match';
			}*/
			echo json_encode($result);
			exit;
		}
		else
		{
			$this->layout = false;
			$this->render('/Layouts/login');
		}
	}
	function logout() {
		$this->Session->destroy();
		$this->Auth->logout();
		$this->redirect($this->Auth->logoutRedirect);
	}
}
