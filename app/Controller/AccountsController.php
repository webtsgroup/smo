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
class AccountsController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

/**
 * Displays a view
 *
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	public function index() {
		$results = $this->Account->find('all',array(
			//'conditions' => array('email' => $email)
		));
		//debug($results);
		$this->set(compact('results'));
	}
	public function add() {
		if(!empty($this->data))
		{
			$result = array(
				'success' => false,
				'data' => array(),
				'message' => ''
			);
			$error = true ;
			if($this->data['name'] != '' && $this->data['email'] != '')
			{
				$error = false;
			}
			if($this->checkAccount($this->data['email']) > 0)
			{
				$error = true;
			}
			if($error)
			{
				$result['message'] = 'Data not save';
			}
			else
			{
				$NOW = time();
				$data['Account']['date_create'] = $NOW;
				/*if($data['Account']['date_expiry'] == '')
				{
					$data['Account']['date_expiry'] = strtotime( "+1 month", $NOW );
				}*/
				$data['Account'] = $this->data;
				$data['Account']['date_init'] = strtotime($this->data['date_init']);
				$this->Account->create();
				$this->Account->save($data);
				$variable = $this->Account->getLastInsertId();
				if(is_numeric($variable))
				{
					$result = array(
						'success' => true,
						'data' => array(),
						'message' => 'Data saved'
					);
					//if add account success, add user default for account
					$this->loadModel('User');
					$dataUser['first_name'] = 'Admin';
					$dataUser['last_name'] = 'System';
					$dataUser['email'] = $data['Account']['email'];
					$dataUser['pass'] = md5('admin');
					$dataUser['account_id'] = $variable;
					$dataUser['User'] = $dataUser;
					$this->User->create();
					$this->User->save($dataUser);
					
					//add group default for account
					$this->loadModel('Group');
					$dataGroup['name'] = 'Default';
					$dataGroup['default'] = 1;
					$dataGroup['account_id'] = $variable;
					$this->Group->create();
					$this->Group->save($dataGroup);
					//end
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
		$result = $this->Account->find('first',array(
			'conditions' => array('id' => $id)
		));
		$result = $result['Account'];
		$result['date_init'] = date('d-m-Y',$result['date_init']);
		$action = 'edit';
		$onchange = "updateField('Account',$id,this.id,this.value);";
		$this->set(compact('result','action','onchange'));
		$this->render('add');
	}
	public function checkAccount($email)
	{
		$check = $this->Account->find('count',array(
			'conditions' => array('email' => $email)
		));
		return $check;
	}
	public function login(){	
		$this->layout = false;
		$this->render('/Layouts/login');
	}
}
