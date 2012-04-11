<?php
App::uses('AppModel', 'Model');

class Usuario extends AppModel {

	public $displayField = 'login';

	public $useTable = 'usuario';

}