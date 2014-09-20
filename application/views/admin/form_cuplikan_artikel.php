<div class="header_overlay">
    <span class="overlay_title">Cuplikan Artikel</span>
</div>
<div class="overlay_content">
    <div id="cuplikan_artikel" title="Setting Cuplikan Artikel">
        <table>
            <tr>
                <td>
                    <?php
						if($image_name == "")
						{
							echo '<div id="form_cuplikan_gambar">
									Cuplikan Gambar<br />
									<input type="file" name="file_gambar" id="file_gambar" />
								</div>
								<div id="progress" class="hidden">
									<div class="bar" style="width: 0%;"></div>
									<span class="text gray_sepuluh right">0%</span>
								</div>
								<div id="error_message" class="error_message"></div>
								
								<div id="hidden" class="cuplikan_pic" target-id="cuplikan_dialog">
									<img id="cuplikan_gambar_dialog" class="cuplikan_gambar" src="" />
									<label title="hapus" onclick="hapus_foto_temp();"></label>
								</div>';
						}
						else
						{
							$image_file = $image_name.'_thumb'.$image_extension;
							
							if($folder_semula == "Y"){
								$img_url 	= static_url().GAMBAR_TEMP;
							}
							else
							{
								$img_url = static_url().GAMBAR_KONTEN;
							}
							
							echo '<div id="form_cuplikan_gambar" class="hidden">
									Cuplikan Gambar<br />
									<input type="file" name="file_gambar" id="file_gambar" />
								</div>
								<div id="error_message" class="error_message"></div>
								<div id="progress" class="hidden">
									<div class="bar" style="width: 0%;"></div>
									<span class="text gray_sepuluh right">0%</span>
								</div>
								<div class="cuplikan_pic" target-id="cuplikan_dialog">
									<img id="cuplikan_gambar_dialog" class="cuplikan_gambar" src="'.$img_url.$image_file.'" />
									<label title="hapus" onclick="hapus_foto_temp();"></label>
								</div>';
						}
						
					?>
                </td>
            </tr>
            <tr>
                <td>
                Cuplikan Artikel<br />
                <textarea name="cuplikan" id="elm1"><?=htmlentities($cuplikan)?></textarea>
                </td>
            </tr>
        </table>
    </div><!--end of cuplikan_artikel-->
</div><!--end of overlay_content-->

<div class="wrapper_footer_overlay">
    <div class="footer_overlay">
        <div class="button_cancel_wrapper" onclick="myweb.admin.doOverlayClose();">
            <div class="button_cancel">
                Cancel
            </div>
        </div>
        <div class="button_one_wrapper" onclick="set_cuplikan_artikel();">
            <div class="button_one">
                Oke
            </div>
        </div>
        <div id="clearer"></div>
    </div><!--end of footer_overlay-->
</div><!--end of wrapper_footer_overlay-->
<script type="text/javascript">
$(function () {
    $('#file_gambar').fileupload({
		url			: '<?=base_url()?>admin/artikel_ac/upload',
		dataType	: 'json',
		done		: function (e, data) {
			$('#form_cuplikan_gambar').css('display', 'none');
			//remove hidden id
			$('[target-id="cuplikan_dialog"]').removeAttr('id');
			
			//hide progress bar
			$('#progress').addClass('hidden');
			
			//sisipkan source images
			$('#cuplikan_gambar_dialog').attr('src', '<?=static_url()?>temp/'+data.result.raw_name+'_thumb'+data.result.file_ext);
			
			//setting value di hidden form
			$('#image_name').val(data.result.raw_name);
			$('#image_type').val(data.result.file_ext);
			
			//reset position overlaybox
			myweb.admin.showoverlay_box();
		},
		progressall	: function (e, data) {
			//show the progress bar
			$('#progress').removeClass('hidden');
			
			var progress = parseInt(data.loaded / data.total * 100, 10);
			$('#progress .bar').css(
				'width',
				progress + '%'
			);
			$('#progress .text').text(progress + '%');
		}
	});
});
</script>