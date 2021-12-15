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

				switch($tela){
					case 'listar':
						if(isset($noticias) && sizeof($noticias) > 0){
							?>
							<table>
								<thead>
									<th align="left">Título</th>
									<th align="right">Ações</th>
								</thead>
								<tbody>
									<?php
										foreach($noticias as $linha){
											?>
											<tr>
												<td class="titulo-noticia"><?= $linha->titulo ?></td>
												<td align="right" class="acoes"><?= anchor('noticia/editar/'.$linha->id, 'Editar') ?> | <?= anchor('noticia/excluir/'.$linha->id, 'Excluir') ?> | <?= anchor('post/'.$linha->id, 'Ver', array('target' => '_blank')) ?></td>
											</tr>
											<?php
										}
									?>
								</tbody>
							</table>
							<?php
						}else{
							echo '<div class="msg-box"><p>Nenhuma notícia cadastrada!</p></div>';
						}
						break;
					case 'cadastrar':
						echo form_open_multipart();
						echo form_label('Titulo:', 'titulo');
						echo form_input('titulo', set_value('titulo'));
						echo form_label('Conteúdo:', 'conteudo');
						echo form_textarea('conteudo', to_html(set_value('conteudo')), array('class' => 'editorhtml'));
						echo form_label('Imagem da noticia (thumbnail):', 'imagem');
						echo form_upload('imagem');
						echo form_submit('enviar', 'Salvar noticia', array('class' => 'botao'));
						echo form_close();
						break;
					case 'editar':
						echo form_open_multipart();
						echo form_label('Titulo:', 'titulo');
						echo form_input('titulo', set_value('titulo', to_html($noticia->titulo)));
						echo form_label('Conteúdo:', 'conteudo');
						echo form_textarea('conteudo', to_html(set_value('conteudo', $noticia->titulo)), array('class' => 'editorhtml'));
						echo form_label('Imagem da noticia (thumbnail):', 'imagem');
						echo form_upload('imagem');
						echo '<p><small>Imagem atual:</small><br /><img src="'.base_url('uploads/'.$noticia->imagem).'" class="thumb-edicao" /></p>';
						echo form_submit('enviar', 'Salvar noticia', array('class' => 'botao'));
						echo form_close();
						break;
					case 'excluir':
						echo form_open_multipart();
						echo form_label('Titulo:', 'titulo');
						echo form_input('titulo', set_value('titulo', to_html($noticia->titulo)));
						echo form_label('Conteúdo:', 'conteudo');
						echo form_textarea('conteudo', to_html(set_value('conteudo', $noticia->conteudo)), array('class' => 'editorhtml'));
						echo '<p><small>Imagem:</small><br /><img src="'.base_url('uploads/'.$noticia->imagem).'" class="thumb-edicao" /></p>';
						echo form_submit('enviar', 'Excluir noticia', array('class' => 'botao'));
						echo form_close();
						break;
				}
			?>
		</div>
	</div>
<?php $this->load->view('painel/footer'); ?>0