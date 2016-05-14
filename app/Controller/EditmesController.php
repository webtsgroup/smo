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
		$success = false;
		if(!isset($this->data))
		{
			echo $success;
			exit;
		}
		$id = $this->data['id'];
		$field = $this->data['field'];
		$value = $this->data['value'];
		$model = $this->data['model'];
		$this->loadModel($model);
		$check = $this->$model->find('first',array(
			'recursive' => -1,
			'conditions' => array(
				'id' => $id,
			)
		));
		if($check)
		{
			$data = array(
				'id' => $check[$model]['id'],
				$field => $value
			);
			$this->$model->save($data);
			$success = true;
		}
		echo $success;
		exit;
	}
}
