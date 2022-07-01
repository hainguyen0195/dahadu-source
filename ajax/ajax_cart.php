<?php
include "ajax_config.php";
$cmd = (isset($_POST['cmd']) && $_POST['cmd'] != '') ? htmlspecialchars($_POST['cmd']) : '';
$id = (isset($_POST['id']) && $_POST['id'] > 0) ? htmlspecialchars($_POST['id']) : 0;
$mau = (isset($_POST['mau']) && $_POST['mau'] > 0) ? htmlspecialchars($_POST['mau']) : 0;
$size = (isset($_POST['size']) && $_POST['size'] > 0) ? htmlspecialchars($_POST['size']) : 0;


$price = number_format($cart->get_price_new($id, $size, $mau));

$quantity = (isset($_POST['quantity']) && $_POST['quantity'] > 0) ? htmlspecialchars($_POST['quantity']) : 1;
$code = (isset($_POST['code']) && $_POST['code'] != '') ? htmlspecialchars($_POST['code']) : '';
$ma = (isset($_POST['ma']) && $_POST['ma'] != '') ? htmlspecialchars($_POST['ma']) : '';
$ship = (isset($_POST['ship']) && $_POST['ship'] > 0) ? htmlspecialchars($_POST['ship']) : 0;
if ($cmd == 'add-cart' && $id > 0) {
	$cart->addtocart($quantity, $id, $mau, $size);
	$max = (isset($_SESSION['cart'])) ? count($_SESSION['cart']) : 0;
	$info_pro = $cart->get_product_info($id);
	$title = $info_pro['ten' . $lang];
	$image = UPLOAD_PRODUCT_L . $info_pro['photo'];
	$url = $info_pro['tenkhongdau' . $lang];
	//$price = number_format($cart->get_price_new($id, $size));
	$allprice = $func->format_money($cart->get_order_total());
	$data = array('max' => $max, 'allprice' => $allprice, 'image' => $image, 'title' => $title, 'url' => $url, 'price' => $price);
	echo json_encode($data);
} else if ($cmd == 'update-cart' && $id > 0 && $code != '') {
	if (isset($_SESSION['cart'])) {
		$max = count($_SESSION['cart']);
		for ($i = 0; $i < $max; $i++) {
			if ($code == $_SESSION['cart'][$i]['code']) {
				if ($quantity) $_SESSION['cart'][$i]['qty'] = $quantity;
				break;
			}
		}
	}

	$proinfo = $cart->get_product_info($id);
	$giamoi = $func->format_money($cart->get_price_new($id, $_SESSION['cart'][$i]['size'], $_SESSION['cart'][$i]['mau']) * $quantity);

	$gg_Text = '';
	$giam = 0;
	$tgiam = '0đ';
	$total = $cart->get_order_total();
	$totalText = $func->format_money($total);
	$totalTextlast = $func->format_money($total);

	$code_g = $cart->check_giamgia($ma);

	$giam = $code_g['giam'];
	$tgiam = $func->format_money($giam);
	$gg_Text = $code_g['thongbao'];

	$totalText = $func->format_money($cart->get_order_total());
	$total = $cart->get_order_total() - $giam;
	$totalTextlast = $func->format_money($total);

	$data = array('giamoi' => $giamoi, 'gg_Text' => $gg_Text, 'giam' => $giam, 'tgiam' => $tgiam, 'total' => $total, 'totalText' => $totalText, 'totalTextlast' => $totalTextlast, 'max' => $max);
	echo json_encode($data);
} else if ($cmd == 'delete-cart' && $code != '') {
	$cart->remove_product($code);
	$max = (isset($_SESSION['cart'])) ? count($_SESSION['cart']) : 0;
	$gg_Text = '';
	$giam = 0;
	$tgiam = '0đ';
	$total = $cart->get_order_total();
	$totalText = $func->format_money($total);
	$totalTextlast = $func->format_money($total);
	$code_g = $cart->check_giamgia($ma);

	$giam = $code_g['giam'];
	$tgiam = $func->format_money($giam);
	$gg_Text = $code_g['thongbao'];

	$totalText = $func->format_money($cart->get_order_total());
	$total = $cart->get_order_total() - $giam;
	$totalTextlast = $func->format_money($total);
	$data = array('gg_Text' => $gg_Text, 'giam' => $giam, 'tgiam' => $tgiam, 'total' => $total, 'totalText' => $totalText, 'totalTextlast' => $totalTextlast, 'max' => $max);
	echo json_encode($data);
} else if ($cmd == 'check-ma') {
	$gg_Text = '';
	$giam = 0;
	$tgiam = '0đ';
	$total = $cart->get_order_total();
	$totalText = $func->format_money($total);
	$totalTextlast = $func->format_money($total);

	$code_g = $cart->check_giamgia($ma);

	$giam = $code_g['giam'];
	$tgiam = $func->format_money($giam);
	$gg_Text = $code_g['thongbao'];

	$totalText = $func->format_money($cart->get_order_total());
	$total = $cart->get_order_total() - $giam;
	$totalTextlast = $func->format_money($total);
	$data = array('gg_Text' => $gg_Text, 'giam' => $giam, 'tgiam' => $tgiam, 'total' => $total, 'totalText' => $totalText, 'totalTextlast' => $totalTextlast);
	echo json_encode($data);
} else if ($cmd == 'ship-cart') {
	$shipData = array();
	$shipPrice = 0;
	$shipText = '0đ';
	$total = 0;
	$totalText = '';
	if ($id) $shipData = $d->rawQueryOne("select gia from #_wards where id = ? limit 0,1", array($id));
	$total = $cart->get_order_total();
	if (isset($shipData['gia']) && $shipData['gia'] > 0) {
		$total += $shipData['gia'];
		$shipText = $func->format_money($shipData['gia']);
	}
	$totalText = $func->format_money($total);
	$shipPrice = (isset($shipData['gia'])) ? $shipData['gia'] : 0;
	$data = array('shipText' => $shipText, 'ship' => $shipPrice, 'totalText' => $totalText, 'total' => $total);
	echo json_encode($data);
} else if ($cmd == 'cancel-order') {
	$detail_order = $d->rawQueryOne("select tinhtrang from #_order where id = ? order by stt,id desc", array($id));
	$kq = 0;
	if (isset($detail_order['tinhtrang']) && $detail_order['tinhtrang'] == 1) {
		$data['tinhtrang'] = 5;
		$d->where('id', $id);
		$d->update('order', $data);
		$kq = 1; // hủy đơn xong 
	}

	echo $kq;
}
