<?php

$ds_size_s = $d->rawQuery("select ten$lang, id from #_product_size where type = ? and hienthi > 0 order by stt,id desc", array('san-pham'));

$ds_color_s = $d->rawQuery("select ten$lang, id from #_product_mau where type = ? and hienthi > 0 order by stt,id desc", array('san-pham'));

?>
<div class="flex_row row_fiter">
    <input type="hidden" name="com-product" id="com-product" value="<?= (isset($com) && $com >= 0) ? $com : '' ?>">

    <div class="fiter-left">
        <div class="">
            <select name="filter-list" class="form-control select-filter select2" id="filter-list">
                <option value=""><?= loaihoa ?></option>
                <?php foreach ($splistmenu as $k => $v) { ?>
                    <option value="<?= $v['id'] ?>" <?php if (isset($s1) && $s1 > 0  && $s1 == $v['id']) {
                                                        echo 'selected';
                                                    } ?>><?= $v['ten' . $lang] ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="fiter-left">
        <div class="">
            <select name="filter-size" class="form-control select-filter select2" id="filter-size">
                <option value="">Size</option>
                <?php foreach ($ds_size_s as $k => $v) { ?>
                    <option value="<?= $v['id'] ?>" <?php if (isset($ss) && $ss > 0  && $ss == $v['id']) {
                                                        echo 'selected';
                                                    } ?>><?= $v['ten' . $lang] ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="fiter-left">
        <div class="">
            <select name="filter-color" class="form-control select-filter select2" id="filter-color">
                <option value="">Color</option>
                <?php foreach ($ds_color_s as $k => $v) { ?>
                    <option value="<?= $v['id'] ?>" <?php if (isset($sc) && $sc > 0  && $sc == $v['id']) {
                                                        echo 'selected';
                                                    } ?>><?= $v['ten' . $lang] ?></option>
                <?php } ?>
            </select>
        </div>
    </div>

    <div class="fiter-right flex_row">
        <div class="fiter-rightc">
            <select name="sort-product" class="form-control" id="sort-product">
                <option value=""><?= sapxep ?></option>
                <option value="thap" <?php if (isset($s) && $s != ''  && $s == 'thap') {
                                            echo 'selected';
                                        } ?>><?= thapcao ?></option>
                <option value="cao" <?php if (isset($s) && $s != ''  && $s == 'cao') {
                                        echo 'selected';
                                    } ?>><?= caothap ?></option>
                <option value="moi" <?php if (isset($s) && $s != ''  && $s == 'moi') {
                                        echo 'selected';
                                    } ?>><?= moinhat ?></option>
                <option value="az" <?php if (isset($s) && $s != ''  && $s == 'az') {
                                        echo 'selected';
                                    } ?>><?= tuaz ?></option>
                <option value="za" <?php if (isset($s) && $s != ''  && $s == 'za') {
                                        echo 'selected';
                                    } ?>><?= tuza ?></option>
            </select>
        </div>
    </div>