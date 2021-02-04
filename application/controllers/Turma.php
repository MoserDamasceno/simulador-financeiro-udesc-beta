<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Turma extends MY_Controller {

	protected $data = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->model('turma_model');
		$this->data['user'] = $user = $this->session->userdata('user');
	}

	public function index()
	{
		$this->data['title'] = 'Turmas';
		$this->data['classes'] = $this->turma_model->get_all();
		adicionarCanonical(base_url() . 'class');

		$paginas = array('turma/list_turmas');

		renderizarPagina($paginas, $this->data);
	}

	public function alunos($id = null)
	{
		$this->data['title'] = 'Turmas';
		$this->data['classes'] = $this->turma_model->get_all();
		$class = $this->turma_model->get($id);
		adicionarCanonical(base_url() . 'turma');
		
		if ($class) {
			$this->data['class'] = $class;
			$this->data['alunos'] = $this->user_model->get_by_class($id);
			$paginas = array('turma/list_alunos_turma');
			renderizarPagina($paginas, $this->data);
		} else {
			message('error', 'Turma não encontrada.');
			redirect('turma');
		}

		
	}

	public function create()
	{
		$this->data['title'] = 'Adicionar Turma';
		adicionarCanonical(base_url() . 'turma/create');

		$paginas = array('turma/create_turma');
		renderizarPagina($paginas, $this->data);
	}

	public function edit($id = null)
	{

		if ($id === null) {
			redirect('turma');
		}

		$class = $this->turma_model->get($id); 
		if ($class) {
			$this->data['title'] = 'Editar Turma';
			$this->data['class'] = $class;
			adicionarCanonical(base_url() . 'class/edit');

			$paginas = array('turma/edit_turma');
			renderizarPagina($paginas, $this->data);

		} else {
			message('error', 'Turma não encontrada.');
			redirect('turma');
		}

	}

	public function delete($id)
	{
		$res =  $this->turma_model->delete($id);
		if ($res) {
			message('success', 'Turma excluída com sucesso');
			redirect('turma');
		}
	}



	public function save($id = null) {
		if ($this->input->post()) {
			$data['id_class'] = $this->input->post('id_class');
			$data['class'] = $this->input->post('class');

			$res = $this->turma_model->save($data);
			if (!$res) {
				message('error', 'Ocorreu algum erro, repita a operação.');
			} else {
				if ($id) {
					message('success', 'Turma alterada com sucesso!');
				}else{
					message('success', 'Turma cadastrada com sucesso!');
				}
			}
			redirect('turma');
		}
	}



}
