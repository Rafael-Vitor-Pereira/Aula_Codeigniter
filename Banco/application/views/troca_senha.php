<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->view('header');
?>
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
						echo form_label('Usuário:', 'usuario');
						echo form_input('usuario');
						echo form_label('Email:', 'email');
						echo form_input('email');
						echo form_label('CPF:', 'cpf');
						echo form_input('cpf');
						echo form_label('Nova Senha:', 'senha_nova');
						echo form_password('senha_nova');
						echo form_label('Confirmar Senha:', 'senha');
						echo form_password('senha');
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