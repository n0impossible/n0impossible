<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Artikel_join_kategori_model extends CI_Model
{
	private $primary_key	= 'artikel_join_kategori_id';
	private $table_name		= 'artikel_join_kategori';
	
	//konstruktor
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get($artikel_id)
	{
		$this->db->select('kategori_artikel_id');
		$query = $this->db->get_where($this->table_name, array('artikel_id' => $artikel_id));
		
		return $query->result_array();
	}
	
	public function insert($data = array())
	{
		$this->db->insert($this->table_name, $data);
		
		return $this->db->insert_id();
	}
	
	//delete by artike_id
	public function delete_by_artikel_id($artikel_id)
	{
		$this->db->delete($this->table_name, array('artikel_id' => $artikel_id));
	}
	
	public function get_kategori($artikel_id)
	{
		// Produces:
		// SELECT kategori_artikel.kategori_artikel_id, kategori, url FROM artikel_join_kategori
		// LEFT JOIN kategori_artikel ON artikel_join_kategori.kategori_artikel_id = kategori_artikel.kategori_artikel_id
		// WHERE artikel_id = $artikel_id

		$this->db->select('kategori_artikel.kategori_artikel_id, kategori, url');
		$this->db->from('artikel_join_kategori');
		$this->db->join('kategori_artikel', 'artikel_join_kategori.kategori_artikel_id = kategori_artikel.kategori_artikel_id');
		$this->db->where('artikel_id', $artikel_id);
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
}