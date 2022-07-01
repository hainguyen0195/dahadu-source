<div class="container">
    <div class="title-main"><span><?= (@$title_cat != '') ? $title_cat : @$title_crumb ?></span></div>
    <?php include TEMPLATE . "product/filter_product_tpl.php"; ?>
    <div class="content-main ">
        <?php if (isset($product) && count($product) > 0) {
            echo '<div class="row rowrp" >';
            foreach ($product as $k => $v) {
                $func->showProduct($v, 'col-xs-6 col-sm-4 col-md-3');
            }
            echo '</div>'; ?>
            <div class="clear"></div>
            <div class="pagination-home"><?= (isset($paging) && $paging != '') ? $paging : '' ?></div>
        <?php } else { ?>
            <div class="alert alert-warning" role="alert">
                <strong><?= ($com == 'tim-kiem') ? khongtimthayketqua : dangcapnhat ?></strong>
            </div>
        <?php } ?>
    </div>
</div>