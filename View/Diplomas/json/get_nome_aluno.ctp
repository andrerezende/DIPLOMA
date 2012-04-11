<?php
if (isset($aluno['Pessoa']['nome'])) {
	echo $aluno['Pessoa']['nome'];
} else if (isset($erro) && !empty($erro)) {
	echo $this->Html->tag('p', $erro);
}