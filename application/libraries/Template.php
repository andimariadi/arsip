<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Template {
		var $template_data = array();	

		function set($name, $value){
			$this->template_data[$name] = $value;
		}

		function load($title = 'Dashboard', $view = '' , $view_data = array(), $return = FALSE)
		{               
			$this->CI =& get_instance();
			$this->set('contents', $this->CI->load->view($view, $view_data, TRUE));
			$this->set('title', $title);
			return $this->CI->load->view('partials/content', $this->template_data, $return);
		}

		function pagging($view_data = array('page_total' => null, 'page' => null, 'url' => null))
		{               
			$this->CI =& get_instance();
			return $this->CI->load->view('partials/page', $view_data);
		}
}