<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends MY_Controller {

	protected $data = array();

	public function __construct()
	{
		parent::__construct();
		$this->sale_model->change_status();
	}

	public function index()
	{
		$this->session->unset_userdata('session');
		$this->session->sess_destroy();
		redirect('login');
	}

}
