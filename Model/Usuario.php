<?php
App::uses('AppModel', 'Model');

/**
 * Usuario
 *
 * PHP version 5
 *
 * @package     Model
 * @author      Vitor Pacheco <vitor.pacheco@ifbaiano.edu.br>
 */
class Usuario extends AppModel {

/**
 * Display field
 *
 * @access public
 * @var string
 */
	public $displayField = 'login';

/**
 * Use table
 *
 * @access public
 * @var string
 */
	public $useTable = 'usuario';

}