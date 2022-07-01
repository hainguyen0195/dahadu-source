<?php if(count($slider)) { ?>
    <div class="slider" >
        <div id="jssor_1" >
            <div data-u="loading" class="jssor_1_u_loadding" >
                <div class="jssor_1_u_loadding_div1" ></div>
                <div class="jssor_1_u_loadding_div2" ></div>
            </div>
            <div data-u="slides" class="jssor_1_u_slides" >
                <?php foreach($slider as $k=>$v){?>
                    <div  data-p="112.50" class="jssor_1_u_slides_dvp" >
                        <a target="_blank" href="<?= $v['link'] ?>" title="<?=$v['ten'.$lang]?>"> 
                            <img data-u="image" onerror="this.src='<?=THUMBS?>/1366x500x2/assets/images/noimage.png';" src="<?=UPLOAD_PHOTO_L.$v['photo']?>" alt="<?=$v['ten'.$lang]?>" title="<?=$v['ten'.$lang]?>"/>
                        </a>
                    </div>
                <?php } ?>      
            </div>
            <div data-u="navigator" class="jssorb05"  data-autocenter="1">
                <div data-u="prototype" class="jssorb05_prototype" ></div>
            </div>
            <span data-u="arrowleft" class="jssora12l"  data-autocenter="2"></span>
            <span data-u="arrowright" class="jssora12r"  data-autocenter="2"></span>
        </div>
    </div>
    <?php } ?>