<?php

/**
 * Kanan_model Class
 *
 * Kelas ini berguna untuk mengambil data dari database
 * untuk mengisi konten yang ada pada sisi kanan seperti
 * recent artikel, kategori, dan sponsor
 *
 */

class Kanan_model extends CI_Model
{

	/**
	 * Konstruktor
	 *
	 * Konstruktor ini meload database class
	 *
	 */
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * Get recent artikel
	 *
	 * Fungsi ini mengembalikan nilai yang ada pada tabel artikel
	 * namun hanya judul dan artikel id nya saja
	 *
	 * @access	public
	 * @param	none
	 * @return	array
	 */
	public function get_recent_article()
	{
		$this->db->select('artikel_id , judul');
		$this->db->order_by('artikel_id', 'desc');
		$this->db->limit(5);
		
		//produce select artikel_id, judul from artikel order by
		//artikel_id desc
		$query = $this->db->get('artikel');
		
		return $query->result_array();
	}
	
	/**
	 * Get kategori
	 *
	 * Fungsi ini mengembalikan nilai yang diambil
	 * Dari tabel kategori berupa kategorinya dan
	 * total artikel per kategori
	 *
	 * @access	public
	 * @param	none
	 * @return	array
	 */
	public function get_kategori()
	{
		
		/*$this->db->select('kategori, count(artikel_id) as total');
		$this->db->from('kategori_artikel');
		$this->db->join('artikel_join_kategori', 'kategori_artikel.kategori_artikel_id = artikel_join_kategori.kategori_artikel_id', 'left');
		$this->db->group_by('kategori_artikel_id');
		$this->db->order_by('kategori_artikel_id', 'asc');*/
		
		//SELECT kategori, count(artikel_id) FROM kategori_artikel left join artikel_join_kategori using(kategori_artikel_id) group by(kategori_artikel_id)
		
		/**
		 *
		 * SELECT `kategori_artikel_id`, `kategori`, count(artikel_id) as total
		 * FROM (`kategori_artikel`)
		 * LEFT JOIN `artikel` ON `kategori_artikel`.`kategori_artikel_id` = `artikel`.`kategori_id`
		 * GROUP BY `kategori_artikel_id`
		 * ORDER BY `kategori_artikel_id` asc
		 *
		 */
		
		$query = $this->db->query('SELECT kategori, count(artikel_id) as total, url FROM kategori_artikel left join artikel_join_kategori using(kategori_artikel_id) group by(kategori_artikel_id) order by kategori_artikel_id asc');
		
		return $query->result_array();
	}
	
	/**
	 * Get sponsor
	 *
	 * Fungsi ini mengembalikan nilai yang diambil
	 * Dari tabel sponsor berupa title, desc, file gambar
	 * dan sebagainya
	 *
	 * @access	public
	 * @param	none
	 * @return	array
	 *
	 */
	public function get_sponsor()
	{
		$this->db->order_by('sponsor_id', 'desc');	
		$query = $this->db->get('sponsor');
		
		return $query->result_array();
	}
	
	public function total_artikel()
	{
		$query = $this->db->get('artikel');
		
		return $query->num_rows();
	}
	
}

// END Kanan_model class

/* End of file kanan_model.php */
/* Location: ./application/models/kanan_model.php */