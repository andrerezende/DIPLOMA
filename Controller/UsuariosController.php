<?php
App::uses('AppController', 'Controller');

/**
 * UsuariosController
 *
 * PHP version 5
 *
 * @package    Controller
 * @author      Vitor Pacheco <vitor.pacheco@ifbaiano.edu.br>
 *
 * @property   Usuario   $Usuario
 */
class UsuariosController extends AppController {

/**
 * login method
 *
 * @access public
 * @return void
 */
	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('Usuário ou senha inválidos, tente novamente'), 'flash_auth', array(), 'auth');
				unset($this->request->data['Usuario']['senha']);
			}
		}
	}

/**
 * logout method
 *
 * @access public
 * @return void
 */
	public function logout() {
		$this->redirect($this->Auth->logout());
	}

}