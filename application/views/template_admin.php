<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="shortcut icon" href="<?=static_url().IMAGES?>icon.gif" type="image/x-icon" />
<link href="<?=static_url().CSS?>admin_style.css" rel="stylesheet" type="text/css" />
<title><?=$title?></title>
</head>
<body>
<div align="center">
	<div id="header_wrapper">
		<?php echo $_header; ?>
	</div>
	<div id="konten_wrapper">
		<div id="konten">
			<div id="kiri">
				<?php echo $_kiri; ?>
			</div><!--end of kiri-->
			
			<div id="kanan">
				<?php echo $_kanan; ?>
			</div><!--end of kanan-->
			<div id="clearer"></div>
		</div><!--end of konten-->
	</div><!--end of konten_wrapper-->
	
	<div id="clearer"></div>
	
	<div id="footer_wrapper">
		<?php echo $_footer; ?>
	</div>
</div>

<!--for dialog everlay-->
<div class="modal_overlay">&nbsp;</div>
<div class="overlay_box">
</div>
<script type="text/javascript" src="<?=static_url().JQUERY?>jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?=static_url().JQUERY?>jquery-ui-1.10.2.custom.min.js"></script>
<script type="text/javascript" src="<?=static_url().JQUERY_PLUGIN?>jquery.watermark.min.js"></script>
<script type="text/javascript" src="<?=static_url().JQUERY_PLUGIN?>jquery.iframe-transport.js"></script>
<script type="text/javascript" src="<?=static_url().JQUERY_PLUGIN?>jquery.fileupload.js"></script>
<script type="text/javascript" src="<?=static_url().JS_ADMIN?>javascript.js"></script>
<script type="text/javascript" src="<?=static_url().JS?>tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript" src="<?=static_url().JS?>tiny_mce/tiny_mce.js"></script>
</body>
</html>