<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
		$this->load->view('auth/index');
	}

	public function login()
	{
		$this->load->view('auth/login');
	}

	public function visitor()
	{
		$this->load->view('auth/visitor');
	}

	public function action_login()
	{
		print_r($_POST);
	}

	public function register()
	{
		$this->load->view('welcome_message');
	}
}
