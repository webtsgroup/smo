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
class AjaxsController extends AppController {

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
	public function updateField()
	{
		$this->layout = 'ajax';
		$this->render(false);
		$DATA = $this->data;
		if(!empty($DATA))
		{
			$this->loadModel($DATA['model']);
			$result = array(
				'success' => true,
				'data' => array(),
				'message' => 'Updated'
			);
			$this->$DATA['model']->id = $DATA['id'];
			$this->$DATA['model']->saveField($DATA['field'],$DATA['value']);
			echo json_encode($result);
			exit;
		}
	}
	public function upload()
	{
		$this->layout = 'ajax';
		$this->render(false);
		
		$data = $this->request['data'];
		//debug($data);
		$img = -1;
		if(!empty($data))
		{
			if($data['id'] == 0)
			{
				$allowType = explode(',',isset($data['allow']) ? $data['allow'] : '');
				$config = array(
					'file' => 'file_tmp',
					'folder' => 'tmp',
					'allowType' => $allowType,
					'createThumb' => false,
				);
				$result = $this->LIB->upload($config);
				if($result['success'])
				{
					$_saves = array(
						'file' => $result['img'],
						'model' => $data['model'],
						'root' => $data['root'],
						'field' => $data['field']
					);
					$saves['UploadTmp'] = $_saves;
					$this->loadModel('UploadTmp');
					$this->UploadTmp->create();
					$this->UploadTmp->save($saves);
					$result['folder'] = 'tmp/';
					$result['src'] = $result['img'];
				}
			}
		}
		echo json_encode($result);
		exit;
	}
}
