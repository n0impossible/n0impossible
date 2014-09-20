<?php

class Komentar_model extends CI_Model
{
	public $table	= 'komentar';
	
	public function __construct()
	{
		parent::__construct();
	}

	public function insert($data = array())
	{
		 $this->db->insert($this->table, $data); 
	}
	
	public function get_komentar($artikel_id)
	{
		$this->db->select('komentar_id, nama, email, website, komentarnya, avatar');
		$this->db->order_by('komentar_id', 'desc');
		$query = $this->db->get_where($this->table, array('artikel_id' => $artikel_id));
		
		return $query->result_array();
	}
	
	public function get_komentar_reply($komentar_id)
	{
		$this->db->select('nama, email, website, komentarnya, avatar');
		$query = $this->db->get_where('komentar_reply', array('komentar_id' => $komentar_id));
		
		return $query->result_array();
	}
	
}