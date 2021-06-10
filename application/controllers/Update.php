<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update extends CI_Controller {

	private $per_page = 1;
	function __construct() {
		parent::__construct();
	}

	public function users()
	{
		$this->load->model('Users_model', 'user');
		$this->form_validation->set_rules('id', 'id', 'required');
		$this->form_validation->set_rules('full_name', 'full_name', 'required');
		$this->form_validation->set_rules('level', 'level', 'required');
		$this->form_validation->set_rules('data_create', 'data_create', 'required');
		$this->form_validation->set_rules('data_read', 'data_read', 'required');
		$this->form_validation->set_rules('data_update', 'data_update', 'required');
		$this->form_validation->set_rules('data_delete', 'data_delete', 'required');
		$this->form_validation->set_rules('data_export', 'data_export', 'required');
		if( $this->form_validation->run() != false ) {
			$check_username = $this->user->where( array('id' => $this->input->post('id'), 'deleted_at'=> null ) );
			if ($check_username->num_rows() > 0) {
				$this->user->update($this->input->post('id'),
					array(
						'updated_at' => date('Y-m-d H:i:s'),
						'full_name' => $this->input->post('full_name'),
						'level' => $this->input->post('level'),
						'data_create' => $this->input->post('data_create'),
						'data_read' => $this->input->post('data_read'),
						'data_update' => $this->input->post('data_update'),
						'data_delete' => $this->input->post('data_delete'),
						'data_export' => $this->input->post('data_export'),
						'restrict' => implode(',', $this->input->post('restrict') )
					)
				);
				$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <strong>Success!</strong> Data berhasil diedit!</div>' );
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> Username tidak ditemukan!</div>' );
			}
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> ' . str_replace(array('<p>', '</p>'), '',  validation_errors() ) . ' </div>' );
		}
		
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function users_password()
	{
		$this->load->model('Users_model', 'user');
		$this->form_validation->set_rules('id', 'id', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');
		if( $this->form_validation->run() != false ) {
			$check_username = $this->user->where( array('id' => $this->input->post('id'), 'deleted_at'=> null ) );
			if ($check_username->num_rows() > 0) {
				$this->user->update($this->input->post('id'),
					array(
						'updated_at' => date('Y-m-d H:i:s'),
						'password' => password_hash( $this->input->post('password'), PASSWORD_DEFAULT ),
					)
				);
				$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <strong>Success!</strong> Data berhasil ditambahkan!</div>' );
				
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
		$this->form_validation->set_rules('nik', 'nik', 'required');
		$this->form_validation->set_rules('full_name', 'full_name', 'required');
		$this->form_validation->set_rules('gender', 'gender', 'required');
		$this->form_validation->set_rules('telp', 'telp', 'required');
		$this->form_validation->set_rules('address', 'address', 'required');
		if( $this->form_validation->run() != false ) {
			$check_nik = $this->worker->where( array('id' => $this->input->post('id'), 'deleted_at'=> null ) );
			if ($check_nik->num_rows() === 0) {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> Karyawan tidak ditemukan!</div>' );
			} else {
				$data_karyawan = $check_nik->row_array();
				$this->load->helper('Upload');

				$target_path = makeDirectory();
				$config['upload_path'] = $target_path;
		        $config['allowed_types'] = 'gif|jpg|png';
		        $config['encrypt_name'] = true;

		        $this->load->library('upload', $config);
		        // File upload
		         if($this->upload->do_upload('image')){
		            $uploadData = $this->upload->data(); 
		            $filename = $uploadData['file_name'];

		            $path = $target_path . $filename;
		            $this->worker->update($this->input->post('id'),
						array(
							'updated_at' => date('Y-m-d H:i:s'),
							'nik' => $this->input->post('nik'),
							'full_name' => $this->input->post('full_name'),
							'gender' => $this->input->post('gender'),
							'telp' => $this->input->post('telp'),
							'address' => $this->input->post('address'),
							'image' => $path,
						)
					);
						

				    $this->load->library('image_lib');
				    $config['image_library'] = 'gd2';
				    $config['source_image'] = $path;
				    $config['create_thumb'] = FALSE;
				    $config['maintain_ratio'] = TRUE;
				    $config['width']     = 350;
				    $config['height']   = 350;
				    $this->image_lib->clear();
				    $this->image_lib->initialize($config);
				    $this->image_lib->resize();
				    
					unlink($data_karyawan['image']);

					$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <strong>Success!</strong> Data berhasil diedit!</div>' );

		         }else{ 

		            $this->worker->update($this->input->post('id'),
						array(
							'updated_at' => date('Y-m-d H:i:s'),
							'nik' => $this->input->post('nik'),
							'full_name' => $this->input->post('full_name'),
							'gender' => $this->input->post('gender'),
							'telp' => $this->input->post('telp'),
							'address' => $this->input->post('address'),
						)
					);
					$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <strong>Success!</strong> Data berhasil diedit!</div>' );
		         } 
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
		$this->form_validation->set_rules('code', 'code', 'required');
		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('remark', 'remark', 'required');
		if( $this->form_validation->run() != false ) {
			$check_data = $this->category->where( array('id' => $this->input->post('id'), 'deleted_at'=> null ) );
			if ($check_data->num_rows() === 0) {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> Karyawan tidak ditemukan!</div>' );
			} else {
	            $this->category->update($this->input->post('id'),
					array(
						'updated_at' => date('Y-m-d H:i:s'),
						'code' => $this->input->post('code'),
						'name' => $this->input->post('name'),
						'remark' => $this->input->post('remark'),
					)
				);
				$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <strong>Success!</strong> Data berhasil diedit!</div>' );
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
		$this->form_validation->set_rules('category_id', 'Category', 'required');
		$this->form_validation->set_rules('code', 'code', 'required');
		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('remark', 'remark', 'required');
		if( $this->form_validation->run() != false ) {
			$check_data = $this->subcategory->where( array('id' => $this->input->post('id'), 'deleted_at'=> null ) );
			if ($check_data->num_rows() === 0) {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> Karyawan tidak ditemukan!</div>' );
			} else {
	            $this->subcategory->update($this->input->post('id'),
					array(
						'updated_at' => date('Y-m-d H:i:s'),
						'category_id' => $this->input->post('category_id'),
						'code' => $this->input->post('code'),
						'name' => $this->input->post('name'),
						'remark' => $this->input->post('remark'),
					)
				);
				$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <strong>Success!</strong> Data berhasil diedit!</div>' );
			}
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> ' . str_replace(array('<p>', '</p>'), '',  validation_errors() ) . ' </div>' );
		}
		
		redirect($_SERVER['HTTP_REFERER']);
	}
}
