<?php
if (!defined('SOURCES')) die("Error");

@$id = htmlspecialchars($_GET['id']);
@$idl = htmlspecialchars($_GET['idl']);
@$idc = htmlspecialchars($_GET['idc']);
@$idi = htmlspecialchars($_GET['idi']);
@$ids = htmlspecialchars($_GET['ids']);
@$idb = htmlspecialchars($_GET['idb']);

$s = (isset($_GET['s']) && $_GET['s'] != '') ? htmlspecialchars($_GET['s']) : '';
$s1 = (isset($_GET['s1']) && $_GET['s1'] > 0) ? htmlspecialchars($_GET['s1']) : '';
$s2 = (isset($_GET['s2']) && $_GET['s2'] > 0) ? htmlspecialchars($_GET['s2']) : '';
$s3 = (isset($_GET['s3']) && $_GET['s3'] > 0) ? htmlspecialchars($_GET['s3']) : '';
$ss = (isset($_GET['ss']) && $_GET['ss'] > 0) ? htmlspecialchars($_GET['ss']) : '';
$sc = (isset($_GET['sc']) && $_GET['sc'] > 0) ? htmlspecialchars($_GET['sc']) : '';


$where_filter = "";
$order_by = "order by stt,id desc";

if (isset($s) && $s != '') {

	switch ($s) {
		case 'thap':
			$order_by = "order by giamoi asc";
			break;
		case 'cao':
			$order_by = "order by giamoi desc";
			break;
		case 'moi':
			$order_by = "order by ngaytao desc";
			break;
		case 'az':
			$order_by = "order by tenvi asc";
			break;
		case 'za':
			$order_by = "order by tenvi desc";
			break;
		default:
	}
}

if (isset($ss) && $ss > 0) {
	$where_filter .= " and id IN (select id_product from #_size_color_price where id_size=" . $ss . " ) ";
}
if (isset($sc) && $sc > 0) {
	$where_filter .=
		" and id IN (select id_product from #_size_color_price where id_mau=" . $sc . " ) ";
}

