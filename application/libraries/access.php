<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Access
{
	public function __construct()
	{
		$this->CI =& get_instance();
		$auth = $this->CI->config->item('auth');

		$this->CI->load->helper('url');
		$this->CI->load->helper('cookie');
		$this->CI->load->model('user_model');
		
		$this->user_model =& $this->CI->user_model;
	}
	
	
	/**
	 *	Cek login user
	 */
	public function login($username, $password)
	{
		$result = $this->user_model->get_login_info($username, $password);
		
		if($result) //jika result found
		{			
			//start session
			$this->CI->session->set_userdata('user_id', $result->user_id);
			
			//insert session into login info
			$data['last_login_ip']		= $this->CI->session->userdata('ip_address');
			$data['last_login_time']	= date("Y-m-d H:i:s");
			$data['last_login_agent']	= $this->CI->session->userdata('user_agent');
			
			$update	= $this->user_model->update($result->user_id, $data);
			
			return $update ? TRUE : FALSE;
		}
		
		return FALSE;
	}
	
	/**
	 *	Cek apakah sudah login
	 */
	public function is_login()
	{
		return ($this->CI->session->userdata('user_id')) ? TRUE : FALSE;
	}
	
	public function logout()
	{
		$user_id	= $this->CI->session->userdata('user_id');
		$data['last_logout_ip']		= $this->CI->session->userdata('ip_address');
		$data['last_logout_time']	= date("Y-m-d H:i:s");
		$data['last_logout_agent']	= $this->CI->session->userdata('user_agent');
		
		//update table user
		$update	= $this->user_model->update($user_id, $data);
		
		$this->CI->session->unset_userdata('user_id');
	}
	
}

// End Access class

/* End of file access.php */
/* Location: ./application/libraries/access.php */