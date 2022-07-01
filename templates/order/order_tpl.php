<div class="container bgwhite">
	<form class="form-cart validation-cart" novalidate method="post" action="" enctype="multipart/form-data">
		<div class="wrap-cart flex_row">

			<div class="bottom-cart thanhtoan_left">
				<div class="section-cart">

					<p class="titletht"><?= thongtingiaohang ?>:</p>
					<div class="information-cart">
						<div class="input-cart input-field">
							<label><?= hoten ?> (<span>*</span>)</label>
							<input type="text" class="form-control" id="ten" name="ten" placeholder="<?= hoten ?>" required value="<?= (isset($_SESSION[$login_member]['ten']) && $_SESSION[$login_member]['ten'] != '') ? htmlspecialchars_decode($_SESSION[$login_member]['ten']) : '' ?>" />
							<div class="invalid-feedback"><?= vuilongnhaphoten ?></div>
						</div>
						<div class="input-double-cart flex_row">
							<div class="input-cart input-field">
								<label><?= sodienthoai ?> (<span>*</span>)</label>
								<input type="number" class="form-control" id="dienthoai" name="dienthoai" placeholder="<?= sodienthoai ?>" required value="<?= (isset($_SESSION[$login_member]['dienthoai']) && $_SESSION[$login_member]['dienthoai'] != '') ? htmlspecialchars_decode($_SESSION[$login_member]['dienthoai']) : '' ?>" />
								<div class="invalid-feedback"><?= vuilongnhapsodienthoai ?></div>
							</div>
							<div class="input-cart input-field">
								<label>E-Mail (<span>*</span>)</label>
								<input type="email" class="form-control" id="email" name="email" placeholder="Email" required value="<?= (isset($_SESSION[$login_member]['email']) && $_SESSION[$login_member]['email'] != '') ? htmlspecialchars_decode($_SESSION[$login_member]['email']) : '' ?>" />
								<div class="invalid-feedback"><?= vuilongnhapdiachiemail ?></div>
							</div>
						</div>
						<div class="input-triple-cart flex_row">
							<div class="input-cart input-field">
								<label><?= tinhthanh ?> (<span>*</span>)</label>
								<select class="select-city-cart custom-select" required id="city" name="city">
									<option value=""><?= tinhthanh ?></option>
									<?php for ($i = 0; $i < count($city); $i++) { ?>
										<option value="<?= $city[$i]['id'] ?>"><?= $city[$i]['ten'] ?></option>
									<?php } ?>
								</select>
								<div class="invalid-feedback"><?= vuilongchontinhthanh ?></div>
							</div>
							<div class="input-cart input-field">
								<label><?= quanhuyen ?> (<span>*</span>)</label>
								<select class="select-district-cart select-district custom-select" required id="district" name="district">
									<option value=""><?= quanhuyen ?></option>
								</select>
								<div class="invalid-feedback"><?= vuilongchonquanhuyen ?></div>
							</div>
							<div class="input-cart input-field">
								<label><?= phuongxa ?> (<span>*</span>)</label>
								<select class="select-wards-cart select-wards custom-select" required id="wards" name="wards">
									<option value=""><?= phuongxa ?></option>
								</select>
								<div class="invalid-feedback"><?= vuilongchonphuongxa ?></div>
							</div>
						</div>
						<div class="input-cart input-field">
							<label><?= diachidonhang ?> (<span>*</span>)</label>
							<textarea required class="form-control" id="diachi" name="diachi" placeholder="<?= diachi_tt ?>" /> <?= (isset($_SESSION[$login_member]['diachi']) && $_SESSION[$login_member]['diachi'] != '') ? htmlspecialchars_decode($_SESSION[$login_member]['diachi']) : '' ?></textarea>
							<div class="invalid-feedback"><?= vuilongnhapdiachi ?></div>
						</div>
						<div class="input-cart input-field">
							<label><?= ghichudonhang ?></label>
							<textarea class="form-control" id="yeucaukhac" name="yeucaukhac" placeholder="<?= ghichudh ?>" /></textarea>
						</div>
					</div>
					<p class="titletht"><?= hinhthucthanhtoan ?>:</p>
					<div class="payment_bg flex">
						<div class="payment_bg_left">
							<?php foreach ($httt as $k => $v) { ?>
								<div class="radio">
									<label>
										<input type="radio" name="payments" id="optionsRadios1" value="<?= $v['id'] ?>" <?= (!$k) ? 'checked' : '' ?>>
										<?= $v['ten' . $lang] ?>
									</label>
								</div>
							<?php } ?>
						</div>
						<div class="desc payment_bg_right">
							<?php foreach ($httt as $k => $v) { ?>
								<div class="desc-payments desc-<?= $v['id'] ?> <?= ($k) ? 'hide' : '' ?>">
									<p><strong><?= $v['ten' . $lang] ?></strong></p>
									<?= str_replace("\n", "<br>", $v['mota' . $lang]) ?>
								</div>
							<?php }	?>
						</div>
					</div>
				</div>
			</div>
			<?php if (isset($_SESSION['cart']) && count($_SESSION['cart'])) { ?>
				<div class="top-cart thanhtoan_right">
					<p class="titletht"><?= giohangcuaban ?>:</p>
					<div class="list-procart">
						<?php $max = count($_SESSION['cart']);
						for ($i = 0; $i < $max; $i++) {
							$pid = $_SESSION['cart'][$i]['productid'];
							$quantity = $_SESSION['cart'][$i]['qty'];
							$mau = ($_SESSION['cart'][$i]['mau']) ? $_SESSION['cart'][$i]['mau'] : 0;
							$size = ($_SESSION['cart'][$i]['size']) ? $_SESSION['cart'][$i]['size'] : 0;

							$code = ($_SESSION['cart'][$i]['code']) ? $_SESSION['cart'][$i]['code'] : '';
							$proinfo = $cart->get_product_info($pid);

							$pro_price = $cart->get_price_new($pid, $size, $mau);

						?>
							<div class="procart procart-<?= $code ?> flex pay_cart">
								<div class="pic-procart pay_cart_left">
									<div class="pay_cart_img">
										<a class="text-decoration-none" href="<?= $proinfo[$sluglang] ?>" target="_blank" title="<?= $proinfo['ten' . $lang] ?>"><img onerror="this.src='<?= THUMBS ?>/85x85x2/assets/images/noimage.png';" src="<?= THUMBS ?>/85x85x1/<?= UPLOAD_PRODUCT_L . $proinfo['photo'] ?>" alt="<?= $proinfo['ten' . $lang] ?>"></a>
									</div>
									<div class="pay_cart_del">
										<a class="del-procart text-decoration-none" data-code="<?= $code ?>">
											<i class="fa fa-times-circle"></i>
											<span><?= xoa ?></span>
										</a>
									</div>
								</div>
								<div class="info-procart pay_cart_center">
									<h3 class="name-procart"><a class="text-decoration-none" href="<?= $proinfo[$sluglang] ?>" target="_blank" title="<?= $proinfo['ten' . $lang] ?>"><?= $proinfo['ten' . $lang] ?></a></h3>
									<div class="properties-procart">
										<?php if ($mau) {
											$maudetail = $d->rawQueryOne("select ten$lang from #_product_mau where type = ? and id = ? limit 0,1", array($proinfo['type'], $mau)); ?>
											<p>Màu: <strong><?= $maudetail['ten' . $lang] ?></strong></p>
										<?php } ?>
										<?php if ($size) {
											$sizedetail = $d->rawQueryOne("select ten$lang from #_product_size where type = ? and id = ? limit 0,1", array($proinfo['type'], $size)); ?>
											<p>Size: <strong><?= $sizedetail['ten' . $lang] ?></strong></p>
										<?php } ?>
									</div>
								</div>
								<div class="pay_cart_right">
									<div class="pay_cart_price_item">
										<span class="giasp-<?= $code ?>"><?= $func->format_money($pro_price) ?></span> <sup>đ</sup>
									</div>
									<div class="quantity-procart product-qty">
										<div class="quantity-counter-procart quantity-counter-procart-<?= $code ?> flex">
											<span class="counter-procart-minus counter-procart">-</span>
											<input type="number" class="quantity-procat" min="1" value="<?= $quantity ?>" data-pid="<?= $pid ?>" data-code="<?= $code ?>" />
											<span class="counter-procart-plus counter-procart">+</span>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="pay_cart_price ">
										<span class="pay_cart_price-<?= $code ?>"><?= $func->format_money($pro_price * $quantity) ?></span> <sup>đ</sup>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
					<div class="money-procart">
						<?php if ($config['order']['ship']) { ?>
							<div class="total-procart flex">
								<p><?= tamtinh ?>:</p>
								<p class="total-price load-price-temp"><?= $func->format_money($cart->get_order_total()) ?></p>
							</div>
						<?php } ?>
						<?php if ($config['order']['ship']) { ?>
							<div class="total-procart flex">
								<p><?= phivanchuyen ?>:</p>
								<p class="total-price load-price-ship">0đ</p>
							</div>
						<?php } ?>
						<div class="total-procart flex">
							<?= tongtien ?>:
							<p class="total-price load-price-total"><?= $func->format_money($cart->get_order_total()) ?></p>
						</div>
						<input type="hidden" class="price-temp" name="price-temp" value="<?= $cart->get_order_total() ?>">
						<input type="hidden" class="price-ship" name="price-ship">
						<input type="hidden" class="price-total" name="price-total" value="<?= $cart->get_order_total() ?>">

						<div class="btndathang_ord flex">
							<a href="san-pham" class="buymore-cart text-decoration-none" title="<?= tieptucmuahang ?>">
								<i class="fa fa-angle-double-left"></i>
								<span><?= tieptucmuahang ?></span>
							</a>
							<input type="submit" class="btn-cart" name="thanhtoan" value="<?= thanhtoan ?> " disabled>
						</div>
					</div>
				</div>
			<?php } else { ?>
				<div class="top-cart thanhtoan_right">
					<p class="titletht"><?= giohangcuaban ?>:</p>
					<div><?= khongtontaisanphamtronggiohang ?></div>
					<div class="btndathang_ord flex">
						<a href="" class="buymore-cart text-decoration-none" title="<?= vetrangchu ?>">
							<i class="fa fa-angle-double-left"></i>
							<span><?= vetrangchu ?></span>
						</a>
					</div>
				</div>
			<?php } ?>
		</div>
	</form>
</div>