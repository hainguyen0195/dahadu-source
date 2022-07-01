<div class="container">
    <?php include TEMPLATE . "product/info_product_tpl.php"; ?>


    <div class="tabs-pro-detail">
        <ul class="ul-tabs-pro-detail w-clear">
            <li class="active transition" data-tabs="info-pro-detail"><?= thongtinsanpham ?></li>
            <li class="transition" data-tabs="commentfb-pro-detail"><?= binhluan ?></li>
            <div class="clearfix"></div>
        </ul>
        <div class="content-tabs-pro-detail info-pro-detail active"><?= (isset($row_detail['noidung' . $lang]) && $row_detail['noidung' . $lang] != '') ? htmlspecialchars_decode($row_detail['noidung' . $lang]) : '' ?></div>
        <div class="content-tabs-pro-detail commentfb-pro-detail">
            <div class="fb-comments" data-href="<?= $func->getCurrentPageURL() ?>" data-numposts="3" data-colorscheme="light" data-width="100%"></div>
        </div>
    </div>
    <?php include TEMPLATE . "product/start_product_tpl.php"; ?>
    <?php if (isset($product) && count($product) > 0) {  ?>
        <div class="title-main"><span><?= sanphamcungloai ?></span></div>
        <div class="content-main w-clear">
            <?php
            echo '<div class="row rowrp" >';
            foreach ($product as $k => $v) {
                $func->showProduct($v, 'col-xs-6 col-sm-4 col-md-3');
            }
            echo '</div>';
            ?>
            <div class="clearfix"></div>
            <div class="pagination-home"><?= (isset($paging) && $paging != '') ? $paging : '' ?></div>
        </div>
    <?php } ?>
</div>