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
class MembersController extends AppController {

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
	public function index($group = null) {
		$conditions = $group == null ? array() : array ('group' => $group) ;
		$results = $this->Member->find('all', array(
			'conditions' => $conditions
		));
		$this->set(compact('results','group'));
	}
	public function update($group) {
		$this->layout='ajax';
		$results = $this->defaultAjaxResult;
		$data = isset($this->data) ? $this->data : array();
		$error = false;
		if(!$this->LIB->validateEmail($data['email']))
		{
			$error = true ;
			$results['message'] = 'Email invalid';
		}
		if(!empty($data) && $error === false)
		{
			$saves = $data;
			$saves['account_id'] = $this->ACCOUNT;
			$saves['group'] = $group;
			if($data['id'] == 0)
			{
				//do nothing
				$this->Member->save($saves);
				$data['id'] = $this->Member->getLastInsertId();
			}
			else
			{
				$this->Member->id = $data['id'];
				$this->Member->save($saves);
			}
			if($data['id'])
			{
				$results['success'] = true;
				$results['message'] = 'Saved';
			}
			$results['data'] = $data;
		}
		echo json_encode($results);
		exit;
	}
	public function delete($group) {
		$this->layout='ajax';
		$data = isset($this->data) ? $this->data : array();
		$results = $this->defaultAjaxResult;
		if($data['id'])
		{
			$check = $this->Member->find('count', array(
				'conditions' => array(
					'Member.id' => $data['id']
				)
			));
			if($check)
			{
				if($this->Member->delete($data['id']))
				{
					$results['success'] = true;
					$results['data'] = $data;
					$results['message'] = 'Deleted';
				}
			}
		}
		echo json_encode($results);
		exit;
	}
}
