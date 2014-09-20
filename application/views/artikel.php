<?php
	if(count($kategorinya) != 0)
	{
		foreach($kategorinya as $bread_cat):
			$bread_kategori	= $bread_cat['kategori'];
			$url_bread		= base_url().'cat/'.$bread_cat['url'].'.html';
			break;
		endforeach;
		
		$bread_2	= '<span class="arrow"></span><a href="'.$url_bread.'"><b>'.$bread_kategori.'</b></a>';
	}
	else
	{
		$bread_2	= '';
	}
	$artikel_anchor = artikel_url($article['judul'],$article['artikel_id']);
?>
<div id="artikel">
	<span class="home_ico"></span><a href="<?=base_url()?>"><b>Home</b></a><?=$bread_2?><span class="arrow"></span><a class="bold_anchor" href="<?=$artikel_anchor?>"><?=$article['judul']?></a>
</div>
<hr />
<div id="artikel">
	<h1 class="judul">
        <a class="anchor_judul" href="<?=$artikel_anchor?>">
        	<?=$article['judul']?>
       	</a>
     </h1>   
	<div class="tanggal"><acronym title="<?=$article['formated_date']?>"><?=time_since(strtotime($article['tanggal_masuk']))?></acronym></div>
	<?=$article['isi']?>						
</div><!--end of artikel-->

<div id="komentar_form_wrapper">
<h2 class="komentar_title">Tinggalkan Komentar</h2>
<p class="komentar_form">
	<label for="nama">Nama*</label>
	<input type="text" name="nama" id="nama_komentator" autocomplete="off" >
</p>
<p class="komentar_form">

	<label for="email">Email*</label>
	<input type="text" name="email" id="email_komentator" autocomplete="off" >
</p>
<p class="komentar_form">
	<label for="url">URL</label>
	<input type="text" name="url" id="url_komentator" autocomplete="off" >
</p>
<p class="komentar_form_textarea">
	<label for="komentar">Komentar*</label>
	<textarea name="komentarnya" id="komentarnya" cols="50" rows="10"></textarea>
    <input type="hidden" id="artikel_id" name="artikel_id" value="<?=$artikel_id?>" />
</p>
<p class="komentar_form_textarea">
<i>*Harus diisi</i>
<a href="javascript:;" class="button_submit_komentar none kanan" onclick="get_avatar();">
    Submit
</a>
</p>
<div id="clearer"></div>
</div><!--end of komentar_form_wrapper-->

<?php
	if(count($komentar) > 0)
	{
		echo '<div id="komentar_list_wrapper">
				<h2 class="komentar_title">'.count($komentar).' Komentar</h2>
				<ul class="komentar_list">';
		foreach($komentar as $komentarnya)
		{
			if(!empty($komentarnya['website']))
			{
				$link = str_replace('http://', '', $komentarnya['website']);
				$anchor = 'target="_blank" href="http://'.$link.'"';
			}
			else
			{
				$anchor = 'href="javascript:;"';
			}
			
			echo '<li>
					<div id="avatar_komentar">
						<img src="'.static_url().IMAGES.'troll/'.$komentarnya['avatar'].'">
					</div>
					<div id="isi_komentar">
						<a '.$anchor.'><b>'.$komentarnya['nama'].'</b></a>
						'.$komentarnya['komentarnya'].'
					</div>
					<div id="clearer"></div>';

			$komentar_reply = $this->komentar_model->get_komentar_reply($komentarnya['komentar_id']);
			if(!empty($komentar_reply))
			{
				echo '<ul class="komentar_reply_list">';
				foreach($komentar_reply as $komentar_replynya)
				{
					if(!empty($komentar_replynya['website']))
					{
						$link = str_replace('http://', '', $komentar_replynya['website']);
						$anchor = 'target="_blank" href="http://'.$link.'"';
					}
					else
					{
						$anchor = 'href="javascript:;"';
					}
					echo '<li>
							<div id="avatar_komentar">
								<img src="'.static_url().IMAGES.'troll/'.$komentar_replynya['avatar'].'">
							</div>
							<div id="isi_komentar_reply">
								<a '.$anchor.'><b>'.$komentar_replynya['nama'].'</b></a>
								'.$komentar_replynya['komentarnya'].'
							</div>
							<div id="clearer"></div>
						</li>';
				}
				echo '</ul><!--end of komentar_reply_list-->';
			}
			echo '</li>';
		}
		echo '</ul>
		</div><!--end of komentar_list_wrapper-->';
	}
	else//jika komentarnya masih kosong
	{
		echo '<div id="komentar_list_wrapper">
				<ul class="komentar_list">
				</ul>
			</div><!--end of komentar_list_wrapper-->';
	}
?>