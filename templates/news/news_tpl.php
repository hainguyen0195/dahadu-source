<div class="container">
    <div class="title-main"><span><?=(@$title_cat!='')?$title_cat:@$title_crumb?></span></div>
    <?php if(count($news)>0) {  
     echo'<div class="row rowrp">';
     foreach($news as $k=>$v){ $func->showNews($v,'col-md-6 col-sm-6 col-xs-12'); }
     echo'</div>';
 } else { 
    echo'<div class="alert alert-warning" role="alert">';
    echo'<strong>'.dangcapnhat.'</strong>';
    echo'</div>';
} ?>
<div class="clear"></div>
<div class="pagination-home"><?=(isset($paging) && $paging != '') ? $paging : ''?></div>
</div>