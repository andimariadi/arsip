<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update extends CI_Controller {

	private $per_page = 1;
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
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> Kategory tidak ditemukan!</div>' );
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
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> Kategory tidak ditemukan!</div>' );
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

	public function notice()
	{
		$this->load->model('Notice_model', 'notice');
		$this->form_validation->set_rules('id', 'id', 'required');
		$this->form_validation->set_rules('number', 'number', 'required');
		$this->form_validation->set_rules('title', 'title', 'required');
		$this->form_validation->set_rules('description', 'description', 'required');
		$this->form_validation->set_rules('expired_at', 'expired_at', 'required');
		if( $this->form_validation->run() != false ) {
			$check_data = $this->notice->where( array('id' => $this->input->post('id'), 'deleted_at'=> null ) );
			if ($check_data->num_rows() === 0) {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> ID tidak ditemukan!</div>' );
			} else {
				$this->load->helper('Upload');

				$target_path = makeDirectory('files');
				$config['upload_path'] = $target_path;
		        $config['allowed_types'] = 'pdf|doc|docx';
		        $config['encrypt_name'] = true;

		        $this->load->library('upload', $config);
		        if ( ! $this->upload->do_upload('document')){
		            $this->notice->update($this->input->post('id'),
						array(
							'updated_at' => date('Y-m-d H:i:s'),
							'number' => $this->input->post('number'),
							'title' => $this->input->post('title'),
							'description' => $this->input->post('description'),
							'expired_at' => $this->input->post('expired_at'),
						)
					);
				}else{

					$uploadData = $this->upload->data(); 
		            $filename = $uploadData['file_name'];

		            $path = $target_path . $filename;
		            $this->notice->update($this->input->post('id'),
						array(
							'updated_at' => date('Y-m-d H:i:s'),
							'number' => $this->input->post('number'),
							'title' => $this->input->post('title'),
							'description' => $this->input->post('description'),
							'expired_at' => $this->input->post('expired_at'),
							'path' => $path
						)
					);
				}
				$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <strong>Success!</strong> Data berhasil diedit!</div>' );
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
		$this->form_validation->set_rules('subcategory_id', 'subcategory_id', 'required');
		$this->form_validation->set_rules('remark', 'remark', 'required');
		$this->form_validation->set_rules('area', 'area', 'required');
		$this->form_validation->set_rules('user', 'user', 'required');
		$this->form_validation->set_rules('time_minutes', 'time_minutes', 'required');
		if( $this->form_validation->run() != false ) {
			$check_data = $this->desccategory->where( array('id' => $this->input->post('id'), 'deleted_at'=> null ) );
			if ($check_data->num_rows() === 0) {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> ID tidak ditemukan!</div>' );
			} else {
	            $this->desccategory->update($this->input->post('id'),
					array(
							'updated_at' => date('Y-m-d H:i:s'),
							'subcategory_id' => $this->input->post('subcategory_id'),
							'remark' => $this->input->post('remark'),
							'area' => $this->input->post('area'),
							'user' => $this->input->post('user'),
							'time_minutes' => $this->input->post('time_minutes'),
						)
				);
				$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <strong>Success!</strong> Data berhasil diedit!</div>' );
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
		$this->form_validation->set_rules('code', 'code', 'required');
		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('address', 'address', 'required');
		if( $this->form_validation->run() != false ) {
			$check_data = $this->institute->where( array('id' => $this->input->post('id'), 'deleted_at'=> null ) );
			if ($check_data->num_rows() === 0) {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> ID tidak ditemukan!</div>' );
			} else {
	            $this->institute->update($this->input->post('id'),
					array(
						'updated_at' => date('Y-m-d H:i:s'),
						'code' => $this->input->post('code'),
						'name' => $this->input->post('name'),
						'address' => $this->input->post('address'),
					)
				);
				$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <strong>Success!</strong> Data berhasil diedit!</div>' );
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
		$this->form_validation->set_rules('institute_id', 'institute_id', 'required');
		$this->form_validation->set_rules('category_id', 'category_id', 'required');
		$this->form_validation->set_rules('type', 'type', 'required');
		$this->form_validation->set_rules('date', 'date', 'required');
		$this->form_validation->set_rules('code', 'code', 'required');
		$this->form_validation->set_rules('number', 'number', 'required');
		$this->form_validation->set_rules('about', 'about', 'required');
		if( $this->form_validation->run() != false ) {
			$check_data = $this->inbox->where( array('id' => $this->input->post('id'), 'deleted_at'=> null ) );
			if ($check_data->num_rows() === 0) {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> ID tidak ditemukan!</div>' );
			} else {
				$this->load->helper('Upload');

				$target_path = makeDirectory('files');
				$config['upload_path'] = $target_path;
		        $config['allowed_types'] = 'pdf|doc|docx';
		        $config['encrypt_name'] = true;

		        $this->load->library('upload', $config);
		        if ( ! $this->upload->do_upload('document')){
		            $this->inbox->update($this->input->post('id'),
						array(
							'updated_at' => date('Y-m-d H:i:s'),
							'institute_id' => $this->input->post('institute_id'),
							'category_id' => $this->input->post('category_id'),
							'type' => $this->input->post('type'),
							'date' => $this->input->post('date'),
							'code' => $this->input->post('code'),
							'number' => $this->input->post('number'),
							'about' => $this->input->post('about'),
						)
					);
				}else{

					$uploadData = $this->upload->data(); 
		            $filename = $uploadData['file_name'];

		            $path = $target_path . $filename;
		            $this->inbox->update($this->input->post('id'),
						array(
							'updated_at' => date('Y-m-d H:i:s'),
							'institute_id' => $this->input->post('institute_id'),
							'category_id' => $this->input->post('category_id'),
							'type' => $this->input->post('type'),
							'date' => $this->input->post('date'),
							'code' => $this->input->post('code'),
							'number' => $this->input->post('number'),
							'about' => $this->input->post('about'),
							'document' => $path
						)
					);
				}
				$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <strong>Success!</strong> Data berhasil diedit!</div>' );
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
		$this->form_validation->set_rules('institute_id', 'institute_id', 'required');
		$this->form_validation->set_rules('category_id', 'category_id', 'required');
		$this->form_validation->set_rules('type', 'type', 'required');
		$this->form_validation->set_rules('date', 'date', 'required');
		$this->form_validation->set_rules('code', 'code', 'required');
		$this->form_validation->set_rules('number', 'number', 'required');
		$this->form_validation->set_rules('about', 'about', 'required');
		if( $this->form_validation->run() != false ) {
			$check_data = $this->outbox->where( array('id' => $this->input->post('id'), 'deleted_at'=> null ) );
			if ($check_data->num_rows() === 0) {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> ID tidak ditemukan!</div>' );
			} else {
				$this->load->helper('Upload');

				$target_path = makeDirectory('files');
				$config['upload_path'] = $target_path;
		        $config['allowed_types'] = 'pdf|doc|docx';
		        $config['encrypt_name'] = true;

		        $this->load->library('upload', $config);
		        if ( ! $this->upload->do_upload('document')){
		            $this->outbox->update($this->input->post('id'),
						array(
							'updated_at' => date('Y-m-d H:i:s'),
							'institute_id' => $this->input->post('institute_id'),
							'category_id' => $this->input->post('category_id'),
							'type' => $this->input->post('type'),
							'date' => $this->input->post('date'),
							'code' => $this->input->post('code'),
							'number' => $this->input->post('number'),
							'about' => $this->input->post('about'),
						)
					);
				}else{

					$uploadData = $this->upload->data(); 
		            $filename = $uploadData['file_name'];

		            $path = $target_path . $filename;
		            $this->outbox->update($this->input->post('id'),
						array(
							'updated_at' => date('Y-m-d H:i:s'),
							'institute_id' => $this->input->post('institute_id'),
							'category_id' => $this->input->post('category_id'),
							'type' => $this->input->post('type'),
							'date' => $this->input->post('date'),
							'code' => $this->input->post('code'),
							'number' => $this->input->post('number'),
							'about' => $this->input->post('about'),
							'document' => $path
						)
					);
				}
				$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <strong>Success!</strong> Data berhasil diedit!</div>' );
			}
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> ' . str_replace(array('<p>', '</p>'), '',  validation_errors() ) . ' </div>' );
		}
		
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function guest_book()
	{
		$this->load->model('Guestbook_model', 'guestbook');
		$this->load->model('Subcategory_model', 'subcategory');
		$this->form_validation->set_rules('id', 'id', 'required');
		$this->form_validation->set_rules('nik', 'nik', 'required');
		$this->form_validation->set_rules('full_name', 'full_name', 'required');
		$this->form_validation->set_rules('address', 'address', 'required');
		$this->form_validation->set_rules('utility', 'utility', 'required');
		$this->form_validation->set_rules('institute_id', 'institute_id', 'required');
		if( $this->form_validation->run() != false ) {
			$check_data = $this->guestbook->where( array('id' => $this->input->post('id'), 'deleted_at'=> null ) );
			if ($check_data->num_rows() === 0) {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> ID tidak ditemukan!</div>' );
			} else {
	            $this->guestbook->update($this->input->post('id'),
					array(
						'updated_at' => date('Y-m-d H:i:s'),
						'nik' => $this->input->post('nik'),
						'full_name' => $this->input->post('full_name'),
						'address' => $this->input->post('address'),
						'utility' => $this->input->post('utility'),
						'institute_id' => $this->input->post('institute_id'),
					)
				);
				$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <strong>Success!</strong> Data berhasil diedit!</div>' );
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
		$this->form_validation->set_rules('number', 'number', 'required');
		$this->form_validation->set_rules('title', 'title', 'required');
		$this->form_validation->set_rules('description', 'description', 'required');
		if( $this->form_validation->run() != false ) {
			$check_data = $this->archives->where( array('id' => $this->input->post('id'), 'deleted_at'=> null ) );
			if ($check_data->num_rows() === 0) {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> ID tidak ditemukan!</div>' );
			} else {
				$this->load->helper('Upload');

				$target_path = makeDirectory('files');
				$config['upload_path'] = $target_path;
		        $config['allowed_types'] = 'pdf|doc|docx';
		        $config['encrypt_name'] = true;

		        $this->load->library('upload', $config);
		        if ( ! $this->upload->do_upload('document')){
		            $this->archives->update($this->input->post('id'),
						array(
							'updated_at' => date('Y-m-d H:i:s'),
							'number' => $this->input->post('number'),
							'title' => $this->input->post('title'),
							'description' => $this->input->post('description'),
						)
					);
				}else{

					$uploadData = $this->upload->data(); 
		            $filename = $uploadData['file_name'];

		            $path = $target_path . $filename;
		            $this->archives->update($this->input->post('id'),
						array(
							'updated_at' => date('Y-m-d H:i:s'),
							'number' => $this->input->post('number'),
							'title' => $this->input->post('title'),
							'description' => $this->input->post('description'),
							'path' => $path
						)
					);
				}
				$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <strong>Success!</strong> Data berhasil diedit!</div>' );
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
		$this->form_validation->set_rules('code', 'code', 'required');
		$this->form_validation->set_rules('subcategory_id', 'subcategory_id', 'required');
		$this->form_validation->set_rules('institute_id', 'institute_id', 'required');
		$this->form_validation->set_rules('nik', 'nik', 'required');
		$this->form_validation->set_rules('file_number', 'file_number', 'required');
		$this->form_validation->set_rules('reference_number', 'reference_number', 'required');
		$this->form_validation->set_rules('type', 'type', 'required');
		$this->form_validation->set_rules('date', 'date', 'required');
		$this->form_validation->set_rules('date_recieved', 'date_recieved', 'required');
		$this->form_validation->set_rules('about', 'about', 'required');
		$this->form_validation->set_rules('purpose', 'purpose', 'required');
		$this->form_validation->set_rules('remark', 'remark', 'required');
		if( $this->form_validation->run() != false ) {
			$check_data = $this->disposition->where( array('id' => $this->input->post('id'), 'deleted_at'=> null ) );
			if ($check_data->num_rows() === 0) {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> ID tidak ditemukan!</div>' );
			} else {
				$this->load->helper('Upload');

				$target_path = makeDirectory('files');
				$config['upload_path'] = $target_path;
		        $config['allowed_types'] = 'pdf|doc|docx';
		        $config['encrypt_name'] = true;

		        $this->load->library('upload', $config);
		        if ( ! $this->upload->do_upload('document')){
		            $this->disposition->update($this->input->post('id'),
						array(
							'updated_at' => date('Y-m-d H:i:s'),
							'code' => $this->input->post('code'),
							'subcategory_id' => $this->input->post('subcategory_id'),
							'institute_id' => $this->input->post('institute_id'),
							'nik' => $this->input->post('nik'),
							'file_number' => $this->input->post('file_number'),
							'reference_number' => $this->input->post('reference_number'),
							'type' => $this->input->post('type'),
							'date' => $this->input->post('date'),
							'date_recieved' => $this->input->post('date_recieved'),
							'about' => $this->input->post('about'),
							'purpose' => $this->input->post('purpose'),
							'remark' => $this->input->post('remark'),
						)
					);
				}else{

					$uploadData = $this->upload->data(); 
		            $filename = $uploadData['file_name'];

		            $path = $target_path . $filename;
		            $this->disposition->update($this->input->post('id'),
						array(
							'updated_at' => date('Y-m-d H:i:s'),
							'code' => $this->input->post('code'),
							'subcategory_id' => $this->input->post('subcategory_id'),
							'institute_id' => $this->input->post('institute_id'),
							'nik' => $this->input->post('nik'),
							'file_number' => $this->input->post('file_number'),
							'reference_number' => $this->input->post('reference_number'),
							'type' => $this->input->post('type'),
							'date' => $this->input->post('date'),
							'date_recieved' => $this->input->post('date_recieved'),
							'about' => $this->input->post('about'),
							'purpose' => $this->input->post('purpose'),
							'remark' => $this->input->post('remark'),
							'path' => $path
						)
					);
				}
				$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <strong>Success!</strong> Data berhasil diedit!</div>' );
			}
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> ' . str_replace(array('<p>', '</p>'), '',  validation_errors() ) . ' </div>' );
		}
		
		redirect($_SERVER['HTTP_REFERER']);
	}

}
