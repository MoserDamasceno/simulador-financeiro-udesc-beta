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
		$this->data['user'] = $user = $this->session->userdata('user');
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
			# OK // Pega os dados do POST
			$data['type'] = 'buy';
			$data['quantity'] = $this->input->post('quantidade');
			$data['user_id'] = $this->session->userdata('user')->id_user;
			$data['stock_id'] = $this->input->post('id_stock');
			$data['cotation_id'] = $this->input->post('id_cotation');
			$data['date_time'] = date('Y-m-d H:i:s');
			
			# OK // Busca o valor da cotação da ação para comprar
			$this->load->model('cotation_model');
			$price = $this->cotation_model->get_by_stock_and_id($data['cotation_id'], $data['stock_id']);
			# OK // Verifica se há preço para esta ação
			if ($price) {
				$price = $price->value;
			} else {
				message('error', 'Ocorreu algum erro, repita a operação.');
				redirect('dashboard');
			}

			// Checa se o usuário tem saldo disponível
			$user = $this->session->userdata('user');
			$s = $this->user_model->check_saldo($data['quantity'], $price, $user->id_user);
			if (!$s) {
				message('error', 'Você não tem saldo suficiente para esta compra.');
				redirect('dashboard');
			}

			# OK // Salva os dados da compra
			$this->load->model('transaction_model');
			$res = $this->transaction_model->save($data);

			# OK // Guarda na carteira a compra
			$this->load->model('wallet_model');
			$stock = $this->wallet_model->get_stock_by_user($data['stock_id'], $user->id_user);

			// Se já existe a ação, altera a quantidade e o preço médio
			if ($stock) {
				$old = $stock->quantity *  $stock->average_price;
				$new = $data['quantity'] *  $price;
				$new_q = $stock->quantity + $data['quantity'];

				$average_price = ($old + $new) / ($new_q);

				$wallet = [
					'id_wallet' => $stock->id_wallet,
					'stock_id' => $data['stock_id'],
					'quantity' => $new_q,
					'average_price' => $average_price,
					'user_id' => $user->id_user
				];

				$w = $this->wallet_model->save($wallet);
				
			} else { #OK // Senão, adiciona a nova quantidade e preço médio
				$wallet = [
					'id_wallet' => null,
					'stock_id' => $data['stock_id'],
					'quantity' => $data['quantity'],
					'average_price' => $price,
					'user_id' => $user->id_user
				];
				$w = $this->wallet_model->save($wallet);
			}

			#OK // Altera o valor do saldo do usuário
			$us = $this->user_model->buy_stock($data['quantity'], $price, $user->id_user);
			
			if (!$res) {
				message('error', 'Ocorreu algum erro, repita a operação.');
			} else {
				message('success', 'Ação comprada com sucesso com suceso!');
				
			}
			redirect('wallet');
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

		$this->load->model('wallet_model');
		$user = $this->session->userdata('user');
		$wallet = $this->wallet_model->get_stock_by_user($stock->stock_id, $user->id_user);

		if ($stock) {
			adicionarCanonical(base_url() . 'stock');

			$this->data['stock'] = $stock;
			$this->data['wallet'] = $wallet;

			$paginas = array('stock/sell');

			renderizarPagina($paginas, $this->data);
		} else {
			message('error', 'Stock not found!');
			redirect('dashboard');
		}

		
	}

	public function save_sell()
	{
		if ($this->input->post()) {
			$user = $this->session->userdata('user');
			$this->load->model('wallet_model');
			$this->load->model('cotation_model');
			
			# OK // Pega os dados do POST
			$data['type'] = 'sell';
			$data['quantity'] = $this->input->post('quantidade');
			$data['user_id'] = $this->session->userdata('user')->id_user;
			$data['stock_id'] = $this->input->post('id_stock');
			$data['cotation_id'] = $this->input->post('id_cotation');
			$data['date_time'] = date('Y-m-d H:i:s');

			
			# OK // 1 - valida se possui o número de ações a vender
			$stock = $this->wallet_model->check_quantity($data['stock_id'], $user->id_user, $data['quantity']);
			if (!$stock) {
				message('error', 'Você não possui o total de ações que deseja vender. Por favor selecione um valor menor.');
				redirect('dashboard');
			}

			# OK // 2 - altera na carteira o número de ações
			$new_q = $stock->quantity - $data['quantity'];
			if ($new_q == 0) {
				$w = $this->wallet_model->delete($stock->id_wallet);
			} else {
				$wallet = [
					'id_wallet' => $stock->id_wallet,
					'quantity' => $new_q,
				];
				$w = $this->wallet_model->save($wallet);
			}

			// 3 - altera o saldo no usuário
			$price = $this->cotation_model->get_by_stock_and_id($data['cotation_id'], $data['stock_id']);

			// Verifica o preço da ação
			if ($price) {
				$price = $price->value;
			} else {
				message('error', 'Ocorreu algum erro, repita a operação.');
				redirect('dashboard');
			}
			
			$this->user_model->sell_stock($data['quantity'], $price, $user->id_user);
			// 4 - Salva a transação
			$this->load->model('transaction_model');
			$res = $this->transaction_model->save($data);

			if (!$res) {
				message('error', 'Ocorreu algum erro, repita a operação.');
			} else {
				message('success', 'Ação vendida com sucesso com suceso!');
				
			}
			redirect('wallet');
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
