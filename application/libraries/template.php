<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
class Template
{
	protected $_ci;
	
	function __construct()
	{
		$this->_ci =& get_instance();
	}
	
	function display($template, $data=null)
	{
		$data['_header']	= $this->_ci->load->view('template/header','', true);
		$data['_kiri']		= $this->_ci->load->view($template, $data, true);
		$data['_kanan']		= $this->_ci->load->view('template/kanan', $data, true);
		$data['_footer']	= $this->_ci->load->view('template/footer', '', true);
		
		$this->_ci->load->view('template', $data);
		
	}
	
}

// END Template class

/* End of file template.php */
/* Location: ./application/libraries/template.php */