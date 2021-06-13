<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	private $per_page = 10;
	function __construct() {
		parent::__construct();
		$username 	= $this->session->userdata('username');
		if (!$username) {
			redirect(base_url('Auth'));
		}
		$this->load->library(array('template', 'component') );
	}
	public function index()
	{
		$this->template->load('Dashboard','dash/home');
	}

	public function mail_inbox()
	{
		permission_restrict('report_mail_inbox');

		$this->load->model('Inbox_model', 'inbox');
		$this->load->model('Subcategory_model', 'subcategory');
		$this->load->model('Institute_model', 'institute');

		$start_date = $this->input->get('start_date') == "" ? date("Y-m-d", strtotime('-7 day')) : $this->input->get('start_date');
		$end_date = $this->input->get('end_date') == "" ? date("Y-m-d") : $this->input->get('end_date');
		$page = $this->input->get('page') == "" ? 1 : $this->input->get('page');

		//pagging
		$total = $this->inbox->getReportTotal($start_date, $end_date)->num_rows();
		$start = ($page - 1) * $this->per_page;
		$data['page_total'] =  ceil($total / $this->per_page);
		$data['page'] = $page;
		$data['data_inbox'] = $this->inbox->getReport($start, $this->per_page, $start_date, $end_date)->result_array();
		$data['data_subcategory'] = $this->subcategory->view()->result_array();
		$data['data_institute'] = $this->institute->view()->result_array();
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
		$this->template->load('Surat Masuk','report/mail_inbox', $data);
	}

	public function mail_outbox()
	{
		permission_restrict('report_mail_outbox');
		
		$this->load->model('Outbox_model', 'outbox');
		$this->load->model('Subcategory_model', 'subcategory');
		$this->load->model('Institute_model', 'institute');

		$start_date = $this->input->get('start_date') == "" ? date("Y-m-d", strtotime('-7 day')) : $this->input->get('start_date');
		$end_date = $this->input->get('end_date') == "" ? date("Y-m-d") : $this->input->get('end_date');
		$page = $this->input->get('page') == "" ? 1 : $this->input->get('page');

		//pagging
		$total = $this->outbox->getReportTotal($start_date, $end_date)->num_rows();
		$start = ($page - 1) * $this->per_page;
		$data['page_total'] =  ceil($total / $this->per_page);
		$data['page'] = $page;
		$data['data_outbox'] = $this->outbox->getReport($start, $this->per_page, $start_date, $end_date)->result_array();
		$data['data_subcategory'] = $this->subcategory->view()->result_array();
		$data['data_institute'] = $this->institute->view()->result_array();
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
		$this->template->load('Surat Keluar','report/mail_outbox', $data);
	}

	public function guest_book()
	{
		permission_restrict('report_guest_book');
		
		$this->load->model('Guestbook_model', 'guestbook');
		$this->load->model('Subcategory_model', 'subcategory');
		$this->load->model('Institute_model', 'institute');

		$start_date = $this->input->get('start_date') == "" ? date("Y-m-d", strtotime('-7 day')) : $this->input->get('start_date');
		$end_date = $this->input->get('end_date') == "" ? date("Y-m-d") : $this->input->get('end_date');
		$page = $this->input->get('page') == "" ? 1 : $this->input->get('page');

		//pagging
		$total = $this->guestbook->getReportTotal($start_date, $end_date)->num_rows();
		$start = ($page - 1) * $this->per_page;
		$data['page_total'] =  ceil($total / $this->per_page);
		$data['page'] = $page;
		$data['data_guestbook'] = $this->guestbook->getReport($start, $this->per_page, $start_date, $end_date)->result_array();
		$data['data_subcategory'] = $this->subcategory->view()->result_array();
		$data['data_institute'] = $this->institute->view()->result_array();
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
		$this->template->load('Buku Tamu','report/guest_book', $data);
	}

	public function disposition()
	{
		permission_restrict('report_disposition');
		
		$this->load->model('Disposition_model', 'disposition');
		$this->load->model('Subcategory_model', 'subcategory');
		$this->load->model('Institute_model', 'institute');

		$start_date = $this->input->get('start_date') == "" ? date("Y-m-d", strtotime('-7 day')) : $this->input->get('start_date');
		$end_date = $this->input->get('end_date') == "" ? date("Y-m-d") : $this->input->get('end_date');
		$page = $this->input->get('page') == "" ? 1 : $this->input->get('page');

		//pagging
		$total = $this->disposition->getReportTotal($start_date, $end_date)->num_rows();
		$start = ($page - 1) * $this->per_page;
		$data['page_total'] =  ceil($total / $this->per_page);
		$data['page'] = $page;
		$data['data_disposition'] = $this->disposition->getReport($start, $this->per_page, $start_date, $end_date)->result_array();
		$data['data_subcategory'] = $this->subcategory->view()->result_array();
		$data['data_institute'] = $this->institute->view()->result_array();
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
		$this->template->load('Surat Disposisi','report/disposition', $data);
	}
}
