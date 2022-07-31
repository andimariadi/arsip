<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Description_model extends CI_Model
{
	public function view()
	{
		$level = $this->session->userdata('level');
		$by_user = $this->session->userdata('id');
		if($level != 'administrator')
			$this->db->where('description_subcategory.by_user', $by_user);
			
		$this->db->where('deleted_at', NULL);
		return $this->db->get('description_subcategory');
	}

	public function getData($start, $limit)
	{
		$level = $this->session->userdata('level');
		$by_user = $this->session->userdata('id');
		if($level != 'administrator')
			$this->db->where('description_subcategory.by_user', $by_user);
			
		$this->db->select('description_subcategory.*, subcategory.name as subcategory_description, worker.full_name');
		$this->db->where('description_subcategory.deleted_at', NULL);
		$this->db->join('subcategory', 'subcategory.id = description_subcategory.subcategory_id', 'left');
		$this->db->join('worker', 'worker.id = description_subcategory.user', 'left');
		$this->db->limit($limit, $start);
		return $this->db->get('description_subcategory');
	}

	public function where($where = array())
	{
		$level = $this->session->userdata('level');
		$by_user = $this->session->userdata('id');
		if($level != 'administrator')
			$this->db->where('description_subcategory.by_user', $by_user);
			
		$this->db->where('deleted_at', NULL);
		$this->db->where($where);
		return $this->db->get('description_subcategory');
	}

	public function GetWhere($where = array())
	{
		$level = $this->session->userdata('level');
		$by_user = $this->session->userdata('id');
		// if($level != 'administrator')
		// 	$this->db->where('description_subcategory.by_user', $by_user);
			
		$this->db->select('description_subcategory.*, subcategory.name as subcategory_description, worker.full_name');
		$this->db->where('description_subcategory.deleted_at', NULL);
		$this->db->join('subcategory', 'subcategory.id = description_subcategory.subcategory_id', 'left');
		$this->db->join('worker', 'worker.id = description_subcategory.user', 'left');
		$this->db->where($where);
		return $this->db->get('description_subcategory');
	}

	public function create($data = array())
	{
		return $this->db->insert('description_subcategory', $data);
	}

	public function update($id, $data = array())
	{
		$this->db->where('id', $id);
		return $this->db->update('description_subcategory', $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$data = array(
			'deleted_at' => date('Y-m-d H:i:s'),
		);
		return $this->db->update('description_subcategory', $data);
	}

	public function getAll()
	{
		$level = $this->session->userdata('level');
		$by_user = $this->session->userdata('id');
		if($level != 'administrator')
			$this->db->where('description_subcategory.by_user', $by_user);
			
		$this->db->select('description_subcategory.*, subcategory.name as subcategory_description, worker.full_name');
		$this->db->where('description_subcategory.deleted_at', NULL);
		$this->db->join('subcategory', 'subcategory.id = description_subcategory.subcategory_id', 'left');
		$this->db->join('worker', 'worker.id = description_subcategory.user', 'left');
		return $this->db->get('description_subcategory');
	}
}