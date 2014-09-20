<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_c extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('access');
	}
	
	public function index()
	{
		$this->access->logout();
		$this->login();
	}
	
	public function login()
	{
		$this->output->enable_profiler(TRUE);
		$this->load->library('form_validation');
		$this->load->helper('form');
		
		$this->form_validation->set_rules('username', 'Username', 'trim|required|strip_tag');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('token', 'token', 'callback_check_login');
		
		//$this->output->enable_profiler(1);
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('login');
			
		}
		else
		{
				redirect('admin/home_ac/index');
		}
	}
	
	public function logout()
	{
		$this->access->logout();
		redirect('login_c/login');
	}
	
	public function check_login()
	{
		$username = $this->input->post('username', TRUE);
		$password = $this->input->post('password', TRUE);
		
		$login = $this->access->login($username, $password);
		if($login)
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('check_login', 'Username atau Password anda salah.');
			return FALSE;
		}
	}
	
}

/* End of file login_c.php */
/* Location: ./application/controllers/login_c.php */