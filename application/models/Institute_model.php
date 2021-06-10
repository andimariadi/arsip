<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Institute_model extends CI_Model
{
	public function view()
	{
		$this->db->where('deleted_at', NULL);
		return $this->db->get('institute');
	}

	public function getData($start, $limit)
	{
		$this->db->where('deleted_at', NULL);
		$this->db->limit($limit, $start);
		return $this->db->get('institute');
	}

	public function where($where = array())
	{
		$this->db->where('deleted_at', NULL);
		$this->db->where($where);
		return $this->db->get('institute');
	}

	public function create($data = array())
	{
		return $this->db->insert('institute', $data);
	}

	public function update($id, $data = array())
	{
		$this->db->where('id', $id);
		return $this->db->update('institute', $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$data = array(
			'deleted_at' => date('Y-m-d H:i:s'),
		);
		return $this->db->update('institute', $data);
	}
}