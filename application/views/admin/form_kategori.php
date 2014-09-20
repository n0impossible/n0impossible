<span class="admin_title"><?=$title?></span>
<div class="panel">
	<table class="table_style_panel">
		<tr>
			<td>
				<a href="<?=base_url()?>admin/kategori_ac" title="Kembali">
					<img src="<?=static_url().IMAGES_ADMIN?>back.png"><br />Kembali
				</a>
			</td>
			<td>
				<a href="javascript:;" onclick="document.forms[0].submit();" title="Buat Baru">
					<img src="<?=static_url().IMAGES_ADMIN?>simpan.gif"><br />Simpan
				</a>
			</td>
		</tr>
	</table>
</div>
<form method="post" action="<?=base_url().'admin/kategori_ac/add_kategori'?>">
<table width="100%" class="table_style_satu" cellspacing="0">
	<tr>
		<td width="20%">Nama Kategori</td>
		<td width="10%" align="center">:</td>
		<td>
			<input type="text" name="kategori_name" value="<?=set_value('kategori_name')?>" /><?php echo form_error('kategori_name'); ?>
		</td>
	</tr>
	<tr>
		<td>Deskripsi</td>
		<td align="center">:</td>
		<td>
			<textarea name="deskripsi" rows="3" cols="30"><?=set_value('deskripsi')?></textarea><?php echo form_error('deskripsi'); ?>
		</td>
	</tr>
	<tr>
		<td>Keyword</td>
		<td align="center">:</td>
		<td>
			<textarea name="keyword" rows="3" cols="30"><?=set_value('keyword')?></textarea><?php echo form_error('keyword'); ?>
		</td>
	</tr>
	<tr>
		<td>URL</td>
		<td align="center">:</td>
		<td>
			<input type="text" name="url" value="<?=set_value('url')?>" /><?php echo form_error('url'); ?>
		</td>
	</tr>
</table>
</form>