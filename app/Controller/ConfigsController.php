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
class ConfigsController extends AppController {

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
		
	}
	public function editMe($field = null, $value = null, $private = false){	
		$result = $this->defaultAjaxResult ;
		$ACCOUNT = $this->ACCOUNT;		
		$value = $this->data['value'];
		$field = $this->data['field'];
		$check = $this->Config->find('first',array(
			'recursive' => -1,
			'conditions' => array(
				'name' => $field,
				'account_id' => $ACCOUNT
			)
		));
		if($check)
		{
			/*$data = array(
				'id'=> $check['Config']['id'],
				'value'=> $value
			);	*/		
			$this->Config->updateAll(
				array('Config.value' => "'$value'"),
				array('Config.name' => $field, 'account_id' => $ACCOUNT)
			);
			$result['success'] = true;
			$result['data'] = array();
			$result['message'] = 'Updated';
		}
		else
		{
			$this->Config->create();
			$data = array(
				'name' => $field,
				'value' => $value,
				'account_id' => $ACCOUNT
			);
			$this->Config->save($data);
			//$data['id'] = $this->Group->getLastInsertId();
			$result['success'] = true;
			$result['data'] = $data;
			$result['message'] = 'Saved';
		}
		echo json_encode($result);
		exit;
	}
}
