<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delete extends CI_Controller {

	function __construct() {
		parent::__construct();
		$username 	= $this->session->userdata('username');
		if (!$username) {
			redirect(base_url('Auth'));
		}
	}

	public function users()
	{
		$this->load->model('Users_model', 'user');
		$this->form_validation->set_rules('id', 'id', 'required');
		if( $this->form_validation->run() != false ) {
			$check_username = $this->user->where( array('id' => $this->input->post('id'), 'deleted_at'=> null ) );
			if ($check_username->num_rows() > 0) {
				$check_admin = $this->user->where( array('id' => $this->input->post('id'), 'level' => 'administrator', 'deleted_at'=> null ) );
				if ($check_admin->num_rows() == 1) {
					$this->session->set_flashdata('msg', '<div class="alert alert-warning" role="alert"> <strong>Error!</strong> User tidak dapat dihapus!</div>' );
					redirect($_SERVER['HTTP_REFERER']);
					return;
				} else {
					$this->user->delete( $this->input->post('id') );
					$this->session->set_flashdata('msg', '<div class="alert alert-warning" role="alert"> <strong>Success!</strong> Data berhasil dihapus!</div>' );
				}
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> Username tidak ditemukan!</div>' );
			}
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> ' . str_replace(array('<p>', '</p>'), '',  validation_errors() ) . ' </div>' );
		}
		
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function workers()
	{
		$this->load->model('Worker_model', 'worker');
		$this->form_validation->set_rules('id', 'id', 'required');
		if( $this->form_validation->run() != false ) {
			$check_data = $this->worker->where( array('id' => $this->input->post('id'), 'deleted_at'=> null ) );
			if ($check_data->num_rows() > 0) {
				
				$this->worker->delete( $this->input->post('id') );
				$this->session->set_flashdata('msg', '<div class="alert alert-warning" role="alert"> <strong>Success!</strong> Data berhasil dihapus!</div>' );
				
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> Data tidak ditemukan!</div>' );
			}
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> ' . str_replace(array('<p>', '</p>'), '',  validation_errors() ) . ' </div>' );
		}
		
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function category()
	{
		$this->load->model('Category_model', 'category');
		$this->form_validation->set_rules('id', 'id', 'required');
		if( $this->form_validation->run() != false ) {
			$check_data = $this->category->where( array('id' => $this->input->post('id'), 'deleted_at'=> null ) );
			if ($check_data->num_rows() > 0) {
				
				$this->category->delete( $this->input->post('id') );
				$this->session->set_flashdata('msg', '<div class="alert alert-warning" role="alert"> <strong>Success!</strong> Data berhasil dihapus!</div>' );
				
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> Data tidak ditemukan!</div>' );
			}
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> ' . str_replace(array('<p>', '</p>'), '',  validation_errors() ) . ' </div>' );
		}
		
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function sub_category()
	{
		$this->load->model('Subcategory_model', 'subcategory');
		$this->form_validation->set_rules('id', 'id', 'required');
		if( $this->form_validation->run() != false ) {
			$check_data = $this->subcategory->where( array('id' => $this->input->post('id'), 'deleted_at'=> null ) );
			if ($check_data->num_rows() > 0) {
				
				$this->subcategory->delete( $this->input->post('id') );
				$this->session->set_flashdata('msg', '<div class="alert alert-warning" role="alert"> <strong>Success!</strong> Data berhasil dihapus!</div>' );
				
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> Data tidak ditemukan!</div>' );
			}
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> ' . str_replace(array('<p>', '</p>'), '',  validation_errors() ) . ' </div>' );
		}
		
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function notice()
	{
		$this->load->model('Notice_model', 'notice');
		$this->form_validation->set_rules('id', 'id', 'required');
		if( $this->form_validation->run() != false ) {
			$check_data = $this->notice->where( array('id' => $this->input->post('id'), 'deleted_at'=> null ) );
			if ($check_data->num_rows() > 0) {
				
				$this->notice->delete( $this->input->post('id') );
				$this->session->set_flashdata('msg', '<div class="alert alert-warning" role="alert"> <strong>Success!</strong> Data berhasil dihapus!</div>' );
				
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> Data tidak ditemukan!</div>' );
			}
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> ' . str_replace(array('<p>', '</p>'), '',  validation_errors() ) . ' </div>' );
		}
		
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function description_category()
	{
		$this->load->model('Description_model', 'desccategory');
		$this->form_validation->set_rules('id', 'id', 'required');
		if( $this->form_validation->run() != false ) {
			$check_data = $this->desccategory->where( array('id' => $this->input->post('id'), 'deleted_at'=> null ) );
			if ($check_data->num_rows() > 0) {
				
				$this->desccategory->delete( $this->input->post('id') );
				$this->session->set_flashdata('msg', '<div class="alert alert-warning" role="alert"> <strong>Success!</strong> Data berhasil dihapus!</div>' );
				
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> Data tidak ditemukan!</div>' );
			}
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> ' . str_replace(array('<p>', '</p>'), '',  validation_errors() ) . ' </div>' );
		}
		
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function institute()
	{
		$this->load->model('Institute_model', 'institute');
		$this->form_validation->set_rules('id', 'id', 'required');
		if( $this->form_validation->run() != false ) {
			$check_data = $this->institute->where( array('id' => $this->input->post('id'), 'deleted_at'=> null ) );
			if ($check_data->num_rows() > 0) {
				
				$this->institute->delete( $this->input->post('id') );
				$this->session->set_flashdata('msg', '<div class="alert alert-warning" role="alert"> <strong>Success!</strong> Data berhasil dihapus!</div>' );
				
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> Data tidak ditemukan!</div>' );
			}
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> ' . str_replace(array('<p>', '</p>'), '',  validation_errors() ) . ' </div>' );
		}
		
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function mail_inbox()
	{
		$this->load->model('Inbox_model', 'inbox');
		$this->form_validation->set_rules('id', 'id', 'required');
		if( $this->form_validation->run() != false ) {
			$check_data = $this->inbox->where( array('id' => $this->input->post('id'), 'deleted_at'=> null ) );
			if ($check_data->num_rows() > 0) {
				
				$this->inbox->delete( $this->input->post('id') );
				$this->session->set_flashdata('msg', '<div class="alert alert-warning" role="alert"> <strong>Success!</strong> Data berhasil dihapus!</div>' );
				
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> Data tidak ditemukan!</div>' );
			}
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> ' . str_replace(array('<p>', '</p>'), '',  validation_errors() ) . ' </div>' );
		}
		
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function mail_outbox()
	{
		$this->load->model('Outbox_model', 'outbox');
		$this->form_validation->set_rules('id', 'id', 'required');
		if( $this->form_validation->run() != false ) {
			$check_data = $this->outbox->where( array('id' => $this->input->post('id'), 'deleted_at'=> null ) );
			if ($check_data->num_rows() > 0) {
				
				$this->outbox->delete( $this->input->post('id') );
				$this->session->set_flashdata('msg', '<div class="alert alert-warning" role="alert"> <strong>Success!</strong> Data berhasil dihapus!</div>' );
				
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> Data tidak ditemukan!</div>' );
			}
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> ' . str_replace(array('<p>', '</p>'), '',  validation_errors() ) . ' </div>' );
		}
		
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function guest_book()
	{
		$this->load->model('Guestbook_model', 'guestbook');
		$this->form_validation->set_rules('id', 'id', 'required');
		if( $this->form_validation->run() != false ) {
			$check_data = $this->guestbook->where( array('id' => $this->input->post('id'), 'deleted_at'=> null ) );
			if ($check_data->num_rows() > 0) {
				
				$this->guestbook->delete( $this->input->post('id') );
				$this->session->set_flashdata('msg', '<div class="alert alert-warning" role="alert"> <strong>Success!</strong> Data berhasil dihapus!</div>' );
				
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> Data tidak ditemukan!</div>' );
			}
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> ' . str_replace(array('<p>', '</p>'), '',  validation_errors() ) . ' </div>' );
		}
		
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function archive()
	{
		$this->load->model('Archives_model', 'archives');
		$this->form_validation->set_rules('id', 'id', 'required');
		if( $this->form_validation->run() != false ) {
			$check_data = $this->archives->where( array('id' => $this->input->post('id'), 'deleted_at'=> null ) );
			if ($check_data->num_rows() > 0) {
				
				$this->archives->delete( $this->input->post('id') );
				$this->session->set_flashdata('msg', '<div class="alert alert-warning" role="alert"> <strong>Success!</strong> Data berhasil dihapus!</div>' );
				
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> Data tidak ditemukan!</div>' );
			}
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> ' . str_replace(array('<p>', '</p>'), '',  validation_errors() ) . ' </div>' );
		}
		
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function disposition()
	{
		$this->load->model('Disposition_model', 'disposition');
		$this->form_validation->set_rules('id', 'id', 'required');
		if( $this->form_validation->run() != false ) {
			$check_data = $this->disposition->where( array('id' => $this->input->post('id'), 'deleted_at'=> null ) );
			if ($check_data->num_rows() > 0) {
				
				$this->disposition->delete( $this->input->post('id') );
				$this->session->set_flashdata('msg', '<div class="alert alert-warning" role="alert"> <strong>Success!</strong> Data berhasil dihapus!</div>' );
				
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> Data tidak ditemukan!</div>' );
			}
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> ' . str_replace(array('<p>', '</p>'), '',  validation_errors() ) . ' </div>' );
		}
		
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function archive_sk()
	{
		$this->load->model('Archives_sk_model', 'archives');
		$this->form_validation->set_rules('id', 'id', 'required');
		if( $this->form_validation->run() != false ) {
			$check_data = $this->archives->where( array('id' => $this->input->post('id'), 'deleted_at'=> null ) );
			if ($check_data->num_rows() > 0) {
				
				$this->archives->delete( $this->input->post('id') );
				$this->session->set_flashdata('msg', '<div class="alert alert-warning" role="alert"> <strong>Success!</strong> Data berhasil dihapus!</div>' );
				
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> Data tidak ditemukan!</div>' );
			}
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> ' . str_replace(array('<p>', '</p>'), '',  validation_errors() ) . ' </div>' );
		}
		
		redirect($_SERVER['HTTP_REFERER']);
	}
}
