<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Stock_model extends CI_Model {

	protected $table_stock = 'stocks';

	function __construct() {
		parent::__construct();
	}

	public function save($data) {
		return $this->db->replace($this->table_stock, $data);
	}

	public function get($id)
	{
		return $this->db
		->where('s.id_stock',$id)
		->get($this->table_stock)
		->row();
	}

	public function delete($id)
	{
		if ($id) {
			$this->db->where('id_stock', $id);
			return $this->db->delete($this->table_stock);
		}
	}

	public function get_by_ticker($ticker) {
		return $this->db
		->where('ticker',$ticker)
		->get($this->table_stock)
		->row();
	}

	public function get_all() {
		return $this->db
		->get($this->table_stock . ' as s')
		->result();
	}

}