<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	protected $data = array();

	protected $messages = [
		'validation' => 'E-mail inválido.',
		'email' => 'Este e-mail já está em uso.',
		'required' => 'Todos os campos são obrigatórios.',
		'terms' => 'Você precisa aceitar os termos e condições.',
		'some' => 'Erro ao se registrar, pora favor repita a operação.',
		'register' => 'Sucesso ao registrar! Agora é só efetuar o Login!',
		'login' => 'Erro ao efetuar login! Usuário ou senha inválidos, ou usuário desativado',
	];

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}

	public function index()
	{
		$this->is_logged();

		$this->data['title'] = 'Login';
		adicionarCanonical(base_url() . 'login');
		adicionarJavaScript('pages/home.js');
		adicionarStyle('login.css');

		if ($error = $this->input->get('error')) {
			$this->data['error'] = $this->messages[$error];
		}

		if ($success = $this->input->get('success')) {
			$this->data['success'] = $this->messages[$success];
		}

		$opt['template'] = 'login';
		$paginas = array('auth/login_view');
		renderizarPagina($paginas, $this->data, $opt);
	}

	public function register()
	{
		if ($this->input->post()) {
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$class = $this->input->post('class');
			$password = $this->input->post('password');
			// md5($pass)
			if (! $name || ! $email || ! $password || ! $class) {
				return redirect('auth/register?error=required');
			}
		
			if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
				return redirect('auth/register?error=validation');
			}

			if ($this->user_model->get_by_email($email)) {
				return redirect('auth/register?error=email');
			}

			$res = $this->user_model->save([
				'role_id' => 2,
				'name' => $name,
				'email' => $email,
				'class' => $class,
				'password' => md5($password),
			]);

			if (! $res) {
				return redirect('auth/register?error=some');
			}


			return redirect('auth?success=register');
		}

		$this->is_logged();

		$this->data['title'] = 'Cadastrar';
		adicionarCanonical(base_url() . 'register');
		adicionarJavaScript('pages/home.js');
		adicionarStyle('login.css');

		if ($error = $this->input->get('error')) {
			$this->data['error'] = $this->messages[$error];
		}

		$opt['template'] = 'login';
		$paginas = array('auth/register_view');
		renderizarPagina($paginas, $this->data, $opt);
	}

	public function login()
	{
		if ($this->input->post()) {
			$this->session->unset_userdata('user');
			$user = $this->user_model->validate_user($this->input->post('email'), $this->input->post('password'));

			if ($user) {
				$this->session->set_userdata('user', $user);
				redirect('dashboard');
			} else {
				$this->data['title'] = 'Login';
				
				redirect('auth?error=login');
			}
			
		} else{
			redirect('auth');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('user');
		redirect('auth');
	}

	public function is_logged()
	{
		$user = $this->session->userdata('user');
		if($user) {
			redirect('dashboard');
		}
	}

}
