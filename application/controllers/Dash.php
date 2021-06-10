<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dash extends CI_Controller {

	private $per_page = 10;
	function __construct() {
		parent::__construct();
		$this->load->library(array('template', 'component') );
	}
	public function index()
	{
		$this->template->load('Dashboard','dash/home');
	}

	public function users($page = 1)
	{
		permission_restrict('users');

		$this->load->model('Users_model', 'user');

		//pagging
		$total = $this->user->view()->num_rows();
		$start = ($page - 1) * $this->per_page;
		$data['page_total'] =  ceil($total / $this->per_page);
		$data['page'] = $page;
		$data['data_users'] = $this->user->getData($start, $this->per_page)->result_array();
		$this->template->load('Users','dash/users', $data);
	}

	public function workers($page = 1)
	{
		permission_restrict('workers');

		$this->load->model('Worker_model', 'worker');

		//pagging
		$total = $this->worker->view()->num_rows();
		$start = ($page - 1) * $this->per_page;
		$data['page_total'] =  ceil($total / $this->per_page);
		$data['page'] = $page;
		$data['data_workers'] = $this->worker->getData($start, $this->per_page)->result_array();
		$this->template->load('Karyawan','dash/workers', $data);
	}

	public function notice($page = 1)
	{
		permission_restrict('notice');

		$this->load->model('Notice_model', 'notice');

		//pagging
		$total = $this->notice->view()->num_rows();
		$start = ($page - 1) * $this->per_page;
		$data['page_total'] =  ceil($total / $this->per_page);
		$data['page'] = $page;
		$data['data_notice'] = $this->notice->getData($start, $this->per_page)->result_array();
		$this->template->load('Pengunguman','dash/notice', $data);
	}

	public function category($page = 1)
	{
		permission_restrict('category');

		$this->load->model('Category_model', 'category');

		//pagging
		$total = $this->category->view()->num_rows();
		$start = ($page - 1) * $this->per_page;
		$data['page_total'] =  ceil($total / $this->per_page);
		$data['page'] = $page;
		$data['data_category'] = $this->category->getData($start, $this->per_page)->result_array();
		$this->template->load('Category','dash/category', $data);
	}

	public function sub_category($page = 1)
	{
		permission_restrict('sub_category');

		$this->load->model('Category_model', 'category');
		$this->load->model('Subcategory_model', 'subcategory');

		//pagging
		$total = $this->subcategory->view()->num_rows();
		$start = ($page - 1) * $this->per_page;
		$data['page_total'] =  ceil($total / $this->per_page);
		$data['page'] = $page;
		$data['data_subcategory'] = $this->subcategory->getData($start, $this->per_page)->result_array();
		$data['data_category'] = $this->category->view()->result_array();
		$this->template->load('Sub Category','dash/sub_category', $data);
	}

	public function description_category($page = 1)
	{
		permission_restrict('description_category');
		$this->template->load('Arahan','dash/description_category');
	}

	public function mail_inbox($page = 1)
	{
		permission_restrict('mail_inbox');
		$this->template->load('Surat Masuk','dash/mail_inbox');
	}

	public function mail_outbox($page = 1)
	{
		permission_restrict('mail_outbox');
		$this->template->load('Surat Keluar','dash/mail_outbox');
	}

	public function disposition($page = 1)
	{
		permission_restrict('disposition');
		$this->template->load('Surat Disposis','dash/disposition');
	}

	public function institute($page = 1)
	{
		permission_restrict('institute');
		$this->template->load('Institusi','dash/institute');
	}

	public function archive($page = 1)
	{
		permission_restrict('archive');
		$this->template->load('Arsip Surat','dash/archive');
	}

	public function guest_book($page = 1)
	{
		permission_restrict('guest_book');
		$this->template->load('Buku Tamu','dash/guest_book');
	}
}
