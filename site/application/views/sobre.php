<?php $this->load->view('header'); ?>
	<div class="linha">
		<section>
			<div class="coluna col8">
				<h2>Sobre mim</h2>
				<p>Ut vehicula interdum augue, non eleifend sem iaculis a. </p>
				<p>Vestibulum vitae elit commodo, maximus magna vel, vehicula urna. Ut vitae porta mauris, vel luctus mauris.</p>
				<p>Maecenas est tortor, cursus et mauris et, rhoncus aliquam lorem. Mauris venenatis mollis ultrices.</p>
				<p>Ut vehicula interdum augue, non eleifend sem iaculis a.Vestibulum vitae elit commodo, maximus magna vel, vehicula urna. Ut vitae porta mauris, vel luctus mauris.</p>
				<h2>Porque trabalho com web</h2>
				<p>Ut vehicula interdum augue, non eleifend sem iaculis a. Vestibulum vitae elit commodo, maximus magna vel, vehicula urna.</p>
				<p>Ut vitae porta mauris, vel luctus mauris. Maecenas est tortor, cursus et mauris et, rhoncus aliquam lorem. Mauris venenatis mollis ultrices.</p>
				<p>Maecenas est tortor, cursus et mauris et, rhoncus aliquam lorem. Mauris venenatis mollis ultrices.</p>
			</div>
			<div class="coluna col4 sidebar">
				<h3>Formação profissional</h3>
				<img src="<?= base_url('assets/img/formatura.jpg') ?>" alt="" />
				<ul>
					<li></li>
				</ul>
				<h3>Áreas de conhecimento</h3>
				<ul>
					<li>HTML e CSS</li>
					<li>Javascript</li>
					<li>PHP</li>
					<li>Mysql</li>
					<li>C e C#</li>
				</ul>
			</div>
		</section>
	</div>
	<div class="conteudo-extra">
		<div class="linha">
			<div class="coluna col7">
				<section>
					<h2>Curiosidade</h2>
					<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
					<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
					<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
					<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
				</section>
			</div>
			<div class="coluna col5">
				<?php $this->load->view('noticias'); ?>
			</div>
		</div>
	</div>
<?php $this->load->view('footer'); ?>