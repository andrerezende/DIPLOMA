<?php
App::uses('AppModel', 'Model');
App::uses('Sanitize', 'Utility');

/**
 * Diploma
 *
 * PHP version 5
 *
 * @package     Model
 * @author      Vitor Pacheco <vitor.pacheco@ifbaiano.edu.br>
 */
class Diploma extends AppModel {

/**
 * Display field
 *
 * @access public
 * @var string
 */
	public $displayField = 'numero';

/**
 * Use table
 *
 * @access public
 * @var string
 */
	public $useTable = 'documento_identificacao';

/**
 * getNomeAluno method
 *
 * @access public
 * @return array
 */
	public function getNomeAluno($cpf) {
		return $this->find('first', array(
			'fields' => 'Pessoa.nome',
			'conditions' => array('Diploma.numero' => Sanitize::clean($cpf), 'Diploma.tipo_doc_identificacao' => 'CPF'),
			'joins' => array(
				array(
					'alias' => 'Pessoa',
					'table' => 'pessoa_fisica',
					'type' => 'LEFT',
					'conditions' => array('Pessoa.id = Diploma.pessoa_fisica_id'),
				),
			),
		));
	}
}