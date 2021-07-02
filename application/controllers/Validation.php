<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validation extends CI_Controller {

	private $per_page = 10;
	function __construct() {
		parent::__construct();
		$username 	= $this->session->userdata('username');
		if (!$username) {
			redirect(base_url('Auth'));
		}
	}
	public function index()
	{
	}

	public function users($val = '')
	{
		permission_restrict('users');

		$this->load->model('Users_model', 'user');
		$row = $this->user->where(array('username' => $val) );
		if ($row->num_rows() > 0) {
			echo 'Error! Username sudah ada!';
		}
	}

	public function workers($val = '')
	{
		permission_restrict('workers');

		$this->load->model('Worker_model', 'worker');
		$row = $this->worker->where(array('nik' => $val) );
		if ($row->num_rows() > 0) {
			echo 'Error! Nomor Induk Kependudukan sudah ada!';
		}
	}

	public function notice($val = '')
	{
		permission_restrict('notice');

		$this->load->model('Notice_model', 'notice');
		$row = $this->notice->where(array('number' => $val) );
		if ($row->num_rows() > 0) {
			echo 'Error! Nomor sudah ada!';
		}
	}

	public function category($val = '')
	{
		permission_restrict('category');

		$this->load->model('Category_model', 'category');
		$row = $this->category->where(array('code' => $val) );
		if ($row->num_rows() > 0) {
			echo 'Error! Kode sudah ada!';
		}
	}

	public function sub_category($val = '')
	{
		permission_restrict('sub_category');

		$this->load->model('Subcategory_model', 'subcategory');
		$row = $this->subcategory->where(array('code' => $val) );
		if ($row->num_rows() > 0) {
			echo 'Error! Kode sudah ada!';
		}
	}

	public function description_category($val = '')
	{
		permission_restrict('description_category');

		$this->load->model('Description_model', 'desccategory');
	}

	public function institute($val = '')
	{
		permission_restrict('institute');

		$this->load->model('Institute_model', 'institute');
		$row = $this->institute->where(array('code' => $val) );
		if ($row->num_rows() > 0) {
			echo 'Error! Kode sudah ada!';
		}
	}

	public function mail_inbox($val = '')
	{
		permission_restrict('mail_inbox');

		$this->load->model('Inbox_model', 'inbox');
		$row = $this->inbox->where(array('code' => $val) );
		if ($row->num_rows() > 0) {
			echo 'Error! Kode sudah ada!';
		}
	}

	public function mail_outbox($val = '')
	{
		permission_restrict('mail_outbox');
		
		$this->load->model('Outbox_model', 'outbox');
		$row = $this->outbox->where(array('code' => $val) );
		if ($row->num_rows() > 0) {
			echo 'Error! Kode sudah ada!';
		}
	}

	public function disposition($val = '')
	{
		permission_restrict('disposition');

		$this->load->model('Disposition_model', 'disposition');
		$row = $this->disposition->where(array('code' => $val) );
		if ($row->num_rows() > 0) {
			echo 'Error! Kode sudah ada!';
		}
	}

	public function archive($val = '')
	{
		permission_restrict('archive');
		
		$this->load->model('Archives_model', 'archives');
		$row = $this->archives->where(array('number' => $val) );
		if ($row->num_rows() > 0) {
			echo 'Error! Nomor sudah ada!';
		}
	}

	public function guest_book($val = '')
	{
		permission_restrict('guest_book');
		
		$this->load->model('Guestbook_model', 'guestbook');
	}

	public function archive_sk($val = '')
	{
		permission_restrict('archive_sk');
		
		$this->load->model('Archives_sk_model', 'archives');
		$row = $this->archives->where(array('number' => $val) );
		if ($row->num_rows() > 0) {
			echo 'Error! Nomor sudah ada!';
		}
	}
}
