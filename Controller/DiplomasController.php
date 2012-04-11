<?php
App::uses('AppController', 'Controller');

class DiplomasController extends AppController {

	public function gerar() {
		$this->set('title_for_layout', __('Gerar'));
		if ($this->request->is('post')) {
			
		}
	}

	public function getNomeAluno() {
		if ($this->request->is('ajax')) {
			$aluno = $this->Diploma->getNomeAluno($this->request->query['cpf']);
			if (!empty($aluno)) {
				$this->set('aluno', $aluno);
			} else {
				$this->set('erro', 'Nenhuma aluno encontrado com este CPF');
			}
			
		}
	}

}