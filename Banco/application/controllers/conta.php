<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Conta extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('funcoes_helper');
		$this->load->model('usuario_model', 'usuario');
		$this->load->model('contas_model', 'conta');
		$this->load->model('extrato_model', 'extrato');
	}


	public function index(){
		verifica_login();

		//Carrega view
		$dados['titular'] = $this->usuario->get($this->session->userdata('user_login'));
		$dados['conta'] = $this->conta->get($this->session->userdata('user_id'));
		$dados['titulo'] = 'Banco Pirapora';
		$this->load->view('setup/home', $dados);
	}

	public function logout(){
		//destroi dados da sessão
		$this->session->unset_userdata('logged');
		$this->session->unset_userdata('user_login');
		$this->session->unset_userdata('user_email');
		$this->session->unset_userdata('user_name');
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('Numero');
		$this->session->unset_userdata('Digito');
		$this->session->unset_userdata('Pergunta');
		$this->session->unset_userdata('Resposta');
		set_msg('<p>Você saiu do sistema</p>');
		redirect('pagina', 'refresh');
	}

	public function alterar_senha(){
		verifica_login();

		$this->form_validation->set_rules('senha_antiga', 'Senha Antiga', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('senha_nova', 'Nova Senha', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('senha', 'Confirme a Senha', 'trim|required|min_length[6]|matches[senha_nova]');
		$this->form_validation->set_rules('pergunta', 'Pergunta de segurança', 'trim|required');
		$this->form_validation->set_rules('teste', 'Responda a operação', 'trim|required');

		if($this->form_validation->run() == FALSE){
			if(validation_errors()){
				set_msg(validation_errors());
			}
		}else{
			$dados_form = $this->input->post();

			$dados['id'] = $this->session->userdata('user_id');
			$dados['Senha'] = password_hash($dados_form['senha_nova'], PASSWORD_DEFAULT);

			if(password_verify($dados_form['pergunta'], $this->session->userdata('Resposta')) && $dados_form['num1'] + $dados_form['num2'] == $dados_form['teste']){

				$result = $this->usuario->get($this->session->userdata('user_login'));

				if(password_verify($dados_form['senha_antiga'], $result->Senha)){
					$this->usuario->salvar($dados);
					set_msg('<p>Senha alterada com sucesso</p>');
					redirect('conta');
				}else{
					set_msg('<p>Não foi possível alterar a senha 1</p>');
				}
			}else{
				set_msg('<p>Não foi possível alterar a senha 2</p>');
			}
		}

		$dados['h2'] = 'Trocar senha';
		$dados['titulo'] = 'Banco Pirapora - Troca Senha';
		$this->load->view('setup/alterar_senha', $dados);
	}

	public function alterar_email(){
		verifica_login();

		$this->form_validation->set_rules('email_antigo', 'Email Antigo', 'trim|required|valid_email');
		$this->form_validation->set_rules('email_novo', 'Email Novo', 'trim|required|valid_email');
		$this->form_validation->set_rules('email', 'Confirme o Email', 'trim|required|valid_email|matches[email_novo]');
		$this->form_validation->set_rules('pergunta', 'Pergunta de segurança', 'trim|required');
		$this->form_validation->set_rules('teste', 'Responda a operação', 'trim|required');

		if($this->form_validation->run() == FALSE){
			if(validation_errors()){
				set_msg(validation_errors());
			}
		}else{
			$dados_form = $this->input->post();

			$dados['id'] = $this->session->userdata('user_id');
			$dados['Email'] = $dados_form['email_novo'];

			if($dados_form['pergunta'] == $this->session->userdata('Resposta') && $dados_form['num1'] + $dados_form['num2'] == $dados_form['teste']){

				$result = $this->usuario->get($this->session->userdata('user_login'));

				if($result->Email == $dados_form['email_antigo']){
					$this->usuario->salvar($dados);
					set_msg('Email alterado com sucesso');
					redirect('conta');
				}else{
					set_msg('<p>Não foi possível alterar o email 1</p>');
				}
			}else{
				set_msg('<p>Não foi possível alterar o email 2</p>');
			}
		}

		$dados['h2'] = 'Trocar Email';
		$dados['titulo'] = 'Banco Pirapora - Troca Email';
		$this->load->view('setup/alterar_email', $dados);
	}

	public function alterar_usuario(){
		verifica_login();

		$this->form_validation->set_rules('usuario_antigo', 'Usuário Antigo', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('usuario_novo', 'Novo Usuário', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('usuario', 'Confirme o Usuário', 'trim|required|min_length[3]|matches[usuario_novo]');
		$this->form_validation->set_rules('pergunta', 'Pergunta de segurança', 'trim|required');
		$this->form_validation->set_rules('teste', 'Responda a operação', 'trim|required');

		if($this->form_validation->run() == FALSE){
			if(validation_errors()){
				set_msg(validation_errors());
			}
		}else{
			$dados_form = $this->input->post();

			$dados['id'] = $this->session->userdata('user_id');
			$dados['Usuario'] = $dados_form['usuario_novo'];

			if(password_verify($dados_form['pergunta'], $this->session->userdata('Resposta')) && $dados_form['num1'] + $dados_form['num2'] == $dados_form['teste']){

				$result = $this->usuario->get($this->session->userdata('user_login'));

				if($result->Usuario == $dados_form['usuario_antigo']){
					$this->usuario->salvar($dados);
					set_msg('<p>Usuário alterado com sucesso</p>');
					redirect('conta');
				}else{
					set_msg('<p>Não foi possível alterar o usuário</p>');
				}
			}else{
				set_msg('<p>Não foi possível alterar o usuário</p>');
			}
		}

		$dados['h2'] = 'Trocar Usuário';
		$dados['titulo'] = 'Banco Pirapora - Troca de Usuario';
		$this->load->view('setup/alterar_usuario', $dados);
	}

	public function alterar_endereco(){
		verifica_login();

		$this->form_validation->set_rules('endereco_antigo', 'Endereço Antigo', 'trim|required');
		$this->form_validation->set_rules('endereco_novo', 'Novo Endereço', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('numero', 'Número', 'trim|required|min_length[2]');
		$this->form_validation->set_rules('bairro', 'Bairro', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('cidade', 'Cidade', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('pergunta', 'Pergunta de segurança', 'trim|required');
		$this->form_validation->set_rules('teste', 'Responda a operação', 'trim|required');

		if($this->form_validation->run() == FALSE){
			if(validation_errors()){
				set_msg(validation_errors());
			}
		}else{
			$dados_form = $this->input->post();

			$dados['id'] = $this->session->userdata('user_id');
			$dados['Endereco'] = $dados_form['endereco_novo'];
			$dados['Numero'] = $dados_form['numero'];
			$dados['Bairro'] = $dados_form['bairro'];
			$dados['Cidade'] = $dados_form['cidade'];

			if($dados_form['pergunta'] == $this->session->userdata('Resposta') && $dados_form['num1'] + $dados_form['num2'] == $dados_form['teste']){

				$result = $this->usuario->get($this->session->userdata('user_login'));

				if($result->Endereco == $dados_form['endereco_antigo']){
					$this->usuario->salvar($dados);
					set_msg('<p>Endereço alterado com sucesso</p>');
					redirect('conta');
				}else{
					set_msg('<p>Não foi possível alterar o endereço</p>');
				}
			}else{
				set_msg('<p>Não foi possível alterar o endereço</p>');
			}
		}

		$dados['h2'] = 'Alterar endereço';
		$dados['titulo'] = 'Banco Pirapora - Troca de endereço';
		$this->load->view('setup/alterar_endereco', $dados);
	}

	public function alterar_pergunta(){
		verifica_login();

		$this->form_validation->set_rules('pergunta_antiga', 'Pergunta Antiga', 'trim|required');
		$this->form_validation->set_rules('pergunta_nova', 'Pergunta Nova', 'trim|required');
		$this->form_validation->set_rules('resposta', 'Resposta', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('resposta2', 'Confirmar Resposta', 'trim|required|min_length[3]|matches[resposta]');
		$this->form_validation->set_rules('usuario', 'Usuário', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('senha', 'Senha', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('teste', 'Responda a operação', 'trim|required');

		if($this->form_validation->run() == FALSE){
			if(validation_errors()){
				set_msg(validation_errors());
			}
		}else{
			$dados_form = $this->input->post();

			$dados['id'] = $this->session->userdata('user_id');
			$dados['Pergunta'] = $dados_form['pergunta_nova'];
			$dados['Resposta'] = password_hash($dados_form['resposta'], PASSWORD_DEFAULT);
			$result = $this->usuario->get($this->session->userdata('user_login'));

			if($dados_form['usuario'] == $this->session->userdata('user_login')&& password_verify($dados_form['senha'], $result->Senha) && $dados_form['num1'] + $dados_form['num2'] == $dados_form['teste']){

				if($result->Pergunta == $dados_form['pergunta_antiga']){
					$this->usuario->salvar($dados);
					set_msg('<p>Pergunta de segurança alterada com sucesso</p>');
					redirect('conta');
				}else{
					set_msg('<p>Não foi possível alterar a pergunta 1</p>');
				}
			}else{
				set_msg('<p>Não foi possível alterar a pergunta 2</p>');
			}
		}		

		$dados['h2'] = 'Alterar Pergunta de segurança';
		$dados['titulo'] = 'Banco Pirapora - Alterar Pergunta';
		$this->load->view('setup/alterar_pergunta', $dados);
	}

	public function transferir(){
		verifica_login();

		$this->form_validation->set_rules('contadestino', 'Número da conta destino', 'trim|required|max_length[7]');
		$this->form_validation->set_rules('digito', 'Digito', 'trim|required|max_length[1]');
		$this->form_validation->set_rules('valor', 'Valor', 'trim|required');
		$this->form_validation->set_rules('pergunta', 'Pergunta de segurança', 'trim|required');
		$this->form_validation->set_rules('teste', 'Responda a operação', 'trim|required');

		if($this->form_validation->run() == FALSE){
			if(validation_errors()){
				set_msg(validation_errors());
			}
		}else{
			$dados_form = $this->input->post();

			if(password_verify($dados_form['pergunta'], $this->session->userdata('Resposta')) && $dados_form['num1'] + $dados_form['num2'] == $dados_form['teste']){

				floatval($dados_form['valor']);
				$dados_destinatario['Numero'] = $dados_form['contadestino'];
				$dados_destinatario['Digito'] = $dados_form['digito'];
				$saldo_anterior = $this->conta->get_saldo($dados_destinatario['Numero'], $dados_destinatario['Digito']);
				$dados_destinatario['Saldo'] = $saldo_anterior->Saldo + $dados_form['valor'];

				$dados_remetente['Numero'] = $this->session->userdata('Numero');
				$dados_remetente['Digito'] = $this->session->userdata('Digito');
				$saldo_anterior = $this->conta->get_saldo($dados_remetente['Numero'], $dados_remetente['Digito']);
				$dados_remetente['Saldo'] = $saldo_anterior->Saldo - $dados_form['valor'];

				$result = $this->conta->get_id($dados_destinatario['Numero'], $dados_destinatario['Digito']);

				$select = $this->conta->get($this->session->userdata('user_id'));
				$opcoes['idContaRemetente'] = $select->idConta;
				$opcoes['idContaDestinatario'] = $result->idConta;
				$opcoes['TipoMovimentacao'] = 'Transferência';
				$opcoes['Valor'] = $dados_form['valor'];

				if(verifica_saldo($saldo_anterior->Saldo, $dados_form['valor'])){		
					if($conf = $this->conta->atualiza_saldo($dados_destinatario)){
						$this->conta->atualiza_saldo($dados_remetente);
						$this->extrato->salvar($opcoes);
						redirect('conta');
					}else{
						set_msg('<p>Não foi possível concluir a transferência 1</p>');
					}
				}
			}else{
				set_msg('<p>Não foi possível concluir a transferência 2</p>');
			}
		}

		$dados['h2'] = 'Transferir Dinheiro';
		$dados['titulo'] = 'Banco Pirapora - Efetuar Transferencia';
		$this->load->view('setup/transferir', $dados);
	}

	public function sacar(){
		verifica_login();

		$this->form_validation->set_rules('valor', 'Valor', 'trim|required');
		$this->form_validation->set_rules('usuario', 'Usuário', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('senha', 'Senha', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('pergunta', 'Pergunta de segurança', 'trim|required');
		$this->form_validation->set_rules('teste', 'Responda a operação', 'trim|required');

		if($this->form_validation->run() == FALSE){
			if(validation_errors()){
				set_msg(validation_errors());
			}
		}else{
			$dados_form = $this->input->post();

			$result = $this->usuario->get($this->session->userdata('user_login'));

			if(password_verify($dados_form['pergunta'], $this->session->userdata('Resposta')) && $dados_form['num1'] + $dados_form['num2'] == $dados_form['teste'] && $dados_form['usuario'] == $result->Usuario && password_verify($dados_form['senha'], $result->Senha)){

				$result = $this->conta->get($this->session->userdata('user_id'));

				floatval($dados_form['valor']);
				$dados['Numero'] = $this->session->userdata('Numero');
				$dados['Digito'] = $this->session->userdata('Digito');
				$saldo_anterior = $result->Saldo;
				$dados['Saldo'] = $saldo_anterior - $dados_form['valor'];

				$select = $this->conta->get($this->session->userdata('user_id'));
				$opcoes['idContaRemetente'] = $select->idConta;
				$opcoes['TipoMovimentacao'] = 'Saque';
				$opcoes['Valor'] = $dados_form['valor'];

				if(verifica_saldo($saldo_anterior, $dados_form['valor'])){
					if($conf = $this->conta->atualiza_saldo($dados)){
						$this->extrato->salvar($opcoes);
						redirect('conta');
					}else{
						set_msg('<p>Não foi possível concluir o Saque 1</p>');
					}
				}
			}else{
				set_msg('<p>Não foi possível concluir o Saque 2</p>');
			}
		}

		$dados['h2'] = 'Sacar dinheiro';
		$dados['titulo'] = 'Banco Pirapora - Efetuar Saque';
		$this->load->view('setup/sacar', $dados);
	}

	public function depositar(){
		verifica_login();

		$this->form_validation->set_rules('valor', 'Valor', 'trim|required');
		$this->form_validation->set_rules('pergunta', 'Pergunta de segurança', 'trim|required');
		$this->form_validation->set_rules('teste', 'Responda a operação', 'trim|required');

		if($this->form_validation->run() == FALSE){
			if(validation_errors()){
				set_msg(validation_errors());
			}
		}else{
			$dados_form = $this->input->post();

			$result = $this->usuario->get($this->session->userdata('user_login'));

			if(password_verify($dados_form['pergunta'], $this->session->userdata('Resposta')) && $dados_form['num1'] + $dados_form['num2'] == $dados_form['teste'] && $dados_form['usuario'] == $result->Usuario && password_verify($dados_form['senha'], $result->Senha)){

				$result = $this->conta->get($this->session->userdata('user_id'));

				floatval($dados_form['valor']);
				$dados['Numero'] = $this->session->userdata('Numero');
				$dados['Digito'] = $this->session->userdata('Digito');
				$saldo_anterior = $result->Saldo;
				$dados['Saldo'] = $saldo_anterior + $dados_form['valor'];

				$select = $this->conta->get($this->session->userdata('user_id'));
				$opcoes['idContaRemetente'] = $select->idConta;
				$opcoes['TipoMovimentacao'] = 'Deposito';
				$opcoes['Valor'] = $dados_form['valor'];

				if($conf = $this->conta->atualiza_saldo($dados)){
					$this->extrato->salvar($opcoes);
					redirect('conta');
				}else{
					set_msg('<p>Não foi possível concluir o Deposito</p>');
				}
			}else{
				set_msg('<p>Não foi possível concluir o Deposito</p>');
			}
		}

		$dados['h2'] = 'Depositar dinheiro';
		$dados['titulo'] = 'Banco Pirapora - Efetuar Deposito';
		$this->load->view('setup/depositar', $dados);
	}

	public function extrato(){
		verifica_login();
		
		$options = $this->conta->get($this->session->userdata('user_id')); 

		$dados['dados'] = $this->extrato->get($options->idConta);
		$dados['h2'] = 'Extrato da Conta';
		$dados['titulo'] = 'Banco Pirapora - Extrato';
		$this->load->view('setup/extrato', $dados);
	}

	public function excluir(){
		verifica_login();

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

			$cpf = $this->usuario->get($this->session->userdata('user_login'));

			if(password_verify($dados_form['pergunta'], $this->session->userdata('Resposta')) && ($dados_form['num1'] + $dados_form['num2'] == $dados_form['teste']) && ($dados_form['email'] == $this->session->userdata('user_email')) && ($dados_form['cpf'] == $cpf->CPF) && ($dados_form['usuario'] == $this->session->userdata('user_login')) && password_verify($dados_form['senha'], $cpf->Senha)){
				
				if($conf = $this->session->userdata('user_id')){
					$result = $this->conta->get($this->session->userdata('user_id'));
					$this->usuario->excluir($this->session->userdata('user_id'));
					$this->extrato->excluir($result->idConta);
					set_msg('<p>Conta excluida com sucesso</p>');
					redirect('home');
				}else{
					set_msg('<p>Não foi possível excluir a conta</p>');
				}
			}else{
				set_msg('<p>Não foi possível excluir a conta</p>');
			}
		}

		$dados['h2'] = 'Excluir conta';
		$dados['titulo'] = 'Banco Pirapora - Exclusão de Conta';
		$this->load->view('setup/excluir', $dados);
	}
}