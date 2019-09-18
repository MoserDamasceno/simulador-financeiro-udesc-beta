<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class cotation_model extends CI_Model {

	protected $table_cotation = 'cotations';
	protected $table_stock = 'stocks';

	protected $url_api = "https://www.alphavantage.co/";
	protected $param = "query";
	protected $global_quote = "GLOBAL_QUOTE";
	protected $api_key = "MCYBE65KZV6L4CTD";
	protected $bolsa = ".SAO";


	function __construct() {
		parent::__construct();
	}

	public function search_stock_api($symbol = 'BBAS3') {
		$url = $this->url_api.$this->param.'?function=SYMBOL_SEARCH&keywords='.$symbol.$this->bolsa.'&apikey='.$this->api_key;
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$data = curl_exec($ch);

		if (curl_errno($ch)) {
			return "Error: " . curl_error($ch);
		} else { 
			$transaction = json_decode($data, TRUE);
			curl_close($ch);
			return $transaction;
			// if (isset($transaction['Note'])) {
			// 	return 'Limite de requests atingido';
			// } else if(isset($transaction['Error Message'])){
			// 	return $transaction['Error Message'];
			// } else {
			// 	return $transaction['Global Quote'];
			// }
		}
	}

	public function get_global_quote($symbol = 'BBAS3') {
		$url = $this->url_api.$this->param.'?function='.$this->global_quote.'&symbol='.$symbol.$this->bolsa.'&apikey='.$this->api_key;
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$data = curl_exec($ch);

		if (curl_errno($ch)) {
			return "Error: " . curl_error($ch);
		} else { 
			$transaction = json_decode($data, TRUE);
			curl_close($ch);
			if (isset($transaction['Note'])) {
				return $this->global_quote . ' - '. 'Limite de requests atingido';
			} else if(isset($transaction['Error Message'])){
				return $this->global_quote . ' - '. $transaction['Error Message'];
			} else {
				return $transaction['Global Quote'];
			}
		}
	}

	public function get_cotations_updated()
	{
		return $this->db
		->from($this->table_stock . ' as s')
		->join('cotations', 'cotations.stock_id = id_stock')
		->like('date_time','2019-08-13', 'after')
		->get()
		->result();
	}	 

	public function save($data) {
		if (!$data['id_cotation']) {
			$res = $this->db->insert($this->table_cotation, $data);
			return ($res) ? $this->db->insert_id('id_cotation') : false;
		} else {
			$this->db->where('id_cotation', $data['id_cotation']);
			return $this->db->update($this->table_cotation, $data);
		}
	}

	public function get($id)
	{
		return $this->db
		->where('u.id_cotation',$id)
		->get($this->table_cotation . ' as u')
		->row();
	}

	public function get_cotation_by_stock($stock)
	{
		return $this->db
		->from($this->table_cotation . ' as c')
		->where('stocks.id_stock',$stock)
		->join('stocks', 'stocks.id_stock = stock_id')
		->limit(1)
		->order_by('date_time', 'DESC')
		->get()
		->row();
	}

	public function get_by_stock_and_id($id, $stock)
	{
		return $this->db
		->where('id_cotation',$id)
		->where('stock_id',$stock)
		->get($this->table_cotation)
		->row();
	}

	public function get_cotation_by_ticker($ticker) {
		return $this->db
		->from($this->table_cotation . ' as c')
		->where('stocks.ticker',$ticker)
		->join('stocks', 'stocks.id_stock = stock_id')
		->limit(1)
		->order_by('date_time', 'DESC')
		->get()
		->row();
	}

	public function delete($id)
	{
		if ($id) {
			$this->db->where('id_cotation', $id);
			return $this->db->delete($this->table_cotation);
		}
	}

	public function get_all() {
		return $this->db
		->from($this->table_cotation . ' as c')
		->join('stocks', 'stocks.id_stock = stock_id', 'LEFT')
		->get()
		->result();
	}



}