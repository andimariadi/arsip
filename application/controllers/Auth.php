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
		$this->load->model('Users_model', 'user');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		if($username != '' || $password != '') {
			$data = $this->user->where(array('username' => $username) );
			if ($data->num_rows() > 0) {
				$data_user = $data->row_array();
				if (password_verify($password, $data_user['password'])) {
					$session = array(
						'id' => $data_user['id'],
						'username' => $data_user['username'],
						'full_name' => $data_user['full_name'],
						'level' => $data_user['level'],
						'access_create' => $data_user['data_create'],
						'access_read' => $data_user['data_read'],
						'access_update' => $data_user['data_update'],
						'access_delete' => $data_user['data_delete'],
						'access_export' => $data_user['data_export'],
						'restrict' => $data_user['restrict'],
					);
					$this->session->set_userdata($session);
					redirect(base_url('dash'));
				} else {					
					$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> Username atau Password tidak valid! </div>');
					redirect(base_url('auth/login'));
				}
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> Username atau Password tidak valid! </div>');
				redirect(base_url('auth/login'));
			}
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> Username atau Password tidak valid! </div>');
			redirect(base_url('auth/login'));
		}
	}

	public function register()
	{
		$this->load->view('welcome_message');
	}
}
