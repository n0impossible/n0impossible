<?php
// Simpler way of making sure all no-cache headers get sent
// and understood by all browsers, including IE.
session_cache_limiter('nocache');
header('Expires: ' . gmdate('r', 0));

header('Content-type: application/json');

//atur dulu arraynya
$upload_path	= GAMBAR_KONTEN;
for($i=0; $i<count($artikels); $i++)
{
	if($artikels[$i]['file_gambar_name'] == "")
	{
		$artikels[$i]['link_gambar']	= static_url().IMAGES.'default_50x50.jpg';
	}
	else
	{
		$artikels[$i]['link_gambar']	= static_url().$upload_path.$artikels[$i]['file_gambar_name'].'_50x50_thumb'.$artikels[$i]['file_gambar_ext'];
	}

	$artikels[$i]['link_artikel']	= artikel_url($artikels[$i]['judul'], $artikels[$i]['artikel_id']);
	
	//hilangkan dari elemen array
	unset($artikels[$i]['file_gambar_name']);
	unset($artikels[$i]['file_gambar_ext']);
}

$more_result_total	= $total_artikel - count($artikels);

$next	= '';
if($more_result_total > 0)
{
	$next	= base_url().'artikel_c/search/'.$keyword.'/10/'.count($artikels);
}
else
{
	$next	= base_url().'artikel_c/more/'.$keyword.'/10/'.count($artikels);
}

$json_string	= '[{
						"data"			: '.json_encode($artikels).',
						"others"	: {
										"pagging_next"	: "'.$next.'",
										"keyword"		: "'.$keyword.'",
										"more_result_total"	: "'.$more_result_total.'"
										}
					}]';

echo $json_string;