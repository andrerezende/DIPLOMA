<?php
App::uses('AppController', 'Controller');
App::import('Vendor', 'ClientSoap', array('file' => 'client.soap.php'));

/**
 * DiplomasController
 *
 * PHP version 5
 *
 * @package     Controller
 * @author      Vitor Pacheco <vitor.pacheco@ifbaiano.edu.br>
 *
 * @property    Diploma    $Diploma
 */
class DiplomasController extends AppController {

/**
 * gerar method
 *
 * @access public
 * @return void
 */
	public function gerar() {
		$this->set('title_for_layout', __('Gerar'));

		if ($this->request->is('post')) {
			$result = ws_get(
				Configure::read('Jasper.CurrentUri'),
				array('webservices_uri' => Configure::read('Jasper.WebServiceUri'), 'namespace' => Configure::read('Jasper.Namespace')),
				array('username' => Configure::read('Jasper.User'), 'password' => Configure::read('Jasper.Password'))
			);

			if (is_soap_fault($result)) {
				$errorMessage = $result->getFault()->faultstring;
				echo $errorMessage;
				exit();
			} else {
				$folders = getResourceDescriptors($result);
			}

			if (count($folders) != 1 || $folders[0]['type'] != 'reportUnit') {
				echo '<h1>Invalid RU (' . Configure::read('Jasper.CurrentUri') .')</h1>';
				echo '<pre>$result</pre>';
				exit();
			}

			$reportUnit = $folders[0];

			$report_params = array();

			$moveToPage = 'executeReport.php?uri=' . Configure::read('Jasper.CurrentUri');

			foreach ($this->request->data['Diploma'] as $param_name => $param_value) {
				$report_params[mb_strtoupper($param_name)] = $param_value;
			}
			$moveToPage .= '&page=';

			$output_params = array();
			$output_params[RUN_OUTPUT_FORMAT] = Configure::read('Jasper.Format');

			$result = ws_runReport(
				Configure::read('Jasper.CurrentUri'),
				$report_params,
				$output_params,
				$attachments,
				array('username' => Configure::read('Jasper.User'), 'password' => Configure::read('Jasper.Password'), 'webservices_uri' => Configure::read('Jasper.WebServiceUri'))
			);

			if (is_soap_fault($result)) {
				$errorMessage = $result->getFault()->faultstring;

				echo $errorMessage;
				exit();
			}

			$operationResult = getOperationResult($result);

			if ($operationResult['returnCode'] != '0') {
				echo "Error executing the report:<br /><font color=\"red\">".$operationResult['returnMessage']."</font>";
				exit();
			}

			if (is_array($attachments)) {
				if ($output_params[RUN_OUTPUT_FORMAT] == RUN_OUTPUT_FORMAT_PDF) {
					header ('Content-type: application/force-download name="Diploma-' . $this->request->data['Diploma']['nome'] .'-.pdf"');
					header ('Content-Disposition: attachment; filename="Diploma-' . $this->request->data['Diploma']['nome'] .'-.pdf"');
					echo ($attachments["cid:report"]);
				}
				exit();
			} else {
				echo "No attachment found!";
			}
		}
	}

/**
 * getNomeAluno method
 *
 * @access public
 * @return void
 */
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