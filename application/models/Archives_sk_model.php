<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Archives_sk_model extends CI_Model
{
	public function view()
	{
		$this->db->where('deleted_at', NULL);
		return $this->db->get('archives_sk');
	}

	public function viewThisMonth()
	{
		$this->db->where('deleted_at', NULL);
		$this->db->where(array('YEAR(archives_sk.created_at)' => date('Y'), 'MONTH(archives_sk.created_at)' => date('m')));
		return $this->db->get('archives_sk');
	}

	public function getData($start, $limit)
	{
		$this->db->where('deleted_at', NULL);
		$this->db->limit($limit, $start);
		return $this->db->get('archives_sk');
	}

	public function where($where = array())
	{
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
		$this->db->where('deleted_at', NULL);
		$this->db->where('archives_sk.start_date >=', $start_date);
		$this->db->where('archives_sk.start_date <=', $end_date);
		$this->db->limit($limit, $start);
		return $this->db->get('archives_sk');
	}

	public function getReportTotal($start_date, $end_date)
	{
		$this->db->where('deleted_at', NULL);
		$this->db->where('archives_sk.start_date >=', $start_date);
		$this->db->where('archives_sk.start_date <=', $end_date);
		return $this->db->get('archives_sk');
	}

	public function getAll()
	{
		$this->db->where('deleted_at', NULL);
		$this->db->where(array('YEAR(archives_sk.created_at)' => date('Y'), 'MONTH(archives_sk.created_at)' => date('m')));
		return $this->db->get('archives_sk');
	}
}