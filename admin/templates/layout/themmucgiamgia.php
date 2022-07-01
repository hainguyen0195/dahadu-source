<script type="text/javascript">		
	$(document).ready(function() {
		$('.delete_images_size').click(function(){
			if (confirm('Bạn có muốn xóa size này ko ? ')) {
				var id = $(this).attr('title');
				$.ajax ({
					type: "POST",
					url: "ajax/delete_images_size.php",
					data: {id:id},
					success: function(result) { 
					}
				});
				$(this).parent().parent().slideUp();
			}
			return false;
		});
		$("body").on("click",".delete_images_size_ap",function(){
			$(this).parent().parent().slideUp();
			$(this).parent().parent().remove();
		});
	});
</script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('.clickaddmau').click(function(){
			$('#addmau').append('<div class="flex_row" ><div class="formRow"><label>Nhập số lượng min</label><div class="formRight formRightre" style="width:84%;"><input type="number" name="soluongmin[]" title="Nhập số lượng min" id="soluongmin" class="textcolor_prd_new" autocomplete="off" /></div><div class="clear"></div></div><div class="formRow"><label>Nhập số lượng max</label><div class="formRight formRightre" style="width:84%;"><input type="number" name="soluongmax[]" title="Nhập số lượng max" id="soluongmax" class="textcolor_prd_new" autocomplete="off" /></div><div class="clear"></div></div> <div class="formRow"><label>Phần trăm giảm</label><div class="formRight formRightre" style="width:84%;"><input type="number" name="phantramgiam[]" title="Nhập phần trăm" id="phantramgiam" class="textcolor_prd_new" autocomplete="off" /></div><div class="clear"></div></div></div>');
		});
	});
</script>
<style type="text/css" media="screen">
	.item_size,.item_mau{display: inline-block; margin-right: 10px;position: relative;} .btnthem a{    display: inline-block;padding: 3px 15px;background: #17b1cc;border-radius: 5px;color: #fff;} .btnthem a:hover{background:#1c9cb3;} .ct_color{width: 46px;height:25px;} .item_size, .item_mau {display: inline-block; margin-right: 10px; position: relative; } .item_mau .minicolors {float: left; } .item_mau a {cursor: pointer; }
	.item_mau_show{display: -webkit-flex; display: -moz-flex; display: -ms-flex; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; padding: 10px; margin-bottom: 10px; box-shadow: 0px 0px 3px #ccc; background: #f2f2f2; }
	.delete_images_size{cursor: pointer; }
	.flex_row{display: -webkit-flex; display: -moz-flex; display: -ms-flex; display: flex; align-items: center; justify-content: flex-start; flex-wrap: wrap; }
	.flex_row>.formRow{width: 30%;padding: 5px 5px;}
	.flex_row>.formRow input{display: block; width: 100%; height: calc(2.25rem + 2px); padding: .375rem .75rem; font-size: 1rem; font-weight: 400; line-height: 1.5; color: #495057; background-color: #fff; background-clip: padding-box; border: 1px solid #ced4da; border-radius: .25rem; box-shadow: inset 0 0 0 transparent; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;}
	.delete_images_size i{
		color: red;
	}
 </style>

<div class="formRow">
	<label>Mức giảm </label>
	<div class="formRight">
		<div class="btnthem">
			<a class="clickaddmau" href="javasript:void(0);">Thêm </a>
		</div>
		<div class="clear"></div>
		<div id="addmau"></div>
	</div>
	<div class="clear"></div>
</div>

<?php if(isset($ds_mucgiam) && count($ds_mucgiam)>0){ 
	if($_GET['act'] == 'edit_list'){ ?>
		<div class="formRow">
			<label>Danh sách màu hiện tại</label>
			<div class="formRight">
				<?php for($i=0;$i<count($ds_mucgiam);$i++){ ?>
					<div class="item_mau_show">
						<input type="hidden" class=" minicolors-input" name="id_mucgiam_have[]" value="<?= $ds_mucgiam[$i]['id'] ?>" >
						<div class="flex_row" >
							<div class="formRow">
								<label>Nhập số lượng min</label>
								<div class="formRight formRightre" style="width:84%;">
									<input type="number" name="soluongmin_have[]" title="Nhập số lượng min" id="soluongmin_have" class="textcolor_prd_new conso" autocomplete="off" value="<?= $ds_mucgiam[$i]['soluongmin'] ?>" />
								</div>
								<div class="clear"></div>
							</div> 
							<div class="formRow">
								<label>Nhập số lượng max</label>
								<div class="formRight formRightre" style="width:84%;">
									<input type="number" name="soluongmax_have[]" title="Nhập số lượng max" id="soluongmax_have" class="textcolor_prd_new conso" autocomplete="off" value="<?= $ds_mucgiam[$i]['soluongmax'] ?>" />
								</div>
								<div class="clear"></div>
							</div> 
							<div class="formRow">
								<label>Phần trăm giảm</label>
								<div class="formRight formRightre" style="width:84%;">
									<input type="number" name="phantramgiam_have[]" title="Nhập phần trăm" id="phantramgiam_have" class="textcolor_prd_new conso" autocomplete="off" value="<?= $ds_mucgiam[$i]['phantram'] ?>"/>
								</div>
								<div class="clear"></div>
							</div>
						</div>
						<a class="delete_images_size" title="<?=$ds_mucgiam[$i]['id']?>"><i class="fas fa-trash-alt"></i></a>
					</div>
					<div class="clear"></div>
				<?php } ?>
			</div>
			<div class="clear"></div>
		</div>
	<?php } 
} ?>
