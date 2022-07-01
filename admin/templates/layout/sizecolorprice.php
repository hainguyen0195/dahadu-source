<?php
$ds_mau_s = $d->rawQuery("select tenvi, id from #_product_mau where type = ? and hienthi > 0 order by stt,id desc", array('san-pham'));
$ds_size_s = $d->rawQuery("select tenvi, id from #_product_size where type = ? and hienthi > 0 order by stt,id desc", array('san-pham'));
?>
<script type="text/javascript">
	function load_conso() {
		$('.conso').priceFormat({
			limit: 13,
			prefix: '',
			centsLimit: 0
		});
	}
	$(document).ready(function() {
		$('.clickaddsize').click(function() {
			$('#addsize').append('<div class="formRight item_mau_show"><div class="size_1"><select name="name-mau[]" class="form-control select2" ><option>Chọn màu</option><?php foreach ($ds_mau_s as $k => $v) { ?><option value="<?= $v['id'] ?>" ><?= $v['tenvi'] ?></option><?php } ?></select></div><div class="size_1"><select name="name-size[]" class="form-control select2" ><option>Chọn size</option><?php foreach ($ds_size_s as $k => $v) { ?><option value="<?= $v['id'] ?>" ><?= $v['tenvi'] ?></option><?php } ?></select></div><div class="size_2"><input type="text" name="gia_size_prd[]" class="textsize_prd_new conso form-control" autocomplete="off" placeholder="Nhập giá bán" /></div> <div class="size_3"><input type="text" name="giaban_size_prd[]" class="textsize_prd_new conso form-control" autocomplete="off" placeholder="Nhập giá mới"/></div><div class="size_4"><a class="delete_images_size_ap text-danger"><i class="fas fa-trash-alt"></i></a></div> </div> ');
			load_conso();
			$('.select2').select2();
			return false;
		});
		$('.delete_images_size').click(function() {
			if (confirm('Bạn có muốn xóa size này ko ? ')) {
				var id = $(this).attr('title');
				$.ajax({
					type: "POST",
					url: "ajax/delete_images_size.php",
					data: {
						id: id
					},
					success: function(result) {}
				});
				$(this).parent().parent().slideUp();
			}
			return false;
		});
		$("body").on("click", ".delete_images_size_ap", function() {
			$(this).parent().parent().slideUp();
			$(this).parent().parent().remove();
		});
	});
</script>

<style type="text/css" media="screen">
	.item_size,
	.item_mau {
		display: inline-block;
		margin-right: 10px;
		position: relative;
	}

	.btnthem a {
		display: inline-block;
		padding: 3px 15px;
		background: #17b1cc;
		border-radius: 5px;
		color: #fff;
	}

	.btnthem a:hover {
		background: #1c9cb3;
	}

	.ct_color {
		width: 46px;
		height: 25px;
	}

	.item_size,
	.item_mau {
		display: inline-block;
		margin-right: 10px;
		position: relative;
	}

	.item_mau .minicolor {
		float: left;
	}

	.item_mau a {
		cursor: pointer;
	}

	.item_mau_show {
		display: -webkit-flex;
		display: -moz-flex;
		display: -ms-flex;
		display: flex;
		align-items: center;
		justify-content: space-between;
		flex-wrap: wrap;
		padding: 10px;
		margin-bottom: 10px;
		box-shadow: 0px 0px 3px #ccc;
		background: #f2f2f2;
	}

	.delete_images_size {
		cursor: pointer;
	}

	.size_1 {
		width: 20%;
	}

	.size_2,
	.size_3 {
		width: 25%;
		padding: 0 15px;
	}

	.size_4 {
		width: 5%;
		text-align: right;
	}

	.size_1 label,
	.size_2 label,
	.size_3 label,
	.size_4 label {
		margin: 0;
	}
</style>
<div class="card card-primary card-outline text-sm">
	<div class="card-header">
		<h3 class="card-title">Thuộc tính size - color <?= $config['product'][$type]['title_main'] ?></h3>
		<div class="card-tools">
			<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
		</div>
	</div>
	<div class="card-body">
		<div class="form-group ">
			<div class="formRight">
				<div class="btnthem">
					<a class="clickaddsize btn btn-sm bg-gradient-primary text-white" href="javasript:void(0);"><i class="fas fa-plus mr-2"></i> Thêm mới</a>
				</div>
				<br>
				<div class="clear"></div>
				<div id="addsize"></div>
			</div>
			<div class="clear"></div>
		</div>
		<?php if (isset($ds_size) && count($ds_size) > 0) {
			if ($_GET['act'] == 'edit') { ?>
				<div class="formRow">
					<label>Danh sách size hiện tại</label>
					<div class="formRight">
						<div class="item_mau_show">
							<div class="size_1"><label> Tên màu </label></div>
							<div class="size_1"><label> Tên size </label></div>
							<div class="size_2"><label> Giá bán </label></div>
							<div class="size_3"><label> Giá mới </label></div>
							<div class="size_4"><label> Thao tác </label></div>
						</div>
						<div class="clear"></div>
					</div>
					<div class="formRight">
						<?php for ($i = 0; $i < count($ds_size); $i++) { ?>
							<div class="item_mau_show">
								<input type="hidden" name="id_size_prd_have[]" value="<?= $ds_size[$i]['id'] ?>">
								<div class="size_1">
									<select name="name-mau_have[]" class="form-control select2">
										<option>Chọn mau</option>
										<?php foreach ($ds_mau_s as $k => $v) { ?>
											<option value="<?= $v['id'] ?>" <?php if ($v['id'] == $ds_size[$i]['id_mau']) {
																				echo 'selected';
																			} ?>><?= $v['tenvi'] ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="size_1">
									<select name="name-size_have[]" class="form-control select2">
										<option>Chọn size</option>
										<?php foreach ($ds_size_s as $k => $v) { ?>
											<option value="<?= $v['id'] ?>" <?php if ($v['id'] == $ds_size[$i]['id_size']) {
																				echo 'selected';
																			} ?>><?= $v['tenvi'] ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="size_2">
									<div class="input-group">
										<input type="text" class="form-control format-price gia_ban" name="gia_size_prd_have[]" placeholder="Giá" value="<?= $ds_size[$i]['gia'] ?>">
										<div class="input-group-append">
											<div class="input-group-text"><strong>VNĐ</strong></div>
										</div>
									</div>
								</div>
								<div class="size_3">
									<div class="input-group">
										<input type="text" class="form-control format-price gia_ban" name="giaban_size_prd_have[]" placeholder="Giá" value="<?= $ds_size[$i]['giaban'] ?>">
										<div class="input-group-append">
											<div class="input-group-text"><strong>VNĐ</strong></div>
										</div>
									</div>
								</div>

								<div class="size_4">
									<a class="delete_images_size text-danger" title="<?= $ds_size[$i]['id'] ?>"><i class="fas fa-trash-alt"></i></a>
								</div>
							</div>
							<div class="clear"></div>
						<?php } ?>
					</div>
					<div class="clear"></div>
				</div>
		<?php }
		} ?>
	</div>
</div>