<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

foreach($artikels as $artikel):
	$artikel_anchor = base_url().url_title(strtolower($artikel['judul'])).'-'.$artikel['artikel_id'].'.html';
	echo '<li><a href="'.$artikel_anchor.'">'.$artikel['judul'].'</a></li>';
endforeach;