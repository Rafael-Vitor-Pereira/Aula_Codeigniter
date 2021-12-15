<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Contas_model extends CI_Model {

		function __construct(){
			parent::__construct();
			$this->load->database();
		}

		public function salvar($dados){
			$this->db->insert('contas', $dados);
			return $this->db->insert_id();
		}

		public function get($id=0){
			$this->db
				->select('idConta, Agencia, Operacao, Numero, Digito, Saldo')
				->from('contas')
				->where('idTitular', $id);
			$query = $this->db->get();
			if($query->num_rows() == 1){
				return $query->row();;
			}else{
				return NULL;
			}
		}

		public function get_id($numero, $digito){
			$this->db
				->select('Digito')
				->from('contas')
				->where('Numero', $numero);
			$result = $this->db->get();
			if($result->row()->Digito == $digito){
				$this->db
					->select('idConta')
					->from('contas')
					->where('Digito', $result->row()->Digito);
				$result = $this->db->get();
				if($result->num_rows() > 0){
					return $result->row();
				}else{
					return false;
				}
			}else{
				return false;
			}
		}

		public function testa_conta($num, $dig){
			$this->db
				->select('Numero, Digito')
				->from('contas')
				->where('Numero', '$num');
			$query = $this->db->get();
			if($query->num_rows() > 0){
				return true;
			}else{
				return false;
			}
		}

		public function get_saldo($conta, $digito){
			$this->db
				->select('Digito')
				->from('contas')
				->where('Numero', $conta);

			$conta = $this->db->get();
			if($conta->row()->Digito == $digito){
				$this->db
					->select('Saldo')
					->from('contas')
					->where('Digito', $digito);

				$saldo = $this->db->get();

				if($saldo->num_rows() == 1){
					return $saldo->row();
				}else{
					return false;
				}
			}else{
				return false;
			}
		}		

		public function atualiza_saldo($dados){
			$this->db
				->select('Digito')
				->from('contas')
				->where('Numero', $dados['Numero']);
			unset($dados['Numero']);
			$query = $this->db->get();
			if($query->row()->Digito == $dados['Digito']){
				$this->db->where('Digito', $dados['Digito']);
				unset($dados['Digito']);
				$this->db->update('contas', $dados);
				$result = $this->db->affected_rows();
				if($result > 0){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}

		public function excluir($id=0){
			$this->db->where('idTitular', $id);
			$this->db->delete('contas');
			return $this->db->affected_rows();
		}
	}
?>