<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stock extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	
	}

	public function index() {
		$this->data['title'] = 'List of stocks';
		$this->data['breadcrumbs'] = array(
			array('url' => '/', 'title' => 'Home'),
			array('url' => '#', 'title' => 'Stocks')
		);

		$this->load->model('stock_model');
		$stocks = $this->stock_model->get_all();

		adicionarCanonical(base_url() . 'stock');

		$paginas = array('stock/list');

		//renderizarPagina($paginas, $this->data);
	}


	public function buy($ticker = '') {

		$this->data['title'] = 'Comprar ação';
		$this->data['breadcrumbs'] = array(
			array('url' => '/', 'title' => 'Home'),
			array('url' => '/stocks', 'title' => 'Stocks'),
			array('url' => '#', 'title' => 'buy')
		);

		if (!$ticker) {
			redirect('dashboard');
		}

		$this->load->model('cotation_model');
		$stock = $this->cotation_model->get_cotation_by_ticker($ticker);

		if ($stock) {
			adicionarCanonical(base_url() . 'stock');

			$this->data['stock'] = $stock;

			$paginas = array('stock/buy');

			renderizarPagina($paginas, $this->data);
		} else {
			message('error', 'Stock not found!');
			redirect('dashboard');
		}

		
	}

	public function save_buy()
	{
		if ($this->input->post()) {
			$data['type'] = 'buy';
			$data['quantity'] = $this->input->post('quantidade');
			$data['user_id'] = $this->session->userdata('user')->id_user;
			$data['stock_id'] = $this->input->post('id_stock');
			$data['cotation_id'] = $this->input->post('id_cotation');
			$data['date_time'] = date('Y-m-d H:i:s');

			$this->load->model('transaction_model');
			$res = $this->transaction_model->save($data);
			
			if (!$res) {
				message('error', 'Ocorreu algum erro, repita a operação.');
			} else {
				message('success', 'Ação comprada com sucesso com suceso!');
				
			}
			redirect('dashboard');
		}
	}

	public function sell($ticker = '') {

		$this->data['title'] = 'Vender ação';
		$this->data['breadcrumbs'] = array(
			array('url' => '/', 'title' => 'Home'),
			array('url' => '/stocks', 'title' => 'Stocks'),
			array('url' => '#', 'title' => 'sell')
		);

		if (!$ticker) {
			redirect('dashboard');
		}

		$this->load->model('cotation_model');
		$stock = $this->cotation_model->get_cotation_by_ticker($ticker);

		if ($stock) {
			adicionarCanonical(base_url() . 'stock');

			$this->data['stock'] = $stock;

			$paginas = array('stock/sell');

			renderizarPagina($paginas, $this->data);
		} else {
			message('error', 'Stock not found!');
			redirect('dashboard');
		}

		
	}



	public function success() {
		$this->data['title'] = 'Importação';
		$this->data['breadcrumbs'] = [
			['url' => '/', 'title' => 'Home'],
			['url' => '/import', 'title' => 'Importação'],
			['url' => '#', 'title' => 'Sucesso'],
		];

		adicionarCanonical(base_url() . 'import/sucess');

		$paginas = array('import/success');

		renderizarPagina($paginas, $this->data);
	}

}
