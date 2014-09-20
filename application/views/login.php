<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="<?=static_url().CSS?>login.css" rel="stylesheet" type="text/css" />
<title>Login Administrator</title>
</head>

<body>
<?php $v =& $this->form_validation; ?>
<div align="center">
<?php
	if(validation_errors())
	{
		echo '<div class="fail">
				'.validation_errors().'
			</div>';
	}
?>
	<div id="bg">
		<div id="header">
			<div id="icon-monitor">Form Login Administrator</div>
		</div>
		<form method="post" action="<?php site_url('login_c/login'); ?>">
		<table align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="100px" style="color:#333333;">Username</td>
				<td>
					<input id="text-field" type="text" name="username" />
				</td>
			</tr>
			<tr>
				<td style="color:#333333">Password</td>
				<td><input id="text-field" type="password" name="password" /></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type="image" src="<?=base_url().IMAGES_ADMIN?>login-button.png" id="login_button" /></td>
			</tr>
		</table>
		</form>
		<div id="bottom">
			<div id="bottom-left"></div>
			<div id="bottom-right">&nbsp;</div>
		</div>
	</div>
</div>
</body>
</html>