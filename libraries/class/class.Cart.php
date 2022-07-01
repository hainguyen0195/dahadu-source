<?php
class Cart
{
	private $d;

	function __construct($d)
	{
		$this->d = $d;
	}

	public function get_product_info($pid = 0)
	{
		$row = null;
		if ($pid) {
			$row = $this->d->rawQueryOne("select * from #_product where id = ? limit 0,1", array($pid));
		}
		return $row;
	}

	public function get_price($pid = 0)
	{
		$row = null;
		$gia = 0;
		if ($pid) {
			$row = $this->d->rawQueryOne("select gia,giamoi from #_product where id = ? limit 0,1", array($pid));
		}
		if ($row['giamoi']) {
			$gia = $row['giamoi'];
		} else {
			if ($row['gia']) {
				$gia = $row['gia'];
			}
		}
		return $gia;
	}
	public function get_price_new($pid = 0, $size = 0, $mau = 0)
	{
		$row = null;
		$gia = 0;
		$row_detail_sizecolor = $this->d->rawQueryOne("select * from #_size_color_price where id_product = ? and id_size= ? and id_mau = ? order by stt desc ", array($pid, $size, $mau));

		if ($row_detail_sizecolor['id']) {
			if ($row_detail_sizecolor['giaban']) {
				$gia = $row_detail_sizecolor['giaban'];
			} else {
				if ($row_detail_sizecolor['gia']) {
					$gia = $row_detail_sizecolor['gia'];
				}
			}
		} else {
			$gia = $this->get_price($pid);
		}

		return $gia;
	}
	public function get_ship($id = 0)
	{
		$phiship = 0;
		if ($id) $shipData = $this->d->rawQueryOne("select gia from #_wards where id = ? limit 0,1", array($id));
		if (isset($shipData['gia']) && $shipData['gia'] > 0) {
			$phiship = $shipData['gia'];
		}
		return $phiship;
	}
	public function get_product_mau($mau = 0)
	{
		$str = '';
		if ($mau) {
			$row = $this->d->rawQueryOne("select tenvi from #_product_mau where id = ? limit 0,1", array($mau));
			$str = $row['tenvi'];
		}
		return $str;
	}

	public function get_product_size($size = 0)
	{
		$str = '';
		if ($size) {
			$row = $this->d->rawQueryOne("select tenvi from #_product_size where id = ? limit 0,1", array($size));
			$str = $row['tenvi'];
		}
		return $str;
	}

	public function remove_product($code = '')
	{
		if (isset($_SESSION['cart']) && $code != '') {
			$max = count($_SESSION['cart']);

			for ($i = 0; $i < $max; $i++) {
				if ($code == $_SESSION['cart'][$i]['code']) {
					unset($_SESSION['cart'][$i]);
					break;
				}
			}

			$_SESSION['cart'] = array_values($_SESSION['cart']);
		}
	}
	public function check_giamgia($ma)
	{
		global $login_member;
		$checkma[] = array();

		$check = 'false';
		$giam = 0;
		$thongbao = '';
		$checkma['id_ma'] = '';
		if ($ma) {
			$row = $this->d->rawQueryOne("select * from #_magiamgia where ma = ? limit 0,1", array($ma));
			if (isset($row['ma']) && $row['ma'] != '') {
				$checkma['id_ma'] = $row['id'];
				$giam = $this->get_giam($ma);
				$thongbao = '';
				$check = 'true';
				if (isset($_SESSION[$login_member]['id']) && $_SESSION[$login_member]['id'] > 0) {
					$row_nd = $this->d->rawQueryOne("select count(*) as 'num' from #_user_magiamgia where id_ma = ? and id_user = ? ", array($row['id'], $_SESSION[$login_member]['id']));
					if ($row_nd['num'] > 0) {
						$thongbao = madasudung; // mã đã dùng
						$giam = 0;
						$check = 'false';
					}
				}
				/*kiem tra đơn tối thiểu*/
				if ($this->get_order_total() < $row['toithieu']) {
					$thongbao = donhangcuaban . ' <span style="color: red;">' . chua . '</span> ' . thoadkdeapdungma;
					$check = 'false';
				}
			} else {
				$thongbao = khongtontaima; // mã không tồn tại
			}
		}

		$checkma['thongbao'] = $thongbao;
		$checkma['giam'] = $giam;
		$checkma['check'] = $check;
		return $checkma;
	}

	public function get_giam($ma)
	{
		$giam = 0;
		$row = $this->d->rawQueryOne("select * from #_magiamgia where ma = ? limit 0,1", array($ma));
		if ($row['loaigiam'] == 1) {
			/*Giảm phần trăm*/
			$giam = $this->get_order_total() * $row['giam'] / 100;
		}
		if ($row['loaigiam'] == 2) {
			/*Giảm phần tien*/
			$giam = $row['giam'];
		}
		return $giam;
	}
	public function tongchitieu()
	{
		global  $login_member;
		$tongchitieu = 0;

		$ds_order = $this->d->rawQuery("select tonggia from #_order where id_user = ? order by stt,id desc", array($_SESSION[$login_member]['id']));

		if (isset($ds_order)) {
			foreach ($ds_order as $k => $v) {
				$tongchitieu += $v['tonggia'];
			}
		}

		return $tongchitieu;
	}
	public function get_order_total()
	{
		global $d;
		$sum = 0;

		if (isset($_SESSION['cart'])) {
			$max = count($_SESSION['cart']);

			for ($i = 0; $i < $max; $i++) {
				$pid = $_SESSION['cart'][$i]['productid'];
				$mau = $_SESSION['cart'][$i]['mau'];
				$size = $_SESSION['cart'][$i]['size'];
				$row_detail_sizecolor = $this->d->rawQueryOne("select * from #_size_color_price where id_product = ? and id_size= ? and id_mau = ? order by stt desc ", array($pid, $size, $mau));
				$id_size_mau = ($row_detail_sizecolor['id']) ? ($row_detail_sizecolor['id']) : 0;
				$q = $_SESSION['cart'][$i]['qty'];
				$price = $this->get_price_new($pid, $size, $mau);

				$sum += ($price * $q);
			}
		}

		return $sum;
	}

	public function addtocart($q = 1, $pid = 0, $mau = 0, $size = 0)
	{
		if ($pid < 1 or $q < 1) return;

		$code = md5($pid . $mau . $size);

		if (isset($_SESSION['cart'])) {
			if (!$this->product_exists($code, $q)) {
				$max = count($_SESSION['cart']);
				$_SESSION['cart'][$max]['productid'] = $pid;
				$_SESSION['cart'][$max]['qty'] = $q;
				$_SESSION['cart'][$max]['mau'] = $mau;
				$_SESSION['cart'][$max]['size'] = $size;
				$_SESSION['cart'][$max]['code'] = $code;
			}
		} else {
			$_SESSION['cart'] = array();
			$_SESSION['cart'][0]['productid'] = $pid;
			$_SESSION['cart'][0]['qty'] = $q;
			$_SESSION['cart'][0]['mau'] = $mau;
			$_SESSION['cart'][0]['size'] = $size;
			$_SESSION['cart'][0]['code'] = $code;
		}
	}

	private function product_exists($code = '', $q = 1)
	{
		$flag = 0;

		if (isset($_SESSION['cart']) && $code != '') {
			$q = ($q > 1) ? $q : 1;
			$max = count($_SESSION['cart']);

			for ($i = 0; $i < $max; $i++) {
				if ($code == $_SESSION['cart'][$i]['code']) {
					$_SESSION['cart'][$i]['qty'] += $q;
					$flag = 1;
				}
			}
		}

		return $flag;
	}
}
