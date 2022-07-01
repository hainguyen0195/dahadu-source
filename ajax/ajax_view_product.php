<?php
include "ajax_config.php";


$id = (isset($_POST['id']) && $_POST['id'] > 0) ? htmlspecialchars($_POST['id']) : 0;
$row_detail = $d->rawQueryOne("select type, id, ten$lang, tenkhongdauvi, tenkhongdauen, mota$lang, noidung$lang, masp, luotxem, id_brand, id_mau, id_size, id_list, id_cat, id_item, id_sub, id_tags, photo, options, giakm, giamoi, gia from #_product where id= ? and type = ? and noibat > 0 and hienthi > 0 order by stt,id desc",array($id,'san-pham'));
/* Lấy hình ảnh con */
    $hinhanhsp = $d->rawQuery("select photo from #_gallery where id_photo = ? and com='product' and type = ? and kind='man' and val = ? and hienthi > 0 order by stt,id desc",array($row_detail['id'],'san-pham','san-pham'));


/* Lấy màu */
if($row_detail['id_mau']) $mau = $d->rawQuery("select loaihienthi, photo, mau, id from #_product_mau where type='san-pham' and find_in_set(id,'".$row_detail['id_mau']."') and hienthi > 0 order by stt,id desc");

/* Lấy size */
if($row_detail['id_size']) $size = $d->rawQuery("select id, ten$lang from #_product_size where type='san-pham' and find_in_set(id,'".$row_detail['id_size']."') and hienthi > 0 order by stt,id desc");
?>
<div class="">
    <div class="row rowrp">
        <div class="left-pro-detail col-md-5 col-sm-5 col-xs-12">
            <a id="Zoom-1" class="MagicZoom" data-options="zoomMode: off; hint: off; rightClick: true; selectorTrigger: hover; expandCaption: false; history: false;" href="<?=THUMBS?>/540x540x1/<?=UPLOAD_PRODUCT_L.$row_detail['photo']?>" title="<?=$row_detail['ten'.$lang]?>"><img onerror="this.src='<?=THUMBS?>/540x540x2/assets/images/noimage.png';" src="<?=THUMBS?>/540x540x1/<?=UPLOAD_PRODUCT_L.$row_detail['photo']?>" alt="<?=$row_detail['ten'.$lang]?>"></a>
            <?php if(isset($hinhanhsp)) { if(count($hinhanhsp) > 0) { ?>
                <div class="gallery-thumb-pro">
                    <p class="control-carousel prev-carousel prev-thumb-pro transition"><i class="fas fa-chevron-left"></i></p>
                    <div class="owl-carousel owl-theme owl-thumb-pro">
                        <a class="thumb-pro-detail" data-zoom-id="Zoom-1" href="<?=THUMBS?>/540x540x1/<?=UPLOAD_PRODUCT_L.$row_detail['photo']?>" title="<?=$row_detail['ten'.$lang]?>"><img onerror="this.src='<?=THUMBS?>/540x540x2/assets/images/noimage.png';" src="<?=THUMBS?>/540x540x1/<?=UPLOAD_PRODUCT_L.$row_detail['photo']?>" alt="<?=$row_detail['ten'.$lang]?>"></a>
                        <?php foreach($hinhanhsp as $v) { ?>
                            <a class="thumb-pro-detail" data-zoom-id="Zoom-1" href="<?=THUMBS?>/540x540x1/<?=UPLOAD_PRODUCT_L.$v['photo']?>" title="<?=$row_detail['ten'.$lang]?>">
                                <img onerror="this.src='<?=THUMBS?>/540x540x2/assets/images/noimage.png';" src="<?=THUMBS?>/540x540x1/<?=UPLOAD_PRODUCT_L.$v['photo']?>" alt="<?=$row_detail['ten'.$lang]?>">
                            </a>
                        <?php } ?>
                    </div>
                    <p class="control-carousel next-carousel next-thumb-pro transition"><i class="fas fa-chevron-right"></i></p>
                </div>
            <?php } } ?>
        </div>

        <div class="right-pro-detail  col-md-7 col-sm-7 col-xs-12">
            <p class="title-pro-detail"><?=$row_detail['ten'.$lang]?></p>
            <div class="price-content-pro-detail">
                <?php if($row_detail['giamoi']) { ?>
                    <div class="price-old-pro-detail"><?=$func->format_money($row_detail['gia'])?></div>
                    <span class="price-new-pro-detail"><?=$func->format_money($row_detail['giamoi'])?></span>
                    <?php if($row_detail['giakm']){ ?><span class="price-km-pro-detail">(Tiết kiệm :<?=$row_detail['giakm']?> %)</span><?php } ?>
                <?php } else { ?>
                    <span class="price-new-pro-detail"><?=($row_detail['gia']) ? $func->format_money($row_detail['gia']) : lienhe?></span>
                <?php } ?>
            </div>
            <div class="desc-pro-detail"><?=(isset($row_detail['mota'.$lang]) && $row_detail['mota'.$lang] != '') ? htmlspecialchars_decode($row_detail['mota'.$lang]) : ''?></div>
            <ul class="attr-pro-detail">
             <?php if(isset($row_detail['masp']) && $row_detail['masp'] != ''){ ?>
                <li class="w-clear"> 
                    <label class="attr-label-pro-detail"><?=masp?>:</label>
                    <div class="attr-content-pro-detail masp-attr-content-pro-detail"><?= $row_detail['masp'] ?></div>
                </li>
            <?php } ?>

            <li class="w-clear"> 
                <label class="attr-label-pro-detail"><?=luotxem?>:</label>
                <div class="attr-content-pro-detail"><?=$row_detail['luotxem']?></div>
            </li>
            <li class="w-clear flex_row"> 
                <label class="attr-label-pro-detail d-block"><?=soluong?>:</label>
                <div class="attr-content-pro-detail d-block">
                    <div class="quantity-pro-detail">
                        <span class="quantity-minus-pro-detail btn_c">-</span>
                        <input type="text" class="qty-pro" min="1" value="1" readonly />
                        <span class="quantity-plus-pro-detail btn_c">+</span>
                    </div>
                </div>
            </li>
        </ul>
        <div class="cart-pro-detail">
            <a class="transition addnow addcart text-decoration-none" data-id="<?=$row_detail['id']?>" data-action="addnow"><i class="fas fa-shopping-bag"></i><span>Thêm vào giỏ hàng</span></a>
            <a class="transition buynow addcart text-decoration-none" data-id="<?=$row_detail['id']?>" data-action="buynow"><i class="fas fa-shopping-bag"></i><span>Đặt hàng</span></a>
        </div>
    </div>
</div>
</div>