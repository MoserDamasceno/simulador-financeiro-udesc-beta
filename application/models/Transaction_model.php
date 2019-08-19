<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Transaction_model extends CI_Model {

	protected $table_transaction = 'transactions';

	function __construct() {
		parent::__construct();
	}

	public function save($data) {
		return $this->db->replace($this->table_transaction, $data);
	}

	public function get($id)
	{
		return $this->db
		->where('id_transaction',$id)
		->get($this->table_transaction)
		->row();
	}

	public function delete($id)
	{
		if ($id) {
			$this->db->where('id_transaction', $id);
			return $this->db->delete($this->table_transaction);
		}
	}

	public function get_all() {
		return $this->db
		->get($this->table_transaction . ' as s')
		->result();
	}

}