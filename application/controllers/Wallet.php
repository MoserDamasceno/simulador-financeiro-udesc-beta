<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wallet extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		
		$this->load->model('wallet_model');
		$this->load->model('cotation_model');
		$this->data['title'] = 'Wallet';
		$this->data['user'] = $user = $this->session->userdata('user');

		adicionarCanonical(base_url() . 'wallet');

		$paginas = [
			'wallet/main',
		];

		$wallet = $this->wallet_model->get_by_user($user->id_user);
		foreach ($wallet as $w) {
			$cotation = $this->cotation_model->get_cotation_by_stock($w->stock_id);
			if ($cotation) {
				$w->date_time = $cotation->date_time;
				$w->value = $cotation->value;
				$w->id_cotation = $cotation->id_cotation;
			}
			
		}
		$this->data['wallet'] = $wallet;

		renderizarPagina($paginas, $this->data);
	}



	public function ranking()
	{
		
		$this->load->model('wallet_model');
		$this->load->model('cotation_model');
		
		$this->data['title'] = 'Ranking';
		$this->data['user'] = $user = $this->session->userdata('user');

		adicionarCanonical(base_url() . 'wallet/ranking');

		$paginas = [
			'wallet/ranking',
		];

		$users = $this->user_model->get_all();

		foreach ($users as $u => $user) {

			$user->wallet = $this->wallet_model->get_by_user($user->id_user);

			if ($user->wallet) {
				$total = 0;
				$values = array();
				foreach ($user->wallet as $w => $wallet) {
					$cotation = $this->cotation_model->get_cotation_by_stock($wallet->stock_id);
					if ($cotation) {
						$total += round($cotation->value, 2) * $wallet->quantity;
					} else {
						$total += round($wallet->average_price, 2) * $wallet->quantity;
					}

				}
				if ($total) {
					$valor_ativos =  $total;
					$valor_total =  $total + $user->saldo;
				} 
			} else {
				$valor_total = $user->saldo;
				$valor_ativos = 0;
			}


			$valor_inicial = 1000000; 
			$valor_atual = $user->saldo; 
			$variacao = str_replace('.', ',', round((($valor_total / $valor_inicial) - 1 ) * 100, 2) );
			
			$user->values =[
				'valor_inicial' => $valor_inicial,
				'valor_atual' => $valor_atual,
				'valor_total' => $valor_total,
				'valor_ativos' => $valor_ativos,
				'variacao' => $variacao,
			];

			$valor_total = null;
			$valor_inicial = null;
			$valor_atual = null;
			$valor_ativos = null;
			$variacao = null;


		}
		
		// pre($users);

		$this->data['users'] = $users;
		
		renderizarPagina($paginas, $this->data);
	}

}


/* End of file company.php */
/* Location: ./application/controllers/company.php */
