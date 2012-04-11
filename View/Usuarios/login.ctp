<div class="hero-unit">
	<?php echo $this->Form->create();?>
		<fieldset>
			<?php
			echo $this->Form->input('login');
			echo $this->Form->input('senha', array('type' => 'password'));
			?>
			<div class="form-actions">
				<?php echo $this->Form->submit(__('Login'), array('class' => 'btn btn-primary'));?>
			</div>
		</fieldset>
	<?php echo $this->Form->end();?>
</div>