<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?= $titulo ?></title>
		<link rel="stylesheet" href="<?php echo base_url('assets/css/normalize.css'); ?>">
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/estilo.css'); ?>">
	</head>
	<body>
		<div class="header">
			<div class="linha">
				<header>
					<div class="coluna col4">
						<h1 class="logo">
							<?php
								echo $this->option->get_option('nome_site', 'Falta configurar');
							?>
						</h1>
					</div>
					<div class="coluna col8">
						<nav>
							<ul class="menu inline sem-marcador">
								<li><a href="<?= base_url() ?>">home</a></li>
								<li><a href="<?= base_url('clientes') ?>">clientes</a></li>
								<li><a href="<?= base_url('servicos') ?>">serviços</a></li>
								<li><a href="<?= base_url('sobre') ?>">sobre</a></li>
								<li><a href="<?= base_url('contato') ?>">contato</a></li>
							</ul>
						</nav>
					</div>
				</header>
			</div>
		</div>