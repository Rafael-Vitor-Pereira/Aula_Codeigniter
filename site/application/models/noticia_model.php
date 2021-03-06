<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Noticia_model extends CI_Model {

		function __construct(){
			parent::__construct();
		}

		public function salvar($dados){
			if(isset($dados['id']) && $dados['id'] > 0){
				//noticia já existe, devo editar
				$this->db->where('id', $dados['id']);
				unset($dados['id']);
				$this->db->update('noticias', $dados);
				return $this->db->affected_rows();
			}else{
				//noticia não existe, devo inserir
				$this->db->insert('noticias', $dados);
				return $this->db->insert_id();
			}
		}

		public function get($limit=0, $offset=0){
			if($limit == 0){
				$this->db->order_by('id', 'desc');
				$query = $this->db->get('noticias');
				if($query->num_rows() > 0){
					return $query->result();
				}else{
					return NULL;
				}
			}else{
				$this->db->order_by('id', 'desc');
				$query = $this->db->get('noticias', $limit);
				if($query->num_rows() > 0){
					return $query->result();
				}else{
					return NULL;
				}
			}
		}

		public function get_single($id=0){
			$this->db->where('id', $id);
			$query = $this->db->get('noticias', 1);
			if($query->num_rows() == 1){
				$row = $query->row();
				return $row;
			}else{
				return NULL;
			}
		}

		public function excluir($id=0){
			$this->db->where('id', $id);
			$this->db->delete('noticias');
			return $this->db->affected_rows();
		}
	}
?>