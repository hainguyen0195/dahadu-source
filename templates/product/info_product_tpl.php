<div class="row rowrp">
    <div class="left-pro-detail col-md-5 col-sm-5 col-xs-12">
        <a id="Zoom-1" class="MagicZoom" data-options="zoomMode: off; hint: off; rightClick: true; selectorTrigger: hover; expandCaption: false; history: false;" href="<?= THUMBS ?>/540x540x1/<?= UPLOAD_PRODUCT_L . $row_detail['photo'] ?>" title="<?= $row_detail['ten' . $lang] ?>"><img onerror="this.src='<?= THUMBS ?>/540x540x2/assets/images/noimage.png';" src="<?= THUMBS ?>/540x540x1/<?= UPLOAD_PRODUCT_L . $row_detail['photo'] ?>" alt="<?= $row_detail['ten' . $lang] ?>"></a>
        <?php if ($hinhanhsp) {
            if (count($hinhanhsp) > 0) { ?>
                <div class="gallery-thumb-pro">
                    <p class="control-carousel prev-carousel prev-thumb-pro transition"><i class="fas fa-chevron-left"></i></p>
                    <div class="owl-carousel owl-theme owl-thumb-pro">
                        <a class="thumb-pro-detail" data-zoom-id="Zoom-1" href="<?= THUMBS ?>/540x540x1/<?= UPLOAD_PRODUCT_L . $row_detail['photo'] ?>" title="<?= $row_detail['ten' . $lang] ?>"><img onerror="this.src='<?= THUMBS ?>/540x540x2/assets/images/noimage.png';" src="<?= THUMBS ?>/540x540x1/<?= UPLOAD_PRODUCT_L . $row_detail['photo'] ?>" alt="<?= $row_detail['ten' . $lang] ?>"></a>
                        <?php foreach ($hinhanhsp as $v) { ?>
                            <a class="thumb-pro-detail" data-zoom-id="Zoom-1" href="<?= THUMBS ?>/540x540x1/<?= UPLOAD_PRODUCT_L . $v['photo'] ?>" title="<?= $row_detail['ten' . $lang] ?>">
                                <img onerror="this.src='<?= THUMBS ?>/540x540x2/assets/images/noimage.png';" src="<?= THUMBS ?>/540x540x1/<?= UPLOAD_PRODUCT_L . $v['photo'] ?>" alt="<?= $row_detail['ten' . $lang] ?>">
                            </a>
                        <?php } ?>
                    </div>
                    <p class="control-carousel next-carousel next-thumb-pro transition"><i class="fas fa-chevron-right"></i></p>
                </div>
            <?php }
        } ?>
    </div>

    <div class="right-pro-detail  col-md-7 col-sm-7 col-xs-12">
        <p class="title-pro-detail"><?= $row_detail['ten' . $lang] ?></p>
        <div class="avgrating">
            <div class="rate_p rate_p-title" title="<?= danhgiasao ?>">
                <?php for ($i = 0; $i < 5; $i++) {
                    if ($i < $row_detail['rate']) {
                        echo '<img alt="1" src="assets/images/star-on-big.png" title="' . danhgiasao . '">';
                    } else {
                        echo '<img alt="1" src="assets/images/star-off-big.png" title="' . danhgiasao . '">';
                    }
                } ?>
                <?= $tongluotdanhgia ?> Lượt đánh giá
            </div>
        </div>
        <div class="price-content-pro-detail">
            <?php if (isset($row_detail_size)) {
                $gia_km = 0;
                if ($row_detail_size['gia'] > 0) {
                    $gia_km = round(100 - (($row_detail_size['giaban'] * 100) / $row_detail_size['gia']), 0);
                }
                $func->get_price_detail($row_detail_size['gia'], $row_detail_size['giaban'], $gia_km);
            } else {
                $func->get_price_detail($row_detail['gia'], $row_detail['giamoi'], $row_detail['giakm']);
            } ?>
        </div>
        <?= (isset($row_detail['mota' . $lang]) && $row_detail['mota' . $lang] != '') ? '<div class="desc-pro-detail">' . htmlspecialchars_decode($row_detail['mota' . $lang]) . '</div>' : '' ?>
        <ul class="attr-pro-detail">
            <?php if (isset($row_detail['masp']) && $row_detail['masp'] != '') { ?>
                <li class="w-clear">
                    <label class="attr-label-pro-detail"><?= masp ?>:</label>
                    <div class="attr-content-pro-detail masp-attr-content-pro-detail"><?= $row_detail['masp'] ?></div>
                </li>
            <?php } ?>
            <li class="w-clear">
                <label class="attr-label-pro-detail"><?= luotxem ?>:</label>
                <div class="attr-content-pro-detail"><?= $row_detail['luotxem'] ?></div>
            </li>
            <?php if (isset($mau) && count($mau) > 0) {  ?>
                <li class="w-clear flex_row">
                    <label class="attr-label-pro-detail d-block"><?= mausac ?>:</label>
                    <div class="attr-content-pro-detail d-block">
                        <?php for ($i = 0; $i < count($mau); $i++) { ?>
                            <?php if (isset($mau[$i]['loaihienthi']) && $mau[$i]['loaihienthi'] == 1) { ?>
                                <a class="color-pro-detail text-decoration-none <?= ($i == 0) ? 'active' : '' ?>" data-idpro="<?= $row_detail['id'] ?>">
                                    <input style="background-image: url(<?= UPLOAD_COLOR_L . $mau[$i]['photo'] ?>)" type="radio" value="<?= $mau[$i]['id'] ?>" name="color-pro-detail" <?= ($i == 0) ? 'checked' : '' ?>>
                                </a>
                            <?php } else { ?>
                                <a class="color-pro-detail text-decoration-none <?= ($i == 0) ? 'active' : '' ?>" data-idpro="<?= $row_detail['id'] ?>">
                                    <input style="background-color: #<?= $mau[$i]['mau'] ?>" type="radio" value="<?= $mau[$i]['id'] ?>" name="color-pro-detail" <?= ($i == 0) ? 'checked' : '' ?>>
                                </a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </li>
            <?php } ?>
            <?php if (isset($size) && count($size) > 0) { ?>
                <li class="w-clear flex_row">
                    <label class="attr-label-pro-detail d-block"><?= kichthuoc ?>:</label>
                    <div class="attr-content-pro-detail d-block mrgin5">
                        <?php for ($i = 0; $i < count($size); $i++) { ?>
                            <a class="size-pro-detail text-decoration-none <?= ($i == 0) ? 'active' : '' ?> " data-changeprice="0" data-idpro="<?= $row_detail['id'] ?>">
                                <input type="radio" value="<?= $size[$i]['id'] ?>" name="size-pro-detail" <?= ($i == 0) ? 'checked' : '' ?>>
                                <?= $cart->get_product_size($size[$i]['id']) ?>
                            </a>
                        <?php } ?>
                    </div>
                </li>
            <?php } ?>
            <!-- size màu có giá -> thay đổi app.js NN_FRAMEWORK.Cart() -->
            <?php if (isset($ds_sm) && count($ds_sm) > 0) { ?>
                <li class="w-clear flex_row">
                    <label class="attr-label-pro-detail d-block">Size-Màu:</label>
                    <div class="attr-content-pro-detail d-block mrgin5">
                        <?php for ($i = 0; $i < count($ds_sm); $i++) { ?>
                            <a class="size-pro-detail ds_sm-pro-detail <?= ($i == 0) ? 'active' : '' ?> " data-changeprice="1" data-idpro="<?= $row_detail['id'] ?>" data-size="<?= $ds_sm[$i]['id_size'] ?>" data-color="<?= $ds_sm[$i]['id_mau'] ?>">
                                <input type="radio" value="<?= $ds_sm[$i]['id'] ?>" name="size-pro-detail" <?= ($i == 0) ? 'checked' : '' ?>>
                                <?= $cart->get_product_mau($ds_sm[$i]['id_mau']) ?>
                                <?= $cart->get_product_size($ds_sm[$i]['id_size']) ?>
                            </a>
                        <?php } ?>
                    </div>
                </li>
            <?php } ?>

            <li class="w-clear flex_row">
                <label class="attr-label-pro-detail d-block"><?= soluong ?>:</label>
                <div class="attr-content-pro-detail d-block">
                    <div class="quantity-pro-detail">
                        <span class="quantity-minus-pro-detail">-</span>
                        <input type="text" class="qty-pro" min="1" value="1" readonly />
                        <span class="quantity-plus-pro-detail">+</span>
                    </div>
                </div>
            </li>
        </ul>
        <div class="cart-pro-detail">
            <a class="addnow addcart" data-id="<?= $row_detail['id'] ?>" data-action="addnow" data-tms="<?= (isset($ds_sm) && count($ds_sm) > 0) ? 1 : 2 ?>"><i class="fas fa-shopping-bag"></i><span>Thêm vào giỏ hàng</span></a>
            <a class="buynow addcart" data-id="<?= $row_detail['id'] ?>" data-action="buynow" data-tms="<?= (isset($ds_sm) && count($ds_sm) > 0) ? 1 : 2 ?>"><i class="fas fa-shopping-bag"></i><span>Đặt hàng</span></a>
        </div>
        <div class="social-plugin social-plugin-pro-detail w-clear">
            <div class="addthis_inline_share_toolbox_qj48"></div>
            <div class="zalo-share-button" data-href="<?= $func->getCurrentPageURL() ?>" data-oaid="<?= ($optsetting['oaidzalo'] != '') ? $optsetting['oaidzalo'] : '579745863508352884' ?>" data-layout="1" data-color="blue" data-customize=false></div>
        </div>
    </div>
</div>