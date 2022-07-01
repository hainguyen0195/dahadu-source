<div class="menu call_showin">
    <div class="container">
        <div class="row-menu flex_row">
         <ul class="flex_row " id="main-nav">
            <li><a class="transition <?php if($com=='' || $com=='index') echo 'active'; ?>" href="" title="<?=trangchu?>"><?=trangchu?></a></li>

            <li><a class="transition <?php if($com=='gioi-thieu') echo 'active'; ?>" href="gioi-thieu" title="<?=gioithieu?>"><?=gioithieu?></a></li>

            <li>
                <a class="transition <?php if($com=='san-pham') echo 'active'; ?>" href="san-pham" title="<?= sanpham ?>"><?= sanpham ?></a>
                <?php if(count($splistmenu)) { ?>
                    <ul>
                        <?php for($i=0;$i<count($splistmenu); $i++) {
                            $spcatmenu = $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, id from #_product_cat where id_list = ? and hienthi > 0 order by stt,id desc",array($splistmenu[$i]['id'])); ?>
                            <li>
                                <a class="transition" title="<?=$splistmenu[$i]['ten'.$lang]?>" href="<?=$splistmenu[$i][$sluglang]?>"><?=$splistmenu[$i]['ten'.$lang]?></a>
                                <?php if(count($spcatmenu)>0) { ?>
                                    <ul>
                                        <?php for($j=0;$j<count($spcatmenu);$j++) {
                                            $spitemmenu = $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, id from #_product_item where id_cat = ? and hienthi > 0 order by stt,id desc",array($spcatmenu[$j]['id'])); ?>
                                            <li>
                                                <a class="transition" title="<?=$spcatmenu[$j]['ten'.$lang]?>" href="<?=$spcatmenu[$j][$sluglang]?>"><?=$spcatmenu[$j]['ten'.$lang]?></a>
                                                <?php if(count($spitemmenu)) { ?>
                                                    <ul>
                                                        <?php for($u=0;$u<count($spitemmenu);$u++) {
                                                            $spsubmenu = $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, id from #_product_sub where id_item = ? and hienthi > 0 order by stt,id desc",array($spitemmenu[$u]['id'])); ?>
                                                            <li>
                                                                <a class="transition" title="<?=$spitemmenu[$u]['ten'.$lang]?>" href="<?=$spitemmenu[$u][$sluglang]?>"><?=$spitemmenu[$u]['ten'.$lang]?></a>
                                                                <?php if(count($spsubmenu)) { ?>
                                                                    <ul>
                                                                        <?php for($s=0;$s<count($spsubmenu);$s++) { ?>
                                                                            <li>
                                                                                <a class="transition" title="<?=$spsubmenu[$s]['ten'.$lang]?>" href="<?=$spsubmenu[$s][$sluglang]?>"><?=$spsubmenu[$s]['ten'.$lang]?></a>
                                                                            </li>
                                                                        <?php } ?>
                                                                    </ul>
                                                                <?php } ?>
                                                            </li>
                                                        <?php } ?>
                                                    </ul>
                                                <?php } ?>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } ?>
            </li>

            <li>
                <a class="transition <?php if($com=='dich-vu') echo 'active'; ?>" href="dich-vu" title="<?=dichvu?>"><?=dichvu?></a>
            </li>
            <li>
                <a class="transition <?php if($com=='tuyen-dung') echo 'active'; ?>" href="tuyen-dung" title="<?=tuyendung?>"><?=tuyendung?></a>
            </li>
            <li>
                <a class="transition <?php if($com=='tin-tuc') echo 'active'; ?>" href="tin-tuc" title="<?=tintuc?>"><?=tintuc?></a>
            </li>

            <li><a class="transition <?php if($com=='lien-he') echo 'active'; ?>" href="lien-he" title="<?=lienhe?>"><?=lienhe?></a></li>


        </ul>
        <div class="search">
            <input type="text" id="keyword" placeholder="Tìm kiếm" onkeypress="doEnter(event,'keyword');" value="<?=(isset($tukhoa) && $tukhoa != '') ? $tukhoa : ''?>"/>
            <p onclick="onSearch('keyword');"><i class="fas fa-search"></i></p>
        </div>
    </div>
</div>
</div>