<?php $this->load->view('painel/header'); ?>
	<div class="linha">
		<div class="coluna col2">
			<ul class="sem-marcador sem-padding">
				<li><a href="<?= base_url('noticia/cadastrar') ?>">INSERIR</a></li>
				<li><a href="<?= base_url('noticia/listar') ?>">LISTAR</a></li>
			</ul>
		</div>
		<div class="coluna col10">
			<h2><?= $h2 ?></h2>
			<?php
				if($msg = get_msg()){
					echo '<div class="msg-box">'.$msg.'</div>';
				}

				echo form_open();
				echo form_label('Nome para login:', 'login');
				echo form_input('login', set_value('login'), array('autofocus' => 'autofocus'));
				echo form_label('Email do administrador do site:', 'email');
				echo form_input('email', set_value('email'));
				echo form_label('Senha (deixe em branco para não alterar):', 'senha');
				echo form_password('senha');
				echo form_label('Repita a senha:', 'senha2');
				echo form_password('senha2');
				echo form_label('Nome do site:', 'nome_site');
				echo form_input('nome_site', set_value('nome_site'));
				echo form_submit('enviar', 'Salvar dados', array('class' => 'botao'));
				echo form_close();
			?>
		</div>
	</div>
<?php $this->load->view('painel/footer'); ?>