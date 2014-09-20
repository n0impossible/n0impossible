<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Artikel_c Class
 *
 * Kelas ini berguna untuk menampilkan artikel secara lengkap
 * berdasarkan artikel_id dan bisa juga yang lain
 *
 */
 
class Artikel_c extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('template');
		
		$this->load->helper('url');
		$this->load->helper('date');
		$this->load->helper('text');
		
		$this->load->model('artikel_model');
		$this->load->model('artikel_join_kategori_model');
		$this->load->model('komentar_model');
		$this->load->model('kanan_model');
		$this->load->model('kategori_model');
	}

	public function index($artikel_id)
	{
		//$this->output->cache(2);
		//get artikel from model
		$articles = $this->artikel_model->get_artikel($artikel_id);
		
		if(empty($articles))
		{
			show_404();
		}
		
		//get komentar
		$komentar 		= $this->komentar_model->get_komentar($artikel_id);
		
		//get recent artikel untuk sisi kanan
		$recent_article	= $this->kanan_model->get_recent_article();
		
		//total artikel
		$total_artikel	= $this->kanan_model->total_artikel();
		
		//get kategori untuk breadcumb link
		$bread_cat		= $this->artikel_join_kategori_model->get_kategori($artikel_id);
		
		//get kategori untuk sisi kanan
		$kategori_article = $this->kanan_model->get_kategori();
		
		//get sponsor list untuk sisi kanan
		$sponsor = $this->kanan_model->get_sponsor();
		
		$meta_description	= character_limiter(htmlentities(strip_tags($articles['isi'])), 155, '');
		
		if($articles['file_gambar_name'] == "")
		{
			//set default og:image
			$og_image	= static_url().'images/default.gif';
		}
		else
		{
			$og_image	= static_url().'gambar_konten/'.$articles['file_gambar_name'].'_100x100_thumb'.$articles['file_gambar_ext'];
		}
		
		$data = array(
					'keyword'			=>	$articles['keyword'],
					'desc'				=>	$meta_description,
					'og_image'			=>	$og_image,
					'title'				=>	$articles['judul'],
					'article'			=>	$articles,
					'kategorinya'		=>	$bread_cat,
					'total_artikel'		=> 	$total_artikel,
					'komentar'			=>	$komentar,
					'recent_articles'	=>	$recent_article,
					'categories'		=>	$kategori_article,
					'sponsors'			=>	$sponsor,
					'artikel_id'		=>	$artikel_id
				);
		
		$this->template->display('artikel', $data);
		
	}
	
	public function display_artikel_by_cat( $cat_url, $limit = 7, $offset = 0 )
	{
		//$this->output->enable_profiler(TRUE);
		//get artikel from model
		$articles = $this->artikel_model->get_artikel_by_cat( $cat_url, $limit, $offset );
		
		if(empty($articles))
		{
			show_404();
		}
		
		foreach($articles as $seo)
		{
			$keyword	= $seo['keyword'];
			$desc		= $seo['deskripsi'];
			$title		= $seo['kategori'];
			break; //cukup satu kali putaran saja
		}
		
		//get recent artikel untuk sisi kanan
		$recent_article = $this->kanan_model->get_recent_article();
		
		//total artikel
		$total_artikel	= $this->kanan_model->total_artikel();
		
		//get kategori untuk sisi kanan
		$kategori_article = $this->kanan_model->get_kategori();
		
		//get sponsor list untuk sisi kanan
		$sponsor = $this->kanan_model->get_sponsor();

		//get kategori
		$kategori_breadcum	= $this->kategori_model->get_kategori_byurl($cat_url);
		
		//generate next & previous page
		$next_offset	= $offset + 7;
		$cek_artikel	= $this->artikel_model->get_artikel_by_cat( $cat_url, $limit, $next_offset );
		$next_page	= '';
		$prev_page	= ''; 
		if(count($cek_artikel) > 0)
		{
			$next_page	= base_url().'cat/'.$cat_url.'/'.$limit.'/'.$next_offset;
		}
		if($offset != 0)
		{
			$prev_offset	= $offset - 7;
			if($prev_offset != 0){
				$prev_page		= base_url().'cat/'.$cat_url.'/'.$limit.'/'.$prev_offset;
			}else{
				$prev_page		= base_url().'cat/'.$cat_url.'.html';
			}
		}
		
		//set default og:image
		$og_image	= static_url().'images/default.gif';

		$data = array(
					'keyword'			=>	$keyword,
					'desc'				=>	$desc,
					'og_image'			=>	$og_image,
					'title'				=>	$title,
					'articles'			=>	$articles,
					'next_page'			=>	$next_page,
					'prev_page'			=>	$prev_page,
					'kategori_breadcum'	=>	$kategori_breadcum,
					'total_artikel'		=> 	$total_artikel,
					'recent_articles'	=>	$recent_article,
					'categories'		=>	$kategori_article,
					'sponsors'			=>	$sponsor
				);
		
		$this->template->display('index', $data);
	}
	
	public function lihat_lagi()
	{
		$jumlah	= $this->input->post('jumlah', TRUE);
		
		$data['artikels']	= $this->artikel_model->artikel_limit(5, $jumlah);
		
		$this->load->view('konten/lihat_lagi', $data);
	}
	
	public function search($keyword, $limit = 6, $offset = 0)
	{
		/*$keyword	= $this->input->get('term', TRUE);*/
		
		$data['artikels']		= $this->artikel_model->search_artikel($keyword, $limit, $offset);
		$data['total_artikel']	= $this->artikel_model->totalartikel_byjudul($keyword);
		$data['keyword']		= $keyword;
		
		$this->load->view('konten/hasil_search', $data);
	}
	
	public function more($keyword, $limit, $offset) //more search
	{
		//$keyword	= $this->input->get('term', TRUE);
		
		echo $keyword;
	}
	
	public function get_avatar()
	{
		$this->load->view('konten/avatar');
	}
	
	public function save_comment()
	{
		$data['nama']			= $this->input->post('nama', TRUE);
		$data['email']			= $this->input->post('email', TRUE);
		$data['website']		= $this->input->post('url', TRUE);
		$data['komentarnya']	= htmlentities($this->input->post('komentarnya'));
		$data['artikel_id']		= $this->input->post('artikel_id', TRUE);
		$data['avatar']			= $this->input->post('avatar', TRUE);
		
		$this->komentar_model->insert($data);
		
		$this->load->view('konten/komentar', $data);
	}
}

/* End of file artikel_c.php */
/* Location: ./application/controllers/artikel_c.php */