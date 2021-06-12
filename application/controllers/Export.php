<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends CI_Controller {

	function __construct() {
		parent::__construct();
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
}
?>