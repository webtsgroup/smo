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
class TemplatesController extends AppController {

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
		
	}
	private function make_data_to_move_file($data = array(),$name)
	{	
		$ext = $this->LIB->get_file_name_extensions($data['file']);
		$new_name = $name.'.'.$ext;
		$cur = 'tmp/'.$data['file'];
		$new = $data['root'].'/'.$new_name;
		return array($cur,$new);
	}
	public function preview($id) {
		$conditions = array('id' => $id);
		$templates = $this->Template->find('first', array(
			'fields' => array('id','file'),
			'conditions' => $conditions
		));
		echo file_get_contents('uploads/'.$templates['Template']['file']);
		exit;
	}
	public function add() {
		$data = $this->data;
		if(!empty($data))
		{
			$this->layout = 'ajax';
			$this->render(false);
			$result = $this->defaultAjaxResult;
			$this->loadModel('UploadTmp');
			$thumbnail = $this->UploadTmp->find('first',array(
				'conditions' => array('file' => $data['thumbnail']),
			));
			$file = $this->UploadTmp->find('first',array(
				'conditions' => array('file' => $data['file']),
			));
			$name = $this->LIB->seoURL($data['name']).'-'.NOW;
			list($cur_thumbnail,$new_thumbnail) = $this->make_data_to_move_file($thumbnail['UploadTmp'],$name);
			$data['thumbnail'] = $new_thumbnail;
			list($cur_file,$new_file) = $this->make_data_to_move_file($file['UploadTmp'],$name);
			$data['file'] = $new_file;
			$this->Template->create();
			$this->Template->save($data);
			$variable = $this->Template->getLastInsertId();
			if($variable)
			{
				$this->LIB->move_file($cur_thumbnail,$new_thumbnail);
				$this->LIB->move_file($cur_file,$new_file);
				$result = array(
					'success' => true,
					'message' => 'Data saved'
				);
			}
			echo json_encode($result);
			exit;
		}
	}
	public function delete($group) {
		
	}
}
