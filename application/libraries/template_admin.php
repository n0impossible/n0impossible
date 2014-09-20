<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template_admin
{
	protected $_ci;
	
	
	function __construct()
	{
		$this->_ci =& get_instance();
	}
	
	function display($template, $data=null)
	{
		$data['_header']	= $this->_ci->load->view('template_admin/header', '', true);
		$data['_kiri']		= $this->_ci->load->view('template_admin/kiri', $data, true);
		$data['_kanan']		= $this->_ci->load->view('admin/'.$template, $data , true);
		$data['_footer']	= $this->_ci->load->view('template_admin/footer', '', true);
		
		$this->_ci->load->view('template_admin', $data);
		
	}
}

// END template_admin class

/* End of file template_admin.php */
/* Location: ./application/libraries/template_admin.php */