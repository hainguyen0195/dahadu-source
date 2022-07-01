<div class="menu-user">
	<div class="name-account">
		<span>Hi, <?=$_SESSION[$login_member]['username']?></span>
	</div>
	<ul class="info-account" >
		<li>
			<a class="<?php if($action=='thong-tin'){echo'ahere';} ?>" href="account/thong-tin"><i class="fas fa-user"></i> <?=thongtintaikhoan?></a>
		</li>
		<li>
			<a class="<?php if($action=='lich-su-mua-hang'){echo'ahere';} ?>" href="account/lich-su-mua-hang"><i class="fas fa-cart-arrow-down"></i> <?=lichsumuahang?></a>
		</li>
		<li>
			<a class="<?php if($action=='yeu-thich'){echo'ahere';} ?>" href="account/yeu-thich"><i class="far fa-heart"></i> <?=yeuthich?></a>
		</li>
		<li>
			<a class="<?php if($action=='da-xem'){echo'ahere';} ?>" href="account/da-xem"><i class="far fa-eye"></i> <?=daxem?></a>
		</li>
		<li>
			<a class="<?php if($action=='dang-xuat'){echo'ahere';} ?>" href="account/dang-xuat"><i class="fas fa-sign-out-alt"></i> <?=dangxuat?></a>
		</li>
	</ul>
</div>