<span class="admin_title"><?=$title?></span>
<div class="panel">
	<table class="table_style_panel">
		<tr>
			<td>
				<a href="<?=base_url()?>admin/artikel_ac/new_artikel" title="Buat Baru">
					<img src="<?=static_url().IMAGES_ADMIN?>new.gif"><br />Buat Baru
				</a>
			</td>
		</tr>
	</table>
</div>
<table width="100%" class="table_style_satu" cellspacing="0">
	<thead>
		<tr>
			<th width="30%">Judul</th>
			<th width="34%">Cuplikan Artikel</th>
			<th width="10%">Status</th>
			<th width="20%">Tanggal Masuk</th>
			<th width="6%">&nbsp;</th>
		</tr>
	</thead>
	<?php foreach($artikels as $artikel): ?>
		<?php
			$a_kategoris = $this->artikel_model->get_kategori($artikel['artikel_id']);
			
			if(count($a_kategoris) != 0)
			{
				$kategori = ' ';
				foreach($a_kategoris as $a_kategori):
					$kategori .= $a_kategori['kategori'].', ';
				endforeach;
			}
			else
			{
				$kategori = ' -';
			}

		?>
	<?php
		$artikel_id	= $artikel['artikel_id'];
		if(isset($last_id))
		{
			if($artikel_id == $last_id)
			{
				$id = 'last';
			}
			else
			{
				$id = 'artikel_'.$artikel_id;
			}
		}
		else
		{
			$id = 'artikel_'.$artikel_id;
		}
	?>
	<tr id="<?=$id?>">
		<td><b><?=$artikel['judul']?></b><br /><br /><span class="gray_sepuluh"><b>Kategori:</b><?=rtrim($kategori, ', ')?></span></td>
		<td class="gray_sepuluh"><?=word_limiter(strip_tags($artikel['cuplikan_artikel']), 20)?></td>
		<td><?=$artikel['status']?></td>
		<td><acronym title="<?=time_since(strtotime($artikel['tanggal_masuk']))?>"><?=$artikel['formated_date']?></acronym></td>
		<td>
			<a class="edit" href="<?=base_url()?>admin/artikel_ac/edit/<?=$artikel['artikel_id']?>">Edit</a>
            <label id="<?=$id?>" class="delete right" onclick="delete_confirm_artikel(<?=$artikel_id?>, '<?=$id?>');" data-judul="<?=$artikel['judul']?>">
            </label>
		</td>
	</tr>
	<?php endforeach; ?>
</table>