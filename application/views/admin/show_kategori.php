<span class="admin_title"><?=$title?></span>
<div class="panel">
	<table class="table_style_panel" id="test_aja">
		<tr>
			<td>
				<a href="<?=base_url()?>admin/kategori_ac/new_kategori" title="Buat Baru">
					<img src="<?=static_url().IMAGES_ADMIN?>new.gif"><br />Buat Baru
				</a>
			</td>
		</tr>
	</table>
</div>
<table width="100%" class="table_style_satu" cellspacing="0">
	<thead>
		<tr>
			<th width="15%">Kategori</th>
			<th width="30%">Deskripsi</th>
			<th width="30%">Keyword</th>
			<th width="19%">Url</th>
			<th width="6%">&nbsp;</th>
		</tr>
	</thead>
	<?php foreach($kategoris as $kategori): ?>
	<?php
		$kategori_id	= $kategori['kategori_artikel_id'];
		if(isset($last_id))
		{
			if($kategori_id == $last_id)
			{
				$id = 'last';
			}
			else
			{
				$id = 'kategori_'.$kategori_id;
			}
		}
		else
		{
			$id = 'kategori_'.$kategori_id;
		}
	?>
	<tr id="<?=$id?>">
		<td><b><?=$kategori['kategori']?></b></td>
		<td><?=$kategori['deskripsi']?></td>
		<td><?=$kategori['keyword']?></td>
		<td><?=$kategori['url']?></td>
		<td>
			<a class="edit" href="<?=base_url()?>admin/kategori_ac/edit_kategori/<?=$kategori['kategori_artikel_id']?>">Edit</a>
			<?php
				if($kategori['have_artikel'] == 0)
				{
					echo'<label id="'.$id.'" class="delete right" onclick="delete_confirm_kategori(\''.$kategori_id.'\',\''.$id.'\');" data-kategori="'.$kategori['kategori'].'" ></label>';
				}
			?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>