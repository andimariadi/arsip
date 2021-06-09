<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Create extends CI_Controller {

	private $per_page = 1;
	function __construct() {
		parent::__construct();
	}

	public function users()
	{
		$this->load->model('Users_model', 'user');
		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');
		$this->form_validation->set_rules('full_name', 'full_name', 'required');
		$this->form_validation->set_rules('level', 'level', 'required');
		$this->form_validation->set_rules('data_create', 'data_create', 'required');
		$this->form_validation->set_rules('data_read', 'data_read', 'required');
		$this->form_validation->set_rules('data_update', 'data_update', 'required');
		$this->form_validation->set_rules('data_delete', 'data_delete', 'required');
		$this->form_validation->set_rules('data_export', 'data_export', 'required');
		$this->form_validation->set_rules('restrict', 'restrict', 'required');
		if( $this->form_validation->run() != false ) {
			$check_username = $this->user->where( array('username' => $this->input->post('username'), 'deleted_at'=> null ) );
			if ($check_username->num_rows() > 0) {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> Username sudah ada!</div>' );
			} else {
				$this->user->create(
					array(
						'created_at' => date('Y-m-d H:i:s'),
						'updated_at' => date('Y-m-d H:i:s'),
						'username' => $this->input->post('username'),
						'password' => $this->input->post('password'),
						'full_name' => $this->input->post('full_name'),
						'level' => $this->input->post('level'),
						'data_create' => $this->input->post('data_create'),
						'data_read' => $this->input->post('data_read'),
						'data_update' => $this->input->post('data_update'),
						'data_delete' => $this->input->post('data_delete'),
						'data_export' => $this->input->post('data_export'),
						'restrict' => $this->input->post('restrict')
					)
				);
				$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <strong>Success!</strong> Data berhasil ditambahkan!</div>' );
			}
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> ' . str_replace(array('<p>', '</p>'), '',  validation_errors() ) . ' </div>' );
		}
		
		redirect($_SERVER['HTTP_REFERER']);
	}
}
