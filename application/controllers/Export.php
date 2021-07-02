<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends CI_Controller {

	function __construct() {
		parent::__construct();
		$username 	= $this->session->userdata('username');
		if (!$username) {
			redirect(base_url('Auth'));
		}
		$this->load->library('Pdf');
	}

	public function index() {
	}

	public function mail_inbox()
	{
		permission_restrict('mail_inbox');

		$this->load->model('Inbox_model', 'inbox');

		$data['data_inbox'] = $this->inbox->getAll()->result_array();
		$data['start_date'] = date('Y-m-d');
		$data['end_date'] = date('Y-m-d');
		$this->load->view('export/mail_inbox', $data);
	}

	public function mail_outbox()
	{
		permission_restrict('mail_outbox');

		$this->load->model('Outbox_model', 'outbox');

		$data['data_outbox'] = $this->outbox->getAll()->result_array();
		$data['start_date'] = date('Y-m-d');
		$data['end_date'] = date('Y-m-d');
		$this->load->view('export/mail_outbox', $data);
	}

	public function guest_book()
	{
		permission_restrict('report_mail_outbox');

		$this->load->model('Guestbook_model', 'guestbook');

		$data['data_guestbook'] = $this->guestbook->getAll()->result_array();
		$data['start_date'] = date('Y-m-d');
		$data['end_date'] = date('Y-m-d');
		$this->load->view('export/guestbook', $data);
	}

	public function archive()
	{
		permission_restrict('archive');
		
		$this->load->model('Archives_model', 'archives');

		$data['data_archive'] = $this->archives->view()->result_array();
		$data['start_date'] = date('Y-m-d');
		$data['end_date'] = date('Y-m-d');
		$this->load->view('export/archive', $data);
	}

	public function disposition()
	{
		permission_restrict('disposition');

		$this->load->model('Disposition_model', 'disposition');

		$data['data_disposition'] = $this->disposition->getAll()->result_array();
		$data['start_date'] = date('Y-m-d');
		$data['end_date'] = date('Y-m-d');
		$this->load->view('export/disposition', $data);
	}

	public function notice()
	{
		permission_restrict('notice');

		$this->load->model('Notice_model', 'notice');

		$data['data_notice'] = $this->notice->view()->result_array();
		$data['start_date'] = date('Y-m-d');
		$data['end_date'] = date('Y-m-d');
		$this->load->view('export/notice', $data);
	}

	public function workers()
	{
		permission_restrict('workers');

		$this->load->model('Worker_model', 'worker');

		$data['data_worker'] = $this->worker->view()->result_array();
		$data['start_date'] = date('Y-m-d');
		$data['end_date'] = date('Y-m-d');
		$this->load->view('export/workers', $data);
	}

	public function category()
	{
		permission_restrict('category');

		$this->load->model('Category_model', 'category');

		$data['data_category'] = $this->category->view()->result_array();
		$data['start_date'] = date('Y-m-d');
		$data['end_date'] = date('Y-m-d');
		$this->load->view('export/category', $data);
	}

	public function sub_category()
	{
		permission_restrict('sub_category');

		$this->load->model('Subcategory_model', 'subcategory');

		$data['data_category'] = $this->subcategory->getAll()->result_array();
		$data['start_date'] = date('Y-m-d');
		$data['end_date'] = date('Y-m-d');
		$this->load->view('export/sub_category', $data);
	}

	public function description_category()
	{
		permission_restrict('description_category');
		$this->load->model('Description_model', 'desccategory');

		$data['data_desccategory'] = $this->desccategory->getAll()->result_array();
		$data['start_date'] = date('Y-m-d');
		$data['end_date'] = date('Y-m-d');
		$this->load->view('export/description_category', $data);
	}

	public function institute()
	{
		permission_restrict('institute');

		$this->load->model('Institute_model', 'institute');

		$data['data_institute'] = $this->institute->view()->result_array();
		$data['start_date'] = date('Y-m-d');
		$data['end_date'] = date('Y-m-d');
		$this->load->view('export/institute', $data);
	}

	public function archive_sk()
	{
		permission_restrict('archive_sk');
		
		$this->load->model('Archives_sk_model', 'archives');

		$data['data_archive'] = $this->archives->view()->result_array();
		$data['start_date'] = date('Y-m-d');
		$data['end_date'] = date('Y-m-d');
		$this->load->view('export/archive_sk', $data);
	}

	public function report_mail_inbox()
	{
		permission_restrict('report_mail_inbox');

		$this->load->model('Inbox_model', 'inbox');

		$start_date = $this->input->get('start_date') == "" ? date("Y-m-d", strtotime('-7 day')) : $this->input->get('start_date');
		$end_date = $this->input->get('end_date') == "" ? date("Y-m-d") : $this->input->get('end_date');

		$data['data_inbox'] = $this->inbox->getReportTotal($start_date, $end_date)->result_array();
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
		$this->load->view('export/report_mail_inbox', $data);
	}

	public function report_mail_outbox()
	{
		permission_restrict('report_mail_outbox');

		$this->load->model('Outbox_model', 'outbox');

		$start_date = $this->input->get('start_date') == "" ? date("Y-m-d", strtotime('-7 day')) : $this->input->get('start_date');
		$end_date = $this->input->get('end_date') == "" ? date("Y-m-d") : $this->input->get('end_date');

		$data['data_outbox'] = $this->outbox->getReportTotal($start_date, $end_date)->result_array();
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
		$this->load->view('export/report_mail_outbox', $data);
	}

	public function report_guest_book()
	{
		permission_restrict('report_mail_outbox');

		$this->load->model('Guestbook_model', 'guestbook');

		$start_date = $this->input->get('start_date') == "" ? date("Y-m-d", strtotime('-7 day')) : $this->input->get('start_date');
		$end_date = $this->input->get('end_date') == "" ? date("Y-m-d") : $this->input->get('end_date');

		$data['data_guestbook'] = $this->guestbook->getReportTotal($start_date, $end_date)->result_array();
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
		$this->load->view('export/report_guestbook', $data);
	}

	public function report_disposition()
	{
		permission_restrict('report_disposition');

		$this->load->model('Disposition_model', 'disposition');

		$start_date = $this->input->get('start_date') == "" ? date("Y-m-d", strtotime('-7 day')) : $this->input->get('start_date');
		$end_date = $this->input->get('end_date') == "" ? date("Y-m-d") : $this->input->get('end_date');

		$data['data_disposition'] = $this->disposition->getReportTotal($start_date, $end_date)->result_array();
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
		$this->load->view('export/report_disposition', $data);
	}

	public function report_notice()
	{
		permission_restrict('report_notice');

		$this->load->model('Notice_model', 'notice');
		$start_date = $this->input->get('start_date') == "" ? date("Y-m-d", strtotime('-7 day')) : $this->input->get('start_date');
		$end_date = $this->input->get('end_date') == "" ? date("Y-m-d") : $this->input->get('end_date');

		$data['data_notice'] = $this->notice->getReportTotal($start_date, $end_date)->result_array();
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
		$this->load->view('export/report_notice', $data);
	}

	public function report_archive()
	{
		permission_restrict('report_archive');
		
		$this->load->model('Archives_model', 'archives');
		$start_date = $this->input->get('start_date') == "" ? date("Y-m-d", strtotime('-7 day')) : $this->input->get('start_date');
		$end_date = $this->input->get('end_date') == "" ? date("Y-m-d") : $this->input->get('end_date');

		$data['data_archive'] = $this->archives->getReportTotal($start_date, $end_date)->result_array();
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
		$this->load->view('export/report_archive', $data);
	}

	public function report_archive_sk()
	{
		permission_restrict('report_archive_sk');
		
		$this->load->model('Archives_sk_model', 'archives');
		$start_date = $this->input->get('start_date') == "" ? date("Y-m-d", strtotime('-7 day')) : $this->input->get('start_date');
		$end_date = $this->input->get('end_date') == "" ? date("Y-m-d") : $this->input->get('end_date');

		$data['data_archive'] = $this->archives->getReportTotal($start_date, $end_date)->result_array();
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
		$this->load->view('export/report_archive_sk', $data);
	}
}
?>