<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dash extends CI_Controller {

	private $per_page = 10;
	function __construct() {
		parent::__construct();
		$this->load->library('template');
	}
	public function index()
	{
		$this->template->load('Dashboard','dash/home');
	}

	public function users($page = 1)
	{
		$this->load->model('Users_model', 'user');

		//pagging
		$total = $this->user->view()->num_rows();
		$start = ($page - 1) * $this->per_page;
		$data['page_total'] =  ceil($total / $this->per_page);
		$data['page'] = $page;
		$data['data_users'] = $this->user->getData($start, $this->per_page)->result_array();
		$this->template->load('Users','dash/users', $data);
	}

	public function workers()
	{
		$this->template->load('Karyawan','dash/workers');
	}

	public function notice()
	{
		$this->template->load('Pengunguman','dash/notice');
	}

	public function category()
	{
		$this->template->load('Category','dash/category');
	}

	public function sub_category()
	{
		$this->template->load('Sub Category','dash/sub_category');
	}

	public function description_category()
	{
		$this->template->load('Arahan','dash/description_category');
	}

	public function mail_inbox()
	{
		$this->template->load('Surat Masuk','dash/mail_inbox');
	}

	public function mail_outbox()
	{
		$this->template->load('Surat Keluar','dash/mail_outbox');
	}

	public function disposition()
	{
		$this->template->load('Surat Disposis','dash/disposition');
	}

	public function institute()
	{
		$this->template->load('Institusi','dash/institute');
	}

	public function archive()
	{
		$this->template->load('Institusi','dash/archive');
	}
}
