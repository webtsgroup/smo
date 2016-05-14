<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	var $components = array(
        'Auth',
        'Session',
        'Cookie' => array(
            'name' => 'PMO'
        ),
        'RequestHandler');
		
	var $defaultAjaxResult = array(
		'success' => false,
		'data' => array(),
		'message' => ''
	);
	
	public $ROLE = null;
	public $SAS = false;
	public $systemConfigs;
	public $companyConfigs;
	public $ACCOUNT = 0;
	public $USER;
	public $LIB;
	function beforeFilter() {
		App::import('Vendor', '', array('file' => 'library.php'));
		$this->LIB = new library;
		$this->_setLocale();
        $this->Auth->userScope = array(
            'active' => 1,
        );
        $this->Auth->allow('login', 'logout');
		$this->Auth->loginRedirect = array('controller' => 'accounts');
		//debug($this->Auth->loginRedirect);
		$this->isAuthorized();
		$this->loadModel('Acl');
		$ACLS = $this->Acl->find('list',array(
			'fields' => array('role_str','pass'),
			'conditions' => array(
				'pass' => 1,
				'role' => $this->ROLE
			)
		));
		$isPermission = true;
		$ACLS = array_keys($ACLS);
		if($this->ROLE !== null)
		{
			$ACCESS =$this->ROLE.'_'.$this->params['controller'].'_'.$this->params['action'];
			if($this->params['controller'] != 'pages')
			{
				if(!in_array($ACCESS,$ACLS))
				{
					$isPermission = false;
				}
			}
		}
		if($this->params['controller'] == 'users' && ($this->params['action'] == 'login' || $this->params['action'] == 'logout'))
		{
			$isPermission = true;
		}
		if($this->SAS && $this->params['controller'] == 'acls')
		{
			$isPermission = true;
		}
		if(!$isPermission)
		{
			$this->redirect("/pages/permission");
		}
		$this->_getAllConfigs();
	}
	protected function _setLocale() {
        if ($this->Cookie->read('lang') && !$this->Session->check('Config.language')) {
            $this->Session->write('Config.language', $this->Cookie->read('lang'));
        }
        elseif ( isset($this->params['language']) && ($this->params['language'] !=  $this->Session->read('Config.language'))) {
            $this->Session->write('Config.language', $this->params['language']);
            $this->Cookie->write('lang', $this->params['language']);
        }
    }
	function isAuthorized(){
		if($this->Auth->user())
		{			
			$USER = $this->Session->read('Auth.User.username');
			$this->loadModel('User');		
			$info = $this->User->find('first',array(
				'recursive' => 1,
				'conditions' => array('User.email' => $USER)
			));
			$this->Session->write('Auth.Info', $info);
			$this->ROLE = $this->Session->read('Auth.Info.User.role');
			$this->SAS = $this->Session->read('Auth.Info.User.sas') == 1 ? true : false ;
			$this->ACCOUNT = isset($info['Account']['id']) ? $info['Account']['id'] : 0;
			if($this->params['controller'] == 'users' && $this->params['action'] == 'login')
			{			
				$this->redirect($this->Auth->loginRedirect);
			}
		}
	}	
	function _getAllConfigs(){
		$ACCOUNT = $this->ACCOUNT;
		$this->loadModel('Config');
		$this->companyConfigs = $this->Config->find('list',array(
			'recursive' => -1,
			'conditions' => array('Config.account_id' => $ACCOUNT),
			'fields' => array('name', 'value')
		));
		
		//get configs list
		$this->Session->write('companyConfigs',$this->companyConfigs); //use in model
		$this->set('companyConfigs', $this->companyConfigs); //use in view

		$this->systemConfigs = $this->Config->find('list',array(
			'recursive' => -1,
			'conditions' => array('Config.account_id' => 0),
			'fields' => array('name', 'value')
		));
		$this->set('systemConfigs', $this->systemConfigs);
		$this->set('ROLE', $this->SAS == 1 ? 'sas' : 'admin');
	}
	function getCompanyConfig($name){
		return isset($this->companyConfigs[$name]) ? $this->companyConfigs[$name] : null;
	}
    function getSystemConfig($name){
		return isset($this->systemConfigs[$name]) ? $this->systemConfigs[$name] : null;
	}
}
