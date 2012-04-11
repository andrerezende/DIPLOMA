<?php
App::uses('AppHelper', 'Helper');

/**
 * UtilHelper
 *
 * PHP version 5
 *
 * @package       View
 * @subpackage    Helper
 *
 * @author        Vitor Pacheco <vitor.pacheco@ifbaiano.edu.br>
 */
class UtilHelper extends AppHelper {

/**
 * Names of helpers that were used
 *
 * @access public
 * @var array
 */
	public $helpers = array(
		'Html',
		'Js' => array('Jquery'),
	);

/**
 *
 * @access public
 * @return void
 */
	public function js() {
		$diplomas = array();

		if (isset($this->request->params['locale'])) {
			$diplomas['basePath'] = Router::url('/', $this->request->params['locale']);
		} else {
			$diplomas['basePath'] = Router::url('/');
		}

		$diplomas['params'] = array(
			'controller' => $this->request->params['controller'],
			'action' => $this->request->params['action'],
			'named' => $this->request->params['named'],
		);

		if (is_array(Configure::read('Js'))) {
			$diplomas = Set::merge($diplomas, Configure::read('Js'));
		}

		return $this->Html->scriptBlock('var Diplomas = ' . $this->Js->object($diplomas) . ';', array('block' => 'script'));
	}

}