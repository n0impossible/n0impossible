<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kategori_ac extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('kategori_model');
		$this->load->library('template_admin');
		$this->load->library('form_validation');
		$this->load->helper('url');
	}
	
	public function index()
	{
		$data['kategoris']	= $this->kategori_model->get_kategori();
		$data['title']		= 'Kategori Artikel';
		$data['menu']		= 'kategori';

		$this->template_admin->display('show_kategori', $data);
	}
	
	public function new_kategori()
	{
		$data['title']		= 'Tambah Kategori Artikel';
		$data['menu']		= 'kategori';
	
		$this->template_admin->display('form_kategori', $data);
	}
	
	public function add_kategori()
	{
		if($this->_validasi_data())
		{
			$data['kategori']	= $this->input->post('kategori_name', TRUE);
			$data['deskripsi']	= $this->input->post('deskripsi', TRUE);
			$data['keyword']	= $this->input->post('keyword', TRUE);
			$data['url']		= $this->input->post('url', TRUE);
			
			$last_insert_id = $this->kategori_model->insert_kategori($data);
			if($last_insert_id)
			{
				$data['kategoris']	= $this->kategori_model->get_kategori();
				$data['title']		= 'Kategori Artikel';
				$data['menu']		= 'kategori';
				$data['last_id']	= $last_insert_id;
		
				$this->template_admin->display('show_kategori', $data);
			}
			else
			{
				$this->template_admin->display('form_kategori');
			}
		}
		else
		{
			$data['title']		= 'Tambah Kategori Artikel';
			$data['menu']		= 'kategori';
			$this->template_admin->display('form_kategori', $data);
		}
	}
	
	public function edit_kategori($kategori_artikel_id = FALSE)
	{
		if($kategori_artikel_id === FALSE)
		{
			redirect('admin/kategori_ac');
		}
		else
		{
			$data['kategori']	= $this->kategori_model->get_kategori($kategori_artikel_id);
			$data['title']		= 'Edit Kategori Artikel';
			$data['menu']		= 'kategori';
		
			$this->template_admin->display('form_edit_kategori', $data);
		}
	}
	
	public function update_kategori()
	{
		//$this->output->enable_profiler(TRUE);
		
		$id	= $this->input->post('kategori_id', TRUE);
		
		if(empty($id))
		{
			redirect('admin/kategori_ac');
		}
		
		if($this->_validasi_data())
		{
			$data['kategori']	= $this->input->post('kategori_name', TRUE);
			$data['deskripsi']	= $this->input->post('deskripsi', TRUE);
			$data['keyword']	= $this->input->post('keyword', TRUE);
			$data['url']		= $this->input->post('url', TRUE);
			
			$this->kategori_model->update_kategori($data, $id);
			
			$data['kategoris']	= $this->kategori_model->get_kategori();
			$data['title']		= 'Kategori Artikel';
			$data['menu']		= 'kategori';
			$data['last_id']	= $id;
	
			$this->template_admin->display('show_kategori', $data);
		}
		else
		{
			$id	= $this->input->post('kategori_id', TRUE);
			$data['title']		= 'Edit Kategori Artikel';
			$data['menu']		= 'kategori';
			
			$data['kategori']	= $this->kategori_model->get_kategori($id);
			$this->template_admin->display('form_edit_kategori', $data);
		}
	}
	
	public function delete()
	{
		$id = $this->input->post('del_id', TRUE);
		$this->kategori_model->delete_kategori($id);
	}
	
	//dialog delete kategori
	public function delete_dialog()
	{
		$kategori_id		= $this->input->post('delete_id', TRUE);
		$attribute_id		= $this->input->post('attribute_id', TRUE);
		
		$data['string']		= $this->input->post('kategori', TRUE);
		$data['type']		= 'Kategori';
		$data['function']	= "delete_kategori('".$kategori_id."', '".$attribute_id."');";
		
		$this->load->view('admin/remove_dialog', $data);
	}
	
	public function _validasi_data()
	{
		$this->form_validation->set_rules('kategori_name', 'Nama Kategori', 'trim|required|htmlspecialchars|xss_clean');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required|htmlspecialchars|xss_clean');
		$this->form_validation->set_rules('keyword', 'Keyword', 'trim|required|htmlspecialchars|xss_clean');
		$this->form_validation->set_rules('url', 'URL', 'trim|required|htmlspecialchars|xss_clean');
		
		return ($this->form_validation->run() == FALSE) ? FALSE : TRUE;
	}
	
}