<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Kategori_model Class
 *
 * Kelas ini berguna untuk mengambil data dari database
 * berupa data-data yang tersimpan di tabel kategori
 * juga untuk menyimpan data kategori dan sebagainya
 * 
 */

class Kategori_model extends CI_Model{

	private $primary_key	= 'kategori_artikel_id';
	private $table_name		= 'kategori_artikel';
		
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_kategori($kategori_id = FALSE)
	{
		if($kategori_id === FALSE)
		{
			$query = $this->db->query('SELECT
			'.$this->primary_key.', kategori, deskripsi, keyword, url, count( artikel_id ) as have_artikel 
			FROM '.$this->table_name.' LEFT JOIN artikel_join_kategori USING ('.$this->primary_key.')
			group by '.$this->primary_key.' order by '.$this->primary_key.' desc');
			
			return $query->result_array();
		}
		
		$query = $this->db->query('SELECT 
		'.$this->primary_key.', kategori, deskripsi, keyword, url, count( artikel_id ) as have_artikel 
		FROM '.$this->table_name.' LEFT JOIN artikel_join_kategori USING ('.$this->primary_key.')
		WHERE '.$this->primary_key.' = '.$kategori_id.'
		group by '.$this->primary_key.' order by '.$this->primary_key.' desc');
		
		return $query->row_array();
	}
	
	public function get_kategori_byurl($url)
	{
		$query	= $this->db->get_where($this->table_name, array('url' => $url), 1);
		
		return $query->row_array();
	}
	
	public function insert_kategori($data = array())
	{
		$this->db->insert($this->table_name, $data);
		
		return $this->db->insert_id();
	}
	
	public function update_kategori($data = array(), $id)
	{
		$this->db->where($this->primary_key, $id);
		$this->db->update($this->table_name, $data);
	}
	
	public function delete_kategori($id)
	{
		$this->db->delete($this->table_name, array($this->primary_key => $id)); 
		
		return TRUE;
	}
}

// END Kategori_model class

/* End of file kategori_model.php */
/* Location: ./application/models/kategori_model.php */