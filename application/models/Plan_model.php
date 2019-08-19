<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Stock_model extends CI_Model {

	protected $table_stock = 'stocks';

	function __construct() {
		parent::__construct();
	}

	public function save($data) {
		if (!$data['id_stock']) {
			$res = $this->db->insert($this->table_stock, $data);
			return ($res) ? $this->db->insert_id('id_stock') : false;
		} else {
			$this->db->where('id_stock', $data['id_stock']);
			return $this->db->update($this->table_stock, $data);
		}
	}

	public function get($id)
	{
		return $this->db
		->where('u.id_stock',$id)
		->get($this->table_stock . ' as u')
		->row();
	}

	public function delete($id)
	{
		if ($id) {
			$this->db->where('id_stock', $id);
			return $this->db->delete($this->table_stock);
		}
	}

	public function get_all() {
		return $this->db
		->get($this->table_stock . ' as u')
		->result();
	}

}