<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Archives_sk_model extends CI_Model
{
	public function view()
	{
		$level = $this->session->userdata('level');
		$by_user = $this->session->userdata('id');
		if($level != 'administrator')
			$this->db->where('archives_sk.by_user', $by_user);
			
		$this->db->where('deleted_at', NULL);
		return $this->db->get('archives_sk');
	}

	public function viewThisMonth()
	{
		$level = $this->session->userdata('level');
		$by_user = $this->session->userdata('id');
		if($level != 'administrator')
			$this->db->where('archives_sk.by_user', $by_user);
			
		$this->db->where('deleted_at', NULL);
		$this->db->where(array('YEAR(archives_sk.created_at)' => date('Y'), 'MONTH(archives_sk.created_at)' => date('m')));
		return $this->db->get('archives_sk');
	}

	public function getData($start, $limit)
	{
		$level = $this->session->userdata('level');
		$by_user = $this->session->userdata('id');
		if($level != 'administrator')
			$this->db->where('archives_sk.by_user', $by_user);
			
		$this->db->where('deleted_at', NULL);
		$this->db->limit($limit, $start);
		return $this->db->get('archives_sk');
	}

	public function where($where = array())
	{
		$level = $this->session->userdata('level');
		$by_user = $this->session->userdata('id');
		if($level != 'administrator')
			$this->db->where('archives_sk.by_user', $by_user);
			
		$this->db->where('deleted_at', NULL);
		$this->db->where($where);
		return $this->db->get('archives_sk');
	}

	public function create($data = array())
	{
		return $this->db->insert('archives_sk', $data);
	}

	public function update($id, $data = array())
	{
		$this->db->where('id', $id);
		return $this->db->update('archives_sk', $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$data = array(
			'deleted_at' => date('Y-m-d H:i:s'),
		);
		return $this->db->update('archives_sk', $data);
	}

	public function getReport($start, $limit, $start_date, $end_date)
	{
		$level = $this->session->userdata('level');
		$by_user = $this->session->userdata('id');
		if($level != 'administrator')
			$this->db->where('archives_sk.by_user', $by_user);
			
		$this->db->where('deleted_at', NULL);
		$this->db->group_start();
		$this->db->where('archives_sk.expired_date >=', $start_date);
		$this->db->or_where('archives_sk.expired_date >=', $end_date);
		$this->db->group_end();
		$this->db->limit($limit, $start);
		return $this->db->get('archives_sk');
	}

	public function getReportTotal($start_date, $end_date)
	{
		$level = $this->session->userdata('level');
		$by_user = $this->session->userdata('id');
		if($level != 'administrator')
			$this->db->where('archives_sk.by_user', $by_user);
			
		$this->db->where('deleted_at', NULL);
		$this->db->group_start();
		$this->db->where('archives_sk.expired_date >=', $start_date);
		$this->db->or_where('archives_sk.expired_date >=', $end_date);
		$this->db->group_end();
		return $this->db->get('archives_sk');
	}

	public function getAll()
	{
		$level = $this->session->userdata('level');
		$by_user = $this->session->userdata('id');
		if($level != 'administrator')
			$this->db->where('archives_sk.by_user', $by_user);
			
		$this->db->where('deleted_at', NULL);
		$this->db->where(array('YEAR(archives_sk.created_at)' => date('Y'), 'MONTH(archives_sk.created_at)' => date('m')));
		return $this->db->get('archives_sk');
	}
}