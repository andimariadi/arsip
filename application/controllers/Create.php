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
						'restrict' => implode(',', $this->input->post('restrict') )
					)
				);
				$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <strong>Success!</strong> Data berhasil ditambahkan!</div>' );
			}
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> ' . str_replace(array('<p>', '</p>'), '',  validation_errors() ) . ' </div>' );
		}
		
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function workers()
	{
		$this->load->model('Worker_model', 'worker');
		$this->form_validation->set_rules('nik', 'nik', 'required');
		$this->form_validation->set_rules('full_name', 'full_name', 'required');
		$this->form_validation->set_rules('gender', 'gender', 'required');
		$this->form_validation->set_rules('telp', 'telp', 'required');
		$this->form_validation->set_rules('address', 'address', 'required');
		if( $this->form_validation->run() != false ) {
			$check_nik = $this->worker->where( array('nik' => $this->input->post('nik'), 'deleted_at'=> null ) );
			if ($check_nik->num_rows() > 0) {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> NIK sudah ada!</div>' );
			} else {
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
		            $this->worker->create(
						array(
							'created_at' => date('Y-m-d H:i:s'),
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

					$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <strong>Success!</strong> Data berhasil ditambahkan!</div>' );

		         }else{ 
		            $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> Sertakan gambar karyawan!</div>' );
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
		$this->form_validation->set_rules('code', 'code', 'required');
		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('remark', 'remark', 'required');
		if( $this->form_validation->run() != false ) {
			$check_data = $this->category->where( array('code' => $this->input->post('code'), 'deleted_at'=> null ) );
			if ($check_data->num_rows() > 0) {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> Nomor kode sudah ada!</div>' );
			} else {
	            $this->category->create(
					array(
						'created_at' => date('Y-m-d H:i:s'),
						'updated_at' => date('Y-m-d H:i:s'),
						'code' => $this->input->post('code'),
						'name' => $this->input->post('name'),
						'remark' => $this->input->post('remark'),
					)
				);
				$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <strong>Success!</strong> Data berhasil ditambahkan!</div>' );
			}
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> ' . str_replace(array('<p>', '</p>'), '',  validation_errors() ) . ' </div>' );
		}
		
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function sub_category()
	{
		$this->load->model('Subcategory_model', 'subcategory');
		$this->form_validation->set_rules('category_id', 'category', 'required');
		$this->form_validation->set_rules('code', 'code', 'required');
		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('remark', 'remark', 'required');
		if( $this->form_validation->run() != false ) {
			$check_data = $this->subcategory->where( array('code' => $this->input->post('code'), 'deleted_at'=> null ) );
			if ($check_data->num_rows() > 0) {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> Nomor kode sudah ada!</div>' );
			} else {
	            $this->subcategory->create(
					array(
						'created_at' => date('Y-m-d H:i:s'),
						'updated_at' => date('Y-m-d H:i:s'),
						'category_id' => $this->input->post('category_id'),
						'code' => $this->input->post('code'),
						'name' => $this->input->post('name'),
						'remark' => $this->input->post('remark'),
					)
				);
				$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <strong>Success!</strong> Data berhasil ditambahkan!</div>' );
			}
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> ' . str_replace(array('<p>', '</p>'), '',  validation_errors() ) . ' </div>' );
		}
		
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function notice()
	{
		$this->load->model('Notice_model', 'notice');
		$this->form_validation->set_rules('number', 'number', 'required');
		$this->form_validation->set_rules('title', 'title', 'required');
		$this->form_validation->set_rules('description', 'description', 'required');
		$this->form_validation->set_rules('expired_at', 'expired_at', 'required');
		if( $this->form_validation->run() != false ) {
			$check_data = $this->notice->where( array('number' => $this->input->post('number'), 'deleted_at'=> null ) );
			if ($check_data->num_rows() > 0) {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> Nomor kode sudah ada!</div>' );
			} else {
				$this->load->helper('Upload');

				$target_path = makeDirectory('files');
				$config['upload_path'] = $target_path;
		        $config['allowed_types'] = 'pdf|doc|docx';
		        $config['encrypt_name'] = true;

		        $this->load->library('upload', $config);
		        if ( ! $this->upload->do_upload('document')){
					$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> ' . str_replace(array('<p>', '</p>'), '',  $this->upload->display_errors() ) . '</div>' );
				}else{
					$uploadData = $this->upload->data(); 
		            $filename = $uploadData['file_name'];

		            $path = $target_path . $filename;
		            $this->notice->create(
						array(
							'created_at' => date('Y-m-d H:i:s'),
							'updated_at' => date('Y-m-d H:i:s'),
							'number' => $this->input->post('number'),
							'title' => $this->input->post('title'),
							'description' => $this->input->post('description'),
							'expired_at' => $this->input->post('expired_at'),
							'path' => $path
						)
					);
					$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <strong>Success!</strong> Data berhasil ditambahkan!</div>' );
				}
			}
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> ' . str_replace(array('<p>', '</p>'), '',  validation_errors() ) . ' </div>' );
		}
		
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function description_category()
	{
		$this->load->model('Description_model', 'desccategory');
		$this->form_validation->set_rules('subcategory_id', 'subcategory_id', 'required');
		$this->form_validation->set_rules('remark', 'remark', 'required');
		$this->form_validation->set_rules('area', 'area', 'required');
		$this->form_validation->set_rules('user', 'user', 'required');
		$this->form_validation->set_rules('time_minutes', 'time_minutes', 'required');
		if( $this->form_validation->run() != false ) {
			// $check_data = $this->desccategory->where( array('number' => $this->input->post('number'), 'deleted_at'=> null ) );
			// if ($check_data->num_rows() > 0) {
			// 	$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> Nomor kode sudah ada!</div>' );
			// } else {
		            $this->desccategory->create(
						array(
							'created_at' => date('Y-m-d H:i:s'),
							'updated_at' => date('Y-m-d H:i:s'),
							'subcategory_id' => $this->input->post('subcategory_id'),
							'remark' => $this->input->post('remark'),
							'area' => $this->input->post('area'),
							'user' => $this->input->post('user'),
							'time_minutes' => $this->input->post('time_minutes'),
						)
					);
					$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> <strong>Success!</strong> Data berhasil ditambahkan!</div>' );
			// }
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> <strong>Error!</strong> ' . str_replace(array('<p>', '</p>'), '',  validation_errors() ) . ' </div>' );
		}
		
		redirect($_SERVER['HTTP_REFERER']);
	}
}
