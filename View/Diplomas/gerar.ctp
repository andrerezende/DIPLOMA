<script type="text/javascript">
$(document).ready(function() {
	$("#btnReset").click(function(e) {
		e.preventDefault();
		$('#DiplomaGerarForm').get(0).reset();
		$("#gerar").button("reset");
	});
	$('#DiplomaGerarForm').submit(function(e) {
		e.preventDefault();
		var btn = $("#gerar");
		btn.button("loading");

		$.ajax({
			type: "GET",
			dataType: "text",
			url: Diplomas.basePath + Diplomas.params["controller"] + "/getNomeAluno.json",
			data: "cpf=" + $("#DiplomaCpf").val(),
			success: function(data, textStatus, jqXHR) {
				console.log(data);
				console.log($(data).is("p"));
				if ($(data).is("p")) {
					$("#modal-text").html(data);
					$("#error").modal({
						backdrop: true,
						keyboard: true,
						show: true
					});
				} else {
					$("#DiplomaNome").val(data);
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(jqXHR);
				console.log(textStatus);
				console.log(errorThrown);
			},
			complete: function(jqXHR, textStatus) {
				if ($("#DiplomaNome").val() != undefined) {
					btn.button("complete");
				} else {
					$("#gerar").button("reset");
				}
			}
		});
	});
});
</script>
<div class="hero-unit">
	<?php
	echo $this->Form->create('Diploma', array(
		'class' => 'form-horizontal',
		'inputDefaults' => array(
			'div' => 'control-group',
			'between' => '<div class="controls">',
			'after' => '</div>',
			'class' => 'span3',
			'label' => array('class' => 'control-label'),
			'error' => array(
				'attributes' => array(
					'wrap' => 'div',
					'class' => 'alert alert-error'
				)
			),
		)
	));
	?>
		<fieldset>
			<legend>Gerar Diploma</legend>
			<?php
			echo $this->Form->input('cpf', array(
				'label' => array('text' => 'Digite o CPF do Aluno'),
			));
			echo $this->Form->input('nome', array(
				'label' => array('text' => 'Confirme o nome do Aluno'),
				'readonly' => 'readonly'
			));
			echo $this->Form->input('conclusao_curso', array(
				'label' => array('text' => 'Digite a data de Conclusão do Curso'),
			));
			echo $this->Form->input('emissao_diploma', array(
				'label' => array('text' => 'Digite a data de Emissão do Diploma'),
			));
			?>
			<div class="form-actions">
				<?php
				echo $this->Form->submit(__('Carregar'), array(
					'div' => false,
					'class' => 'btn btn-primary',
					'data-loading-text' => 'Carregando...',
					'data-complete-text' => 'Gerar',
					'id' => 'gerar'
				));
				echo $this->Form->button(__('Limpar'), array(
					'div' => false,
					'class' => 'btn',
					'type' => 'reset',
					'id' => 'btnReset',
				));
				?>
			</div>
		</fieldset>
	<?php echo $this->Form->end();?>
</div>

<div class="modal hide fade" id="error">
	<div class="modal-header">
		<a class="close" data-dismiss="modal">&times;</a>
		<h3>Alerta!</h3>
	</div>
	<div class="modal-body" id="modal-text"></div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal">Fechar</a>
	</div>
</div>