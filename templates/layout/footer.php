<footer>
    <div class="container">
        <div class="row_footer flex">
            <div class="footer1">
                <div class="noidungfooter">
                    <?=htmlspecialchars_decode($footer['noidung'.$lang])?>
                </div>
                <div class="compayname"><?=$setting['ten'.$lang]?></div>
                <div class="info_footer">
                    <p><?=$optsetting['diachi'.$lang]?></p>
                    <p><?=$optsetting['hotline']?></p>
                    <p><?=$optsetting['email']?></p>
                    <p><?=$optsetting['website']?></p>
                </div>
                <div class="mangxahoi_footer flex_row">
                    <?php for($i=0;$i<count($mangxahoi_footer);$i++) { ?>
                    <a href="<?=$mangxahoi_footer[$i]['link']?>" target="_blank"><img src="<?=UPLOAD_PHOTO_L.$mangxahoi_footer[$i]['photo']?>" alt="<?=$mangxahoi_footer[$i]['ten'.$lang]?>"></a>
                    <?php } ?>
                </div>
            </div>
            <div class="footer2">
                <div class="ttft1">Chính sách</div>
                <div class="chinhsach">
                    <?php foreach($cs as $k=>$v){ ?>
                    <a href="<?=$v['tenkhongdau'.$lang]?>" title="<?=$v['ten'.$lang]?>">
                        <?=$v['ten'.$lang]?>
                        </a>
                    <?php } ?>
                </div>
            </div>
            <div class="footer3">
                <div class="ttft1">fanpage facebook</div>
                <?=$addons->setAddons('fanpage-facebook', 'fanpage-facebook', 10);?>
            </div>
        </div>
    </div>
</footer>
<div class="copppy">
        <div class="container">
            <div class="row">
                <div class="coppyright col-xs-6 col-sm-6 col-md-6">
                 Copyright © 2021 MOONSHOP. All Rights Reserved. Design by Dahadu.com
             </div>
             <div class="thongke col-xs-6 col-sm-6 col-md-6">
                <?=dangonline?>: <?=$online?><span>|</span>
                <?=trongthang?>: <?=$counter['month']?><span>|</span>
                <?=tongtruycap?>: <?=$counter['total']?>
            </div>
        </div>
    </div>
</div>
<div id="bandoiframe">
    <?=$addons->setAddons('footer-map', 'footer-map', 10);?>
</div>