<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Segmentation_model extends CI_Model {

	protected $table_segmentation = 'segmentations';
	protected $table_companies_segmentations = 'companies_segmentations';

	function __construct() {
		parent::__construct();
	}

	public function get($id = null)
	{
		if (! $id) {
			return $this->db->get($this->table_segmentation)->result();
		}
	}

	public function associate($company, $segment, $primary = 0)
	{
		$data = [
			'company_id' => $company,
			'segmentation_id' => $segment,
			'primary' => $primary,
		];

		$result = $this->db
			->where($data)
			->get($this->table_companies_segmentations)
			->row();

		if (! $result) {
			$this->db->insert($this->table_companies_segmentations, $data);
		}

		return $result ?: $this->db->insert_id();
	}

	public function by_company($id)
	{
		return $this->db
			->where('company_id', $id)
			->join('segmentations', 'companies_segmentations.segmentation_id = segmentations.id_segmentation')
			->get($this->table_companies_segmentations)
			->result();
	}

	public function by_cnae($cnae)
	{
		return $this->db
			->where('cnae', $cnae)
			->get($this->table_segmentation)
			->row();
	}

	public function disassociate($id)
	{
		$this->db
			->where('id', $id)
			->delete($this->table_companies_segmentations);
	}

	public function delete_by_company($company_id)
	{
		$this->db
			->where('company_id', $company_id)
			->delete($this->table_companies_segmentations);
	}

	public function get_all()
	{
		return $this->db
			->where('class !=', '')
			->where('subclass', '')
			->order_by('section', 'division', 'group', 'class')
			->get($this->table_segmentation)
			->result();

	}
}
