<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<?php echo $this->Html->charset(); ?>
		<title>
			Diplomas - 
			<?php echo $title_for_layout; ?>
		</title>
		<?php
			echo $this->Html->meta('icon');

			echo $this->Html->css(array(
				'bootstrap',
				'bootstrap-responsive',
			));
			echo $this->Html->script(array(
				'jquery',
				'jquery.maskedinput',
				'bootstrap',
			));

			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->fetch('script');
		?>
	</head>
	<body>
		<?php echo $this->element('nav');?>
		<div id="container">
			<div id="content">
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->Session->flash('auth'); ?>

				<?php echo $this->fetch('content'); ?>

				<?php echo $this->element('menu');?>
			</div>
			<?php echo $this->element('footer');?>
		</div>
	</body>
	<?php echo $this->Js->writeBuffer();?>
</html>
