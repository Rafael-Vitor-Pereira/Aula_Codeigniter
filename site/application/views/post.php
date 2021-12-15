<?php $this->load->view('header'); ?>
	<div class="linha">
		<section>
			<div class="coluna col8">
				<h2><?= $not_titulo ?></h2>
				<?= $not_conteudo ?>
			</div>
			<div class="coluna col4 sidebar">
				<h3>Dados do post</h3>
				<img src="<?= base_url('uploads/'.$not_imagem) ?>" alt="<?= $not_titulo ?>" />
				<ul>
					<li>Publicada em: </li>
					<li>Autor: </li>
				</ul>
			</div>
		</section>
	</div>
	<div class="conteudo-extra">
		<div class="linha">
			<div class="coluna col7">
				<section>
					<h2>Curiosidade</h2>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
					<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
					<p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
					<p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
				</section>
			</div>
			<div class="coluna col5">
				<?php $this->load->view('noticias'); ?>
			</div>
		</div>
	</div>
<?php $this->load->view('footer'); ?>