<header>
	<div class="topone">
		<div class="container">
			<div class="topone_flex flex_row ">
				<div class="topone_left">
					<marquee scrollamount="5"> <?= $optsetting['slogan' . $lang] ?> </marquee>
				</div>
				<div class="topone_center">
					<p class="email_top"><?= $optsetting['email'] ?></p>
				</div>
				<div class="topone_right">
					<div class="mangxahoi_header flex_row">
						<?php foreach ($mangxahoi_header as $key => $value) { ?>
							<a href="<?= $value['link'] ?>" target="_blank"><img src="<?= UPLOAD_PHOTO_L . $value['photo'] ?>" alt="<?= $value['ten' . $lang] ?>"></a>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="wrap-top call_showin">
		<div class="container">
			<div class='wrap-top-row flex_row'>
				<div class="logo ">
					<div class="effect-run ">
						<a class="logo-header" href=""><img onerror="this.src='<?= THUMBS ?>/150x125x2/assets/images/noimage.png';" src="<?= UPLOAD_PHOTO_L . $logo['photo'] ?>" /></a>
					</div>
				</div>
				<div class="banner">
					<a class="banner-header" href=""><img onerror="this.src='<?= THUMBS ?>/500x125x2/assets/images/noimage.png';" src="<?= UPLOAD_PHOTO_L . $banner['photo'] ?>" /></a>
				</div>
				<div class="wrap-top-right">
					<div class="lang-header">
						<span><?= (isset($lang) && $lang == 'vi') ? vietnam : tienganh ?></span>
						<div class="slideTogglelangheader">
							<a href="ngon-ngu/vi/"><?= vietnam ?><?= (isset($lang) && $lang == 'vi') ? '<i class="fas fa-check"></i>' : '' ?></a>
							<a href="ngon-ngu/en/"><?= tienganh ?><?= (isset($lang) && $lang == 'en') ? '<i class="fas fa-check"></i>' : '' ?></a>
						</div>
					</div>
					<div class="dangky-dangnhap">
						<?php if (array_key_exists($login_member, $_SESSION) && $_SESSION[$login_member]['active'] == true) { ?>
							<div class="user-header">
								<div class="name-account">
									<span>Hi, <?= $_SESSION[$login_member]['ten'] ?></span>
								</div>
								<ul id="info-account" style="display: none;">
									<li>
										<a href="account/thong-tin"><i class="fas fa-user"></i> <?= thongtintaikhoan ?></a>
									</li>
									<li>
										<a href="account/lich-su-mua-hang"><i class="fas fa-cart-arrow-down"></i> <?= lichsumuahang ?></a>
									</li>
									<li>
										<a href="account/yeu-thich"><i class="far fa-heart"></i> <?= yeuthich ?></a>
									</li>
									<li>
										<a href="account/da-xem"><i class="far fa-eye"></i> <?= daxem ?></a>
									</li>
									<li>
										<a href="account/dang-xuat"><i class="fas fa-sign-out-alt"></i> <?= dangxuat ?></a>
									</li>
								</ul>
							</div>
						<?php } else { ?>
							<div class="link-user-header">
								<a href="account/dang-nhap" class="adangnhap">
									<span><?= dangnhap ?></span>
								</a>
								<a href="account/dang-ky" class="adangky">
									<span><?= dangky ?></span>
								</a>
							</div>
						<?php } ?>
					</div>
					<div class="hotline">
						<p>Hotline:<span> <?= $optsetting['hotline'] ?></span><span> <?= $optsetting['dienthoai'] ?></span></p>
					</div>
					<div class="cart-header">
						<a href="gio-hang" title="Xem giỏ hàng">
							<i class="fa fa-shopping-bag" aria-hidden="true"></i>
							<span><?= (isset($_SESSION['cart'])) ? count($_SESSION['cart']) : 0 ?></span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>