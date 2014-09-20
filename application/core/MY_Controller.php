<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('access');
		
		if(!$this->access->is_login())
		{
			redirect('login_c/login');
		}
	}
	
	public function is_login()
	{
		return $this->access->is_login();
	}
	
}
// END Admin_Controller class

class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
}

// END MY_Controller class

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */