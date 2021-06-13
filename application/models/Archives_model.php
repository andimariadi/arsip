<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Archives_model extends CI_Model
{
	public function view()
	{
		$this->db->where('deleted_at', NULL);
		return $this->db->get('archives');
	}

	public function viewThisMonth()
	{
		$this->db->where('deleted_at', NULL);
		$this->db->where(array('YEAR(archives.created_at)' => date('Y'), 'MONTH(archives.created_at)' => date('m')));
		return $this->db->get('archives');
	}

	public function getData($start, $limit)
	{
		$this->db->where('deleted_at', NULL);
		$this->db->limit($limit, $start);
		return $this->db->get('archives');
	}

	public function where($where = array())
	{
		$this->db->where('deleted_at', NULL);
		$this->db->where($where);
		return $this->db->get('archives');
	}

	public function create($data = array())
	{
		return $this->db->insert('archives', $data);
	}

	public function update($id, $data = array())
	{
		$this->db->where('id', $id);
		return $this->db->update('archives', $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$data = array(
			'deleted_at' => date('Y-m-d H:i:s'),
		);
		return $this->db->update('archives', $data);
	}
}