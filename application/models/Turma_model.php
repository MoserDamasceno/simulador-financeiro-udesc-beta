<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Turma_model extends CI_Model {

	protected $table_user = 'users';
	protected $table_class = 'classes';

	function __construct() {
		parent::__construct();
	}

	public function save($data) {
		if (!isset($data['id_class'])) {
			return $this->db->insert($this->table_class, $data);
		} else {
			$this->db->where('id_class', $data['id_class']);
			return $this->db->update($this->table_class, $data);
		}
	}

	public function get($id)
	{
		return $this->db
		->where('c.id_class',$id)
		->where('deleted_at', NULL)
		->get($this->table_class . ' as c')
		->row();
	}

	public function delete($id)
	{
		if ($id) {
			$this->db->where('id_class', $id);
			$data = array('deleted_at' => date('Y-m-d H:i:s'));
			return $this->db->update($this->table_class, $data);
		}
	}

	public function get_all() {
		return $this->db
		->where('deleted_at', NULL)
		->get($this->table_class . ' as c')
		->result();
	}

}
