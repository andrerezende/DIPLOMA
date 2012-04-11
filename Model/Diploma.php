<?php
App::uses('AppModel', 'Model');
App::uses('Sanitize', 'Utility');

class Diploma extends AppModel {
	public $displayField = 'numero';

	public $useTable = 'documento_identificacao';

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