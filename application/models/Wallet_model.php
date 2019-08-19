<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Wallet_model extends CI_Model {

	protected $table_transaction = 'transactions';
	protected $table_stock = 'stocks';
	protected $table_cotation = 'cotations';
	protected $initial_value = 1000000000;

	function __construct() {
		parent::__construct();
	}

	public function save($data) {
		if (!$data['id_transaction']) {
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

	public function get_total_by_user($user)
	{
		$query =  $this->db
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

	public function get_average_value($transactions)
	{
		$tr = $buy = $sell = array();
		foreach ($transactions as $t => $transaction) {
			$buy[$transaction->stock_id] = $sell[$transaction->stock_id] = array('value' => 0, 'count' => 0);
			if ($transaction->type == 'buy') {
				$buy[$transaction->stock_id]['total_value'] =+ $transaction->quantity * round($transaction->value);
				$buy[$transaction->stock_id]['count']++;
			} else {
				$sell[$transaction->stock_id]['total_value'] =+ $transaction->quantity * round($transaction->value);
				$sell[$transaction->stock_id]['average_value'] =+ $transaction->quantity * round($transaction->value);
				$sell[$transaction->stock_id]['count']++;
			}

			$tr[$transaction->stock_id]['average_value'] =+ $buy[$transaction->stock_id]['total_value'] / $buy[$transaction->stock_id]['count'];

		}
		// 	pre($tr);

		// pre($buy, false);
		// pre($transactions);
		return $transactions;
	}

}






