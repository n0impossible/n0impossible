<?php
if(isset($kategori_breadcum)):
	$kategori	= $kategori_breadcum['kategori'];
	echo '<div id="artikel">
			<span class="home_ico"></span><a href="'.base_url().'"><b>Home</b></a><span class="arrow"></span><b>'.$kategori.'</b>
		</div>
		<hr />';
endif;
?>

<?php
$i=1;
foreach($articles as $article):
	$artikel_anchor = artikel_url($article['judul'],$article['artikel_id']);
?>
<div id="artikel">
	<h1 class="judul">
		<a class="anchor_judul" href="<?=$artikel_anchor?>">
			<?=$article['judul']?>
		</a>
	</h1>
	<div class="tanggal"><acronym title="<?=$article['formated_date']?>"><?=time_since(strtotime($article['tanggal_masuk']))?></acronym></div>
    <?php
		if($article['file_gambar_name'] != "")
		{
			$img_url	= static_url().GAMBAR_KONTEN.$article['file_gambar_name'].'_thumb'.$article['file_gambar_ext'];
			$img_anchor	= static_url().GAMBAR_KONTEN.$article['file_gambar_name'].$article['file_gambar_ext'];
			
			echo '<a title="click to show picture" target="_blank" href="'.$img_anchor.'" class="image_artikel">
					<img src="'.$img_url.'">
				</a>';
		}

		if($article['cuplikan_artikel'] == "") // jika cuplikan artikel kosong
		{
			//langsung tampilkan isinya
			echo $article['isi'];
		}
		else
		{
			echo ''.$article['cuplikan_artikel'].'
				<div align="right">
					<a href="'.$artikel_anchor.'">
						<i>Selengkapnya &gt;&gt;</i>
					</a>
				</div>';
		}
	?>
<div id="clearer">&nbsp;</div>
</div><!--end of artikel-->
<hr />
<?php
	$i++;
endforeach;
?>
<div id="artikel">
<?php
	if($next_page != '')
	{
		echo '<a href="'.$next_page.'" title="Older Stories"><b>&larr; Older Stories</b></a>';
	}
	
	if($prev_page != '')
	{
		echo '<a class="right" href="'.$prev_page.'" title="New Stories"><b>New Stories &rarr;</b></a>';
	}
?>
<div id="clearer">&nbsp;</div>
</div><!--end of artikel-->