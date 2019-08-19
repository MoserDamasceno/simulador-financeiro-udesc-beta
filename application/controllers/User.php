<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {

	protected $data = array();

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->data['title'] = 'Usuários';
		$this->data['users'] = $this->user_model->get_all();
		$this->data['type_user'] = $this->user_model->get_type_user();
		adicionarCanonical(base_url() . 'user');

		$paginas = array('user/list_users');

		renderizarPagina($paginas, $this->data);
	}

	public function create()
	{
		$this->data['type_user'] = $this->user_model->get_type_user();
		$this->data['title'] = 'Adicionar Usuário';
		adicionarCanonical(base_url() . 'user/create');

		$paginas = array('user/create_user');
		renderizarPagina($paginas, $this->data);
	}

	public function edit($id = null)
	{

		if ($id === null) {
			redirect('user');
		}

		$user = $this->user_model->get($id); 
		if ($user) {
			$this->data['title'] = 'Adicionar Usuário';
			$this->data['user'] = $user;
			$this->data['type_user'] = $this->user_model->get_type_user();
			adicionarCanonical(base_url() . 'user/create');

			$paginas = array('user/edit_user');
			renderizarPagina($paginas, $this->data);

		} else {
			// Mensagem Usuário não encontrado
		}

	}

	public function delete($id)
	{
		$res =  $this->user_model->delete($id);
		if ($res) {
			message('success', 'Usuário excluído com sucesso');
			redirect('user');
		}
	}

	public function profile()
	{
		if ($this->session->userdata('user')->role_id == 3) {
			$id = $this->session->userdata('user')->id_user;

			$user = $this->user_model->get($id); 
			if ($user) {
				$this->data['title'] = 'Editar Usuário';
				$this->data['user'] = $user;
				$this->data['type_user'] = $this->user_model->get_type_user();
				adicionarCanonical(base_url() . 'user/edit');

				$paginas = array('user/edit_user');
				renderizarPagina($paginas, $this->data);

			} 

		} else {
			
		}

	}

	public function reset_password()
	{
		# code...
	}

	public function save($id = null) {
		if ($this->input->post()) {
			$data['id_user'] = $this->input->post('id_user');
			$data['name'] = $this->input->post('name');
			$data['email'] = $this->input->post('email');
			$data['phone'] = $this->input->post('phone');
			$data['role_id'] = $this->input->post('role_id');
			if ($this->input->post('password')) {
				$data['password'] = MD5($this->input->post('password'));
			}

			$res = $this->user_model->save($data);
			if (!$res) {
				message('error', 'Ocorreu algum erro, repita a operação.');
			} else {
				if ($id) {
					message('success', 'Usuário alterado com suceso!');
				}else{
					message('success', 'Usuário cadastrado com suceso!');
				}
			}
			redirect('user');
		}
	}

	public function validate_email()
	{
		if ($this->input->post()){
			$email = $this->input->post('email');
			$user = $this->user_model->get_by_email($email);
			if ($user) {
				echo 'false';
			}else{
				echo 'true';
			}
		}
	}

}
