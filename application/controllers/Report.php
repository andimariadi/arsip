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

	public function archive()
	{
		permission_restrict('report_archive');
		
		$this->load->model('Archives_model', 'archives');

		$start_date = $this->input->get('start_date') == "" ? date("Y-m-d", strtotime('-7 day')) : $this->input->get('start_date');
		$end_date = $this->input->get('end_date') == "" ? date("Y-m-d") : $this->input->get('end_date');
		$page = $this->input->get('page') == "" ? 1 : $this->input->get('page');
		
		//pagging
		$total = $this->archives->getReportTotal($start_date, $end_date)->num_rows();
		$start = ($page - 1) * $this->per_page;
		$data['page_total'] =  ceil($total / $this->per_page);
		$data['page'] = $page;
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
		$data['data_archives'] = $this->archives->getReport($start, $this->per_page, $start_date, $end_date)->result_array();

		$this->template->load('Arsip Surat','report/archive', $data);
	}

	public function archive_sk()
	{
		permission_restrict('report_archive_sk');
		
		$this->load->model('Archives_sk_model', 'archives');

		$start_date = $this->input->get('start_date') == "" ? date("Y-m-d", strtotime('-7 day')) : $this->input->get('start_date');
		$end_date = $this->input->get('end_date') == "" ? date("Y-m-d") : $this->input->get('end_date');
		$page = $this->input->get('page') == "" ? 1 : $this->input->get('page');
		
		//pagging
		$total = $this->archives->getReportTotal($start_date, $end_date)->num_rows();
		$start = ($page - 1) * $this->per_page;
		$data['page_total'] =  ceil($total / $this->per_page);
		$data['page'] = $page;
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
		$data['data_archives'] = $this->archives->getReport($start, $this->per_page, $start_date, $end_date)->result_array();

		$this->template->load('Arsip Surat SK','report/archive_sk', $data);
	}

	public function workers()
	{
		permission_restrict('report_workers');

		$this->load->model('Worker_model', 'worker');
		$page = $this->input->get('page') == "" ? 1 : $this->input->get('page');

		//pagging
		$total = $this->worker->view()->num_rows();
		$start = ($page - 1) * $this->per_page;
		$data['page_total'] =  ceil($total / $this->per_page);
		$data['page'] = $page;
		$data['data_workers'] = $this->worker->getData($start, $this->per_page)->result_array();
		$this->template->load('Karyawan','report/workers', $data);
	}

	public function notice()
	{
		permission_restrict('report_notice');

		$this->load->model('Notice_model', 'notice');

		$start_date = $this->input->get('start_date') == "" ? date("Y-m-d", strtotime('-7 day')) : $this->input->get('start_date');
		$end_date = $this->input->get('end_date') == "" ? date("Y-m-d") : $this->input->get('end_date');
		$page = $this->input->get('page') == "" ? 1 : $this->input->get('page');

		//pagging
		$total = $this->notice->getReportTotal($start_date, $end_date)->num_rows();
		$start = ($page - 1) * $this->per_page;
		$data['page_total'] =  ceil($total / $this->per_page);
		$data['page'] = $page;
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
		$data['data_notice'] = $this->notice->getReport($start, $this->per_page, $start_date, $end_date)->result_array();
		$this->template->load('Pengunguman','report/notice', $data);
	}

	public function institute()
	{
		permission_restrict('report_institute');

		$this->load->model('Institute_model', 'institute');

		$page = $this->input->get('page') == "" ? 1 : $this->input->get('page');

		//pagging
		$total = $this->institute->view()->num_rows();
		$start = ($page - 1) * $this->per_page;
		$data['page_total'] =  ceil($total / $this->per_page);
		$data['page'] = $page;
		$data['data_institute'] = $this->institute->getData($start, $this->per_page)->result_array();
		$this->template->load('Institusi','report/institute', $data);
	}

	public function instructions()
	{
		permission_restrict('report_instructions');

		$this->load->model('Instructions_model', 'instructions');

		$page = $this->input->get('page') == "" ? 1 : $this->input->get('page');
		$detail = $this->input->get('detail') == "" ? "" : $this->input->get('detail');

		//pagging
		
		if($detail) {
			$data['data_instructions'] = $this->instructions->where(['id' => $detail])->row_array();
			$this->template->load('Data Bantuan','report/instructions_detail', $data);
		} else {
			$total = $this->instructions->view()->num_rows();
			$start = ($page - 1) * $this->per_page;
			$data['page_total'] =  ceil($total / $this->per_page);
			$data['page'] = $page;
			$data['data_instructions'] = $this->instructions->getData($start, $this->per_page)->result_array();
			$this->template->load('Data Bantuan','report/instructions', $data);
		}
	}
}
