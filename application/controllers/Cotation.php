<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

ini_set('max_execution_time', -1);

class Cotation extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	
	}

	public function index() {
		$this->data['title'] = 'Importação';
		$this->data['user'] = $user = $this->session->userdata('user');
		$this->data['breadcrumbs'] = [
			['url' => '/', 'title' => 'Home'],
			['url' => '#', 'title' => 'Atualização'],
		];

		adicionarCanonical(base_url() . 'import/update');

		$paginas = array('import/update_all');
		renderizarPagina($paginas, $this->data);
	}

	// public function get_stocks()
	// {
	// 	$this->load->model('cotation_model');
	// 	// $db_stocks = $this->stock_model->get_all();
	// 	$stocks = [
	// 		'RLOG3','NEOE3','UNIP6','NEV3'
	// 	];

	// 	$tem = [];
	// 	foreach ($stocks as $dbs){
	// 		$tem[] = $this->cotation_model->search_stock_api($dbs);
	// 		// sleep(13);
	// 	}

	// 	pre($tem);

	// }

	public function update_all()
	{
		$this->load->model('stock_model');
		$stocks = $this->stock_model->get_all();
		
		foreach ($stocks as $s => $stock) {
			$this->update($stock->ticker, true);
			sleep(13);
		}
	}

	// public function import()
	// {
	// 	$this->load->model('cotation_model');
		
	// 	$this->load->model('stock_model');
	// 	$cotations = $this->cotation_model->get_cotations_updated();
	// 	$stocks = $this->stock_model->get_all();
		
	// 	$symbols= array();

	// 	foreach ($cotations as $cotation) {
	// 		$c[$cotation->stock_id] = $cotation;
	// 	}
		
	// 	foreach ($stocks as $stock) {		
	// 		if (!array_key_exists($stock->id_stock, $c)) { 
	// 			$symbols[$stock->id_stock] = $stock;
	// 		}
	// 	}

	// 	$s = current($symbols);

	// 	$cot = $this->cotation_model->get_global_quote($s->ticker);
	// 	if ($cot && isset($cot['08. previous close'])) {
	// 		$data = [
	// 			'id_cotation' => null,
	// 			'stock_id' => $s->id_stock,
	// 			'value' => $cot['08. previous close'],
	// 			'date_time' => date('Y-m-d H:i:s')
	// 		];
	// 	}


	// 	$this->cotation_model->save($data);
	// }

	public function update($ticker, $print = false) {
		$this->load->model('cotation_model');
		$this->load->model('stock_model');
		$stock = $this->stock_model->get_by_ticker($ticker);
		$response = '';
		if ($stock) {
			$cot = $this->cotation_model->get_global_quote($ticker);

			if ($cot && isset($cot['05. price'])) {
				$data = [
					'id_cotation' => null,
					'stock_id' => $stock->id_stock,
					'value' => $cot['05. price'],
					'date_time' => date('Y-m-d H:i:s')
				];
				$this->cotation_model->save($data);
				$response = "Ação atualizada " . $ticker . "<br/>";
			} else {
				// pre($cot);
				$response = $ticker . " - Mensagem:" . $cot;
			}

		} else {
			$response = 'Ação não encontrada <br/>';
		}

		if($print){
			$this->output->set_content_type('text/html');
			echo $response;
		} else {
			$this->data['title'] = 'Ação importada';
			$this->data['user'] = $user = $this->session->userdata('user');
			$this->data['response'] = $response;
			$this->data['breadcrumbs'] = [
				['url' => '/', 'title' => 'Home'],
				['url' => '#', 'title' => 'Atualização'],
			];
	
			adicionarCanonical(base_url() . 'import/update');
	
			$paginas = array('import/success-one-ticker');
			renderizarPagina($paginas, $this->data);

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
