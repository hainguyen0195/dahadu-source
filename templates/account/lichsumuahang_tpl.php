<div class="container">
	<div class="flex_row row-users">
		<div class="col-users-left">
			<?php include TEMPLATE . "account/menu_tpl.php"; ?>
		</div>
		<div class="col-users-right">
			<?php
			echo '<div class="title-main"><span>' . $title_crumb . '</span></div>';
			if (isset($ds_order) && count($ds_order) > 0) { ?>
				<div class="thongkedonhang flex_row">
					<div class="">
						<?= tongchitieu ?>
						<span><?= $func->format_money($cart->tongchitieu()) ?></span>
					</div>
					<div class="">
						<?= tongsodonhang ?>
						<span><?= count($ds_order) ?></span>
					</div>
				</div>

				<div class="signup-business-title"><span><?= danhsachdonhang ?></span></div>
				<div class="danhsachdonhang">
					<?php for ($k = 0; $k < count($ds_order); $k++) {
						$donhang = $d->rawQuery("select ten,photo,soluong,gia,mau,size,giamoi,id_size,id_mau from #_order_detail where id_order = ? order by id desc", array($ds_order[$k]['id']));
					?>
						<div class="item_dh">
							<div class="title_lichsu flex_row">
								<span><?= madonhang ?>: <?= $ds_order[$k]['madonhang'] ?> - <?= $ds_order[$k]['id'] ?></span>
								<div class="">
									<span><?= ngaydat ?>: <?= date('d/m/Y', $ds_order[$k]['ngaytao']) ?></span>
									<i class="fas fa-minus-circle btn-andsdh" data-id="<?= $ds_order[$k]['id'] ?>"></i>
								</div>
							</div>
							<div class="cthdsl" data-id="<?= $ds_order[$k]['id'] ?>">
								<?php include TEMPLATE . "account/table_donhang_tpl.php"; ?>
								<div class="tinhtiendonhang flex_row">
									<div class="tinhtiendonhang-left">
										<div class="">
											<p><?= tamtinh ?>:</p>
											<span><?= $func->format_money($ds_order[$k]['tamtinh']) ?></span>
										</div>
										<div class="">
											<p><?= giam ?>:</p>
											<span><?= $func->format_money($ds_order[$k]['giamgia']) ?></span>
										</div>
										<div class="">
											<?= tongtienthanhtoan ?>:
											<span><?= $func->format_money($ds_order[$k]['tonggia']) ?></span>
										</div>
									</div>
									<div class="tinhtiendonhang-right">
										<?php
										if (isset($ds_order[$k]['tinhtrang']) && $ds_order[$k]['tinhtrang'] > 0) {
											$id_tinhtrang = $ds_order[$k]['tinhtrang'];
											$tinhtrang = $d->rawQueryOne("select trangthai$lang from #_status where id = ?", array($id_tinhtrang));
										}
										if (isset($ds_order[$k]['tinhtrang']) && $ds_order[$k]['tinhtrang'] == 1) {
											echo '<a class="btn-huydh" data-id="' . $ds_order[$k]['id'] . '">' . huydon . '</a>';
										}
										?>
										<div class="tinhtiendonhangtt">
											<span data-id="<?= $ds_order[$k]['id'] ?>"><?= $tinhtrang['trangthai' . $lang] ?></span>
										</div>
										<div class="btn-xemttdh" data-id="<?= $ds_order[$k]['id'] ?>"><i class="far fa-eye"></i> <?= xemthongtingiaohang ?></div>
									</div>
								</div>
								<div class="thongtingiaohang" data-id="<?= $ds_order[$k]['id'] ?>">
									<div class="row">
										<div class="col-xs-12 title-ttgh"><?= thongtingiaohang ?></div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="">
												<p class="text-green"><?= $ds_order[$k]['hoten'] ?></p>
												<p><?= $ds_order[$k]['email'] ?></p>
												<p><?= $ds_order[$k]['dienthoai'] ?></p>
												<p><?= $ds_order[$k]['diachi'] ?></p>
												<p><?= $ds_order[$k]['ghichu'] ?></p>
												<p><?= $func->get_payments(@$ds_order[$k]['httt']) ?></p>
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="">
												<p class="text-red"><span><?= hinhthucthanhtoan ?>:</span><?= $func->get_payments($ds_order[$k]['httt']) ?></p>
												<p><span><?= ngaygiaohoa ?>:</span><?= date("d/m/Y", @$ds_order[$k]['ngaygiao']) ?></p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			<?php } else { ?>
				<div class="alert alert-danger"><strong><?= banchuamuasanpham ?></strong></div>
			<?php }  ?>
		</div>
	</div>
</div>