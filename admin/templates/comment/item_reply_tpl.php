<?php
$linkMan = "index.php?com=comment&act=man&type=".$type."&p=".$curPage;
$linkSave = "index.php?com=comment&act=save&type=".$type."&p=".$curPage;
?>
<!-- Content Header -->
<section class="content-header text-sm">
	<div class="container-fluid">
		<div class="row">
			<ol class="breadcrumb float-sm-left">
				<li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
				<li class="breadcrumb-item"><a href="<?=$linkMan?>" title="Quản lý comment">Quản lý comment</a></li>
			</ol>
		</div>
	</div>
</section>
<!-- Main content -->
<section class="content">
	<form class="validation-form" novalidate method="post" action="<?=$linkSave?>" enctype="multipart/form-data">
		<div class="card-footer text-sm sticky-top">
			<a class="btn btn-sm bg-gradient-danger" href="<?=$linkMan?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
		</div>
		<div class="card card-primary card-outline text-sm">
			<div class="card-header">
				<h3 class="card-title">Thông tin chính</h3>
			</div>
			<div class="card-body row">
				<!-- <div class="form-group col-md-12 col-sm-12">
					<div class="comment_list" id="comment_list">
						<div class="items-comment_l clearfix">
							<div class="des-comment_l">
								<div class="flex flex_comment_l">
									<div class="img-comment_l"><?=substr($items['hoten'],0,1)?></div>
									<h3><?= $items['hoten'] ?></h3>
									<div class="raty-num">
										<?php for ($i=0; $i < $items['diem']; $i++) { echo'<img alt="1" src="../assets/images/star-on-big.png" title="bad">'; } ?>
									</div>
								</div>
								<p><?=$items['noidung']?></p>
								<div class="comment_l_ac">
									 <?=$func->humanTiming($items['ngaytao'])?>
								</div>
							</div>	
						</div>
					</div>
				</div> -->
				<div class="form-group col-md-4 col-sm-6">
					<label>Tên:</label>
					<p class="text-primary"><?=@$items['hoten']?></p>
				</div>
				<div class="form-group col-md-4 col-sm-6">
					<label>Email:</label>
					<p class="text-primary"><?=@$items['email']?></p>
				</div>
				<div class="form-group col-md-4 col-sm-6">
					<label>Số điện thoại:</label>
					<p class="text-primary"><?=@$items['dienthoai']?></p>
				</div>
				<div class="form-group col-md-4 col-sm-6">
					<label>Đánh giá:</label>
					<p class="text-primary">
						<?php for ($i=0; $i < $items['diem']; $i++) { echo'<img alt="1" src="../assets/images/star-on-big.png" title="bad">'; } ?>
					</p>
				</div>
				<div class="form-group col-md-8 col-sm-6">
					<label>Nội dung:</label>
					<p class="text-primary"><?=@$items['noidung']?></p>
				</div>
			</div>
		</div>
	</form>
</section>

