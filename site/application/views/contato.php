	<?php $this->load->view('header'); ?>
		<div class="linha">
			<section>
				<div class="coluna col5 sidebar">
					<h3>Localização</h3>
					<img src="<?php echo base_url('assets/img/mapa.jpg'); ?>">
					<ul class="sem-padding sem-marcador">
						<li>Rua Julio Cesár Batista, 350</li>
						<li>Bairro Shekinah</li>
						<li>Pirapora - MG</li>
					</ul>
					<h3>Contato direto</h3>
					<ul class="sem-padding sem-marcador">
						<li>Fone: <strong>(38) 99190-6355</strong></li>
						<li>Email: <strong>rafaelpereira0599@gmail.com</strong></li>
						<li>Skype: <strong>login.skype</strong></li>
					</ul>
				</div>
				<div class="coluna col7">
					<h2>Envie uma mensagem</h2>
					<?php
						if($formerror){
							echo '<p>'.$formerror.'</p>';
						}
						echo form_open('pagina/contato');
						echo form_label('Seu nome:', 'nome');
						echo form_input('nome', set_value('nome'));
						echo form_label('Seu email:', 'email');
						echo form_input('email', set_value('email'));
						echo form_label('Assunto:', 'assunto');
						echo form_input('assunto', set_value('assunto'));
						echo form_label('Mensagem:', 'mensagem');
						echo form_textarea('mensagem', set_value('mensagem'));
						echo form_submit('enviar', 'Enviar mensagem >>', array('class' => 'botao'));
						echo form_close();
					?>
				</div>
			</section>
		</div>
		<div class="conteudo-extra">
			<div class="linha">
				<div class="coluna col7">
					<section>
						<h2>Método alternativo de contato</h2>
						<p>Caso você não consiga me contatar por algum dos meios acima, possivelmente eu estarei em uma ilha deserta em algum lugar do pacifico. Neste caso há duas possibilidades:</p>
						<ol>
							<li>Enviar uma mensagem em uma garrafa</li>
							<li>Tentar um sinal de fumaça</li>
						</ol>
						<p>Mas sinceramente não sei se algum desses métodos será eficiente, tente por susa conta e risco :D</p>
					</section>
				</div>
				<div class="coluna col5">
					<?php $this->load->view('noticias'); ?>
				</div>
			</div>
		</div>
	<?php $this->load->view('footer'); ?>