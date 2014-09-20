<span class="admin_title"><?=$title?></span>

<div class="panel">
	<table class="table_style_panel">
		<tr>
			<td>
				<a href="<?=base_url()?>admin/artikel_ac" title="Kembali">
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
<form method="post" enctype="multipart/form-data" action="<?=base_url().'admin/artikel_ac/add_artikel'?>">
    <p class="form">
    <input id="judul_artikel" class="judul width_762" type="text" name="judul" value="<?=set_value('judul')?>" /><?php echo form_error('judul'); ?>
    </p>
    
    <p class="form">
        <input id="keyword" class="judul width_550" type="text" name="keyword" value="<?=set_value('keyword')?>" />
        <?php echo form_error('keyword'); ?>
        <input class="judul width_180" type="text" name="tgl_masuk" id="tgl_masuk" value="<?=date("Y-m-d H:i:s")?>" />
        <?php echo form_error('tgl_masuk'); ?>
    </p>
    
	<div id="view_all">
		<a href="javascript:;" id="setting_cuplikan_artikel" onclick="cuplikan_artikel_form();">Setting Cuplikan Artikel</a>
	</div><!--end of view_all-->
	<div id="clearer"></div>
	<p class="form">
		<?php echo form_error('isi'); ?>
		<textarea name="isi" cols="126" class="width_762" rows="30" id="elm2"><?=set_value('isi')?></textarea>
	</p>
	
	<div id="checkbox_set">
	Kategori : 
		<?php foreach($kategoris as $kategori): ?>
			<input id="<?=$kategori['kategori']?>" type="checkbox" name="kategori[]" value="<?=$kategori['kategori_artikel_id']?>" />
			<label for="<?=$kategori['kategori']?>"><?=$kategori['kategori']?></label>
		<?php endforeach; ?>
	</div>
    <input type="hidden" name="artikel_id" value="" />
    <input type="hidden" name="folder_semula" value="Y" />
    <input type="hidden" name="user_id" value="<?=$user_id?>" />
    <input id="image_name" type="hidden" name="image_name" value="" />
    <input id="image_type" type="hidden" name="image_type" value="" />
    <textarea id="hidden" name="cuplikan_artikel"></textarea>
</form>