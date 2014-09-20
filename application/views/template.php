<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="<?=static_url().IMAGES?>icon.gif" type="image/x-icon" />

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="google-site-verification" content="gwqeGECCRUuim_-iNPEbiKLnJjSsGIQe28kyXppEXqU" />
<meta name="googlebot" content="index,follow" />
<meta name="robots" content="index,follow" />
<meta name="msnbot" content="index,follow" />
<meta name="description" content="<?=$desc?>" />
<meta name="keywords" content="<?=$keyword?>" />
<meta name="author" content="Pangki Arifin" />

<link rel="canonical" href="<?=base_url().str_replace('/', '', $_SERVER["REQUEST_URI"])?>" />
<meta property="og:locale" content="id_ID" />
<meta property="og:title" content="<?=$title?> - n0impossible.com" />
<meta property="og:description" content="<?=$desc?>" />
<meta property="og:url" content="<?=base_url().str_replace('/', '', $_SERVER["REQUEST_URI"])?>" />
<meta property="og:site_name" content="Aneka tutorial pemrograman" />
<meta property="og:type" content="article" />
<meta property="og:image" content="<?=$og_image?>" />

<title><?=$title?></title>

<link href="<?=static_url().CSS?>style.css" rel="stylesheet" type="text/css" />
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
    <div class="modal_overlay">&nbsp;</div>
	<div class="overlay_box"></div>
    <script type="text/javascript" src="<?=static_url().JQUERY?>jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="<?=static_url().JQUERY?>jquery-ui-1.10.2.custom.min.js"></script>
    <script type="text/javascript" src="<?=static_url().JQUERY_PLUGIN?>jquery.watermark.min.js"></script>
    <script type="text/javascript" src="<?=static_url().JS?>javascript.js"></script>
    <script type="text/javascript" src="<?=static_url().JS?>syntaxhighlighter/syntaxhighlighter.js"></script>
    <!-- Piwik -->
	<!--Piwik--><script type="text/javascript">var _paq=_paq||[];_paq.push(['trackPageView']);_paq.push(['enableLinkTracking']);(function(){var u=(("https:"==document.location.protocol)?"https":"http")+"://traffic.n0impossible.com/";_paq.push(['setTrackerUrl',u+'piwik.php']);_paq.push(['setSiteId',1]);var d=document,g=d.createElement('script'),s=d.getElementsByTagName('script')[0];g.type='text/javascript';g.defer=true;g.async=true;g.src=u+'piwik.js';s.parentNode.insertBefore(g,s)})();</script><noscript><p><img src="http://traffic.n0impossible.com/piwik.php?idsite=1"style="border:0;"alt=""/></p></noscript><!--End Piwik Code-->
</body>
</html>