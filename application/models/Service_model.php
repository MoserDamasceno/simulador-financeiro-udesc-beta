<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Service_model extends CI_Model {

	protected $table_service = 'services';

	function __construct() {
		parent::__construct();
	}

	public function save($data) {
		if (!$data['id_service']) {
			return $this->db->insert($this->table_service, $data);
		} else {
			$this->db->where('id_service', $data['id_service']);
			return $this->db->update($this->table_service, $data);
		}
	}

	public function get($id)
	{
		return $this->db
		->where('u.id_service',$id)
		->get($this->table_service . ' as u')
		->row();
	}

	public function delete($id)
	{
		if ($id) {
			$this->db->where('id_service', $id);
			return $this->db->delete($this->table_service);
		}
	}

	public function get_all() {
		return $this->db
		->get($this->table_service . ' as u')
		->result();
	}

}