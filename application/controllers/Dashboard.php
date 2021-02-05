<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		
		$this->load->model('stock_model');
		$this->load->model('cotation_model');
		$this->load->model('wallet_model');
		$this->data['title'] = 'Dashboard';
		$this->data['user'] = $user = $this->session->userdata('user');

		if (!$user) {
			redirect('auth/logout');
		}

		adicionarCanonical(base_url() . 'dashboard');

		$paginas = [
			'dashboard/main',
		];

		$stocks = $this->stock_model->get_all();
		$cotations = array();
		foreach ($stocks as $stock) {
			$cotations[] = $this->cotation_model->get_cotation_by_ticker($stock->ticker);
		}
		
		$this->data['stocks'] = $stocks;
		$this->data['cotations'] = $cotations;
		
		renderizarPagina($paginas, $this->data);
	}

}


/* End of file company.php */
/* Location: ./application/controllers/company.php */
