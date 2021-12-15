	<?php $this->load->view('header'); ?>
		<div class="linha">
			<div class="coluna col3">&nbsp;</div>
			<div class="coluna col6">
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
					echo form_label('Nome completo:', 'nome');
					echo form_input('nome', set_value('nome'), array('autofocus' => 'autofocus'));
					echo form_label('Nome para login:', 'login');
					echo form_input('login', set_value('login'));
					echo form_label('Email do titular da conta:', 'email');
					echo form_input('email', set_value('email'));
					echo form_label('CPF do titular (com pontos e traço):', 'cpf');
					echo form_input('cpf', set_value('cpf'));
					echo form_label('Endereço:', 'endereco');
					echo form_input('endereco', set_value('endereco'));
					echo form_label('Numero:', 'numero');
					echo form_input('numero', set_value('numero'));
					echo form_label('Bairro:', 'bairro');
					echo form_input('bairro', set_value('bairro'));
					echo form_label('Cidade:', 'cidade');
					echo form_input('cidade', set_value('cidade'));
					echo form_label('Pergunta de segurança', 'pergunta');
					$perguntas = array(
						'       ' => 'Selecione',
						'Qual sua cor favorita?' => 'Qual sua cor favorita?',
						'Qual seu nome de solteiro(a)?' => 'Qual seu nome de solteiro(a)?',
						'Qual seu nome do meio?' => 'Qual seu nome do meio?',
						'Onde voce nasceu?' => 'Onde você nasceu?',
						'Qual o nome do seu pai/ sua mãe?' => 'Qual o nome do seu pai/ sua mãe?' 
					);
					echo  form_dropdown('pergunta', $perguntas);
					echo "<br><br>";
					echo form_label('Resposta', 'resposta');
					echo form_input('resposta');
					echo form_label('Senha:', 'senha');
					echo form_password('senha', set_value('senha'));
					echo form_label('Repita a senha:', 'senha2');
					echo form_password('senha2', set_value('senha2'));
					echo form_label('Tipo da Conta:');
					$options  =  array( 
						'		 ' => 'Selecione',
        				'poupança' => 'Poupança' , 
        				'corrente' => 'Conta Corrente' 
					);
					echo  form_dropdown('tipo', $options);
					echo "<br><br>";
					echo form_submit('enviar', 'Salvar dados', array('class' => 'botao'));
					echo form_close();
				?>
			</div>
			<div class="coluna col3">&nbsp;</div>
		</div>
	</body>
</html>