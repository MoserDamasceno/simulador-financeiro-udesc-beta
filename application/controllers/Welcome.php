<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function theme()
	{
		$this->data['title'] = 'Theme';
		adicionarCanonical(base_url() . 'welcome/theme');

		// adicionarJavaScript('init.js');
		// adicionarJavaScript('mask-input.js');
		// adicionarJavaScript('pages/client.js');
		// adicionarStyle('styleDataTable.css');

		$result = $this->session->userdata('result');
		if ($result) {
			$this->data['message']['alert']  = $this->session->userdata('alert');
			$this->data['message']['result'] = $result;
			$this->session->set_userdata( array('result' => false, 'alert' => false) );
		}

		$paginas = array('theme_view');
		renderizarPagina($paginas, $this->data);
		
	}
}
