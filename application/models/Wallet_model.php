<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Wallet_model extends CI_Model {

	protected $table_wallet = 'wallet';
	protected $table_stock = 'stocks';
	protected $initial_value = 1000000000;

	function __construct() {
		parent::__construct();
	}

	public function save($data) {
		if (!$data['id_wallet']) {
			$res = $this->db->insert($this->table_wallet, $data);
			return ($res) ? $this->db->insert_id('id_wallet') : false;
		} else {
			$this->db->where('id_wallet', $data['id_wallet']);
			return $this->db->update($this->table_wallet, $data);
		}
	}

	public function get($id)
	{
		return $this->db
		->where('u.id_wallet',$id)
		->get($this->table_wallet . ' as u')
		->row();
	}

	public function get_stock_by_user($stock, $user)
	{
		$query =  $this->db
		->from($this->table_wallet . ' as w')
		->join('stocks', 'stocks.id_stock = stock_id', 'LEFT')
		->where('user_id',$user)
		->where('stock_id',$stock)
		->get()
		->row();

		return $query;
	}

	public function get_by_user($user)
	{
		$query =  $this->db
		->from($this->table_wallet . ' as w')
		->join('stocks', 'stocks.id_stock = stock_id', 'LEFT')
		->where('user_id',$user)
		->get()
		->result();

		return $query;
	}

	public function check_quantity($stock, $user, $quantity)
	{
		$query =  $this->db
		->from($this->table_wallet . ' as w')
		->join('stocks', 'stocks.id_stock = stock_id', 'LEFT')
		->where('user_id',$user)
		->where('stock_id',$stock)
		->get()
		->row();

		if ($query && $query->quantity >= $quantity) {
			return $query;
		} else {
			return false;
		}
	}

	public function get_wallet_by_stock($stock)
	{
		return $this->db
		->where('stock_id',$id)
		->get($this->table_wallet)
		->result();
	}

	public function delete($id)
	{
		if ($id) {
			$this->db->where('id_wallet', $id);
			return $this->db->delete($this->table_wallet);
		}
	}

	public function get_all() {
		return $this->db
		->from($this->table_wallet . ' as t')
		->join('stocks', 'stocks.id_stock = stock_id', 'LEFT')
		->join('cotations', 'cotations.id_cotation = cotation_id', 'LEFT')
		->get()
		->result();
	}


}






