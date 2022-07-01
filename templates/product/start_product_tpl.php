<div id="RatingCmt">
	<h2 class="title-cmt">
		<span><?= $tongluotdanhgia ?></span> Lượt đánh giá <span><?= $row_detail['ten' . $lang] ?></span>
	</h2>
	<div class="body-rating ">
		<div class="head-rating flex">
			<div class="head-rating-left">
				<b>
					<?= $row_detail['rate'] ?> <img src="assets/images/saoto.png" alt="sao" style="width: 32px;height: 32px;">
				</b>
			</div>
			<div class="head-rating-mid rcrt">
				<div class="r">
					<span class="t">5 <i></i></span>
					<div class="bgb">
						<div class="bgb-in" style="width: <?= $nam_sao['phantram'] ?>%"></div>
					</div>
					<span class="c"><strong> <?= $nam_sao['soluot'] ?></strong> <?= danhgia ?></span>
				</div>
				<div class="r">
					<span class="t">4 <i></i></span>
					<div class="bgb">
						<div class="bgb-in" style="width: <?= $bon_sao['phantram'] ?>%"></div>
					</div>
					<span class="c"><strong> <?= $bon_sao['soluot'] ?></strong> <?= danhgia ?></span>
				</div>
				<div class="r">
					<span class="t">3 <i></i></span>
					<div class="bgb">
						<div class="bgb-in" style="width: <?= $ba_sao['phantram'] ?>%"></div>
					</div>
					<span class="c"><strong> <?= $ba_sao['soluot'] ?></strong> <?= danhgia ?></span>
				</div>
				<div class="r">
					<span class="t">2 <i></i></span>
					<div class="bgb">
						<div class="bgb-in" style="width: <?= $hai_sao['phantram'] ?>%"></div>
					</div>
					<span class="c"><strong> <?= $hai_sao['soluot'] ?></strong> <?= danhgia ?></span>
				</div>
				<div class="r">
					<span class="t">1 <i></i></span>
					<div class="bgb">
						<div class="bgb-in" style="width: <?= $mot_sao['phantram'] ?>%"></div>
					</div>
					<span class="c"><strong> <?= $mot_sao['soluot'] ?></strong> <?= danhgia ?></span>
				</div>
			</div>
			<div class="head-rating-right">
				<button class="btn-send"><?= guidanhgia ?></button>
				<button class="btn-remove"><?= huy ?></button>
			</div>
		</div>
		<div class="box-rating">
			<div class="chondanhgia">
				<?= chondanhgia ?> : <span data-score="5" id="rate"></span>
				<div id="target-div-hint" class="hint"></div>
			</div>
			<form method="POST" accept-charset="utf-8" id="form_rating">
				<div class="flex_form_rating">
					<div class="form_rating_left">
						<input type="text" placeholder="<?= nhaphoten ?>" class="form-control" value="<?= (isset($_SESSION[$login_member]['ten']) && $_SESSION[$login_member]['ten'] != '') ? htmlspecialchars_decode($_SESSION[$login_member]['ten']) : '' ?>" id="name-rate" name="name-rate" required />
						<input type="text" placeholder="<?= nhapdienthoai ?>" class="form-control" value="<?= (isset($_SESSION[$login_member]['dienthoai']) && $_SESSION[$login_member]['dienthoai'] != '') ? htmlspecialchars_decode($_SESSION[$login_member]['dienthoai']) : '' ?>" id="dienthoai-rate" name="dienthoai-rate" required />
						<input type="text" placeholder="<?= nhapemail ?>" class="form-control" value="<?= (isset($_SESSION[$login_member]['email']) && $_SESSION[$login_member]['email'] != '') ? htmlspecialchars_decode($_SESSION[$login_member]['email']) : '' ?>" id="email-rate" name="email-rate" required />
					</div>
					<div class="form_rating_mid">
						<textarea class="form-control" name="rate-ct" id="rate-ct" placeholder="<?= nhapdanhgia ?>" rows="5" required></textarea>
					</div>
				</div>
				<input type="hidden" class="check_email" value="" />
				<input type="hidden" class="score_input" name="score_input" value="5" />
				<input type="hidden" class="diem_new_input" name="" value="<?= $diem_new ?>" />
				<input type="hidden" name="sanpham" value="<?= $row_detail['id'] ?>" />
				<button type="button" data-id="<?= $row_detail['id'] ?>"><?= guidanhgia ?></button>
			</form>
		</div>
	</div>
	<div class="ratelist <?php if ($tongluotdanhgia > 5) {
								echo 'ratelistroll';
							} ?>">
		<?php foreach ($result_cmt as $k => $v) {  ?>
			<div class="items-cmt">
				<div class="items-row flex_row">
					<div class="img-cmt"><?= substr($v['hoten'], 0, 1) ?></div>
					<div class="flex flex_cmt">
						<h3><?= $v['hoten'] ?></h3>
						<div class="raty-num">
							<?php for ($i = 0; $i < $v['diem']; $i++) {
								echo '<img alt="1" src="assets/images/star-on-big.png" title="bad">';
							} ?>
						</div>
						<span class="time-cmt"><?= $func->humanTiming($v['ngaytao']) ?></span>
					</div>
				</div>
				<div class="des-cmt">
					<p><?= $v['noidung'] ?></p>
				</div>
			</div>
		<?php } ?>
	</div>
</div>

<div class="loaddingding"></div>