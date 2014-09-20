<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Static URL
 * 
 * Mengarahkan ke server static, e.g static.example.com
 * File2 yang bersifat static seperti css, javascript dan gambar template web
 *
 * @access	public
 * @return	string
 */
if ( ! function_exists('static_url'))
{
	function static_url()
	{
		$CI =& get_instance();
		return $CI->config->item('static_url');
	}
}

/**
 * Artikel URL
 * 
 * Generate url friendly
 *
 * @access	public
 * @return	string
 */
if (! function_exists('artikel_url'))
{
	function artikel_url($judul, $artikel_id)
	{
		$url	= base_url().url_title(strtolower($judul)).'-'.$artikel_id.'.html';
		return $url;
	}
}

/* End of file MY_url_helper.php */
/* Location: ./application/helpers/MY_url_helper.php */