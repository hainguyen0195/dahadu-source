<?php if ($about) { ?>
	<section class="section-about padding">
		<div class="container">
			<div class="flex_row row_about">
				<div class="about_left">
					<div class="about_text1">
						<?= (isset($info_about['text1']) && $info_about['text1'] != '') ? $info_about['text1'] : '' ?>
					</div>
					<div class="about_text2">
						<?= (isset($info_about['text2']) && $info_about['text2'] != '') ? $info_about['text2'] : '' ?>
					</div>
					<div class="about_des">
						<?= (isset($about['mota' . $lang]) && $about['mota' . $lang] != '') ? htmlspecialchars_decode($about['mota' . $lang]) : '' ?>
					</div>
					<div class="about_seemore">
						<a href="gioi-thieu" title="<?= _viewmore ?>"><?= _viewmore ?></a>
					</div>
				</div>
				<div class="about_right">
					<div class="about_img img_">
						<img class="img-responsive" onerror="this.src='<?= THUMBS ?>/580x390x2/assets/images/noimage.png';" src="<?= THUMBS ?>/580x390x1/<?= UPLOAD_NEWS_L . $about['photo'] ?>" alt="image about" />
					</div>
				</div>
			</div>
		</div>
	</section>
<?php } ?>

<?php if (isset($pronb) && count($pronb) > 0) {
	if (count($pronb) > 3) {
		$r_pronb = 'owl-pronb owl-carousel';
		$c_pronb = '';
	} else {
		$r_pronb = 'row';
		$c_pronb = 'col-md-3 col-sm-4 col-xs-6';
	}
	?>
	<section class="section-pronb padding">
		<div class="container">
			<div class="title-main"><span>tiltle-main</span></div>
			<div class="<?= $r_pronb ?>">
				<?php foreach ($pronb as $k => $v) {
					$func->showProduct($v, $c_pronb);
				}  ?>
			</div>
		</div>
	</section>
<?php } ?>
<?php if (isset($product_list_nb)) { ?>
	<section class="section-ajaxslick padding">
		<div class="container">
			<div class="title-main">
				<p>mbsofa</p>
				<span>colecction</span>
			</div>
			<div class="title-list flex_row">
				<span class="btn-list-ajaxslick active" data-id_list="">Tất cả</span>
				<?php foreach ($product_list_nb as $k => $v) { ?>
					<span class=" btn-list-ajaxslick " data-id_list="<?= $v['id'] ?>"><?= $v['ten' . $lang] ?></span>
				<?php } ?>
			</div>
			<div id="show-ajaxslick" data-id_list=""></div>
		</div>
	</section>
<?php } ?>

<section class="section-product padding">
	<div class="container">
		<div class="title-main"><span>Sản phẩm nổi bật phân trang</span></div>
		<div class="paging-product"></div>
	</div>
</section>

<?php if (isset($splistnb) && count($splistnb) > 0) { ?>
	<section class="section-product padding">
		<div class="container">
			<div class="title-main"><span>sản phẩm tab phân trang</span></div>
			<div class="choose_list">
				<span class="choosed" data-id_list="">Tất cả</span>
				<?php foreach ($splistnb as $k => $v) { ?>
					<span data-id_list="<?= $v['id'] ?>"><?= $v['ten' . $lang] ?></span>
				<?php } ?>
			</div>
			<div id="show_padding" data-id_list=""></div>
		</div>
	</section>
<?php } ?>

<?php if (isset($splistnb) && count($splistnb) > 0) { ?>
	<?php foreach ($splistnb as $k => $v) {
		$spcatnb = $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, id from #_product_cat where id_list = ? and noibat > 0 and hienthi > 0 order by stt,id desc", array($v['id']));
		?>
		<section class="section-product padding">
			<div class="container">
				<div class="flex_row row-title">
					<div class="title-product"><span><?= $v['ten' . $lang] ?></span></div>
					<div class="choose_list">
						<span class="choosed" data-list="<?= $v['id'] ?>" data-cat="">Tất cả</span>
						<?php foreach ($spcatnb as $kc => $vc) { ?>
							<span class="<?= ($kc == 0) ? 'choosed' : '' ?>" data-list="<?= $v['id'] ?>" data-cat="<?= $vc['id'] ?>"><?= $vc['ten' . $lang] ?></span>
						<?php } ?>
					</div>
				</div>
				<div class="show_padding show_padding<?= $v['id'] ?>" data-list="<?= $v['id'] ?>" data-cat=""></div>
			</div>
		</section>
	<?php } ?>
<?php } ?>

<?php if (isset($bannerqc['photo'])) { ?>
	<section class="section-bannerqc">
		<a class="" href="<?= $bannerqc['link'] ?>"><img class="img-responsive" onerror="this.src='<?= THUMBS ?>/1366x365x2/assets/images/noimage.png';" src="<?= THUMBS ?>/1366x365x2/<?= UPLOAD_PHOTO_L . $bannerqc['photo'] ?>" /></a>
	</section>
<?php } ?>

