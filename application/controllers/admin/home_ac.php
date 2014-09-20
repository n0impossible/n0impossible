<?php

class Home_ac extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('template_admin');
	}
	
	public function index()
	{
		$this->output->enable_profiler(1);
		$data['title']	= 'Halaman Administrator - Selamat Datang';
		$data['menu']	= '';
		$this->template_admin->display('selamat_datang', $data);
	}
}