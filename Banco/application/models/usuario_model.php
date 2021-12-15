<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Usuario_model extends CI_Model {

		function __construct(){
			parent::__construct();
			$this->load->database();
		}

		public function salvar($dados){
			if(isset($dados['id']) && $dados['id'] > 0){
				//usuario já existe, devo editar as informações
				$this->db->where('id', $dados['id']);
				unset($dados['id']);
				$this->db->update('usuarios', $dados);
				return $this->db->affected_rows();
			}else{
				//usuario não existe, devo cadastra-lo
				$this->db->insert('usuarios', $dados);
				return $this->db->insert_id();
			}
		}

		public function update($dados){
			$this->db->where('Usuario', $dados['Usuario']);
			unset($dados['Usuario']);
			$this->db->update('usuarios', $dados);
			$result = $this->db->get();
			if($result){
				return true;
			}else{
				return false;
			}
		}

		public function get($login){
			$this->db
				->select('id, NomeCompleto, Usuario, Email, CPF, Endereco, Bairro, Cidade, Senha, Pergunta, Resposta')
				->from('usuarios')
				->where('Usuario', $login);

			$result = $this->db->get();

			if ($result->num_rows() > 0) {
				return $result->row();
			} else {
				return NULL;
			}
		}

		public function excluir($id=0){
			$this->db->where('id', $id);
			$this->db->delete('usuarios');
			return $this->db->affected_rows();
		}
	}
?>