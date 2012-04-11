<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<?php echo $this->Html->charset(); ?>
		<title>Diplomas - <?php echo $title_for_layout; ?></title>
		<?php
			echo $this->Html->meta('icon');

			echo $this->Util->js();
			echo $this->Html->css(array(
				'bootstrap',
				'bootstrap-responsive',
			));
			echo $this->Html->script(array(
				'jquery',
				'bootstrap',
			));

			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->fetch('script');
		?>
		<style type="text/css">
		body {
			padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
		}
		</style>
	</head>
	<body>
		<?php echo $this->element('nav');?>
		<div id="container-fluid">
			<div id="row-fluid">
				<?php echo $this->element('menu');?>

				<div class="span9">
					<?php echo $this->Session->flash(); ?>
					<?php echo $this->Session->flash('auth'); ?>
					
					<?php echo $this->fetch('content'); ?>
					<?php echo $this->element('footer');?>
				</div>
			</div>
		</div>
	</body>
	<?php echo $this->Js->writeBuffer();?>
</html>