<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?= $titulo ?></title>
		<link rel="stylesheet" href="<?php echo base_url('assets/css/normalize.css'); ?>">
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/estilo.css'); ?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/painel.css'); ?>">
	</head>
	<body>
		<div class="linha">
			<div class="coluna col4">&nbsp;</div>
			<div class="coluna col4 login">
				<h2><?= $h2 ?></h2>
				<?php
					if($msg = get_msg()){
						echo '<div class="msg-box">'.$msg.'</div>';
					}
					echo form_open();
					echo form_label('Usuário:', 'login');
					echo form_input('login', set_value('login'), array('autofocus' => 'autofocus'));
					echo form_label('Senha:', 'senha');
					echo form_password('senha');
					echo form_submit('enviar', 'Autenticar', array('class' => 'botao'));
					echo form_close();
				?>
			</div>
			<div class="coluna col4">&nbsp;</div>
		</div>
	</body>
</html>