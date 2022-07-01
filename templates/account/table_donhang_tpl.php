<?php foreach ($donhang as $k_dh => $v_dh) { ?>
	<div class="infodonhang flex_row">
		<div class="infodonhang-left flex_row">
			<div class="img-dh">
				<img class="img-responsive" onerror="this.src='<?= THUMBS ?>/50x50x2/assets/images/noimage.png';" src="<?= THUMBS ?>/50x50x1/<?= UPLOAD_PRODUCT_L . $v_dh['photo'] ?>" alt="<?= $v_dh['ten'] ?>" />
			</div>
			<div class="ten-sl-dh">
				<h3 class="name_p_cart">
					<?= $v_dh['ten'] ?>
					(<strong>
						<?php if ($v_dh['id_mau']) {
							echo $cart->get_product_mau($v_dh['id_mau']);
						} ?>
					</strong>
					<?= (isset($v_dh['id_mau']) && isset($v_dh['id_size'])) ? '-' : '' ?>
					<strong>
						<?php if ($v_dh['id_size']) {
							echo $cart->get_product_size_new($v_dh['id_size']);
						} ?>
					</strong>)
				</h3>
				<span>x<?= $v_dh['soluong'] ?></span>
			</div>
		</div>
		<div class="infodonhang-right">
			<?= $func->format_money($v_dh['soluong'] * $v_dh['giamoi']) ?>
		</div>
	</div>
<?php } ?>