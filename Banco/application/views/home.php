<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?= $titulo ?></title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="<?php echo base_url('assets/css/normalize.css'); ?>">
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/estilo.css'); ?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/painel.css'); ?>">
	</head>
	<body>
		<div class="linha">
			<div class="coluna col4">&nbsp;</div>
			<div class="coluna col4 login">
				<center>
					<h2><?= $h2 ?></h2>
				</center>
				<?php
					if($msg = get_msg()){
						echo '<div class="alert alert-danger" role="alert">';
						echo '<button type="button" class="close" data-dismiss="alert" aria-label="Fechar">';
						echo '<span aria-hidden="true">&times;</span></button>'.$msg.'</div>';
					}
					echo form_open();
					echo form_label('Usuário:', 'login');
					echo form_input('login', set_value('login'), array('autofocus' => 'autofocus'));
					echo form_label('Senha:', 'senha');
					echo form_password('senha');
					echo form_submit('enviar', 'Autenticar', array('class' => 'botao'));
					echo form_close();
				?>
				<center>
					<h6>
						Ainda não possui conta abra a sua 
						<a href="<?php echo base_url('cadastro'); ?>">aqui</a>
					</h6>
				</center>

				<center>
					<h6>
						<a href="<?php echo base_url('troca_senha'); ?>">Esqueci minha senha</a>
					</h6>
				</center>
			</div>
			<div class="coluna col4">&nbsp;</div>
		</div>
	</body>
</html>