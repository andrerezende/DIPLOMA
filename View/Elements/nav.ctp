<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container-fluid">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<?php echo $this->Html->link('Geração de Diplomas', '/', array('class' => 'brand'));?>
			<div class="nav-collapse">
				<ul class="nav pull-right">
					<?php if (isset($userData) && !empty($userData)) :?>
						<li>
							<p class="navbar-text">
								<?php echo $this->Html->link('<i class="icon-user icon-white"></i> ' . $userData['login'], '#', array('escape' => false));?>
							</p>
						</li>
						<li class="divider-vertical"></li>
						<li><?php echo $this->Html->link(__('Sair') . ' <i class="icon-off icon-white"></i>', array('controller' => 'usuarios', 'action' => 'logout'), array('escape' => false));?></li>
					<?php else:?>
						<li class="divider-vertical"></li>
						<li><?php echo $this->Html->link('Entrar', array('controller' => 'usuarios', 'action' => 'login'));?></li>
					<?php endif;?>
				</ul>
			</div>
		</div>
	</div>
</div>