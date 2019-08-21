<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Transaction_model extends CI_Model {

	protected $table_transaction = 'transactions';
	protected $table_stock = 'stocks';
	protected $table_cotation = 'cotations';
	protected $initial_value = 1000000000;

	function __construct() {
		parent::__construct();
	}

	public function save($data) {
		if (!isset($data['id_transaction'])) {
			$res = $this->db->insert($this->table_transaction, $data);
			return ($res) ? $this->db->insert_id('id_transaction') : false;
		} else {
			$this->db->where('id_transaction', $data['id_transaction']);
			return $this->db->update($this->table_transaction, $data);
		}
	}

	public function get($id)
	{
		return $this->db
		->where('u.id_transaction',$id)
		->get($this->table_transaction . ' as u')
		->row();
	}

	public function get_all_by_user($user)
	{
		$query =  $this->db
		->select('t.*, stocks.id_stock, stocks.ticker, stocks.company, cotations.id_cotation, cotations.value')
		->from($this->table_transaction . ' as t')
		->join('stocks', 'stocks.id_stock = stock_id', 'LEFT')
		->join('cotations', 'cotations.id_cotation = cotation_id', 'LEFT')
		->where('t.user_id',$user)
		->get()
		->result();

		return $query;
	}

	public function get_transaction_by_stock($stock)
	{
		return $this->db
		->where('stock_id',$id)
		->get($this->table_transaction)
		->result();
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
		->from($this->table_transaction . ' as t')
		->join('stocks', 'stocks.id_stock = stock_id', 'LEFT')
		->join('cotations', 'cotations.id_cotation = cotation_id', 'LEFT')
		->get()
		->result();
	}

}






