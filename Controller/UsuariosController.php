<?php
App::uses('AppController', 'Controller');

/**
 * UsuariosController
 *
 * PHP version 5
 */
class UsuariosController extends AppController {

	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('Usuário ou senha inválidos, tente novamente'));
			}
		}
	}

	public function logout() {
		$this->redirect($this->Auth->logout());
	}

}