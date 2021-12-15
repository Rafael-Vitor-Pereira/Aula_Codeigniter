		<h3>Últimas noticias</h3>
		<ul class="sem-marcador sem-padding noticias">
			<?php
				if($noticias = $this->noticia->get(3)){
					foreach($noticias as $linha){
						?>
						<li>
							<img src="<?= base_url('uploads/'.$linha->imagem) ?>" alt="" />
							<h4><?= to_html($linha->titulo) ?></h4>
							<p><?= resumo_post($linha->conteudo) ?>...
							<a href="<?= base_url('post/'.$linha->id) ?>">Leia mais &raquo;</a></p>
						</li>
						<?php
					}
				}else{
					echo '<p>Nenhuma notícia cadastrada!</p>';
				}
			?>
		</ul>