<?php
	include "ajax_config.php";
	
	$id = (isset($_POST['id']) && $_POST['id'] > 0) ? htmlspecialchars($_POST['id']) : 0;
	$video = $d->rawQueryOne("select link_video from #_photo where id = ? limit 0,1",array($id));
?>
<?php if(isset($video['link_video']) && $video['link_video'] != '') { ?>
<iframe width="100%" height="100%" src="//www.youtube.com/embed/<?=$func->getYoutube($video['link_video'])?>" frameborder="0" allowfullscreen></iframe>
<?php } ?>