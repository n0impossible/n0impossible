<div class="header_overlay">
    <span class="overlay_title">Select your face</span>
</div>

<div class="overlay_content" style="width:232px;">
	<div>
        <ul class="avatar">
            <li onclick="save_comment('1.gif');"><img src="<?=static_url().IMAGES.'troll/1.gif'?>"</li>
            <li onclick="save_comment('2.gif');"><img src="<?=static_url().IMAGES.'troll/2.gif'?>"</li>
            <li onclick="save_comment('3.gif');"><img src="<?=static_url().IMAGES.'troll/3.gif'?>"</li>
            <li onclick="save_comment('4.gif');"><img src="<?=static_url().IMAGES.'troll/4.gif'?>"</li>
        </ul>
        <ul class="avatar">
            <li onclick="save_comment('5.gif');"><img src="<?=static_url().IMAGES.'troll/5.gif'?>"</li>
            <li onclick="save_comment('6.gif');"><img src="<?=static_url().IMAGES.'troll/6.gif'?>"</li>
            <li onclick="save_comment('7.gif');"><img src="<?=static_url().IMAGES.'troll/7.gif'?>"</li>
            <li onclick="save_comment('8.gif');"><img src="<?=static_url().IMAGES.'troll/8.gif'?>"</li>
        </ul>
        <ul class="avatar">
            <li onclick="save_comment('9.gif');"><img src="<?=static_url().IMAGES.'troll/9.gif'?>"</li>
            <li onclick="save_comment('10.gif');"><img src="<?=static_url().IMAGES.'troll/10.gif'?>"</li>
            <li onclick="save_comment('11.gif');"><img src="<?=static_url().IMAGES.'troll/11.gif'?>"</li>
            <li onclick="save_comment('12.gif');"><img src="<?=static_url().IMAGES.'troll/12.gif'?>"</li>
        </ul>
    </div>
    <div id="clearer"></div>
</div><!--end of overlay_content-->

<div class="wrapper_footer_overlay">
    <div class="footer_overlay">
        <div class="button_cancel_wrapper" onclick="myweb.nonadmin.doOverlayClose();">
            <div class="button_cancel">
                Cancel
            </div>
        </div>
        <div id="clearer"></div>
    </div><!--end of footer_overlay-->
</div><!--end of wrapper_footer_overlay-->