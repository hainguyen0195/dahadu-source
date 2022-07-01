<?php  
if(!defined('SOURCES')) die("Error");

$slider = $d->rawQuery("select ten$lang, photo, link from #_photo where type = ? and hienthi > 0 order by stt,id desc",array('slide'));
$bannerqc = $d->rawQueryOne("select ten$lang, photo, link, hienthi from #_photo where type = ? and act = ? limit 0,1",array('bannerqc','photo_static'));

$about = $d->rawQueryOne("select ten$lang,mota$lang,photo,info_more from #_static where type = ? limit 0,1",array('gioi-thieu'));
$info_about = (isset($about['info_more']) && $about['info_more'] != '') ? json_decode($about['info_more'],true) : null;

$title_index = $d->rawQueryOne("select info_more from #_static where type = ? limit 0,1",array('text_index'));
$title_ = (isset($title_index['info_more']) && $title_index['info_more'] != '') ? json_decode($title_index['info_more'],true) : null;

$product_list_nb = $d->rawQuery("select ten$lang, tenkhongdauvi,tenkhongdauen , id from #_product_list where type = ? and noibat > 0 and hienthi > 0 order by stt,id desc",array('san-pham'));
$text_product = $d->rawQueryOne("select ten$lang from #_static where type = ? limit 0,1",array('text_product'));
$doitac = $d->rawQuery("select ten$lang, photo, link from #_photo where type = ? and hienthi > 0 order by stt,id desc",array('doitac'));


$pronb = $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, id, photo, giamoi,gia, type ,id_mau,id_size from #_product where type = ? and noibat > 0 and hienthi > 0",array('san-pham'));

$thuvienanh = $d->rawQuery("select ten$lang, tenkhongdauvi,tenkhongdauen,photo from #_product where type = ? and noibat > 0 and hienthi > 0",array('thu-vien-anh'));

$rs_video = $d->rawQuery("select id,link_video,ten$lang from #_photo where noibat > 0 and type = ? and hienthi > 0",array('video'));

$tintuc = $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, mota$lang, ngaytao, id, photo from #_news where type = ? and noibat > 0 and hienthi > 0 order by stt,id desc",array('tin-tuc'));
$tintuc_first= array_shift($tintuc);

/* SEO */
$seoDB = $seo->getSeoDB(0,'setting','capnhat','setting');
$seo->setSeo('h1',$seoDB['title'.$seolang]);
$seo->setSeo('title',$seoDB['title'.$seolang]);
$seo->setSeo('keywords',$seoDB['keywords'.$seolang]);
$seo->setSeo('description',$seoDB['description'.$seolang]);
$seo->setSeo('url',$func->getPageURL());
$img_json_bar = (isset($logo['options']) && $logo['options'] != '') ? json_decode($logo['options'],true) : null;
if($img_json_bar['p'] != $logo['photo'])
{
	$img_json_bar = $func->getImgSize($logo['photo'],UPLOAD_PHOTO_L.$logo['photo']);
	$seo->updateSeoDB(json_encode($img_json_bar),'photo',$logo['id']);
}
$seo->setSeo('photo',$config_base.THUMBS.'/'.$img_json_bar['w'].'x'.$img_json_bar['h'].'x2/'.UPLOAD_PHOTO_L.$logo['photo']);
$seo->setSeo('photo:width',$img_json_bar['w']);
$seo->setSeo('photo:height',$img_json_bar['h']);
$seo->setSeo('photo:type',$img_json_bar['m']);
?>
