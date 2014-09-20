<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Artikel_ac extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('artikel_model');
		$this->load->model('kategori_model');
		$this->load->model('artikel_join_kategori_model');
		
		$this->load->library('template_admin');
		$this->load->library('form_validation');
		$this->load->library('image_thumb');
		$this->load->library('image_crop');
		
		$this->load->helper('url');
		$this->load->helper('text');
		$this->load->helper('date');
	}
	
	public function index()
	{
		$data['artikels']	= $this->artikel_model->get_artikel();
		
		$data['title']		= 'Artikel';
		$data['menu']		= 'artikel';
		
		$this->template_admin->display('show_artikel', $data);
	}
	
	public function new_artikel()
	{
		$data['title']		= 'Tambah Artikel';
		$data['menu']		= 'artikel';
		$data['kategoris']	= $this->kategori_model->get_kategori();
		$data['user_id']	= $this->session->userdata('user_id');
		
		$this->template_admin->display('form_artikel', $data);
	}
	
	public function add_artikel()
	{
		$this->output->enable_profiler(TRUE);
		if($this->_validasi_data())
		{
			//cuplikan gambar
			$image_name			= $this->input->post('image_name', TRUE);
			$image_extension	= $this->input->post('image_type', TRUE);
			
			if($image_name != "" && $image_extension != "")
			{
				$data_img = $this->move_gambar($image_name, $image_extension);
			}
			else
			{
				$data_img['file_name']	= '';
				$data_img['file_ext']	= '';
			}
			
			$data['user_id']			= $this->input->post('user_id', TRUE);
			$data['judul']				= $this->input->post('judul', TRUE);
			$data['keyword']			= $this->input->post('keyword', TRUE);
			$data['file_gambar_name']	= $data_img['file_name'];
			$data['file_gambar_ext']	= $data_img['file_ext'];
			$data['cuplikan_artikel']	= $this->input->post('cuplikan_artikel');
			$data['isi']				= $this->input->post('isi');
			$data['status']				= 'published';
			$data['tanggal_masuk']		= $this->input->post('tgl_masuk', TRUE);
			
			//masukin ke database
			
			if($artikel_id = $this->artikel_model->insert_artikel($data))
			{
				if($kategorinya	= $this->input->post('kategori', TRUE)) //insert kategori artikel
				{
					foreach($kategorinya as $kategori)
					{
						$data2['artikel_id']			= $artikel_id;
						$data2['kategori_artikel_id']	= $kategori;
						
						$this->artikel_join_kategori_model->insert($data2);
					}
				}
				
				//show artikel
				$data_view['artikels']	= $this->artikel_model->get_artikel();

				$data_view['title']		= 'Artikel';
				$data_view['menu']		= 'artikel';
				$data_view['last_id']	= $artikel_id;					
				
				$this->template_admin->display('show_artikel', $data_view);
			}			
			else
			{
				$data['title']			= 'Tambah Artikel';
				$data['menu']			= 'artikel';
				$data['error_gambar']	= $this->upload->display_errors();
				$data['kategoris']		= $this->kategori_model->get_kategori();
				$data['user_id']		= $this->session->userdata('user_id');
				
				$this->template_admin->display('form_artikel', $data);
			}
		}
		else
		{
			$data['title']		= 'Tambah Artikel';
			$data['menu']		= 'artikel';
			$data['kategoris']	= $this->kategori_model->get_kategori();
			$data['user_id']	= $this->session->userdata('user_id');
			
			$this->template_admin->display('form_artikel', $data);
		}
	}
	
	public function edit($artikel_id = FALSE)
	{
		if($artikel_id === FALSE)
		{
			redirect('admin/artikel_ac');
		}
		else
		{
			if($this->_validasi_data())
			{
				//cuplikan gambar
				$image_name			= $this->input->post('image_name', TRUE);
				$image_extension	= $this->input->post('image_type', TRUE);
				
				$artikel_id			= $this->input->post('artikel_id', TRUE);
				
				$artikel = $this->artikel_model->get_artikel($artikel_id);
				
				$data['user_id']			= $this->input->post('user_id', TRUE);
				$data['judul']				= $this->input->post('judul', TRUE);
				$data['keyword']			= $this->input->post('keyword', TRUE);
				$data['cuplikan_artikel']	= $this->input->post('cuplikan_artikel');
				$data['isi']				= $this->input->post('isi');
				$data['status']				= 'published';
				$data['tanggal_masuk']		= $this->input->post('tgl_masuk', TRUE);
				
				if($image_name == $artikel['file_gambar_name'])
				{
					$data['file_gambar_name']	= $image_name;
					$data['file_gambar_ext']	= $image_extension;
				}
				else
				{
					if($artikel['file_gambar_name'] !== "" || $artikel['file_gambar_ext'] !== "")
					{
						//hapus images yang lama
						$img_1	= UPLOAD_PATH.$artikel['file_gambar_name'].$artikel['file_gambar_ext'];
						$img_2	= UPLOAD_PATH.$artikel['file_gambar_name'].'_thumb'.$artikel['file_gambar_ext'];
						$img_3	= UPLOAD_PATH.$artikel['file_gambar_name'].'_100x100_thumb'.$artikel['file_gambar_ext'];
						$img_4	= UPLOAD_PATH.$artikel['file_gambar_name'].'_50x50_thumb'.$artikel['file_gambar_ext'];
						
						unlink($img_1);
						unlink($img_2);
						unlink($img_3);
						unlink($img_4);
					}
					
					if($image_name != "" || $image_extension != "")
					{
						//image yang baru, kalo ada
						if($data_img = $this->move_gambar($image_name, $image_extension))
						{
							
						}
						else
						{
							$data_img['file_name']	= '';
							$data_img['file_ext']	= '';
						}
					}
					else
					{
						$data_img['file_name']	= '';
						$data_img['file_ext']	= '';
					}
					
					$data['file_gambar_name']	= $data_img['file_name'];
					$data['file_gambar_ext']	= $data_img['file_ext'];
				}
				
				//update database
				$update = $this->artikel_model->update($artikel_id, $data);
				
				//delete katogori
				$this->artikel_join_kategori_model->delete_by_artikel_id($artikel_id);
				if($kategorinya	= $this->input->post('kategori', TRUE))
				{
					foreach($kategorinya as $kategori)
					{
						$data2['artikel_id']			= $artikel_id;
						$data2['kategori_artikel_id']	= $kategori;
						
						$this->artikel_join_kategori_model->insert($data2);
					}
					
				}
				
				//show artikel
				$data_view['artikels']	= $this->artikel_model->get_artikel();
	
				$data_view['title']		= 'Artikel';
				$data_view['menu']		= 'artikel';
				$data_view['last_id']	= $artikel_id;					
				
				$this->template_admin->display('show_artikel', $data_view);
				
			}
			else
			{
				$kategori_artikel 	= array();
				$data['kategoris']	= $this->kategori_model->get_kategori();
				$data['artikel']	= $this->artikel_model->get_artikel($artikel_id);
				$kategorinya		= $this->artikel_join_kategori_model->get($artikel_id);
				
				foreach($kategorinya as $kategori):
					$kategori_artikel[] = $kategori['kategori_artikel_id'];
				endforeach;
				
				$data['kategorinya']= $kategori_artikel;
				$data['title']		= 'Edit Artikel';
				$data['menu']		= 'artikel';
			
				$this->template_admin->display('form_edit_artikel', $data);
			}
		}
		$this->output->enable_profiler(TRUE);
	}
	
	//delete artikel
	public function delete()
	{
		$id = $this->input->post('del_id', TRUE);
		
		//get image name
		$image = $this->artikel_model->get_image($id);
		
		//delete image
		unlink(UPLOAD_PATH.$image['file_gambar_name'].$image['file_gambar_ext']);
		unlink(UPLOAD_PATH.$image['file_gambar_name'].'_thumb'.$image['file_gambar_ext']);
		unlink(UPLOAD_PATH.$image['file_gambar_name'].'_100x100_thumb'.$image['file_gambar_ext']);
		unlink(UPLOAD_PATH.$image['file_gambar_name'].'_50x50_thumb'.$image['file_gambar_ext']);
		
		//delete in table artikel
		$this->artikel_model->delete_artikel($id);
		//delete in artikel_join_kategori table
		$this->artikel_join_kategori_model->delete_by_artikel_id($id);
	}
	
	//dialog delete artikel
	public function delete_dialog()
	{
		$artikel_id			= $this->input->post('delete_id', TRUE);
		$attribute_id		= $this->input->post('attribute_id', TRUE);
		
		$data['string']		= $this->input->post('judul', TRUE);
		$data['type']		= 'Article';
		$data['function']	= "delete_artikel('".$artikel_id."', '".$attribute_id."');";
		
		$this->load->view('admin/remove_dialog', $data);
	}
	
	public function cuplikan_artikel_form()
	{
		$data['artikel_id']			= $this->input->post('artikel_id', TRUE);
		$data['image_name']			= $this->input->post('image_name', TRUE);
		$data['image_extension']	= $this->input->post('image_extension', TRUE);
		$data['cuplikan']			= $this->input->post('cuplikan');
		$data['folder_semula']		= $this->input->post('folder_semula', TRUE);
		
		$this->load->view('admin/form_cuplikan_artikel', $data);
	}
	
	public function delete_temp_image()
	{
		$image_name			= $this->input->post('image_name', TRUE);
		$image_extension	= $this->input->post('image_extension', TRUE);
		
		if($image_name != "" || $image_extension != "")
		{
			unlink(TEMP_FOLDER.$image_name.$image_extension);
			unlink(TEMP_FOLDER.$image_name.'_thumb'.$image_extension);
			unlink(TEMP_FOLDER.$image_name.'_square_thumb'.$image_extension);
		}
	}
	
	public function _validasi_data()
	{
		$this->form_validation->set_rules('judul', 'Judul', 'trim|required|htmlspecialchars|xss_clean');
		$this->form_validation->set_rules('keyword', 'Keyword', 'trim|required|htmlspecialchars|xss_clean');
		$this->form_validation->set_rules('cuplikan_artikel', 'Cuplikan Artikel', 'trim');
		$this->form_validation->set_rules('tgl_masuk', 'Tanggal Masuk', 'trim|required|htmlspecialchars|xss_clean');
		$this->form_validation->set_rules('isi', 'Isi', 'required');
		
		return ($this->form_validation->run() == FALSE) ? FALSE : TRUE;
	}
	
	public function upload() //upload gambar cuplikan artikel
	{
		if($this->upload_gambar('file_gambar'))
		{
			$data['image_properties']	= $this->upload->data();
			$image_name	= $data['image_properties']['raw_name'];
			$extension	= $data['image_properties']['file_ext'];
			$width		= 150;
			$height		= 113;
			
			$source_file		= TEMP_FOLDER.$data['image_properties']['file_name'];
			$new_file			= TEMP_FOLDER.$image_name.$extension;
			$new_file_square	= TEMP_FOLDER.$image_name.'_square'.$extension;
			
			//create thumbnail
			if(!$this->image_thumb->create($width, $height, $source_file, $new_file))
			{
				// display error, kosongkan HTML formatting
				$data['error_create_thumnail'] = $this->image_thumb->image->display_errors('',''); 
			}
			
			//create thumbnail square
			if(!$this->image_crop->center_crop($source_file, $new_file_square))
			{
				// display error, kosongkan HTML formatting
				$data['error_create_thumnail'] = $this->image_crop->image->display_errors('','');
			}
			
			//load the view
			$this->load->view('admin/hasil_upload', $data);
		}
		else
		{
			// display error, kosongkan HTML formatting 
			$data['error_upload']	= $this->upload->display_errors('','');
			
			//load the view
			$this->load->view('admin/hasil_upload', $data);
		}
		
	}
	
	public function upload_gambar($field_name)
	{
		$config['upload_path'] = TEMP_FOLDER;
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size']	= '2000'; //2MB
		
		$this->load->library('upload', $config);
		
		if(!$this->upload->do_upload($field_name)) //jika gagal upload
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	public function move_gambar($file_name, $file_extension) //move gambar sekalian buat thmbnailnya
	{
		$source_file		= TEMP_FOLDER.$file_name.$file_extension;
		$source_file_square	= TEMP_FOLDER.$file_name.'_square_thumb'.$file_extension;
		
		$new_file_name	= uniqid();

		$new_file_1		= UPLOAD_PATH.$new_file_name.$file_extension; //new file 1
		$new_file_2		= UPLOAD_PATH.$new_file_name.'_100x100'.$file_extension; //new file 2
		$new_file_3		= UPLOAD_PATH.$new_file_name.'_50x50'.$file_extension; //new file 2
		
		//file image yang asli di move & rename
		rename($source_file, $new_file_1);
		
		//buat thumbnail 300 x 244
		if(!$this->image_thumb->create(300, 224, $new_file_1, $new_file_1))
		{
			// display error, kosongkan HTML formatting
			$data['error_create_thumnail'] = $this->image_thumb->image->display_errors('','');
			
			return FALSE;
		}
		
		//buat thumbnail 100 x 100
		if(!$this->image_thumb->create(100, 100, $source_file_square, $new_file_2))
		{
			// display error, kosongkan HTML formatting
			$data['error_create_thumnail'] = $this->image_thumb->image->display_errors('','');
			
			return FALSE;
		}
		
		//buat thumbnail 50 x 50
		if(!$this->image_thumb->create(50, 50, $source_file_square, $new_file_3))
		{
			// display error, kosongkan HTML formatting
			$data['error_create_thumnail'] = $this->image_thumb->image->display_errors('','');
			
			return FALSE;
		}
		
		unlink(TEMP_FOLDER.$file_name.'_thumb'.$file_extension);
		unlink($source_file_square);
		
		$data	= array(
				'file_name'	=> $new_file_name,
				'file_ext'	=> $file_extension,
			);
		
		return $data;
	}
	
}

/* End of file artikel_ac.php */
/* Location: ./application/library/artikel_ac.php */