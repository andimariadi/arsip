<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subcategory_model extends CI_Model
{
	public function view()
	{
		$this->db->where('deleted_at', NULL);
		return $this->db->get('subcategory');
	}

	public function getData($start, $limit)
	{
		$this->db->select('subcategory.*, category.name as category_description');
		$this->db->where('subcategory.deleted_at', NULL);
		$this->db->join('category', 'category.id = subcategory.category_id', 'left');
		$this->db->limit($limit, $start);
		return $this->db->get('subcategory');
	}

	public function where($where = array())
	{
		$this->db->where('deleted_at', NULL);
		$this->db->where($where);
		return $this->db->get('subcategory');
	}

	public function create($data = array())
	{
		return $this->db->insert('subcategory', $data);
	}

	public function update($id, $data = array())
	{
		$this->db->where('id', $id);
		return $this->db->update('subcategory', $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$data = array(
			'deleted_at' => date('Y-m-d H:i:s'),
		);
		return $this->db->update('subcategory', $data);
	}

	public function getAll()
	{
		$this->db->select('subcategory.*, category.name as category_description');
		$this->db->where('subcategory.deleted_at', NULL);
		$this->db->join('category', 'category.id = subcategory.category_id', 'left');
		return $this->db->get('subcategory');
	}
}