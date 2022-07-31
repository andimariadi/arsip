<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guestbook_model extends CI_Model
{
	public function view()
	{
		$level = $this->session->userdata('level');
		$by_user = $this->session->userdata('id');
		if($level != 'administrator')
			$this->db->where('by_user', $by_user);

		$this->db->where('deleted_at', NULL);
		$this->db->where(array('YEAR(guest_book.date)' => date('Y'), 'MONTH(guest_book.date)' => date('m')));
		return $this->db->get('guest_book');
	}

	public function viewAll()
	{
		$level = $this->session->userdata('level');
		$by_user = $this->session->userdata('id');
		if($level != 'administrator')
			$this->db->where('by_user', $by_user);

		$this->db->where('guest_book.deleted_at', NULL);
		return $this->db->get('guest_book');
	}

	public function getData($start, $limit)
	{
		
		$level = $this->session->userdata('level');
		$by_user = $this->session->userdata('id');
		if($level != 'administrator')
			$this->db->where('guest_book.by_user', $by_user);

		$this->db->select('guest_book.*, institute.name as institute_description, subcategory.name as utility_description');
		$this->db->join('institute', 'institute.id = guest_book.institute_id', 'left');
		$this->db->join('subcategory', 'subcategory.id = guest_book.utility', 'left');		
		$this->db->where(array('YEAR(guest_book.date)' => date('Y'), 'MONTH(guest_book.date)' => date('m')));
		$this->db->where('guest_book.deleted_at', NULL);
		$this->db->limit($limit, $start);
		return $this->db->get('guest_book');
	}

	public function where($where = array())
	{
		$level = $this->session->userdata('level');
		$by_user = $this->session->userdata('id');
		if($level != 'administrator')
			$this->db->where('guest_book.by_user', $by_user);
		
		$this->db->where('deleted_at', NULL);
		$this->db->where($where);
		return $this->db->get('guest_book');
	}

	public function create($data = array())
	{
		return $this->db->insert('guest_book', $data);
	}

	public function update($id, $data = array())
	{
		$this->db->where('id', $id);
		return $this->db->update('guest_book', $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$data = array(
			'deleted_at' => date('Y-m-d H:i:s'),
		);
		return $this->db->update('guest_book', $data);
	}

	public function getReport($start, $limit, $start_date, $end_date)
	{
		
		$level = $this->session->userdata('level');
		$by_user = $this->session->userdata('id');
		if($level != 'administrator')
			$this->db->where('guest_book.by_user', $by_user);

		$this->db->select('guest_book.*, institute.name as institute_description, subcategory.name as utility_description');
		$this->db->join('institute', 'institute.id = guest_book.institute_id', 'left');
		$this->db->join('subcategory', 'subcategory.id = guest_book.utility', 'left');
		$this->db->where('guest_book.deleted_at', NULL);
		$this->db->where('guest_book.date >=', $start_date);
		$this->db->where('guest_book.date <=', $end_date);
		$this->db->limit($limit, $start);
		return $this->db->get('guest_book');
	}

	public function getReportTotal($start_date, $end_date)
	{		
		$level = $this->session->userdata('level');
		$by_user = $this->session->userdata('id');
		if($level != 'administrator')
			$this->db->where('guest_book.by_user', $by_user);

		$this->db->select('guest_book.*, institute.name as institute_description, subcategory.name as utility_description');
		$this->db->join('institute', 'institute.id = guest_book.institute_id', 'left');
		$this->db->join('subcategory', 'subcategory.id = guest_book.utility', 'left');
		$this->db->where('guest_book.deleted_at', NULL);
		$this->db->where('guest_book.date >=', $start_date);
		$this->db->where('guest_book.date <=', $end_date);
		return $this->db->get('guest_book');
	}

	public function getAll()
	{
		$level = $this->session->userdata('level');
		$by_user = $this->session->userdata('id');
		if($level != 'administrator')
			$this->db->where('guest_book.by_user', $by_user);
			
		$this->db->select('guest_book.*, institute.name as institute_description, subcategory.name as utility_description');
		$this->db->join('institute', 'institute.id = guest_book.institute_id', 'left');
		$this->db->join('subcategory', 'subcategory.id = guest_book.utility', 'left');		
		$this->db->where(array('YEAR(guest_book.date)' => date('Y'), 'MONTH(guest_book.date)' => date('m')));
		$this->db->where('guest_book.deleted_at', NULL);
		return $this->db->get('guest_book');
	}
}