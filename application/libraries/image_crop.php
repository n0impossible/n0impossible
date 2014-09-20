<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class image_crop
{
	
	public function __construct()
	{
		$this->CI	=& get_instance();
		$this->CI->load->library('image_lib');
		
		$this->image =& $this->CI->image_lib;
	}
	
	public function center_crop($source, $new_image)
	{
		$config['image_library']	= 'gd2';
		$config['source_image'] 	= $source;
		$config['maintain_ratio']	= FALSE;
		$config['overwrite'] 		= TRUE;
		
		$image_size	= getimagesize($source);
		$width		= $image_size[0];
		$height		= $image_size[1];
		
		//Set cropping for y or x axis, depending on image orientation
		if ($width > $height)// width > height
		{
			$config['width'] = $height;
			$config['height'] = $height;
			$config['x_axis'] = (($width / 2) - ($config['width'] / 2));
		}
		else
		{
			$config['height'] = $width;
			$config['width'] = $width;
			$config['y_axis'] = (($height / 2) - ($config['height'] / 2));
		}
		
		$config['new_image']	= $new_image;
		
		$this->image->initialize($config);
		
		if ( ! $this->image->crop())
		{
			echo $this->image->display_errors();
		}
	}
}

/* End of file image_crop.php */
/* Location: ./application/library/image_crop.php */