<div class="seach-ab">
	<div class="container">
		<div class="box-search flex_row">
			<div class="col-search ">
				<input type="text" class="form-control" id="ngaygiaohang" name="ngaygiaohang" placeholder="<?=ngaygiaohang?>"  />
			</div>
			<div class="col-search ">
				<?=$func->get_ajax_category('product', 'list', 'san-pham','Chọn dịp')?>
			</div>
			<div class="col-search ">
				<?= $func->get_ajax_mod('mod_postcode',(isset($mod_postcode) && $mod_postcode != '') ? $mod_postcode : 0 ,'Post code') ?>
			</div>
			<div class="col-search">
				<span class="btn_search">View Gifts</span>
			</div>
		</div>
	</div>
</div>