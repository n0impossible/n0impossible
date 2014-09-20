<li id="last">
    <div id="avatar_komentar">
        <img src="<?=static_url().IMAGES?>troll/<?=$avatar?>">
    </div>
    <?php $url	= ($website == "") ? 'javascript:;' : $website ?>
    <div id="isi_komentar">
        <a href="<?=$url?>"><b><?=$nama?></b></a>
        <?=$komentarnya?>
    </div>
    <div id="clearer"></div>
</li>