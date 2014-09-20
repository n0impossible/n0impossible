<div class="header_overlay">
    <span class="overlay_title">Delete <?=$type?></span>
</div>
<div class="overlay_content" style="width:300px;">
    <div class="delete_warning">
    	<!--<img src="<?=static_url().IMAGES?>warning.png">-->
    	Delete <b><?=$string?></b> ?
    </div>
</div><!--end of overlay_content-->

<div class="wrapper_footer_overlay">
    <div class="footer_overlay">
        <div class="button_cancel_wrapper" onclick="myweb.admin.doOverlayClose();">
            <div class="button_cancel">
                Cancel
            </div>
        </div>
        <div class="button_one_wrapper" onclick="<?=$function?>">
            <div class="button_one">
                Delete
            </div>
        </div>
        <div id="clearer"></div>
    </div><!--end of footer_overlay-->
</div><!--end of wrapper_footer_overlay-->