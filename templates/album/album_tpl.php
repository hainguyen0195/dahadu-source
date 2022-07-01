<div class="container">
    <div class="title-main"><span><?=$title_crumb?></span></div>
    <div class="content-main w-clear">
        <?php if(count($product)>0) {
            echo'<div class="row rowrp">';
            for($i=0;$i<count($product);$i++) { ?>
                <div class="col-xs-12 col-sm-6 col-md-4 ">
                    <a class="album_itema" href="<?=$product[$i][$sluglang]?>" title="<?=$product[$i]['ten'.$lang]?>">
                        <p class="pic-album scale-img"><img onerror="this.src='<?=THUMBS?>/480x360x2/assets/images/noimage.png';" src="<?=THUMBS?>/480x360x1/<?=UPLOAD_PRODUCT_L.$product[$i]['photo']?>" alt="<?=$product[$i]['ten'.$lang]?>"/></p>
                        <h3 class="name-album"><?=$product[$i]['ten'.$lang]?></h3>
                    </a>
                </div>
            <?php } 
            echo'</div>';
        } else { ?>
            <div class="alert alert-warning" role="alert">
                <strong><?=dangcapnhat?></strong>
            </div>
        <?php } ?>
        <div class="clear"></div>
        <div class="pagination-home"><?=(isset($paging) && $paging != '') ? $paging : ''?></div>
    </div>
</div>