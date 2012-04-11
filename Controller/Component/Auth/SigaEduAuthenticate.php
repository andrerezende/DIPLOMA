<?php
App::uses('BaseAuthenticate', 'Controller/Component/Auth');
App::uses('Security', 'Utility');

/**
 * SigaEduAuthenticate
 *
 * PHP version 5
 *
 * @package       Controller
 * @subpackage    Component.Auth
 *
 * @author        Vitor Pacheco <vitor.pacheco@ifbaiano.edu.br>
 */
class SigaEduAuthenticate extends BaseAuthenticate {

/**
 * authenticate method
 *
 * @access public
 * @param CakeRequest $request
 * @param CakeResponse $response
 * @return mixed
 */
	public function authenticate(CakeRequest $request, CakeResponse $response) {
		$userModel = $this->settings['userModel'];
		list($plugin, $model) = pluginSplit($userModel);

		$fields = $this->settings['fields'];
		if (empty($request->data[$model])) {
			return false;
		}
		if (
			empty($request->data[$model][$fields['username']]) ||
			empty($request->data[$model][$fields['password']])
		) {
			return false;
		}
		return $this->_findUser(
			$request->data[$model][$fields['username']],
			$request->data[$model][$fields['password']]
		);
	}

/**
 * _password method
 *
 * @access protected
 * @param string $password
 * @return string
 */
	protected function _password($password) {
		return Security::hash($password, 'md5', false);
	}

}