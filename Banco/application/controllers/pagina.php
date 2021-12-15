<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagina extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('funcoes_helper');
		$this->load->model('usuario_model', 'usuario');
		$this->load->model('contas_model', 'conta');
	}


	public function index(){
		//regras de validação
		$this->form_validation->set_rules('login', 'NOME', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('senha', 'SENHA', 'trim|required|min_length[6]');

		//verifica validação
		if($this->form_validation->run() == FALSE){
			if(validation_errors()){
				set_msg(validation_errors());
			}
		}else{
			$dados_form = $this->input->post();
			if($result = $this->usuario->get($dados_form['login'])){
				$dados = $this->conta->get($result->id);
				//usuário existe
				if(password_verify($dados_form['senha'], $result->Senha)){
					//senha ok, fazer login
					$this->session->set_userdata('logged', TRUE);
					$this->session->set_userdata('user_login', $dados_form['login']);
					$this->session->set_userdata('user_email', $result->Email);
					$this->session->set_userdata('user_name', $result->NomeCompleto);
					$this->session->set_userdata('user_id', $result->id);
					$this->session->set_userdata('Numero', $dados->Numero);
					$this->session->set_userdata('Digito', $dados->Digito);
					$this->session->set_userdata('Pergunta', $result->Pergunta);
					$this->session->set_userdata('Resposta', $result->Resposta);
	
					//fazer redirect para home do painel
					redirect('conta','refresh');
				}else{
					//senha incorreta
					set_msg('<p>Senha incorreta!</p>');
				}
			}else{
				//usuario não existe
				set_msg('<p>Usuário inexistente!</p>');
			}
		}

		//Carrega view
		$dados_login['titulo'] = 'Banco Pirapora - Acesso a conta';
		$dados_login['h2'] = 'Acessar a conta';
		$this->load->view('home', $dados_login);
	}

	public function cadastro(){
		//regras de validação
		$this->form_validation->set_rules('nome', 'NOME COMPLETO', 'trim|required|min_length[10]');
		$this->form_validation->set_rules('login', 'NOME PARA LOGIN', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('email', 'EMAIL', 'trim|required|valid_email');
		$this->form_validation->set_rules('cpf', 'CPF', 'trim|required|min_length[14]');
		$this->form_validation->set_rules('endereco', 'ENDEREÇO', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('numero', 'NUMERO', 'trim|required');
		$this->form_validation->set_rules('bairro', 'BAIRRO', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('cidade', 'CIDADE', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('pergunta', 'PERGUNTA DE SEGURANÇA', 'trim|required');
		$this->form_validation->set_rules('resposta', 'RESPOSTA', 'trim|required');
		$this->form_validation->set_rules('senha', 'SENHA', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('senha2', 'REPITA A SENHA', 'trim|required|min_length[6]|matches[senha]');
		$this->form_validation->set_rules('tipo', 'Tipo da conta', 'trim|required');

		//verifica a validação
		if($this->form_validation->run() == FALSE){
			if(validation_errors()){
				set_msg(validation_errors());
			}
		}else{
			$dados_form = $this->input->post();

			if($usuario = $this->usuario->get_usuario($dados_form['login'])){
				set_msg('<p>Usuário já existe tente outro!</p>');
			}else if($nome = $this->usuario->get_cpf($dados_form['cpf'])){
				set_msg('<p>Você já possui uma conta, por favor faça login!</p>');
			}else{
				$dados['NomeCompleto'] = $dados_form['nome'];
				$dados['Usuario'] = $dados_form['login'];
				$dados['Email'] = $dados_form['email'];
				$dados['CPF'] = $dados_form['cpf'];
				$dados['Endereco'] = $dados_form['endereco'];
				$dados['Numero'] = $dados_form['numero'];
				$dados['Bairro'] = $dados_form['bairro'];
				$dados['Cidade'] = $dados_form['cidade'];
				$dados['Pergunta'] = $dados_form['pergunta'];
				$dados['Resposta'] = password_hash($dados_form['resposta'], PASSWORD_DEFAULT);
				$dados['senha'] = password_hash($dados_form['senha'], PASSWORD_DEFAULT);
				if($this->usuario->salvar($dados)){
					set_msg('<p>Usuário cadastrado com sucesso!</p>');
	 			}else{
					set_msg('<p>Erro! Não foi possivel cadastrar as informações</p>');
				}

				$sit = true;
				$id = $this->usuario->get_id($dados_form['login']);

				while($sit){
					$num = rand(1, 9999999);
					$digito = rand(0, 9);
					$sit = $this->conta->testa_conta($num, $digito);
					$conta['idTitular'] = $id->id;
					$conta['Numero'] = $num;
					$conta['Digito'] = $digito;
					$conta['Agencia'] = '0599';
					$conta['Operacao'] = '012';
					$conta['Tipo'] = $dados_form['tipo'];
				}

				if($this->conta->salvar($conta)){
					set_msg('<p>Conta criada com sucesso!</p>');
					$result = $this->usuario->get_id($dados['Usuario']);
					$this->session->set_userdata('logged', TRUE);
					$this->session->set_userdata('user_login', $dados['Usuario']);
					$this->session->set_userdata('user_email', $dados['Email']);
					$this->session->set_userdata('user_name', $dados['NomeCompleto']);
					$this->session->set_userdata('user_id', $result->id);
					$this->session->set_userdata('Numero', $conta['Numero']);
					$this->session->set_userdata('Digito', $conta['Digito']);
					$this->session->set_userdata('Pergunta', $dados['Pergunta']);
					$this->session->set_userdata('Resposta', $dados['Resposta']);
	 			}else{
					set_msg('<p>Erro! Não foi possivel cadastrar as informações</p>');
				}
				
				redirect('conta');
			}
		}
		//Carrega view
		$dados['titulo'] = 'Banco Pirapora - Cadastro de conta';
		$dados['h2'] = 'Criar uma conta';
		$this->load->view('cadastro', $dados);
	}

	public function troca_senha(){
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('cpf', 'CPF', 'trim|required|min_length[14]');
		$this->form_validation->set_rules('usuario', 'Usuário', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('senha', 'Senha', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('pergunta', 'Resposta de segurança', 'trim|required');
		$this->form_validation->set_rules('teste', 'Responda a operação', 'trim|required');

		if($this->form_validation->run() == FALSE){
			if(validation_errors()){
				set_msg(validation_errors());
			}
		}else{
			$dados_form = $this->input->post();

			$result = $this->usuario->get($dados_form['usuario']);

			if(password_verify($dados_form['pergunta'], $result->Resposta) && $dados_form['num1'] + $dados_form['num2'] == $dados_form['teste'] && $dados_form['email'] == $result->Email && $dados_form['cpf'] == $result->CPF && $dados_form['usuario'] == $result->Usuario){

				$dados['id'] = $result->id;
				$dados['Senha'] = password_hash($dados_form['senha'], PASSWORD_DEFAULT);
				
				if($this->usuario->salvar($dados)){
					set_msg('<p>Senha alterada com sucesso</p>');
					redirect('home');
				}else{
					set_msg('<p>Não foi possível alterar a senha 1</p>');
				}
			}else{
				set_msg('<p>Não foi possível alterar a senha 2</p>');
			}
		}

		$dados['h2'] = 'Esqueci minha senha';
		$dados['$titulo'] = 'Troca senha';
		$this->load->view('troca_senha', $dados);
	}
}