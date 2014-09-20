<div id="kategori_title">
	Recent Artikel
</div>

<div id="konten_kanan_wrapper">
	<ul id="_target_append_lihat_lagi">
		<?php foreach($recent_articles as $recent_article): ?>
		<?php
			$artikel_anchor = artikel_url($recent_article['judul'], $recent_article['artikel_id']);
		?>
			<li>
            	<a href="<?=$artikel_anchor?>">
					<?=$recent_article['judul']?>
               	</a>
			</li>
		<?php endforeach; ?>
	</ul>
    <?php
    	if($total_artikel > 5):
			$selisih = $total_artikel-5;
			($selisih > 5) ? $selisih = 5 : $selisih;
			echo '<div id="view_all" class="_target_load_lihat_lagi">
					<a href="javascript:;" onclick="lihat_lagi('.$selisih.');">Lihat Lagi('.$selisih.')</a>
				</div>';
		endif; 
	?>
	<div id="clearer"></div>
</div><!--end of konten_kanan_wrapper-->

<?php
	$kategori_ganjil = array();
	$kategori_genap = array();
	
	$total_kategori_ganjil = array();
	$total_kategori_genap = array();
	
	$kategori_anchor_ganjil = array();
	$kategori_anchor_genap = array();
	
	$i=1;
	foreach($categories as $categori):

		if($i % 2 == 0)
		{
			$kategori_genap[] = $categori['kategori'];
			$total_kategori_genap[] = $categori['total'];
			$kategori_anchor_genap[] = base_url().'cat/'.$categori['url'].'.html';
		}
		else
		{
			$kategori_anchor_ganjil[] = base_url().'cat/'.$categori['url'].'.html';
			$kategori_ganjil[] = $categori['kategori'];
			$total_kategori_ganjil[] = $categori['total'];
		}
		
		$i++;
	endforeach;
?>
<div id="kategori_title">
	Kategori
</div>

<div id="konten_kanan_wrapper">
	<table width="100%" cellpadding="0" cellspacing="0">
		<tr>
			<td width="50%">
				<ul>
					<?php 
						$i=0;
						foreach($kategori_ganjil as $kategori):
					?>
						<li><a href="<?=$kategori_anchor_ganjil[$i]?>"><?=$kategori?>(<?=$total_kategori_ganjil[$i]?>)</a></li>
					<?php
						$i++;
						endforeach;
					?>
				</ul>
			</td>
			<td width="50%">
				<ul>
					<?php 
						$i=0;
						foreach($kategori_genap as $kategori):
					?>
						<li><a href="<?=$kategori_anchor_genap[$i]?>"><?=$kategori?>(<?=$total_kategori_genap[$i]?>)</a></li>
					<?php
						$i++;
						endforeach;
					?>
				</ul>
			</td>
		</tr>
	</table>
</div><!--end of konten_kanan_wrapper-->

<div id="fixed_position_wrapper">
	<div id="fixed_position">
		<div id="kategori_title">
			Sponsor
		</div>
		<div id="konten_kanan_wrapper">
        	<a href="javascript:;" onclick="fuck_you();" title="klik dahh">
        		<img src="<?=static_url().IMAGES.'fuck_you_s.gif'?>" />	
            </a>
            <a href="javascript:;" onclick="yao_ming();" title="klik buruan">
        		<img src="<?=static_url().IMAGES.'yao_ming_s.gif'?>" />	
            </a>
		</div><!--end of konten_kanan_wrapper-->
		
	</div><!--end of fixed_position-->
</div><!--end of fixed_position_wrapper-->