<ul class="menu_kiri">
    <li class="cat_artikel" <?=($menu == 'kategori')?'id="aktif"':''?>>
        <a href="<?=base_url();?>admin/kategori_ac">
        	<label></label>
        	<span>Kategori Artikel</span>
        </a>
    </li>
    <li class="artikel" <?=($menu == 'artikel')?'id="aktif"':''?>>
        <a href="<?=base_url();?>admin/artikel_ac">
        	<label></label>
        	<span>Artikel</span>
		</a>
    </li>
    <li class="sponsor" <?=($menu == 'sponsor')?'id="aktif"':''?>>
        <a href="javascript:;">
        	<label></label>
        	<span>Sponsor</span>
		</a>
    </li>
    <li class="notif" <?=($menu == 'notif')?'id="aktif"':''?>>
        <a href="javascript:;">
        	<label></label>
            <span>Pemberitahuan</span>
		</a>
    </li>
    <li class="logout">
        <a href="<?=base_url();?>login_c/logout">
        	<label></label>
        	<span>Logout</span>
		</a>
    </li>
</ul>