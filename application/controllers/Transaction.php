<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaction extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		
		$this->load->model('transaction_model');
		$this->data['title'] = 'Transaction';
		$this->data['user'] = $user = $this->session->userdata('user');

		adicionarCanonical(base_url() . 'transaction');

		$paginas = [
			'transaction/main',
		];


		$transaction = $this->transaction_model->get_all_by_user($user->id_user);

		$this->data['transaction'] = $transaction;
		
		renderizarPagina($paginas, $this->data);
	}

}


/* End of file company.php */
/* Location: ./application/controllers/company.php */
