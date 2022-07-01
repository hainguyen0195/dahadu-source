<div class="container">
	<div class="title-main"><span><?=$static['ten'.$lang]?></span></div>
	<div class="content-main"><?=(isset($static['noidung'.$lang]) && $static['noidung'.$lang] != '') ? htmlspecialchars_decode($static['noidung'.$lang]) : ''?></div>
	<div class="share">
		<b><?=chiase?>:</b>
		<div class="social-plugin w-clear">
			<div class="addthis_inline_share_toolbox_qj48"></div>
			<div class="zalo-share-button" data-href="<?=$func->getCurrentPageURL()?>" data-oaid="<?=($optsetting['oaidzalo']!='')?$optsetting['oaidzalo']:'579745863508352884'?>" data-layout="1" data-color="blue" data-customize=false></div>
		</div>
	</div>
</div>