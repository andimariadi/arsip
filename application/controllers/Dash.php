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

		$this->load->model('Subcategory_model', 'subcategory');
		$this->load->model('Description_model', 'desccategory');
		$this->load->model('Worker_model', 'worker');

		//pagging
		$total = $this->desccategory->view()->num_rows();
		$start = ($page - 1) * $this->per_page;
		$data['page_total'] =  ceil($total / $this->per_page);
		$data['page'] = $page;
		$data['data_desccategory'] = $this->desccategory->getData($start, $this->per_page)->result_array();
		$data['data_subcategory'] = $this->subcategory->view()->result_array();
		$data['data_worker'] = $this->worker->view()->result_array();
		$this->template->load('Arahan','dash/description_category', $data);
	}

	public function institute($page = 1)
	{
		permission_restrict('institute');

		$this->load->model('Institute_model', 'institute');

		//pagging
		$total = $this->institute->view()->num_rows();
		$start = ($page - 1) * $this->per_page;
		$data['page_total'] =  ceil($total / $this->per_page);
		$data['page'] = $page;
		$data['data_institute'] = $this->institute->getData($start, $this->per_page)->result_array();
		$this->template->load('Institusi','dash/institute', $data);
	}

	public function mail_inbox($page = 1)
	{
		permission_restrict('mail_inbox');

		$this->load->model('Inbox_model', 'inbox');
		$this->load->model('Subcategory_model', 'subcategory');
		$this->load->model('Institute_model', 'institute');

		//pagging
		$total = $this->inbox->view()->num_rows();
		$start = ($page - 1) * $this->per_page;
		$data['page_total'] =  ceil($total / $this->per_page);
		$data['page'] = $page;
		$data['data_inbox'] = $this->inbox->getData($start, $this->per_page)->result_array();
		$data['data_subcategory'] = $this->subcategory->view()->result_array();
		$data['data_institute'] = $this->institute->view()->result_array();
		$this->template->load('Surat Masuk','dash/mail_inbox', $data);
	}

	public function mail_outbox($page = 1)
	{
		permission_restrict('mail_outbox');
		
		$this->load->model('Outbox_model', 'outbox');
		$this->load->model('Subcategory_model', 'subcategory');
		$this->load->model('Institute_model', 'institute');

		//pagging
		$total = $this->outbox->view()->num_rows();
		$start = ($page - 1) * $this->per_page;
		$data['page_total'] =  ceil($total / $this->per_page);
		$data['page'] = $page;
		$data['data_outbox'] = $this->outbox->getData($start, $this->per_page)->result_array();
		$data['data_subcategory'] = $this->subcategory->view()->result_array();
		$data['data_institute'] = $this->institute->view()->result_array();
		$this->template->load('Surat Keluar','dash/mail_outbox', $data);
	}

	public function disposition($page = 1)
	{
		permission_restrict('disposition');

		$this->load->model('Disposition_model', 'disposition');
		$this->load->model('Subcategory_model', 'subcategory');
		$this->load->model('Institute_model', 'institute');

		//pagging
		$total = $this->disposition->view()->num_rows();
		$start = ($page - 1) * $this->per_page;
		$data['page_total'] =  ceil($total / $this->per_page);
		$data['page'] = $page;
		$data['data_disposition'] = $this->disposition->getData($start, $this->per_page)->result_array();
		$data['data_subcategory'] = $this->subcategory->view()->result_array();
		$data['data_institute'] = $this->institute->view()->result_array();
		$this->template->load('Surat Disposisi','dash/disposition', $data);
	}

	public function archive($page = 1)
	{
		permission_restrict('archive');
		
		$this->load->model('Archives_model', 'archives');
		//pagging
		$total = $this->archives->view()->num_rows();
		$start = ($page - 1) * $this->per_page;
		$data['page_total'] =  ceil($total / $this->per_page);
		$data['page'] = $page;
		$data['data_archives'] = $this->archives->getData($start, $this->per_page)->result_array();

		$this->template->load('Arsip Surat','dash/archive', $data);
	}

	public function guest_book($page = 1)
	{
		permission_restrict('guest_book');
		
		$this->load->model('Guestbook_model', 'guestbook');
		$this->load->model('Subcategory_model', 'subcategory');
		$this->load->model('Institute_model', 'institute');

		//pagging
		$total = $this->guestbook->view()->num_rows();
		$start = ($page - 1) * $this->per_page;
		$data['page_total'] =  ceil($total / $this->per_page);
		$data['page'] = $page;
		$data['data_guestbook'] = $this->guestbook->getData($start, $this->per_page)->result_array();
		$data['data_subcategory'] = $this->subcategory->view()->result_array();
		$data['data_institute'] = $this->institute->view()->result_array();
		$this->template->load('Buku Tamu','dash/guest_book', $data);
	}
}
