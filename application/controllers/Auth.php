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
		$this->load->model('Subcategory_model', 'subcategory');
		$this->load->model('Institute_model', 'institute');


		$data['data_subcategory'] = $this->subcategory->view()->result_array();
		$data['data_institute'] = $this->institute->view()->result_array();
		$this->load->view('auth/visitor', $data);
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

	public function action_visitor()
	{
		$this->load->model('Guestbook_model', 'guestbook');
		$this->load->model('Subcategory_model', 'subcategory');
		$this->form_validation->set_rules('nik', 'nik', 'required');
		$this->form_validation->set_rules('full_name', 'full_name', 'required');
		$this->form_validation->set_rules('address', 'address', 'required');
		$this->form_validation->set_rules('utility', 'utility', 'required');
		$this->form_validation->set_rules('institute_id', 'institute_id', 'required');
		if( $this->form_validation->run() != false ) {
			$check_data = $this->subcategory->where( array('id' => $this->input->post('utility'), 'deleted_at'=> null ) );
			if ($check_data->num_rows() === 0) {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> Keperluan tidak ditemukan!</div>' );
				redirect($_SERVER['HTTP_REFERER']);
			} else {

				$this->guestbook->create(
					array(
						'created_at' => date('Y-m-d H:i:s'),
						'updated_at' => date('Y-m-d H:i:s'),
						'date' => date('Y-m-d'),
						'nik' => $this->input->post('nik'),
						'full_name' => $this->input->post('full_name'),
						'address' => $this->input->post('address'),
						'utility' => $this->input->post('utility'),
						'institute_id' => $this->input->post('institute_id'),
					)
				);


				redirect(base_url('auth/arahan_visitor/' . $this->input->post('utility') ));
			}
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> ' . str_replace(array('<p>', '</p>'), '',  validation_errors() ) . ' </div>' );
			redirect($_SERVER['HTTP_REFERER']);
		}
	}


	public function arahan_visitor($id = null)
	{

		$this->load->model('Description_model', 'descsubcategory');

		$data['data_descsubcategory'] = $this->descsubcategory->GetWhere(array('description_subcategory.id' => $id))->row_array();
		$this->load->view('auth/arahan', $data);
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('Auth'));
	}
}
