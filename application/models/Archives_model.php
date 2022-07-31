<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Archives_model extends CI_Model
{
	public function view()
	{
		$level = $this->session->userdata('level');
		$by_user = $this->session->userdata('id');
		if($level != 'administrator')
			$this->db->where('archives.by_user', $by_user);

		$this->db->where('deleted_at', NULL);
		return $this->db->get('archives');
	}

	public function viewThisMonth()
	{
		$level = $this->session->userdata('level');
		$by_user = $this->session->userdata('id');
		if($level != 'administrator')
			$this->db->where('archives.by_user', $by_user);

		$this->db->where('deleted_at', NULL);
		$this->db->where(array('YEAR(archives.created_at)' => date('Y'), 'MONTH(archives.created_at)' => date('m')));
		return $this->db->get('archives');
	}

	public function getData($start, $limit)
	{
		$level = $this->session->userdata('level');
		$by_user = $this->session->userdata('id');
		if($level != 'administrator')
			$this->db->where('archives.by_user', $by_user);
			
		$this->db->where('deleted_at', NULL);
		$this->db->limit($limit, $start);
		return $this->db->get('archives');
	}

	public function where($where = array())
	{
		$level = $this->session->userdata('level');
		$by_user = $this->session->userdata('id');
		if($level != 'administrator')
			$this->db->where('archives.by_user', $by_user);
			
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

	public function getReport($start, $limit, $start_date, $end_date)
	{
		$level = $this->session->userdata('level');
		$by_user = $this->session->userdata('id');
		if($level != 'administrator')
			$this->db->where('archives.by_user', $by_user);
			
		$this->db->where('deleted_at', NULL);
		$this->db->where('date(archives.created_at) >=', $start_date);
		$this->db->where('date(archives.created_at) <=', $end_date);
		$this->db->limit($limit, $start);
		return $this->db->get('archives');
	}

	public function getReportTotal($start_date, $end_date)
	{
		$level = $this->session->userdata('level');
		$by_user = $this->session->userdata('id');
		if($level != 'administrator')
			$this->db->where('archives.by_user', $by_user);
			
		$this->db->where('deleted_at', NULL);
		$this->db->where('date(archives.created_at) >=', $start_date);
		$this->db->where('date(archives.created_at) <=', $end_date);
		return $this->db->get('archives');
	}

	public function getAll()
	{
		$level = $this->session->userdata('level');
		$by_user = $this->session->userdata('id');
		if($level != 'administrator')
			$this->db->where('archives.by_user', $by_user);
			
		$this->db->where('deleted_at', NULL);
		$this->db->where(array('YEAR(archives.created_at)' => date('Y'), 'MONTH(archives.created_at)' => date('m')));
		return $this->db->get('archives');
	}
}