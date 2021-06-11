<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guestbook_model extends CI_Model
{
	public function view()
	{
		$this->db->where('deleted_at', NULL);
		return $this->db->get('guest_book');
	}

	public function getData($start, $limit)
	{
		$this->db->select('guest_book.*, institute.name as institute_description, subcategory.name as utility_description');
		$this->db->where('guest_book.deleted_at', NULL);
		$this->db->join('institute', 'institute.id = guest_book.institute_id', 'left');
		$this->db->join('subcategory', 'subcategory.id = guest_book.utility', 'left');
		$this->db->limit($limit, $start);
		return $this->db->get('guest_book');
	}

	public function where($where = array())
	{
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
}