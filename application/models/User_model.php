<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

	protected $table_user = 'users';
	protected $table_role = 'roles';
	protected $table_class = 'classes';

	function __construct() {
		parent::__construct();
	}

	public function is_admin()
	{
		$user = $this->session->userdata('user');
		if ($user->role_id == 1){
			return true;
		}else{
			return false;
		}
	}

	public function logged($admin = false)
	{
		$user = $this->session->userdata('user');
		if (!$user) {
			redirect('login');
		}else{
			if ($admin && $user->role_id != 1) {
				redirect('trip');
			}
		}
	}

	public function save($data) {
		if (!isset($data['id_user'])) {
			$data['created_at'] = date('Y-m-d H:i:s');
			$data['saldo'] = 1000000;
			return $this->db->insert($this->table_user, $data);
		} else {
			$data['updated_at'] = date('Y-m-d H:i:s');
			$this->db->where('id_user', $data['id_user']);
			return $this->db->update($this->table_user, $data);
		}
	}

	public function get($id)
	{
		return $this->db
		->where('u.id_user',$id)
		->where('deleted_at', NULL)
		->join($this->table_role . ' as r', 'u.role_id = r.id', 'left')
		->get($this->table_user . ' as u')
		->row();
	}

	public function delete($id)
	{
		if ($id) {
			$this->db->where('id_user', $id);
			$data = array('deleted_at' => date('Y-m-d H:i:s'));
			return $this->db->update($this->table_user, $data);
		}
	}

	public function get_by_email($email)
	{
		return $this->db->where('email',$email)
		->get($this->table_user)
		->row();
	}

	public function get_by_class($class)
	{
		return $this->db->where('class', $class)
		->get($this->table_user)
		->result();
	}

	public function check_saldo($quantity, $price, $id_user)
	{
		$total = doubleval($quantity) * doubleval($price);

		$user =  $this->db
		->where('id_user',$id_user)
		->get($this->table_user)
		->row();

		if ($user) {
			return ($total <= $user->saldo)? true : false;
		}

		return false;
	}

	public function get_all() {
		return $this->db
		->where('u.deleted_at', NULL)
		->join($this->table_role . ' as r', 'u.role_id = r.id', 'left')
		->join($this->table_class . ' as c', 'u.class = c.id_class', 'left')
		->get($this->table_user . ' as u')
		->result();
	}

	public function get_type_user()
	{
		$query = $this->db->order_by('id ASC')->get($this->table_role);
		return $query->result();
	}

	public function validate_user($email, $pass)
	{
		$query = $this->db

			->get_where($this->table_user, array('email' => $email, 'password' => md5($pass), 'deleted_at' => null,));
		
		return $query->row();
	}

	public function sell_stock($quantity, $price, $id_user)
	{
		$saldo = doubleval($quantity) * doubleval($price);

		$this->db->set('saldo', 'saldo+'.$saldo, FALSE);
		$this->db->where('id_user', $id_user);
		$this->db->update($this->table_user);

		$user = $this->db->select()
		->where('id_user', $id_user)
		->get('users')
		->row();

		$this->session->unset_userdata('user');
		if ($user) {
			$this->session->set_userdata('user', $user);
		}
	}

	public function buy_stock($quantity, $price, $id_user)
	{
		$saldo = doubleval($quantity) * doubleval($price);

		$this->db->set('saldo', 'saldo-'.$saldo, FALSE);
		$this->db->where('id_user', $id_user);
		$this->db->update($this->table_user);

		$user = $this->db->select()
		->where('id_user', $id_user)
		->get('users')
		->row();

		$this->session->unset_userdata('user');
		if ($user) {
			$this->session->set_userdata('user', $user);
		}


	}




}
