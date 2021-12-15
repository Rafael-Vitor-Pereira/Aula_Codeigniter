<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Extrato_model extends CI_Model {

		function __construct(){
			parent::__construct();
			$this->load->database();
		}

		public function salvar($dados){
			$this->db->insert('extrato', $dados);
			return $this->db->insert_id();
		}

		public function get($id){
			$this->db
				->select('*')
				->from('extrato')
				->where('idContaRemetente', $id);
			$result = $this->db->get();
			if($result->num_rows() > 0){
				return $result->result();
			}else{
				return false;
			}
		}

		public function excluir($id=0){
			$this->db->where('idTitular', $id);
			$this->db->delete('extrato');
			return $this->db->affected_rows();
		}
	}
?>