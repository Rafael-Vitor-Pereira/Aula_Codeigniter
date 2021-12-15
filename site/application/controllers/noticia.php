<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Noticia extends CI_Controller{

		function __construct(){
			parent::__construct();
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->load->model('option_model', 'option');
			$this->load->model('noticia_model', 'noticia');
		}

		public function index(){
			redirect('noticia/listar', 'refresh');
		}

		public function listar(){
			//verifica se o usuário está logado
			verifica_login();

			//carrega a view
			$dados['titulo'] = 'RBernardi - Listagem de noticias';
			$dados['h2'] = 'Listagem de noticias';
			$dados['tela'] = 'listar';
			$dados['noticias'] = $this->noticia->get();
			$this->load->view('painel/noticias', $dados);
		}

		public function cadastrar(){
			verifica_login();

			//regras de validação
			$this->form_validation->set_rules('titulo', 'TÍTULO', 'trim|required');
			$this->form_validation->set_rules('conteudo', 'CONTEÚDO', 'trim|required');

			//verifica validação
			if($this->form_validation->run() == FALSE){
				if(validation_errors()){
					set_msg(validation_errors());
				}
			}else{
				$this->load->library('upload', config_upload());
				if($this->upload->do_upload('imagem')){
					//upload foi efetuado
					$dados_upload = $this->upload->data();
					$dados_form = $this->input->post();
					$dados_insert['titulo'] = to_bd($dados_form['titulo']);
					$dados_insert['conteudo'] = to_bd($dados_form['conteudo']);
					$dados_insert['imagem'] = $dados_upload['file_name'];
					
					//salvar no banco de dados
					if($id = $this->noticia->salvar($dados_insert)){
						set_msg('<p>Noticia cadastrada com sucesso!</p>');
						redirect('noticia/editar/'.$id, 'refresh');
					}else{
						set_msg('<p>Erro! Notícia não cadastrada.</p>');
					}
				}else{
					//erro no upload
					$msg = $this->upload->display_errors();
					$msg .= '<p>São permitidos arquivos JPG e PNG de até 512KB.</p>';
					set_msg($msg);
				}
			}

			//carrega view
			$dados['titulo'] = 'RBernardi - Cadastro de noticias';
			$dados['h2'] = 'Cadastro de noticias';
			$dados['tela'] = 'cadastrar';
			$this->load->view('painel/noticias', $dados);
		}

		public function excluir(){
			verifica_login();
 
			//verifica se foi passado o id da noticia
			if(($id = $this->uri->segment(3)) > 0){
				//id infromado, continuar com exclusão
				if($noticia = $this->noticia->get_single($id)){
					$dados['noticia'] = $noticia;
				}else{
					set_msg('<p>Notícia inexistente! Escolha uma noticia para excluir.</p>');
					redirect('noticia/listar', 'refresh');
				}
			}else{
				set_msg('<p>Você deve escolher uma noticia para excluir!</p>');
				redirect('noticia/listar', 'refresh');
			}

			//regras de validação
			$this->form_validation->set_rules('enviar', 'ENVIAR', 'trim|required');

			//verifica a validação
			if($this->form_validation->run() == FALSE){
				if(validation_errors()){
					set_msg(validation_errors());
				}
			}else{
				$imagem = 'uploads/'.$noticia->imagem;
				if($this->noticia->excluir($id)){
					unlink($imagem);
					set_msg('<p>Noticia excluída com sucesso!</p>');
					redirect('noticia/listar', 'refresh');
				}else{
					set_msg('<p>Erro! Nenhuma notícia fou excluída!</p>');
				}
			}

			//carrega view
			$dados['titulo'] = 'RBernardi - Exclusão de noticias';
			$dados['h2'] = 'Exclusão de noticias';
			$dados['tela'] = 'excluir';
			$this->load->view('painel/noticias', $dados);	
		}

		public function editar(){
			verifica_login();

			//verifica se foi passado o id da noticia
			if(($id = $this->uri->segment(3)) > 0){
				//id informado, continuar com edição
				if($noticia = $this->noticia->get_single($id)){
					$dados['noticia'] = $noticia;
					$dados_update['id'] = $noticia->id;
				}else{
					set_msg('<p>Notícia inexistente! Escolha uma noticia para editar.</p>');
					redirect('noticia/listar', 'refresh');
				}
			}else{
				set_msg('<p>Você deve escolher uma noticia para editar!</p>');
				redirect('noticia/listar', 'refresh');
			}

			//regras de validação
			$this->form_validation->set_rules('titulo', 'TÍTULO', 'trim|required');
			$this->form_validation->set_rules('conteudo', 'CONTEÚDO', 'trim|required');

			//verifica a validação
			if($this->form_validation->run() == FALSE){
				if(validation_errors()){
					set_msg(validation_errors());
				}
			}else{
				$this->load->library('upload', config_upload());
				if(isset($_FILES['imagem']) && $_FILES['imagem']['name'] != ''){
					//foi enviada uma imagem, devo fazer upload
					if($this->upload->do_upload('imagem')){
						//upload foi efetuado
						$imagem_antiga = 'uploads/'.$noticia->imagem;
						$dados_upload = $this->upload->data();
						$dados_form = $this->input->post();
						$dados_update['titulo'] = to_bd($dados_form['titulo']);
						$dados_update['conteudo'] = to_bd($dados_form['conteudo']);
						$dados_update['imagem'] = $dados_upload['file_name'];
						if($this->noticia->salvar($dados_update)){
							unlink($imagem_antiga);
							set_msg('<p>Noticia alterada com sucesso!</p>');
							$dados['noticia']->imagem = $dados_update['imagem'];
						}else{
							set_msg('<p>Erro! Nenhuma alterção foi salva</p>');
						}
					}else{
						//erro no upload
						$msg = $this->upload->display_errors();
						$msg .= '<p>São permitidos arquivos JPG e PNG de até 512KB.</p>';
						set_msg($msg);
					}
				}else{
					//não foi enviada uma imagem pelo form
					$dados_form = $this->input->post();
					$dados_update['titulo'] = to_bd($dados_form['titulo']);
					$dados_update['conteudo'] = to_bd($dados_form['conteudo']);
					if($this->noticia->salvar($dados_update)){
						set_msg('<p>Noticia alterada com sucesso!</p>');
 					}else{
						set_msg('<p>Erro! Nenhuma alterção foi salva</p>');
					}
				}
			}

			//carrega view
			$dados['titulo'] = 'RBernardi - Alteração de noticias';
			$dados['h2'] = 'Alteração de noticias';
			$dados['tela'] = 'editar';
			$this->load->view('painel/noticias', $dados);	
		}
	}
?>