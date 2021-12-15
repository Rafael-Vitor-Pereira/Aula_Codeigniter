<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
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
		<style type="text/css">
			.cabecalho{
				text-align: center;
			}
			.conteudo{
				padding: 10px 20px;
				text-align: center;
			}
		</style>
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
						<br>
						<table>
							<tr>
								<th class="cabecalho">Data</th>
								<th class="cabecalho">Hora</th>
								<th class="cabecalho">Movimentação</th>
								<th class="cabecalho">Valor</th>
							</tr>
							<?php 
								foreach ($dados as $linha) {
							?>
							<tr>
								<td class="conteudo"><?= $linha->DataMovimentacao ?></td>
								<td class="conteudo"><?= $linha->Hora ?></td>
								<td class="conteudo"><?= $linha->TipoMovimentacao ?></td>
								<td class="conteudo"><?= $linha->Valor ?></td>
							</tr>
							<?php
								}
							?>
						</table>
					</center>
				</div>
				<div class="coluna col3">&nbsp;</div>
			</div>
		</div>
	<?php $this->load->view('footer'); ?>