<div class="container">
    <div class="title-main"><span><?= (@$title_cat != '') ? $title_cat : @$title_crumb ?></span></div>

    <div class="searchmadh">
        <input type="text" id="madh" placeholder="<?= madonhang ?>" onkeypress="doEnterOrder(event,'madh');" value="">
        <p onclick="onSearchOrder('madh');"><i class="fas fa-search"></i></p>
    </div>

    <?php if (isset($detail_order) && count($detail_order['id']) > 0) { ?>
        <div class="item_dh">
            <div class="title_lichsu flex_row">
                <span><?= madonhang ?>: <?= $detail_order['madonhang'] ?></span>
                <span><?= ngaydat ?>: <?= date('d/m/Y', $detail_order['ngaytao']) ?></span>
                <i class="fas fa-minus" data-id="<?= $detail_order['id'] ?>"></i>
            </div>

            <?php
            $donhang = $d->rawQuery("select ten,photo,soluong,gia,mau,size,giamoi from #_order_detail where id_order = ? order by id desc", array($detail_order['id']));
            include TEMPLATE . "account/table_donhang_tpl.php"; ?>
            <div class="tinhtiendonhang flex_row">
                <div class="tinhtiendonhang-left">
                    <div class="">
                        <p><?= tamtinh ?>:</p>
                        <span><?= $func->format_money($detail_order['tamtinh']) ?></span>
                    </div>
                    <div class="">
                        <p><?= giam ?>:</p>
                        <span><?= $func->format_money($detail_order['giamgia']) ?></span>
                    </div>
                    <div class="">
                        <?= tongtienthanhtoan ?>:
                        <span><?= $func->format_money($detail_order['tonggia']) ?></span>
                    </div>
                </div>
                <div class="tinhtiendonhang-right">
                    <?php
                    if (isset($detail_order['tinhtrang']) && $detail_order['tinhtrang'] > 0) {
                        $id_tinhtrang = $detail_order['tinhtrang'];
                        $tinhtrang = $d->rawQueryOne("select trangthai$lang from #_status where id = ?", array($id_tinhtrang));
                    }
                    ?>
                    <span><?= $tinhtrang['trangthai' . $lang] ?></span>
                    <div class="btn-xemttdh" data-id="<?= $detail_order['id'] ?>"><i class="far fa-eye"></i> <?= xemthongtingiaohang ?></div>
                </div>
            </div>
            <div class="thongtingiaohang" data-id="<?= $detail_order['id'] ?>">
                <div class="row">
                    <div class="col-xs-12 title-ttgh"><?= thongtingiaohang ?></div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="">
                            <p class="text-green"><?= $detail_order['hoten'] ?></p>
                            <p><?= $detail_order['email'] ?></p>
                            <p><?= $detail_order['dienthoai'] ?></p>
                            <p><?= $detail_order['diachi'] ?></p>
                            <p><?= $detail_order['ghichu'] ?></p>
                            <p><?= $func->get_payments(@$detail_order['httt']) ?></p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="">
                            <p class="text-red"><span><?= hinhthucthanhtoan ?>:</span><?= $func->get_payments($detail_order['httt']) ?></p>
                            <p><span><?= ngaygiaohoa ?>:</span><?= date("d/m/Y", @$detail_order['ngaygiao']) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>