<?php
// Simpler way of making sure all no-cache headers get sent
// and understood by all browsers, including IE.
session_cache_limiter('nocache');
header('Expires: ' . gmdate('r', 0));

header('Content-type: application/json');

	if(!isset($image_properties))
	{
		$error = array('error' => $error_upload);
		
		echo json_encode($error);
	}
	else
	{
		if(!isset($error_create_thumnail))
		{
			echo json_encode($image_properties);
		}
		else
		{
			$error = array('error' => $error_create_thumnail);
			
			//gabungkan antara hasil upload image dan error thumbnail
			$result = array_merge($image_properties,$error);
			
			echo json_encode($result);
		}
		
	}