<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_c extends CI_Controller{

	function __construct()
	{
		parent::__construct();
		
		$this->load->library('template');
		
		$this->load->helper('url');
		$this->load->helper('date');
		
		$this->load->model('artikel_model');
		$this->load->model('kanan_model');
	}
	
	function index($limit = 7, $offset = 0)
	{
		//meta tag
		$keyword	= 'Aneka Tutorial Pemrograman PHP, Tutorial MySQL, Javascript, JQuery, Ajax, PHP, MySQL, Linux, CentOS, Codeigniter, Komputer, Assembly';
		$desc		= 'A place to remember what I do, what will I do and what I want';

		//get artikel from model
		$articles 		= $this->artikel_model->get_artikel(FALSE, $limit, $offset);
		
		//generate next & previous page
		$next_offset	= $offset + 7;
		$cek_artikel	= $this->artikel_model->get_artikel(FALSE, $limit, $next_offset);
		$next_page	= '';
		$prev_page	= ''; 
		if(count($cek_artikel) > 0)
		{
			$next_page	= base_url().'page/'.$limit.'/'.$next_offset;
		}
		if($offset != 0)
		{
			$prev_offset	= $offset - 7;
			if($prev_offset != 0){
				$prev_page		= base_url().'page/'.$limit.'/'.$prev_offset;
			}else{
				$prev_page		= base_url();
			}
		}
		
		//total artikel
		$total_artikel	= $this->kanan_model->total_artikel();
		
		//get recent artikel untuk sisi kanan
		$recent_article	= $this->kanan_model->get_recent_article();
		
		//get kategori untuk sisi kanan
		$kategori_article = $this->kanan_model->get_kategori();
		
		//get sponsor list untuk sisi kanan
		$sponsor = $this->kanan_model->get_sponsor();
		
		$og_image	= static_url().'images/default.gif';
		
		$data = array(
					'title'				=>	'Hidden Monster Inside a Programmer',
					'keyword'			=>	$keyword,
					'desc'				=>	$desc,
					'og_image'			=>	$og_image,
					'articles'			=>	$articles,
					'next_page'			=>	$next_page,
					'prev_page'			=>	$prev_page,
					'total_artikel'		=>	$total_artikel,
					'recent_articles'	=>	$recent_article,
					'categories'		=>	$kategori_article,
					'sponsors'			=>	$sponsor
				);
		
		$this->template->display('index', $data);
		//$this->output->cache(2);
	}
	
}

/* End of file home_c.php */
/* Location: ./application/controllers/home_c.php */