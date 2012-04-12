<?php
App::uses('Controller', 'Controller');

/**
 * AppController
 *
 * PHP version 5
 *
 * @package     Controller
 * @author      Vitor Pacheco <vitor.pacheco@ifbaiano.edu.br>
 *
 * @property    Auth              $Auth
 * @property    Session           $Session
 * @property    RequestHandler    $RequestHandler
 */
class AppController extends Controller {

/**
 * Names of components this controller
 *
 * @access public
 * @var array
 */
	public $components = array(
		'Auth',
		'Session',
		'RequestHandler',
	);

/**
 * Names of helpers this controller
 *
 * @var array
 * @access public
 */
	public $helpers = array(
		'Html',
		'Form',
		'Session',
		'Js' => array('Jquery'),
		'Util',
	);

/**
 * beforeFilter callback
 *
 * @access public
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();

		$this->_setUpAuth();
		$this->_setUpUser();

		if ($this->request->is('ajax')) {
			$this->layout = 'ajax';
		}
	}

/**
 * afterFilter callback
 *
 * Disable debug mode on JSON pages to prevent the script execution time to be appended to
 * the page.
 *
 * @access public
 * @return void
 */
	public function afterFilter() {
		parent::afterFilter();

		if (!empty($this->request->params['url']['ext']) && $this->request->params['url']['ext'] === 'json') {
			Configure::write('debug', 0);
		}
	}

/**
 * setUpAuth method
 *
 * @access protected
 * @return void
 */
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

/**
 * setUpUser method
 *
 * @access protected
 * @return void
 */
	protected function _setUpUser() {
		$userData = $this->Auth->user();
		if ($userData) {
			$this->set(compact('userData'));
		}
	}

/**
 * setUpAuthActions method
 *
 * @access private
 * @return void
 */
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