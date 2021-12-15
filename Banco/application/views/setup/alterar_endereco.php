<?php defined('BASEPATH') OR exit('No direct script access allowed');  ?>
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
		<div class="header">
			<div class="linha">
				<header>
					<div class="coluna col4">
						<h3 class="logo">Banco Pirapora</h3>
					</div>
					<div class="coluna col8">
						<nav>
							<ul class="menu inline sem-marcador">
								<li>
									<a href="<?= base_url('conta') ?>">
										<span class="glyphicon glyphicon-arrow-left"></span>
									</a>
								</li>
							</ul>
						</nav>
					</div>
				</header>
			</div>
		</div>
		<div style="min-height: calc(100vh - 136px);">
			<div class="linha">
				<div class="coluna col3">&nbsp;</div>
				<div class="coluna col6">
					<center>
						<h3><?= $h2 ?></h3>
					</center>
					<?php 
						if($msg = get_msg()){
							echo '<div class="alert alert-danger" role="alert">';
							echo '<button type="button" class="close" data-dismiss="alert" aria-label="Fechar">';
							echo '<span aria-hidden="true">&times;</span></button>'.$msg.'</div>';
						}
						$num1 = rand(0, 9);
						$num2 = rand(0, 9);
						echo form_open('');
						echo form_label('Endereço Antigo:', 'endereco_antigo');
						echo form_input('endereco_antigo');
						echo form_label('Endereço novo:', 'endereco_novo');
						echo form_input('endereco_novo');
						echo form_label('Número:', 'numero');
						echo form_input('numero');
						echo form_label('Bairro:', 'bairro');
						echo form_input('bairro');
						echo form_label('Cidade:', 'cidade');
						echo form_input('cidade');
						echo form_label('Resposta da pergunta de segurança:', 'pergunta');
						echo form_password('pergunta');
						echo form_label("Responda: ".$num1." + ".$num2, 'teste');
						echo form_input('teste');
						echo form_hidden('num1', $num1);
						echo form_hidden('num2', $num2);
						echo form_submit('enviar', 'Alterar', array('class' => 'botao'));
					?>
				</div>
				<div class="coluna col3">&nbsp;</div>
			</div>
		</div>
	<?php $this->load->view('footer'); ?>