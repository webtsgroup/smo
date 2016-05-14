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
class GroupsController extends AppController {

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
		$results = $this->Group->find('all', array(
			'recursive' => -1,
			'conditions' => array('account_id' => $this->ACCOUNT)
		));
		//$data = Set::combine($data,'{n}.Group','{n}.Group');
		$group = $this->params;
		$this->set(compact('results'));
	}
	public function update() {
		$this->layout='ajax';
		$results = $this->defaultAjaxResult;
		$data = isset($this->data) ? $this->data : array();
		
		if(!empty($data))
		{
			$saves = array('name' => '');
			$saves = array_intersect_key(array_merge($saves, $data), $saves);
			$saves['account_id'] = $this->ACCOUNT;
			if($data['id'] == 0)
			{
				//do nothing
				$this->Group->save($saves);
				$data['id'] = $this->Group->getLastInsertId();
			}
			else
			{
				$this->Group->id = $data['id'];
				$this->Group->save($saves);
			}
			if($data['id']) $results['success'] = true;
			$results['data'] = $data;
		}
		echo json_encode($results);
		exit;
	}
	public function delete() {
		$this->layout='ajax';
		$data = isset($this->data) ? $this->data : array();
		$results = $this->defaultAjaxResult;
		if($data['id'])
		{
			$check = $this->Group->find('first', array(
				'conditions' => array(
					'Group.id' => $data['id']
				)
			));
			if(!empty($check) && $check['Group']['default'] == 0)
			{
				$this->Group->delete($data['id']);
				$results['success'] = true;
				$results['data'] = $data;
				$results['message'] = 'Deleted';
			}
			else
			{
				$results['message'] = 'Can not delete Default group';
			}
		}
		echo json_encode($results);
		exit;
	}
}
