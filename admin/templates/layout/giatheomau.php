<script type="text/javascript">		
	$(document).ready(function() {
		$('.delete_images_mau').click(function(){
			if (confirm('Bạn có muốn xóa size này ko ? ')) {
				var id = $(this).attr('title');
				$.ajax ({
					type: "POST",
					url: "ajax/delete_images_mau.php",
					data: {id:id},
					success: function(result) { 
					}
				});
				$(this).parent().parent().slideUp();
			}
			return false;
		});
		$("body").on("click",".delete_images_mau_ap",function(){
			$(this).parent().parent().slideUp();
			$(this).parent().parent().remove();
		});
	});
	function load_conso(){
		$('.conso').priceFormat({
			limit: 13,
			prefix: '',
			centsLimit: 0
		});
	}
</script>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		
		$('.clickaddmau').click(function(){
			$('#addmau').append('<div class="formRight item_mau_show"> <div class="size_1"><input type="text" name="textmau_prd[]"  id="textmau_prd" class="textmau_prd_new form-control" placeholder="Nhập tên màu" autocomplete="off" /></div> <div class="size_2"><input type="text" name="gia_mau_prd[]" class="textsize_prd_new conso form-control" autocomplete="off" placeholder="Nhập giá bán" /></div> <div class="size_3"><input type="text" name="giamoi_mau_prd[]" class="textsize_prd_new conso form-control" autocomplete="off" placeholder="Nhập giá mới"/></div><div class="size_4"><a class="delete_images_mau_ap text-danger"><i class="fas fa-trash-alt"></i></a></div> </div> ');
			load_conso();
		});
	});
</script>
<style type="text/css" media="screen">
	.item_mau,.item_mau{display: inline-block; margin-right: 10px;position: relative;} .btnthem a{    display: inline-block;padding: 3px 15px;background: #17b1cc;border-radius: 5px;color: #fff;} .btnthem a:hover{background:#1c9cb3;} .ct_color{width: 46px;height:25px;} .item_mau, .item_mau {display: inline-block; margin-right: 10px; position: relative; } .item_mau .minicolor {float: left; } .item_mau a {cursor: pointer; }
	.item_mau_show{display: -webkit-flex; display: -moz-flex; display: -ms-flex; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; padding: 10px; margin-bottom: 10px; box-shadow: 0px 0px 3px #ccc; background: #f2f2f2; }
	.delete_images_mau{cursor: pointer; }
	.size_1{    width: 20%;}
	.size_2,.size_3{    width: 35%; padding: 0 15px;}
	.size_4{    width: 10%;text-align: right;}
	.size_1 label,.size_2 label,.size_3 label,.size_4 label{
		margin: 0;
	}
</style>
<div class="card card-primary card-outline text-sm">
	<div class="card-header">
		<h3 class="card-title">Thuộc tính màu <?=$config['product'][$type]['title_main']?></h3>
		<div class="card-tools">
			<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
		</div>
	</div>
	<div class="card-body">
		<div class="form-group ">
			<div class="formRight">
				<div class="btnthem">
					<a class="clickaddmau btn btn-sm bg-gradient-primary text-white" href="javasript:void(0);"><i class="fas fa-plus mr-2"></i> Thêm mới</a>
				</div>
				<br>
				<div class="clear"></div>
				<div id="addmau"></div>
			</div>
			<div class="clear"></div>
		</div>
		<?php if(isset($ds_mau) && count($ds_mau)>0){ 
			if($_GET['act'] == 'edit'){ ?>
				<div class="formRow">
					<label>Danh sách màu hiện tại</label>
					<div class="formRight">
						<div class="item_mau_show">
							<div class="size_1"><label> Tên màu </label></div>
							<div class="size_2"><label> Giá bán </label></div>
							<div class="size_3"><label> Giá mới </label></div>
							<div class="size_4"><label> Thao tác </label></div>
						</div>
						<div class="clear"></div>
					</div>
					<div class="formRight">
						<?php for($i=0;$i<count($ds_mau);$i++){ ?>
							<div class="item_mau_show">
								<input type="hidden"  name="id_mau_prd_have[]" value="<?= $ds_mau[$i]['id'] ?>" >
								<div class="size_1">
									<input type="text" name="tenvi_mau_prd_have[]" title="Nhập tên" class=" form-control" value="<?= $ds_mau[$i]['tenvi'] ?>" autocomplete="off" />
								</div>
								<div class="size_2">
									<div class="input-group">
										<input type="text" class="form-control format-price gia_ban" name="gia_mau_prd_have[]"  placeholder="Giá" value="<?= $ds_mau[$i]['gia'] ?>">
										<div class="input-group-append">
											<div class="input-group-text"><strong>VNĐ</strong></div>
										</div>
									</div>
								</div>
								<div class="size_3">
									<div class="input-group">
										<input type="text" class="form-control format-price gia_ban" name="giaban_mau_prd_have[]"  placeholder="Giá" value="<?= $ds_mau[$i]['giaban'] ?>">
										<div class="input-group-append">
											<div class="input-group-text"><strong>VNĐ</strong></div>
										</div>
									</div>
								</div>
								<div class="size_4">
									<a class="delete_images_mau text-danger" title="<?=$ds_mau[$i]['id']?>"><i class="fas fa-trash-alt"></i></a>
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