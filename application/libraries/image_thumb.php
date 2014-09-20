<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class image_thumb
{
	
	public function __construct()
	{
		$this->CI	=& get_instance();
		$this->CI->load->library('image_lib');
		
		$this->image =& $this->CI->image_lib;
	}
	
	public function create($width, $height, $source_name, $new_name)
	{
		$config['image_library']	= 'gd2';
		$config['create_thumb']		= TRUE;
		$config['maintain_ratio']	= TRUE;
		$config['width']			= $width;
		$config['height']			= $height;
		$config['source_image']		= $source_name;
		$config['new_image']		= $new_name;
		
		//get image size
		/*$image_size	= getimagesize($source_name);
		
		if($image_size[0] > $image_size[1]) // width > height
		{
			$config['master_dim'] = 'height';
		}
		else
		{
			$config['master_dim'] = 'width';
		}*/
		
		$this->image->initialize($config);
		
		if(!$this->image->resize())
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
}

/* End of file image_thumb.php */
/* Location: ./application/library/image_thumb.php */