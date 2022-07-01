<?php
	$linkMan = "index.php?com=comment&act=man&p=".$curPage;
    $linkSave = "index.php?com=comment&act=save&p=".$curPage;
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
            <button type="submit" class="btn btn-sm bg-gradient-primary" disabled><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?=$linkMan?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
        </div>
         <div class="card card-primary card-outline text-sm">
            <div class="card-header">
                <h3 class="card-title">Thông tin chính</h3>
            </div>
            <div class="card-body row">

            </div>
        </div>
    </form>
</section>



<div class="wrapper">

	<div class="control_frm" style="margin-top:25px;">
		<div class="bc">
			<ul id="breadcrumbs" class="breadcrumbs">
				<li><a href="index.php?com=comment&act=add_list<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Quản lý Comment</span></a></li>
				<li class="current"><a href="#" onclick="return false;">Thêm</a></li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>

	<form name="supplier" id="validate" class="form" action="index.php?com=comment&act=save&curPage=<?=$_REQUEST['curPage']?>" method="post" enctype="multipart/form-data">
		<div class="widget">

			<div class="title chonngonngu">
				<ul>
					<li><a href="vi" class="active tipS validate[required]" title="Chọn tiếng việt "><img src="./images/vi.png" alt="" class="tiengviet" />Tiếng Việt</a></li>

				</ul>
			</div>	
			<?php
			$d->reset();
			$sql="select * from table_product where id='".$item['sanpham']."'";
			$d->query($sql);
			$item_danhmuc1= $d->fetch_array();
			?>  
			<div class="formRow lang_hidden lang_vi active">
				<label>Sản Phẩm :</label>
				<div class="formRight">
					<input type="text" name="ten_vi" title="Nhập tên danh mục" id="ten_vi" class="tipS validate[required]" value="<?=$item_danhmuc1['ten_vi']?>" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow lang_hidden lang_vi active">
				<label>Họ tên :</label>
				<div class="formRight">
					<input type="text" name="hoten" title="Nhập tên danh mục" id="hoten" class="tipS validate[required]" value="<?=$item['hoten']?>" />
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow lang_hidden lang_vi active">
				<label>Lúc :</label>
				<div class="formRight">
					<input type="text" name="ngaytao" title="Nhập tên danh mục" id="ngaytao" class="tipS validate[required]" value="<?=date('d/m/Y - g:i A',$item['ngaytao']);?>" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow lang_hidden lang_vi active">

				<label>Nội Dung</label>
				<div class="formRight">
					<textarea rows="8" id="noidung_vi" name="noidung"><?=$item['noidung']?></textarea>
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow">
				<label>Hiển thị : <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này ! "> </label>
				<div class="formRight">

					<input type="checkbox" name="hienthi" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
					<label>Số thứ tự: </label>
					<input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="stt" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của danh mục, chỉ nhập số">
				</div>
				<div class="clear"></div>
			</div>

		</div>  
	</form>
</div>

