	<?php $this->load->view('header'); ?>
	<div class="linha">
		<section>
			<div class="coluna col3 sidebar">
				<h3>Clientes satisfeitos</h3>
				<ul class="sem-marcador sem-padding">
					<li><a href="">Nome da Empresa 1</a></li>
					<li><a href="">Nome da Empresa 2</a></li>
					<li><a href="">Nome da Empresa 3</a></li>
					<li><a href="">Nome da Empresa 4</a></li>
					<li><a href="">Nome da Empresa 5</a></li>
					<li><a href="">Nome da Empresa 6</a></li>
					<li><a href="">Nome da Empresa 7</a></li>
				</ul>
				<a href="<?= base_url('clientes') ?>" class="botao">Ver todos &raquo;</a>
			</div>
			<div class="coluna col9">
				<h2>Último trabalho: <em>Empresa ABC</em></h2>
				<img src="<?php echo base_url('assets/img/thumb-grande.jpg'); ?>" alt="" />
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
				<a href="<?= base_url('clientes') ?>" class="botao">Ver outros trabalhos &raquo;</a>
			</div>
		</section>
	</div>
	<div class="conteudo-extra">
		<div class="linha">
			<div class="coluna col7">
				<section>
					<h2>Como um site pode ajudar sua empresa?</h2>
					<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
					<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
					<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
				</section>
			</div>
			<div class="coluna col5">
				<?php $this->load->view('noticias'); ?>
			</div>
		</div>
	</div>
	<?php $this->load->view('footer'); ?>