<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Pagina extends CI_Controller{

		function __construct(){
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('option_model', 'option');
			$this->load->model('noticia_model', 'noticia');
		}

		public function index(){
			$dados['titulo'] = 'RBernardi Desenvolvimento Web';
			$this->load->view('home', $dados);
		}

		public function clientes(){
			$dados['titulo'] = 'Clientes - RBernardi Desenvolvimento Web';
			$this->load->view('clientes', $dados);
		}

		public function servicos(){
			$dados['titulo'] = 'O que eu faço - RBernardi Desenvolvimento Web';
			$this->load->view('servicos', $dados);
		}

		public function sobre(){
			$dados['titulo'] = 'Sobre mim - RBernardi Desenvolvimento Web';
			$this->load->view('sobre', $dados);
		}

		public function contato(){
			$this->load->helper('form');
			$this->load->library(array('form_validation', 'email'));

			//regras de validação do formulario
			$this->form_validation->set_rules('nome', 'Nome', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('assunto', 'Assunto', 'trim|required');
			$this->form_validation->set_rules('mensagem', 'Mensagem', 'trim|required');

			//verificação de validação
			if($this->form_validation->run() == FALSE){
				//validação não executada
				$dados['formerror'] = validation_errors();
			}else{
				//validação executada
				$dados_form = $this->input->post();
				$this->email->from($dados_form['email'], $dados_form['nome']);
				$this->email->to('rafaelpereira0599@gmail.com');
				$this->email->subject($dados_form['assunto']);
				$this->email->message($dados_form['mensagem']);
				if($this->email->send()){
					$dados['formerror'] = 'Email enviado com sucesso';
				}else{
					$dados['formerror'] = 'Erro ao enviar email, tente novamente em alguns minutos';
				}
			}

			$dados['titulo'] = 'Fale comigo - RBernardi Desenvolvimento Web';
			$this->load->view('contato', $dados);
		}

		public function post(){
			if(($id = $this->uri->segment(2)) > 0){
				if($noticia = $this->noticia->get_single($id)){
					$dados['titulo'] = to_html($noticia->titulo).' - RBernardi';
					$dados['not_titulo'] = to_html($noticia->titulo);
					$dados['not_conteudo'] = to_html($noticia->conteudo);
					$dados['not_imagem'] = $noticia->imagem;
				}else{
					$dados['titulo'] = 'Página não encontrada - RBernardi';
					$dados['not_titulo'] = 'Notícia não encontrada';
					$dados['not_conteudo'] = '<p>Nenhuma notícia foi encontrada com base nos parâmetros fornecidos</p>';
					$dados['not_imagem'] = '';
				}
			}else{
				redirect(base_url(), 'refresh');
			}
			$this->load->view('post', $dados);
		}
	}
?>