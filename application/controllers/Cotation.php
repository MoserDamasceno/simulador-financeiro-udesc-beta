<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

ini_set('max_execution_time', -1);

class Cotation extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	
	}

	public function index() {
		$this->data['title'] = 'Importação';
		$this->data['breadcrumbs'] = array(
			array('url' => '/', 'title' => 'Home'),
			array('url' => '#', 'title' => 'Importação')
		);

		adicionarCanonical(base_url() . 'import');

		$paginas = array('import/add_file');

		renderizarPagina($paginas, $this->data);
	}

	public function update_all()
	{
		$this->load->model('stock_model');
		$stocks = $this->stock_model->get_all();
		$count = count($stocks);

		foreach ($stocks as $s => $stock) {
			$this->update($stock->ticker);
			sleep(13);
		}
	}

	public function import()
	{
		$this->load->model('cotation_model');
		
		$this->load->model('stock_model');
		$cotations = $this->cotation_model->get_cotations_updated();
		$stocks = $this->stock_model->get_all();
		
		$symbols= array();

		foreach ($cotations as $cotation) {
			$c[$cotation->stock_id] = $cotation;
		}
		
		foreach ($stocks as $stock) {		
			if (!array_key_exists($stock->id_stock, $c)) { 
				$symbols[$stock->id_stock] = $stock;
			}
		}

		$s = current($symbols);
		pre($s, false);

		$cot = $this->cotation_model->get_global_quote($s->ticker);
		if ($cot && isset($cot['08. previous close'])) {
			$data = [
				'id_cotation' => null,
				'stock_id' => $s->id_stock,
				'value' => $cot['08. previous close'],
				'date_time' => date('Y-m-d H:i:s')
			];
		}


		$this->cotation_model->save($data);
		pre($data);
	}

	public function update($ticker) {
		$this->load->model('cotation_model');
		$this->load->model('stock_model');
		$stock = $this->stock_model->get_by_ticker($ticker);
		if ($stock) {
			$cot = $this->cotation_model->get_global_quote($ticker);
			
			if ($cot && isset($cot['08. previous close'])) {
				$data = [
					'id_cotation' => null,
					'stock_id' => $stock->id_stock,
					'value' => $cot['08. previous close'],
					'date_time' => date('Y-m-d H:i:s')
				];
			}

			$this->cotation_model->save($data);

			pre($data);
		} else {
			echo 'Ação não encontrada';
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
