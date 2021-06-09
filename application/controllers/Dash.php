<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dash extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('template');
	}
	public function index()
	{
		$this->template->load('Dashboard','dash/home');
	}

	public function users()
	{
		$this->template->load('Users','dash/users');
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
		$this->template->load('Pengunguman','dash/category');
	}

	public function sub_category()
	{
		$this->template->load('Pengunguman','dash/sub_category');
	}
}
