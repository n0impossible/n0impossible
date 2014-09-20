<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Artikel_model Class
 *
 * Kelas ini berguna untuk mengambil data dari database
 * untuk mengisi konten yang ada pada sisi kiri berupa artikel
 * juga untuk menyimpan data pengunjung dan sebagainya
 * 
 */

class Artikel_model extends CI_Model
{
	private $primary_key	= 'artikel_id';
	private $table_name		= 'artikel';
	
	//konstruktor
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * Get artikel
	 *
	 * Fungsi ini mengembalikan nilai yang ada pada tabel artikel
	 * berupa judul, isi, cuplikan dll
	 *
	 * @access	public
	 * @param	$artikel_id
	 * @return	array
	 */
	public function get_artikel($artikel_id = FALSE, $limit = "", $offset = "")
	{
		if($artikel_id === FALSE) //jika tanpa artikel_id maka tamplikan cuplikannya
		{
			//two parameter select for not try to protect this field or table names with backticks `
			$this->db->select(
				'artikel_id, judul, file_gambar_name, file_gambar_ext, cuplikan_artikel, isi, status, tanggal_masuk, DATE_FORMAT(tanggal_masuk, "%M %d, %Y") as formated_date',
				FALSE
			);
			
			if($limit != "" && $offset == "")
			{
				$this->db->limit($limit);
			}
			else if($limit != "" && $offset != "")
			{
				$this->db->limit($limit, $offset);
			}
			$this->db->order_by('artikel_id', 'desc');
			//$this->db->limit(10);
			
			/** 
			 * menghasilkan :
			 * select 
			 * artikel_id, judul, file_gambar_name, cuplikan_artikel, isi,
			 * DATE_FORMAT(tanggal_masuk, "%M %d, %Y") as tanggal_masuk
			 * from artikel order by artikel_id desc limit 10
			 *
			 */
			$query = $this->db->get_where('artikel',array('status' => 'published'));
			
			return $query->result_array();
		}
		
		$this->db->select(
				'artikel_id, user_id, judul, keyword, file_gambar_name, file_gambar_ext, cuplikan_artikel, isi, tanggal_masuk, DATE_FORMAT(tanggal_masuk, "%M %d, %Y") as formated_date',
				 FALSE
				);
		$query = $this->db->get_where('artikel', array('artikel_id' => $artikel_id, 'status' => 'published'));
		
		return $query->row_array();
		
	}// end of get_artikel
	
	
	//search artikel by judul
	public function search_artikel($judul , $limit = "", $offset = "")
	{
		
		$this->db->select('artikel.artikel_id, judul, file_gambar_name, file_gambar_ext, kategori');
		$this->db->from('artikel');
		$this->db->join('artikel_join_kategori', 'artikel.artikel_id = artikel_join_kategori.artikel_id', 'left');
		$this->db->join('kategori_artikel', 'artikel_join_kategori.kategori_artikel_id = kategori_artikel.kategori_artikel_id', 'left');
		$this->db->like('judul', $judul);
		$this->db->group_by('judul');
		$this->db->order_by('kategori', 'asc');
		 
		if($limit != "" && $offset == "")
		{
			$this->db->limit($limit);
		}
		else if($limit != "" && $offset != "")
		{
			$this->db->limit($limit, $offset);
		}
		
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	public function totalartikel_byjudul($judul)
	{
		$query	= $this->db->query("select count(artikel_id) as total from artikel where judul like '%".$judul."%'");
		
		return $query->row()->total;
	}
	
	/**
	 * Get artikel by kategori
	 *
	 * Fungsi ini mengembalikan nilai yang ada pada tabel artikel
	 * berupa judul, isi, cuplikan dll
	 *
	 * @access	public
	 * @param	$kategori_url as url field in kategori_artikel table
	 * @return	array
	 *
	 */
	public function get_artikel_by_cat($kategori_url, $limit = "", $offset = "")
	{
		$this->db->select('artikel.artikel_id, judul, kategori, deskripsi, kategori_artikel.keyword as keyword, file_gambar_name, file_gambar_ext, cuplikan_artikel, isi, tanggal_masuk, DATE_FORMAT(tanggal_masuk, "%M %d, %Y") as formated_date', FALSE);
		$this->db->from('artikel_join_kategori');
		$this->db->join('artikel', 'artikel_join_kategori.artikel_id = artikel.artikel_id', 'left');
		$this->db->join('kategori_artikel', 'artikel_join_kategori.kategori_artikel_id = kategori_artikel.kategori_artikel_id', 'left');
		$this->db->where('url', $kategori_url);
		$this->db->where('status', 'published');
		$this->db->order_by('artikel_id', 'desc');

		if($limit != "" && $offset == "")
		{
			$this->db->limit($limit);
		}
		else if($limit != "" && $offset != "")
		{
			$this->db->limit($limit, $offset);
		}
		
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	/**
	 * Save Session
	 *
	 * Fungsi ini menyimpan session ke tabel pengunjung
	 * session sendiri sudah ditambah dengan data baru
	 * seperti execution_time, http_referer dsb
	 *
	 * @access	public
	 * @param	array
	 * @return	none
	 */
	public function save_session($session_data = array())
	{
		//prepare data
		$data = array(
				'artikel_id'			=>	$session_data['artikel_id'],
				'ip_address'			=>	$session_data['ip_address'],
				'user_agent'			=>	$session_data['user_agent'],
				'http_referer'			=>	$session_data['http_referer']
			);
			
		$this->db->insert('pengunjung', $data);
	}
	
	public function get_kategori($artikel_id)
	{
		$query = $this->db->query("SELECT kategori FROM artikel_join_kategori left join kategori_artikel using(kategori_artikel_id) where artikel_id = '".$artikel_id."'");
		
		return $query->result_array();
	}
	
	public function get_image($artkel_id)
	{
		$this->db->select('file_gambar_name, file_gambar_ext');
		$query = $this->db->get_where($this->table_name, array($this->primary_key => $artkel_id));
		
		return $query->row_array();
	}
	
	public function insert_artikel($data = array())
	{
		$this->db->insert($this->table_name, $data);
		
		return $this->db->insert_id();
	}
	
	public function update($artikel_id, $data = array())
	{
		$this->db->where($this->primary_key, $artikel_id);
		
		$query = $this->db->update($this->table_name, $data);
		$result = $query ? true : false;
 
  		return $result;
	}
	
	public function insert_artikel_join($data = array()) //insert artikel_join_kategori
	{
		$this->db->insert('artikel_join_kategori', $data);
		
		return $this->db->insert_id();
	}
	
	public function delete_artikel($id)
	{
		//delete in artikel tabel
		$this->db->delete($this->table_name, array($this->primary_key => $id));
		
		return TRUE;
	}
	
	public function artikel_limit($start, $limit)
	{
		$this->db->order_by($this->primary_key, 'desc');
		
		$query = $this->db->get($this->table_name, $limit, $start);
		// Produces: SELECT * FROM artikel LIMIT $start, $limit order by artikel_id desc
		
		return $query->result_array();
	}
	
}

// END Artikel_model class

/* End of file artikel_model.php */
/* Location: ./application/models/artikel_model.php */