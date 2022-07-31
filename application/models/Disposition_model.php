<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Disposition_model extends CI_Model
{
	public function view()
	{
		$level = $this->session->userdata('level');
		$by_user = $this->session->userdata('id');
		if($level != 'administrator')
			$this->db->where('disposition.by_user', $by_user);
			
		$this->db->where('deleted_at', NULL);
		$this->db->where(array('YEAR(disposition.date)' => date('Y'), 'MONTH(disposition.date)' => date('m')));
		return $this->db->get('disposition');
	}

	public function getData($start, $limit)
	{
		$level = $this->session->userdata('level');
		$by_user = $this->session->userdata('id');
		if($level != 'administrator')
			$this->db->where('disposition.by_user', $by_user);
			
		$this->db->select('disposition.*, institute.name as institute_description, subcategory.name as subcategory_description');
		$this->db->join('institute', 'institute.id = disposition.institute_id', 'left');
		$this->db->join('subcategory', 'subcategory.id = disposition.subcategory_id', 'left');	
		$this->db->where('disposition.deleted_at', NULL);
		$this->db->where(array('YEAR(disposition.date)' => date('Y'), 'MONTH(disposition.date)' => date('m')));
		$this->db->limit($limit, $start);
		return $this->db->get('disposition');
	}

	public function where($where = array())
	{
		$level = $this->session->userdata('level');
		$by_user = $this->session->userdata('id');
		if($level != 'administrator')
			$this->db->where('disposition.by_user', $by_user);
			
		$this->db->where('deleted_at', NULL);
		$this->db->where($where);
		return $this->db->get('disposition');
	}

	public function create($data = array())
	{
		return $this->db->insert('disposition', $data);
	}

	public function update($id, $data = array())
	{
		$this->db->where('id', $id);
		return $this->db->update('disposition', $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$data = array(
			'deleted_at' => date('Y-m-d H:i:s'),
		);
		return $this->db->update('disposition', $data);
	}

	public function getReport($start, $limit, $start_date, $end_date)
	{
		$level = $this->session->userdata('level');
		$by_user = $this->session->userdata('id');
		if($level != 'administrator')
			$this->db->where('disposition.by_user', $by_user);
			
		$this->db->select('disposition.*, institute.name as institute_description, subcategory.name as subcategory_description');
		$this->db->join('institute', 'institute.id = disposition.institute_id', 'left');
		$this->db->join('subcategory', 'subcategory.id = disposition.subcategory_id', 'left');	
		$this->db->where('disposition.deleted_at', NULL);
		$this->db->where('disposition.date >=', $start_date);
		$this->db->where('disposition.date <=', $end_date);
		$this->db->limit($limit, $start);
		return $this->db->get('disposition');
	}

	public function getReportTotal($start_date, $end_date)
	{
		$level = $this->session->userdata('level');
		$by_user = $this->session->userdata('id');
		if($level != 'administrator')
			$this->db->where('disposition.by_user', $by_user);
			
		$this->db->select('disposition.*, institute.name as institute_description, subcategory.name as subcategory_description');
		$this->db->join('institute', 'institute.id = disposition.institute_id', 'left');
		$this->db->join('subcategory', 'subcategory.id = disposition.subcategory_id', 'left');	
		$this->db->where('disposition.deleted_at', NULL);
		$this->db->where('disposition.date >=', $start_date);
		$this->db->where('disposition.date <=', $end_date);
		return $this->db->get('disposition');
	}

	public function getAll()
	{
		$level = $this->session->userdata('level');
		$by_user = $this->session->userdata('id');
		if($level != 'administrator')
			$this->db->where('disposition.by_user', $by_user);
			
		$this->db->select('disposition.*, institute.name as institute_description, subcategory.name as subcategory_description');
		$this->db->join('institute', 'institute.id = disposition.institute_id', 'left');
		$this->db->join('subcategory', 'subcategory.id = disposition.subcategory_id', 'left');	
		$this->db->where('disposition.deleted_at', NULL);
		$this->db->where(array('YEAR(disposition.date)' => date('Y'), 'MONTH(disposition.date)' => date('m')));
		return $this->db->get('disposition');
	}
}