<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NotFound extends MY_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function not_found()
	{
		// $this->load->view('not_found');
		$this->data['title'] = 'Theme';
		adicionarCanonical(base_url() . 'welcome/theme');

		$paginas = array('not_found');
		renderizarPagina($paginas, $this->data);
		
	}
}
