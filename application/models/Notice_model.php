<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notice_model extends CI_Model
{
	public function view()
	{
		$this->db->where('deleted_at', NULL);
		return $this->db->get('archive_public');
	}

	public function getData($start, $limit)
	{
		$this->db->where('deleted_at', NULL);
		$this->db->limit($limit, $start);
		return $this->db->get('archive_public');
	}

	public function where($where = array())
	{
		$this->db->where('deleted_at', NULL);
		$this->db->where($where);
		return $this->db->get('archive_public');
	}

	public function create($data = array())
	{
		return $this->db->insert('archive_public', $data);
	}

	public function update($id, $data = array())
	{
		$this->db->where('id', $id);
		return $this->db->update('archive_public', $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$data = array(
			'deleted_at' => date('Y-m-d H:i:s'),
		);
		return $this->db->update('archive_public', $data);
	}

	public function getReport($start, $limit, $start_date, $end_date)
	{
		$this->db->where('deleted_at', NULL);
		$this->db->where('date(archive_public.created_at) >=', $start_date);
		$this->db->where('date(archive_public.created_at) <=', $end_date);
		$this->db->limit($limit, $start);
		return $this->db->get('archive_public');
	}

	public function getReportTotal($start_date, $end_date)
	{
		$this->db->where('deleted_at', NULL);
		$this->db->where('date(archive_public.created_at) >=', $start_date);
		$this->db->where('date(archive_public.created_at) <=', $end_date);
		return $this->db->get('archive_public');
	}

	public function getAll()
	{
		$this->db->where('deleted_at', NULL);
		$this->db->where(array('YEAR(archive_public.created_at)' => date('Y'), 'MONTH(archive_public.created_at)' => date('m')));
		return $this->db->get('archive_public');
	}
}