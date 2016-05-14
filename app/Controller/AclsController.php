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
class AclsController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();
	public $arr = array(
			'acls' => array('index','setAll','setPermission'),
			'ajaxs' => array('updateField','upload'),
			'accounts' => array('index','add', 'edit','profile'),
			'users' => array('login','logout','index','add','edit','profile','changePass'),
			'configs' => array('index','editMe'),
			'groups' => array('index','update','delete'),
			'letters' => array('index','make','update','ckeditor'),
			'members' => array('index','add','import','update','delete'),
			'templates' => array('index','add','preview')
		);

/**
 * Displays a view
 *
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	public function index()
	{	
		$arr = $this->arr;
		$acls = $this->Acl->find('list',array(
			'recursive' => -1,
			'fields' => array('role_str','id'),
			'conditions' => array(
				'pass' => 1
			)
		));
		$this->set(compact('arr','acls'));
	}
	public function setAll()
	{
		$this->layout = 'ajax';
		$result = $this->defaultAjaxResult;
		$DATA = $this->data;
		if(!empty($DATA))
		{
			$acls = $this->arr[$DATA['controller']];
			//$controller = $DATA['controller'];
			foreach($acls as $act)
			{
				$DATA['action'] = $act;
				$this->saveMe($DATA);
			}
			$result['success'] = true ;
			$result['message'] = 'Updated' ;
		}		
		echo json_encode($result);
		exit;
	}
	private function saveMe($DATA){
		$SAVE = array(
			'role' => $DATA['role'],
			'controller' => $DATA['controller'],
			'action' => $DATA['action'],
			//'pass' => $DATA['pass']
		);
		$check = $this->Acl->find('first',array(
			'recursive' => -1,
			'conditions' => $SAVE
		));
		if($check)
		{
			$data = array(
				'id'=> $check['Acl']['id'],
				'pass'=> $DATA['pass']
			);			
			$this->Acl->save($data);
			$success = 1;
		}
		else
		{
			$this->Acl->create();
			$SAVE['pass'] = $DATA['pass'];
			$this->Acl->save($SAVE);
			$success = 1;
		}
		return $success;
	}
	public function setPermission() {
		$result = $this->defaultAjaxResult;
		$DATA = $this->data;
		if(!empty($DATA))
		{
			$data = $this->saveMe($DATA); 
			if($data)
			{
				$result['success'] = true ;
				$result['message'] = 'Updated' ;
			}
		}
		echo json_encode($result);
		exit;
	}
}
