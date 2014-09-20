<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/*
|--------------------------------------------------------------------------
| Path For css, javascript and images
|--------------------------------------------------------------------------
|
| ini adalah konfigurasi untuk folder css, javascript dan image
| image yang disini adalah image yang sifatnya statis, artinya
| hanya digunakan untuk keperluan interface web itu sendiri bukan konten
|
*/

define('CSS',									'css/');
define('JS',									'js/');
define('IMAGES',								'images/');

define('JS_ADMIN',								'js/admin/');
define('JQUERY',								'js/jquery/');
define('JQUERY_PLUGIN',							'js/jquery_plugin/');
define('CSS_JQUERY',							'js/jquery/themes/base/');
define('IMAGES_ADMIN',							'images/admin/');
define('GAMBAR_KONTEN',							'gambar_konten/');
define('GAMBAR_TEMP',							'temp/');

define('UPLOAD_PATH',    						'../subdom/static.n0impossible.com/gambar_konten/');
define('TEMP_FOLDER',							'../subdom/static.n0impossible.com/temp/');

/* End of file constants.php */
/* Location: ./application/config/constants.php */