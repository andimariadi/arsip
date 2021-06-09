<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_model extends CI_Model
{
	public function view()
	{
		$this->db->where('deleted_at', NULL);
		return $this->db->get('users');
	}

	public function getData($start, $limit)
	{
		$this->db->where('deleted_at', NULL);
		$this->db->limit($limit, $start);
		return $this->db->get('users');
	}

	public function where($where = array())
	{
		$this->db->where('deleted_at', NULL);
		$this->db->where($where);
		return $this->db->get('users');
	}

	public function create($data = array())
	{
		return $this->db->insert('users', $data);
	}
}