<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
	public $table		= 'user';
	public $primary_key	= 'user_id';
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_login_info($username, $password)
	{
		$where = "username = '".$username."' and password = PASSWORD('".$password."')";
		$this->db->where($where);
		$this->db->limit(1);
		
		$query = $this->db->get($this->table);
		
		return ($query->num_rows() > 0) ? $query->row() : FALSE;
	}
	
	public function update($user_id, $data = array())
	{
		$this->db->where($this->primary_key, $user_id);
		$query	= $this->db->update($this->table, $data);
		
		$result	= $query ? true : false;
		
		return $result;
	}
	
}