$select = ' id, ten' . $lang . ' ,tenkhongdauvi, tenkhongdauen , gia,giamoi,giakm ,photo ';
$select_detail = ' type, id, ten' . $lang . ', tenkhongdauvi, tenkhongdauen, mota' . $lang . ', noidung' . $lang . ', masp, luotxem, id_brand, id_mau, id_size, id_list, id_cat, id_item, id_sub, id_tags, photo, options, giakm, giamoi, gia,rate ';
if ($id != '') {
	/* Lấy sản phẩm detail */
	$row_detail = $d->rawQueryOne("select $select_detail from #_product where id = ? and type = ? and hienthi > 0 limit 0,1", array($id, $type));
	// sản phẩm đã xem
	if (array_key_exists($login_member, $_SESSION) && $_SESSION[$login_member]['active'] == true) {
		$if_tv = $d->rawQueryOne("select viewed,id from #_member where id = ? limit 0,1", array($_SESSION[$login_member]['id']));


		if ($if_tv['id'] != '') {

			$ds_viewed[] = array();
			if ($if_tv['viewed']) {
				$ds_viewed = explode(",", $if_tv['viewed']);
			}

			if (in_array($row_detail['id'], $ds_viewed)) {
				//echo 'Đã xem ';
			} else {
				$ds_viewed[] = $row_detail['id'];
				//dd($ds_viewed);
				$data['viewed'] = implode(',', $ds_viewed);

				$d->where('id', $_SESSION[$login_member]['id']);
				$d->update('member', $data);
			}
		}
	}
	/*Đánh giá sao*/

	$rate_cmt = $d->rawQueryOne("select sum(diem) as tongdiem,count(id) as soluot from #_comment where hienthi = 1 and type=? and sanpham=? order by id asc", array('rating', $row_detail['id']));

	$tongluotdanhgia = $rate_cmt['soluot'];


	$result_cmt = $d->rawQuery("select hoten,noidung,diem,ngaytao,id  from #_comment where hienthi = 1 and type= ? and sanpham= ? order by id desc", array('rating', $row_detail['id']));

	$nam_sao['soluot'] = 0;
	$nam_sao['phantram'] = 0;
	$bon_sao['soluot'] = 0;
	$bon_sao['phantram'] = 0;
	$ba_sao['soluot'] = 0;
	$ba_sao['phantram'] = 0;
	$hai_sao['soluot'] = 0;
	$hai_sao['phantram'] = 0;
	$mot_sao['soluot'] = 0;
	$mot_sao['phantram'] = 0;
	if (isset($result_cmt) && count($result_cmt) > 0) {
		foreach ($result_cmt as $k => $v) {
			if ($v['diem'] == 5) {
				$nam_sao['soluot']++;
			}
			if ($v['diem'] == 3) {
				$ba_sao['soluot']++;
			}
			if ($v['diem'] == 4) {
				$bon_sao['soluot']++;
			}
			if ($v['diem'] == 2) {
				$hai_sao['soluot']++;
			}
			if ($v['diem'] == 1) {
				$mot_sao['soluot']++;
			}
		}
		$nam_sao['phantram'] = round($nam_sao['soluot'] / $tongluotdanhgia * 100, 0);
		$bon_sao['phantram'] = round($bon_sao['soluot'] / $tongluotdanhgia * 100, 0);
		$ba_sao['phantram'] = round($ba_sao['soluot'] / $tongluotdanhgia * 100, 0);
		$hai_sao['phantram'] = round($hai_sao['soluot'] / $tongluotdanhgia * 100, 0);
		$mot_sao['phantram'] = round($mot_sao['soluot'] / $tongluotdanhgia * 100, 0);
	}
	/*Đánh giá sao*/

	/* Cập nhật lượt xem */
	$data_luotxem['luotxem'] = $row_detail['luotxem'] + 1;
	$d->where('id', $row_detail['id']);
	$d->update('product', $data_luotxem);

	/* Lấy tags */
	if ($row_detail['id_tags']) $pro_tags = $d->rawQuery("select id, ten$lang, tenkhongdauvi, tenkhongdauen from #_tags where id in (" . $row_detail['id_tags'] . ") and type='" . $type . "'");

	/* Lấy thương hiệu */
	$pro_brand = $d->rawQueryOne("select ten$lang, tenkhongdauvi, tenkhongdauen, id from #_product_brand where id = ? and type = ? and hienthi > 0", array($row_detail['id_brand'], $type));

	/* Lấy màu */
	if ($row_detail['id_mau']) $mau = $d->rawQuery("select loaihienthi, photo, mau, id from #_product_mau where type='" . $type . "' and find_in_set(id,'" . $row_detail['id_mau'] . "') and hienthi > 0 order by stt,id desc");

	/* Lấy size */
	if ($row_detail['id_size']) $size = $d->rawQuery("select id, ten$lang from #_product_size where type='" . $type . "' and find_in_set(id,'" . $row_detail['id_size'] . "') and hienthi > 0 order by stt,id desc");

	// lấy màu sắc size theo giá
	$ds_sm = $d->rawQuery("select * from #_size_color_price where id_product= ? order by id_mau desc ", array($id));
	if (isset($ds_sm) && count($ds_sm) > 0) {
		//$row_detail_size = array_shift($ds_sm);
	}
	/* Lấy cấp 1 */
	$pro_list = $d->rawQueryOne("select id, ten$lang, tenkhongdauvi, tenkhongdauen from #_product_list where id = ? and type = ? and hienthi > 0 limit 0,1", array($row_detail['id_list'], $type));

	/* Lấy cấp 2 */
	$pro_cat = $d->rawQueryOne("select id, ten$lang, tenkhongdauvi, tenkhongdauen from #_product_cat where id = ? and type = ? and hienthi > 0 limit 0,1", array($row_detail['id_cat'], $type));

	/* Lấy cấp 3 */
	$pro_item = $d->rawQueryOne("select id, ten$lang, tenkhongdauvi, tenkhongdauen from #_product_item where id = ? and type = ? and hienthi > 0 limit 0,1", array($row_detail['id_item'], $type));

	/* Lấy cấp 4 */
	$pro_sub = $d->rawQueryOne("select id, ten$lang, tenkhongdauvi, tenkhongdauen from #_product_sub where id = ? and type = ? and hienthi > 0 limit 0,1", array($row_detail['id_sub'], $type));

	/* Lấy hình ảnh con */
	$hinhanhsp = $d->rawQuery("select photo from #_gallery where id_photo = ? and com='product' and type = ? and kind='man' and val = ? and hienthi > 0 order by stt,id desc", array($row_detail['id'], $type, $type));

	/* Lấy sản phẩm cùng loại */
	$where = "";
	$where = "id <> ? and id_list = ? and type = ? and hienthi > 0";
	$params = array($id, $row_detail['id_list'], $type);

	$curPage = $get_page;
	$per_page = $optsetting['paging_product'];
	$startpoint = ($curPage * $per_page) - $per_page;
	$limit = " limit " . $startpoint . "," . $per_page;
	$sql = "select $select from #_product where $where order by stt,id desc $limit";
	$product = $d->rawQuery($sql, $params);
	$sqlNum = "select count(*) as 'num' from #_product where $where order by stt,id desc";
	$count = $d->rawQueryOne($sqlNum, $params);
	$total = $count['num'];
	$url = $func->getCurrentPageURL();
	$paging = $func->pagination($total, $per_page, $curPage, $url);

	/* SEO */
	$seoDB = $seo->getSeoDB($row_detail['id'], 'product', 'man', $row_detail['type']);
	$seo->setSeo('h1', $row_detail['ten' . $lang]);
	if ($seoDB['title' . $seolang] != '') $seo->setSeo('title', $seoDB['title' . $seolang]);
	else $seo->setSeo('title', $row_detail['ten' . $lang]);
	$seo->setSeo('keywords', $seoDB['keywords' . $seolang]);
	$seo->setSeo('description', $seoDB['description' . $seolang]);
	$seo->setSeo('url', $func->getPageURL());
	$img_json_bar = (isset($row_detail['options']) && $row_detail['options'] != '') ? json_decode($row_detail['options'], true) : null;
	if ($img_json_bar['p'] != $row_detail['photo']) {
		$img_json_bar = $func->getImgSize($row_detail['photo'], UPLOAD_PRODUCT_L . $row_detail['photo']);
		$seo->updateSeoDB(json_encode($img_json_bar), 'product', $row_detail['id']);
	}
	$seo->setSeo('photo', $config_base . THUMBS . '/' . $img_json_bar['w'] . 'x' . $img_json_bar['h'] . 'x2/' . UPLOAD_PRODUCT_L . $row_detail['photo']);
	$seo->setSeo('photo:width', $img_json_bar['w']);
	$seo->setSeo('photo:height', $img_json_bar['h']);
	$seo->setSeo('photo:type', $img_json_bar['m']);

	/* breadCrumbs */
	if (isset($title_crumb) && $title_crumb != '') $breadcr->setBreadCrumbs($com, $title_crumb);
	$breadcr->setBreadCrumbs($pro_list[$sluglang], $pro_list['ten' . $lang]);
	$breadcr->setBreadCrumbs($pro_cat[$sluglang], $pro_cat['ten' . $lang]);
	$breadcr->setBreadCrumbs($pro_item[$sluglang], $pro_item['ten' . $lang]);
	$breadcr->setBreadCrumbs($pro_sub[$sluglang], $pro_sub['ten' . $lang]);
	$breadcr->setBreadCrumbs($row_detail[$sluglang], $row_detail['ten' . $lang]);
	$breadcrumbs = $breadcr->getBreadCrumbs();
} else if ($idl != '') {
	/* Lấy cấp 1 detail */
	$pro_list = $d->rawQueryOne("select id, ten$lang, tenkhongdauvi, tenkhongdauen, type, photo, options from #_product_list where id = ? and type = ? limit 0,1", array($idl, $type));

	/* SEO */
	$title_cat = $pro_list['ten' . $lang];
	$seoDB = $seo->getSeoDB($pro_list['id'], 'product', 'man_list', $pro_list['type']);
	$seo->setSeo('h1', $pro_list['ten' . $lang]);
	if ($seoDB['title' . $seolang] != '') $seo->setSeo('title', $seoDB['title' . $seolang]);
	else $seo->setSeo('title', $pro_list['ten' . $lang]);
	$seo->setSeo('keywords', $seoDB['keywords' . $seolang]);
	$seo->setSeo('description', $seoDB['description' . $seolang]);
	$seo->setSeo('url', $func->getPageURL());
	$img_json_bar = (isset($pro_list['options']) && $pro_list['options'] != '') ? json_decode($pro_list['options'], true) : null;
	if ($img_json_bar['p'] != $pro_list['photo']) {
		$img_json_bar = $func->getImgSize($pro_list['photo'], UPLOAD_PRODUCT_L . $pro_list['photo']);
		$seo->updateSeoDB(json_encode($img_json_bar), 'product_list', $pro_list['id']);
	}
	$seo->setSeo('photo', $config_base . THUMBS . '/' . $img_json_bar['w'] . 'x' . $img_json_bar['h'] . 'x2/' . UPLOAD_PRODUCT_L . $pro_list['photo']);
	$seo->setSeo('photo:width', $img_json_bar['w']);
	$seo->setSeo('photo:height', $img_json_bar['h']);
	$seo->setSeo('photo:type', $img_json_bar['m']);

	/* Lấy sản phẩm */
	$where = "";
	$where = "id_list = ? and type = ? and hienthi > 0";
	$params = array($idl, $type);

	$curPage = $get_page;
	$per_page = $optsetting['paging_product'];
	$startpoint = ($curPage * $per_page) - $per_page;
	$limit = " limit " . $startpoint . "," . $per_page;
	$sql = "select $select from #_product where $where $where_filter $order_by $limit";
	$product = $d->rawQuery($sql, $params);
	$sqlNum = "select count(*) as 'num' from #_product where $where $where_filter $order_by";
	$count = $d->rawQueryOne($sqlNum, $params);
	$total = $count['num'];
	$url = $func->getCurrentPageURL();
	$paging = $func->pagination($total, $per_page, $curPage, $url);

	/* breadCrumbs */
	if (isset($title_crumb) && $title_crumb != '') $breadcr->setBreadCrumbs($com, $title_crumb);
	$breadcr->setBreadCrumbs($pro_list[$sluglang], $pro_list['ten' . $lang]);
	$breadcrumbs = $breadcr->getBreadCrumbs();
} else if ($idc != '') {
	/* Lấy cấp 2 detail */
	$pro_cat = $d->rawQueryOne("select id, id_list, ten$lang, tenkhongdauvi, tenkhongdauen, type, photo, options from #_product_cat where id = ? and type = ? limit 0,1", array($idc, $type));

	/* Lấy cấp 1 */
	$pro_list = $d->rawQueryOne("select id, ten$lang, tenkhongdauvi, tenkhongdauen from #_product_list where id = ? and type = ? limit 0,1", array($pro_cat['id_list'], $type));

	/* Lấy sản phẩm */
	$where = "";
	$where = "id_cat = ? and type = ? and hienthi > 0";
	$params = array($idc, $type);

	$curPage = $get_page;
	$per_page = $optsetting['paging_product'];
	$startpoint = ($curPage * $per_page) - $per_page;
	$limit = " limit " . $startpoint . "," . $per_page;
	$sql = "select $select from #_product where $where $where_filter $order_by $limit";
	$product = $d->rawQuery($sql, $params);
	$sqlNum = "select count(*) as 'num' from #_product where $where $where_filter $order_by";
	$count = $d->rawQueryOne($sqlNum, $params);
	$total = $count['num'];
	$url = $func->getCurrentPageURL();
	$paging = $func->pagination($total, $per_page, $curPage, $url);

	/* SEO */
	$title_cat = $pro_cat['ten' . $lang];
	$seoDB = $seo->getSeoDB($pro_cat['id'], 'product', 'man_cat', $pro_cat['type']);
	$seo->setSeo('h1', $pro_cat['ten' . $lang]);
	if ($seoDB['title' . $seolang] != '') $seo->setSeo('title', $seoDB['title' . $seolang]);
	else $seo->setSeo('title', $pro_cat['ten' . $lang]);
	$seo->setSeo('keywords', $seoDB['keywords' . $seolang]);
	$seo->setSeo('description', $seoDB['description' . $seolang]);
	$seo->setSeo('url', $func->getPageURL());
	$img_json_bar = (isset($pro_cat['options']) && $pro_cat['options'] != '') ? json_decode($pro_cat['options'], true) : null;
	if ($img_json_bar['p'] != $pro_cat['photo']) {
		$img_json_bar = $func->getImgSize($pro_cat['photo'], UPLOAD_PRODUCT_L . $pro_cat['photo']);
		$seo->updateSeoDB(json_encode($img_json_bar), 'product_cat', $pro_cat['id']);
	}
	$seo->setSeo('photo', $config_base . THUMBS . '/' . $img_json_bar['w'] . 'x' . $img_json_bar['h'] . 'x2/' . UPLOAD_PRODUCT_L . $pro_cat['photo']);
	$seo->setSeo('photo:width', $img_json_bar['w']);
	$seo->setSeo('photo:height', $img_json_bar['h']);
	$seo->setSeo('photo:type', $img_json_bar['m']);

	/* breadCrumbs */
	if (isset($title_crumb) && $title_crumb != '') $breadcr->setBreadCrumbs($com, $title_crumb);
	$breadcr->setBreadCrumbs($pro_list[$sluglang], $pro_list['ten' . $lang]);
	$breadcr->setBreadCrumbs($pro_cat[$sluglang], $pro_cat['ten' . $lang]);
	$breadcrumbs = $breadcr->getBreadCrumbs();
} else if ($idi != '') {
	/* Lấy cấp 3 detail */
	$pro_item = $d->rawQueryOne("select id, id_list, id_cat, ten$lang, tenkhongdauvi, tenkhongdauen, type, photo, options from #_product_item where id = ? and type = ? limit 0,1", array($idi, $type));

	/* Lấy cấp 1 */
	$pro_list = $d->rawQueryOne("select id, ten$lang, tenkhongdauvi, tenkhongdauen from #_product_list where id = ? and type = ? limit 0,1", array($pro_item['id_list'], $type));

	/* Lấy cấp 2 */
	$pro_cat = $d->rawQueryOne("select id, ten$lang, tenkhongdauvi, tenkhongdauen from #_product_cat where id_list = ? and id = ? and type = ? limit 0,1", array($pro_item['id_list'], $pro_item['id_cat'], $type));

	/* Lấy sản phẩm */
	$where = "";
	$where = "id_item = ? and type = ? and hienthi > 0";
	$params = array($idi, $type);

	$curPage = $get_page;
	$per_page = $optsetting['paging_product'];
	$startpoint = ($curPage * $per_page) - $per_page;
	$limit = " limit " . $startpoint . "," . $per_page;
	$sql = "select $select from #_product where $where $where_filter $order_by $limit";
	$product = $d->rawQuery($sql, $params);
	$sqlNum = "select count(*) as 'num' from #_product where $where $where_filter $order_by";
	$count = $d->rawQueryOne($sqlNum, $params);
	$total = $count['num'];
	$url = $func->getCurrentPageURL();
	$paging = $func->pagination($total, $per_page, $curPage, $url);

	/* SEO */
	$title_cat = $pro_item['ten' . $lang];
	$seoDB = $seo->getSeoDB($pro_item['id'], 'product', 'man_item', $pro_item['type']);
	$seo->setSeo('h1', $pro_item['ten' . $lang]);
	if ($seoDB['title' . $seolang] != '') $seo->setSeo('title', $seoDB['title' . $seolang]);
	else $seo->setSeo('title', $pro_item['ten' . $lang]);
	$seo->setSeo('keywords', $seoDB['keywords' . $seolang]);
	$seo->setSeo('description', $seoDB['description' . $seolang]);
	$seo->setSeo('url', $func->getPageURL());
	$img_json_bar = (isset($pro_item['options']) && $pro_item['options'] != '') ? json_decode($pro_item['options'], true) : null;
	if ($img_json_bar['p'] != $pro_item['photo']) {
		$img_json_bar = $func->getImgSize($pro_item['photo'], UPLOAD_PRODUCT_L . $pro_item['photo']);
		$seo->updateSeoDB(json_encode($img_json_bar), 'product_item', $pro_item['id']);
	}
	$seo->setSeo('photo', $config_base . THUMBS . '/' . $img_json_bar['w'] . 'x' . $img_json_bar['h'] . 'x2/' . UPLOAD_PRODUCT_L . $pro_item['photo']);
	$seo->setSeo('photo:width', $img_json_bar['w']);
	$seo->setSeo('photo:height', $img_json_bar['h']);
	$seo->setSeo('photo:type', $img_json_bar['m']);

	/* breadCrumbs */
	if (isset($title_crumb) && $title_crumb != '') $breadcr->setBreadCrumbs($com, $title_crumb);
	$breadcr->setBreadCrumbs($pro_list[$sluglang], $pro_list['ten' . $lang]);
	$breadcr->setBreadCrumbs($pro_cat[$sluglang], $pro_cat['ten' . $lang]);
	$breadcr->setBreadCrumbs($pro_item[$sluglang], $pro_item['ten' . $lang]);
	$breadcrumbs = $breadcr->getBreadCrumbs();
} else if ($ids != '') {
	/* Lấy cấp 4 */
	$pro_sub = $d->rawQueryOne("select id, id_list, id_cat, id_item, ten$lang, tenkhongdauvi, tenkhongdauen, type, photo, options from #_product_sub where id = ? and type = ? limit 0,1", array($ids, $type));

	/* Lấy cấp 1 */
	$pro_list = $d->rawQueryOne("select id, ten$lang, tenkhongdauvi, tenkhongdauen from #_product_list where id = ? and type = ? limit 0,1", array($pro_sub['id_list'], $type));

	/* Lấy cấp 2 */
	$pro_cat = $d->rawQueryOne("select id, ten$lang, tenkhongdauvi, tenkhongdauen from #_product_cat where id_list = ? and id = ? and type = ? limit 0,1", array($pro_sub['id_list'], $pro_sub['id_cat'], $type));

	/* Lấy cấp 3 */
	$pro_item = $d->rawQueryOne("select id, ten$lang, tenkhongdauvi, tenkhongdauen from #_product_item where id_list = ? and id_cat = ? and id = ? and type = ? limit 0,1", array($pro_sub['id_list'], $pro_sub['id_cat'], $pro_sub['id_item'], $type));

	/* Lấy sản phẩm */
	$where = "";
	$where = "id_sub = ? and type = ? and hienthi > 0";
	$params = array($ids, $type);

	$curPage = $get_page;
	$per_page = $optsetting['paging_product'];
	$startpoint = ($curPage * $per_page) - $per_page;
	$limit = " limit " . $startpoint . "," . $per_page;
	$sql = "select $select from #_product where $where $where_filter $order_by $limit";
	$product = $d->rawQuery($sql, $params);
	$sqlNum = "select count(*) as 'num' from #_product where $where $where_filter $order_by";
	$count = $d->rawQueryOne($sqlNum, $params);
	$total = $count['num'];
	$url = $func->getCurrentPageURL();
	$paging = $func->pagination($total, $per_page, $curPage, $url);

	/* SEO */
	$title_cat = $pro_sub['ten' . $lang];
	$seoDB = $seo->getSeoDB($pro_sub['id'], 'product', 'man_sub', $pro_sub['type']);
	$seo->setSeo('h1', $pro_sub['ten' . $lang]);
	if ($seoDB['title' . $seolang] != '') $seo->setSeo('title', $seoDB['title' . $seolang]);
	else $seo->setSeo('title', $pro_sub['ten' . $lang]);
	$seo->setSeo('keywords', $seoDB['keywords' . $seolang]);
	$seo->setSeo('description', $seoDB['description' . $seolang]);
	$seo->setSeo('url', $func->getPageURL());
	$img_json_bar = (isset($pro_sub['options']) && $pro_sub['options'] != '') ? json_decode($pro_sub['options'], true) : null;
	if ($img_json_bar['p'] != $pro_sub['photo']) {
		$img_json_bar = $func->getImgSize($pro_sub['photo'], UPLOAD_PRODUCT_L . $pro_sub['photo']);
		$seo->updateSeoDB(json_encode($img_json_bar), 'product_sub', $pro_sub['id']);
	}
	$seo->setSeo('photo', $config_base . THUMBS . '/' . $img_json_bar['w'] . 'x' . $img_json_bar['h'] . 'x2/' . UPLOAD_PRODUCT_L . $pro_sub['photo']);
	$seo->setSeo('photo:width', $img_json_bar['w']);
	$seo->setSeo('photo:height', $img_json_bar['h']);
	$seo->setSeo('photo:type', $img_json_bar['m']);

	/* breadCrumbs */
	if (isset($title_crumb) && $title_crumb != '') $breadcr->setBreadCrumbs($com, $title_crumb);
	$breadcr->setBreadCrumbs($pro_list[$sluglang], $pro_list['ten' . $lang]);
	$breadcr->setBreadCrumbs($pro_cat[$sluglang], $pro_cat['ten' . $lang]);
	$breadcr->setBreadCrumbs($pro_item[$sluglang], $pro_item['ten' . $lang]);
	$breadcr->setBreadCrumbs($pro_sub[$sluglang], $pro_sub['ten' . $lang]);
	$breadcrumbs = $breadcr->getBreadCrumbs();
} else if ($idb != '') {
	/* Lấy brand detail */
	$pro_brand = $d->rawQueryOne("select ten$lang, tenkhongdauvi, tenkhongdauen, id, type, photo, options from #_product_brand where id = ? and type = ? limit 0,1", array($idb, $type));

	/* SEO */
	$title_cat = $pro_brand['ten' . $lang];
	$seoDB = $seo->getSeoDB($pro_brand['id'], 'product', 'man_brand', $pro_brand['type']);
	$seo->setSeo('h1', $pro_brand['ten' . $lang]);
	if ($seoDB['title' . $seolang] != '') $seo->setSeo('title', $seoDB['title' . $seolang]);
	else $seo->setSeo('title', $pro_brand['ten' . $lang]);
	$seo->setSeo('keywords', $seoDB['keywords' . $seolang]);
	$seo->setSeo('description', $seoDB['description' . $seolang]);
	$seo->setSeo('url', $func->getPageURL());
	$img_json_bar = (isset($pro_brand['options']) && $pro_brand['options'] != '') ? json_decode($pro_brand['options'], true) : null;
	if ($img_json_bar['p'] != $pro_brand['photo']) {
		$img_json_bar = $func->getImgSize($pro_brand['photo'], UPLOAD_PRODUCT_L . $pro_brand['photo']);
		$seo->updateSeoDB(json_encode($img_json_bar), 'product_brand', $pro_brand['id']);
	}
	$seo->setSeo('photo', $config_base . THUMBS . '/' . $img_json_bar['w'] . 'x' . $img_json_bar['h'] . 'x2/' . UPLOAD_PRODUCT_L . $pro_brand['photo']);
	$seo->setSeo('photo:width', $img_json_bar['w']);
	$seo->setSeo('photo:height', $img_json_bar['h']);
	$seo->setSeo('photo:type', $img_json_bar['m']);

	/* Lấy sản phẩm */
	$where = "";
	$where = "id_brand = ? and type = ? and hienthi > 0";
	$params = array($pro_brand['id'], $type);

	$curPage = $get_page;
	$per_page = $optsetting['paging_product'];
	$startpoint = ($curPage * $per_page) - $per_page;
	$limit = " limit " . $startpoint . "," . $per_page;
	$sql = "select $select from #_product where $where order by stt,id desc $limit";
	$product = $d->rawQuery($sql, $params);
	$sqlNum = "select count(*) as 'num' from #_product where $where order by stt,id desc";
	$count = $d->rawQueryOne($sqlNum, $params);
	$total = $count['num'];
	$url = $func->getCurrentPageURL();
	$paging = $func->pagination($total, $per_page, $curPage, $url);

	/* breadCrumbs */
	$breadcr->setBreadCrumbs($pro_brand[$sluglang], $title_cat);
	$breadcrumbs = $breadcr->getBreadCrumbs();
} else {
	/* SEO */
	$seopage = $d->rawQueryOne("select * from #_seopage where type = ? limit 0,1", array($type));
	$seo->setSeo('h1', $title_crumb);
	if ($seopage['title' . $seolang] != '') $seo->setSeo('title', $seopage['title' . $seolang]);
	else $seo->setSeo('title', $title_crumb);
	$seo->setSeo('keywords', $seopage['keywords' . $seolang]);
	$seo->setSeo('description', $seopage['description' . $seolang]);
	$seo->setSeo('url', $func->getPageURL());
	$img_json_bar = (isset($seopage['options']) && $seopage['options'] != '') ? json_decode($seopage['options'], true) : null;
	if ($img_json_bar['p'] != $seopage['photo']) {
		$img_json_bar = $func->getImgSize($seopage['photo'], UPLOAD_SEOPAGE_L . $seopage['photo']);
		$seo->updateSeoDB(json_encode($img_json_bar), 'seopage', $seopage['id']);
	}
	$seo->setSeo('photo', $config_base . THUMBS . '/' . $img_json_bar['w'] . 'x' . $img_json_bar['h'] . 'x2/' . UPLOAD_SEOPAGE_L . $seopage['photo']);
	$seo->setSeo('photo:width', $img_json_bar['w']);
	$seo->setSeo('photo:height', $img_json_bar['h']);
	$seo->setSeo('photo:type', $img_json_bar['m']);

	/* Lấy tất cả sản phẩm */
	$where = "";
	$where = "type = ? and hienthi > 0";
	$params = array($type);

	$curPage = $get_page;
	$per_page = $optsetting['paging_product'];
	$startpoint = ($curPage * $per_page) - $per_page;
	$limit = " limit " . $startpoint . "," . $per_page;
	$sql = "select $select from #_product where $where $where_filter $order_by $limit";
	$product = $d->rawQuery($sql, $params);
	$sqlNum = "select count(*) as 'num' from #_product where $where $where_filter $order_by";
	$count = $d->rawQueryOne($sqlNum, $params);
	$total = $count['num'];
	$url = $func->getCurrentPageURL();
	$paging = $func->pagination($total, $per_page, $curPage, $url);

	/* breadCrumbs */
	if (isset($title_crumb) && $title_crumb != '') $breadcr->setBreadCrumbs($com, $title_crumb);
	$breadcrumbs = $breadcr->getBreadCrumbs();
}
