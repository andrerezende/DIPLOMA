<?php
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $components = array(
		'Auth',
		'Session',
		'RequestHandler',
	);

	public $helpers = array(
		'Html',
		'Form',
		'Session',
		'Js' => array('Jquery'),
		'Util',
	);

	public function beforeFilter() {
		parent::beforeFilter();

		$this->_setUpAuth();
		$this->_setUpUser();

		if ($this->request->is('ajax')) {
			$this->layout = 'ajax';
		}
	}

	public function afterFilter() {
		parent::afterFilter();

		if (!empty($this->request->params['url']['ext']) && $this->request->params['url']['ext'] === 'json') {
//			Configure::write('debug', 0);
		}
	}

	protected function _setUpAuth() {
		$this->Auth->authenticate = array(
			'SigaEdu' => array(
				'userModel' => 'Usuario',
				'fields' => array(
					'username' => 'login',
					'password' => 'senha',
				),
			),
		);

		$this->Auth->flash = array(
			'element' => 'flash_auth',
			'key' => 'auth',
			'params' => array(),
		);

		$this->__setUpAuthActions();
	}

	protected function _setUpUser() {
		$userData = $this->Auth->user();
		if ($userData) {
			$this->set(compact('userData'));
		}
	}

	private function __setUpAuthActions() {
		$this->Auth->loginAction = array(
			'admin' => false,
			'plugin' => false,
			'controller' => 'usuarios',
			'action' => 'login',
		);

		$this->Auth->logoutRedirect = array(
			'admin' => false,
			'plugin' => false,
			'controller' => 'usuarios',
			'action' => 'login',
		);

		$this->Auth->loginRedirect = array(
			'admin' => false,
			'plugin' => false,
			'controller' => 'diplomas',
			'action' => 'gerar',
		);
	}

}