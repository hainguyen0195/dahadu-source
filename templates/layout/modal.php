<div id="loader-wrapper"><div id="wrap"><div id="loader"></div></div></div>
<?php if(isset($popup) && $popup['hienthi'] == 1) { ?>
	<!-- Modal popup -->
	<div class="">
		<div id="fancy-popup" style="max-width: 800px;max-height: 500px;">
			<div style="">
				<a href="<?=$popup['link']?>"><img class="img-responsive" src="<?=UPLOAD_PHOTO_L.$popup['photo']?>" alt="Popup"></a>
			</div>
		</div>
	</div>
	<a class="fancy-popup" href="#fancy-popup"></a>
<?php } ?>
<!-- Modal notify -->
<div class="modal modal-custom fade" id="popup-notify" tabindex="-1" role="dialog" aria-labelledby="popup-notify-label" aria-hidden="true">
	<div class="modal-dialog modal-dialog-top modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title" id="popup-notify-label"><?=thongbao?></h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body"></div>
			<div class="modal-footer justify-content-center">
				<button type="button" class="btn btn-danger" data-dismiss="modal"><?=thoat?></button>
			</div>
		</div>
	</div>
</div>

<!-- Modal cart -->
<div class="modal fade" id="popup-cart" tabindex="-1" role="dialog" aria-labelledby="popup-cart-label" aria-hidden="true">
	<div class="modal-dialog modal-dialog-top modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title" id="popup-cart-label"><?=giohangcuaban?></h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body"></div>
		</div>
	</div>
</div>
<!-- Modal view_product -->
<div class="modal fade" id="popup-view_product" tabindex="-1" role="dialog" aria-labelledby="popup-view_product-label" aria-hidden="true">
	<div class="modal-dialog modal-dialog-top modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title" id="popup-view_product-label">Chi tiết sản phẩm</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body"></div>
		</div>
	</div>
</div>