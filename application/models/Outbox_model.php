<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Outbox_model extends CI_Model
{
	public function view()
	{
		$this->db->where('mail_outbox.deleted_at', NULL);
		$this->db->where(array('YEAR(mail_outbox.date)' => date('Y'), 'MONTH(mail_outbox.date)' => date('m')));
		return $this->db->get('mail_outbox');
	}

	public function getData($start, $limit)
	{
		$this->db->select('mail_outbox.*, institute.name as institute_description, subcategory.name as category_description');
		$this->db->join('subcategory', 'subcategory.id = mail_outbox.category_id', 'left');
		$this->db->join('institute', 'institute.id = mail_outbox.institute_id', 'left');
		$this->db->where('mail_outbox.deleted_at', NULL);
		$this->db->where(array('YEAR(mail_outbox.date)' => date('Y'), 'MONTH(mail_outbox.date)' => date('m')));
		$this->db->limit($limit, $start);
		return $this->db->get('mail_outbox');
	}

	public function where($where = array())
	{
		$this->db->where('deleted_at', NULL);
		$this->db->where($where);
		return $this->db->get('mail_outbox');
	}

	public function create($data = array())
	{
		return $this->db->insert('mail_outbox', $data);
	}

	public function update($id, $data = array())
	{
		$this->db->where('id', $id);
		return $this->db->update('mail_outbox', $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$data = array(
			'deleted_at' => date('Y-m-d H:i:s'),
		);
		return $this->db->update('mail_outbox', $data);
	}

	public function getReport($start, $limit, $start_date, $end_date)
	{
		$this->db->select('mail_outbox.*, institute.name as institute_description, subcategory.name as category_description');
		$this->db->join('subcategory', 'subcategory.id = mail_outbox.category_id', 'left');
		$this->db->join('institute', 'institute.id = mail_outbox.institute_id', 'left');
		$this->db->where('mail_outbox.deleted_at', NULL);
		$this->db->where('mail_outbox.date >=', $start_date);
		$this->db->where('mail_outbox.date <=', $end_date);
		$this->db->limit($limit, $start);
		return $this->db->get('mail_outbox');
	}

	public function getReportTotal($start_date, $end_date)
	{
		$this->db->select('mail_outbox.*, institute.name as institute_description, subcategory.name as category_description');
		$this->db->join('subcategory', 'subcategory.id = mail_outbox.category_id', 'left');
		$this->db->join('institute', 'institute.id = mail_outbox.institute_id', 'left');
		$this->db->where('mail_outbox.deleted_at', NULL);
		$this->db->where('mail_outbox.date >=', $start_date);
		$this->db->where('mail_outbox.date <=', $end_date);
		return $this->db->get('mail_outbox');
	}

	public function getAll()
	{
		$this->db->select('mail_outbox.*, institute.name as institute_description, subcategory.name as category_description');
		$this->db->join('subcategory', 'subcategory.id = mail_outbox.category_id', 'left');
		$this->db->join('institute', 'institute.id = mail_outbox.institute_id', 'left');
		$this->db->where('mail_outbox.deleted_at', NULL);
		$this->db->where(array('YEAR(mail_outbox.date)' => date('Y'), 'MONTH(mail_outbox.date)' => date('m')));
		return $this->db->get('mail_outbox');
	}
}