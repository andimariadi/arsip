<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Component {
		var $template_data = array();	

		function set($name, $value){
			$this->template_data[$name] = $value;
		}

		function delete($url = null)
		{               
			$this->CI =& get_instance();
			$data['url'] = $url;
			return $this->CI->load->view('partials/component/delete', $data);
		}
}