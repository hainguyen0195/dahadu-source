<div class="container">
    <div class="title-main"><span><?=@$title_crumb?></span></div>
    <div class="content-main w-clear">
        <?php if(isset($video) && count($video) > 0) {
            echo'<div class="row rowrp" >';
            for($i=0;$i<count($video);$i++) { ?>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="video_img">
                        <a class="video text-decoration-none" data-fancybox="video" data-src="<?=$video[$i]['link_video']?>" title="<?=$video[$i]['ten'.$lang]?>">
                            <img onerror="this.src='<?=THUMBS?>/380x280x2/assets/images/noimage.png';" src="https://img.youtube.com/vi/<?=$func->getYoutube($video[$i]['link_video'])?>/0.jpg" alt="<?=$video[$i]['ten'.$lang]?>"/>
                            <h3 class="video_name "><?=$video[$i]['ten'.$lang]?></h3>
                        </a>
                    </div>
                </div>
            <?php } 
            echo'</div>'; ?>
            <div class="clear"></div>
            <div class="pagination-home"><?=(isset($paging) && $paging != '') ? $paging : ''?></div>
        <?php  } else { ?>
            <div class="alert alert-warning" role="alert">
                <strong><?=dangcapnhat?></strong>
            </div>
        <?php } ?>
    </div>
</div>