<?php if (isset($thuvienanh) && count($thuvienanh) > 0) { ?>
	<section class="section-thuvienanh padding">
		<div class="container">
			<h2 class="title_index"><span>Thư viện ảnh</span></h2>
			<div class="row rowrp">
				<?php foreach ($thuvienanh as $k => $v) {   ?>
					<div class="col-md-3 col-sm-4 col-xs-6">
						<div class="tva_img img_">
							<a href="<?= $v[$sluglang] ?>" title="<?= $v['ten' . $lang] ?>">
								<img onerror="this.src='<?= THUMBS ?>/288x210x2/assets/images/noimage.png';" src="<?= THUMBS ?>/288x210x1/<?= UPLOAD_PRODUCT_L . $v['photo'] ?>" alt="<?= $v['ten' . $lang] ?>" />
							</a>
							<h3 class="tva_name">
								<a href="<?= $v[$sluglang] ?>" title="<?= $v['ten' . $lang] ?>"><?= $v['ten' . $lang] ?></a>
							</h3>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</section>
<?php } ?>

<section class="section-dangkynhantin padding">
	<div class="container">
		<div class="rowdknt">
			<div class="title-form"><span>đăng ký nhận tin</span></div>
			<form class="form-newsletter validation-newsletter-index" novalidate method="post" action="" enctype="multipart/form-data">
				<div class="newsletter-row flex_row">
					<div class="newsletter-col">
						<div class="input_">
							<input type="text" class="form-control" id="ten-newsletter" name="ten-newsletter" required placeholder="Họ và tên" />
							<div class="invalid-feedback"><?= vuilongnhaphoten ?></div>
						</div>
						<div class="input_">
							<input type="text" class="form-control" id="dienthoai-newsletter" name="dienthoai-newsletter" required placeholder="Số điện thoại" />
							<div class="invalid-feedback"><?= vuilongnhapsodienthoai ?></div>
						</div>
					</div>
					<div class="newsletter-col">
						<div class="input_">
							<input type="email" class="form-control" id="email-newsletter" name="email-newsletter" required placeholder="Email" />
							<div class="invalid-feedback"><?= vuilongnhapdiachiemail ?></div>
						</div>
						<div class="input_">
							<textarea class="form-control" id="noidung-newsletter" name="noidung-newsletter" required placeholder="Nội dung" /></textarea>
							<div class="invalid-feedback"><?= vuilongnhapnoidung ?></div>
						</div>
					</div>
				</div>
				<div class="newsletter-button">
					<input type="submit" id="submit-newsletter" name="submit-newsletter" disabled value="Gửi đi">
					<input type="hidden" name="recaptcha_response_newsletter" id="recaptchaResponseNewsletter">
					<input type="hidden" name="type-newsletter" value="dangkynhantin">
				</div>
			</form>
		</div>
	</div>
</section>

<section class="section-media padding">
	<div class="container">
		<div class="row rowrp">
			<div class="col-md-8 col-sm-8 col-xs-12 media_left">
				<h2 class="title_media">Tin tức & sự kiện</h2>
				<div class="flex_row row_news_index">
					<?php if ($tintuc_first) { ?>
						<div class="news_index_left">
							<div class="news_first_box">
								<div class="news_first_img">
									<a href="<?= $tintuc_first[$sluglang] ?>" title="<?= $tintuc_first['ten' . $lang] ?>">
										<img class="img-responsive" onerror="this.src='<?= THUMBS ?>/380x200x2/assets/images/noimage.png';" src="<?= THUMBS ?>/380x200x1/<?= UPLOAD_NEWS_L . $tintuc_first['photo'] ?>" alt="<?= $tintuc_first['ten' . $lang] ?>" />
									</a>
								</div>
								<div class="news_first_name">
									<a href="<?= $tintuc_first[$sluglang] ?>" title="<?= $tintuc_first['ten' . $lang] ?>">
										<?= $tintuc_first['ten' . $lang] ?>
									</a>
								</div>
								<div class="news_first_describe">
									<p><?= $tintuc_first['mota' . $lang] ?></p>
								</div>
								<div class="news_first_sm">
									<a href="<?= $tintuc_first[$sluglang] ?>" title="Xem thêm">
										Xem thêm
									</a>
								</div>
							</div>
						</div>
					<?php } ?>
					<?php if (isset($tintuc) && count($tintuc) > 0) { ?>
						<div class="news_index_right">
							<div class="newshome-scroll">
								<ul>
									<?php foreach ($tintuc as $k => $v) {   ?>
										<li>
											<div class="news_index_box flex_row">
												<div class="news_index_img">
													<a href="<?= $v[$sluglang] ?>" title="<?= $v['ten' . $lang] ?>">
														<img class="img-responsive" onerror="this.src='<?= THUMBS ?>/200x120x2/assets/images/noimage.png';" src="<?= THUMBS ?>/200x120x1/<?= UPLOAD_NEWS_L . $v['photo'] ?>" alt="<?= $v['ten' . $lang] ?>" />
													</a>
												</div>
												<div class="news_index_content ">
													<div class="news_index_name">
														<a href="<?= $v[$sluglang] ?>" title="<?= $v['ten' . $lang] ?>">
															<?= $v['ten' . $lang] ?>
														</a>
													</div>
													<div class="news_index_describe">
														<p><?= $v['mota' . $lang] ?></p>
													</div>
												</div>
											</div>
										</li>
									<?php } ?>
								</ul>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-12 media_right">
				<h2 class="title_media">Video clips</h2>
				<?= $addons->setAddons('video-select', 'video-select', 10); ?>
			</div>
		</div>
	</div>
</section>