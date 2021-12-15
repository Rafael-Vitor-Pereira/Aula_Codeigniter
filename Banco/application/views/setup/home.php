<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->view('setup/header'); 
?>

<style type="text/css">
	.cabecalho-conta{
		background-color: whitesmoke; 
		padding: 10px 0px;
	}

	.campo{
		margin-top: 20px; 
		background-color: #1f3c58;
	}

	a.botao:hover{
		color: white;
		background-color: #1f3c58;
	}

	a.botao{
		padding: 10px 80px;
	}
</style>
	<br>
	<div style="min-height: calc(100vh - 157px);">
		<div class="linha cabecalho-conta">
			<div class="coluna col3">
				<span>Saldo: R$ <?php echo $conta->Saldo ?></span>
			</div>
			<div class="coluna col6">
				<center>
					<span><?php echo $titular->NomeCompleto ?></span>
				</center>
			</div>
			<div class="coluna col3">
				<span style="float: right;">
					<?php echo "0".$conta->Agencia."  0".$conta->Operacao."  ".$conta->Numero."-".$conta->Digito ?>
				</span>
			</div>
		</div>

		<div class="linha">
			<?php
				if($msg = get_msg()){
					echo '<div class="alert alert-success" role="alert">';
					echo '<button type="button" class="close" data-dismiss="alert" aria-label="Fechar">';
					echo '<span aria-hidden="true">&times;</span></button>'.$msg.'</div>';
				}
			?>
			<div class="coluna col4">
				<div class="campo">
					<center>
						<a href="<?= base_url('transferir') ?>" class='botao'>
							<span class="glyphicon glyphicon-transfer"></span> <br> Transferir
						</a>
					</center>
				</div>
			</div>
			<div class="coluna col4">
				<div class="campo">
					<center>
						<a href="<?= base_url('sacar') ?>" class='botao'>
							<span class="glyphicon glyphicon-arrow-up"></span> <br> Sacar
						</a>
					</center>
				</div>
			</div>
			<div class="coluna col4">
				<div class="campo">
					<center>
						<a href="<?= base_url('depositar') ?>" class='botao'>
							<span class="glyphicon glyphicon-download-alt"></span> <br> Depositar
						</a>
					</center>
				</div>
			</div>
		</div>
		<div class="linha">
			<div class="coluna col4">
				<div class="campo">
					<center>
						<a href="<?= base_url('extrato') ?>" class="botao">
							<span class="glyphicon glyphicon-list-alt"></span> <br> Extrato
						</a>
					</center>
				</div>
			</div>
			<div class="coluna col4">
				<div class="campo">
					<center>
						<a href="<?= base_url('alterar_senha') ?>" class="botao">
							<span class="glyphicon glyphicon-lock"></span> <br> Alterar Senha
						</a>
					</center>
				</div>
			</div>
			<div class="coluna col4">
				<div class="campo">
					<center>
						<a href="<?= base_url('alterar_usuario') ?>" class="botao">
							<span class="glyphicon glyphicon-user"></span> <br> Alterar Usuário
						</a>
					</center>
				</div>
			</div>
		</div>
		<div class="linha">
			<div class="coluna col4">
				<div class="campo">
					<center>
						<a href="<?= base_url('alterar_email') ?>" class="botao">
							<span class="glyphicon glyphicon-envelope"></span> <br> Alterar Email
						</a>
					</center>
				</div>
			</div>
			<div class="coluna col4">
				<div class="campo">
					<center>
						<a href="<?= base_url('alterar_endereco') ?>" class="botao">
							<span class="glyphicon glyphicon-road"></span> <br> Alterar Endereço
						</a>
					</center>
				</div>
			</div>
			<div class="coluna col4">
				<div class="campo">
					<center>
						<a href="<?= base_url('alterar_pergunta') ?>" class="botao">
							<span class="glyphicon glyphicon-edit"></span> <br> Alterar Pergunta
						</a>
					</center>
				</div>
			</div>
		</div>
		<div class="linha">
			<div class="coluna col4">
				<div class="campo">
					<center>
						<a href="<?= base_url('excluir') ?>" class="botao">
							<span class="glyphicon glyphicon-ban-circle"></span> <br> Excluir Conta
						</a>
					</center>
				</div>
			</div>
		</div>
	</div>
<?php $this->load->view('footer'); ?>