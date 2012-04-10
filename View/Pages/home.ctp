<div class="hero-unit">
	<h1>Geração de Diplomas</h1>

	<?php
	App::uses('Debugger', 'Utility');
	if (Configure::read('debug') > 0):
		Debugger::checkSecurityKeys();
	endif;
	?>
	<p>
	<?php
		if (version_compare(PHP_VERSION, '5.2.8', '>=')):
			echo '<div class="alert alert-success">';
				echo __d('cake_dev', 'Your version of PHP is 5.2.8 or higher.');
			echo '</div>';
		else:
			echo '<div class="alert alert-error">';
				echo __d('cake_dev', 'Your version of PHP is too low. You need PHP 5.2.8 or higher to use CakePHP.');
			echo '</div>';
		endif;
	?>
	</p>
	<p>
	<?php
		if (is_writable(TMP)):
			echo '<div class="alert alert-success">';
				echo __d('cake_dev', 'Your tmp directory is writable.');
			echo '</div>';
		else:
			echo '<div class="alert alert-error">';
				echo __d('cake_dev', 'Your tmp directory is NOT writable.');
			echo '</div>';
		endif;
	?>
	</p>
	<p>
	<?php
		$settings = Cache::settings('_cake_core_');
		if (!empty($settings)):
			echo '<div class="alert alert-success">';
					echo __d('cake_dev', 'The %s is being used for core caching. To change the config edit APP/Config/core.php ', '<em>'. $settings['engine'] . 'Engine</em>');
			echo '</div>';
		else:
			echo '<div class="alert  alert-error">';
				echo __d('cake_dev', 'Your cache is NOT working. Please check the settings in APP/Config/core.php');
			echo '</div>';
		endif;
	?>
	</p>
	<p>
	<?php
		$filePresent = null;
		if (file_exists(APP . 'Config' . DS . 'database.php')):
			echo '<div class="alert alert-success">';
				echo __d('cake_dev', 'Your database configuration file is present.');
				$filePresent = true;
			echo '</div>';
		else:
			echo '<div class="alert  alert-error">';
				echo __d('cake_dev', 'Your database configuration file is NOT present.');
				echo '<br/>';
				echo __d('cake_dev', 'Rename APP/Config/database.php.default to APP/Config/database.php');
			echo '</div>';
		endif;
	?>
	</p>
	<?php
	if (isset($filePresent)):
		App::uses('ConnectionManager', 'Model');
		try {
			$connected = ConnectionManager::getDataSource('default');
		} catch (Exception $e) {
			$connected = false;
		}
	?>
	<p>
		<?php
			if ($connected && $connected->isConnected()):
				echo '<div class="alert alert-success">';
					echo __d('cake_dev', 'Cake is able to connect to the database.');
				echo '</div>';
			else:
				echo '<div class="alert alert-error">';
					echo __d('cake_dev', 'Cake is NOT able to connect to the database.');
				echo '</div>';
			endif;
		?>
	</p>
	<?php endif;?>
	<?php
		App::uses('Validation', 'Utility');
		if (!Validation::alphaNumeric('cakephp')) {
			echo '<p><div class="alert  alert-error">';
			__d('cake_dev', 'PCRE has not been compiled with Unicode support.');
			echo '<br/>';
			__d('cake_dev', 'Recompile PCRE with Unicode support by adding <code>--enable-unicode-properties</code> when configuring');
			echo '</div></p>';
		}
	?>
</div>