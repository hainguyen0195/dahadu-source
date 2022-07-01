<?php 
$linkMan = "index.php?com=comment&act=man&type=".$type."&p=".$curPage;
$linkAdd = "index.php?com=comment&act=add&type=".$type."&p=".$curPage;
$linkEdit = "index.php?com=comment&act=reply&type=".$type."&p=".$curPage;
$linkDelete = "index.php?com=comment&act=delete&type=".$type."&p=".$curPage;
?>
<!-- Content Header -->
<section class="content-header text-sm">
  <div class="container-fluid">
    <div class="row">
      <ol class="breadcrumb float-sm-left">
        <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
        <li class="breadcrumb-item active">Quản lý Comment đánh giá </li>
      </ol>
    </div>
  </div>
</section>
<!-- Main content -->
<section class="content">
 <div class="card-footer text-sm sticky-top">
  <a class="btn btn-sm bg-gradient-danger text-white" id="delete-all" data-url="<?=$linkDelete?>" title="Xóa tất cả"><i class="far fa-trash-alt mr-2"></i>Xóa tất cả</a>
  <div class="form-inline form-search d-inline-block align-middle ml-3">
    <div class="input-group input-group-sm">
      <input class="form-control form-control-navbar text-sm" type="search" id="keyword" placeholder="Tìm kiếm" aria-label="Tìm kiếm" value="<?=(isset($_GET['keyword'])) ? $_GET['keyword'] : ''?>" onkeypress="doEnter(event,'keyword','<?=$linkMan?>')">
      <div class="input-group-append bg-primary rounded-right">
        <button class="btn btn-navbar text-white" type="button" onclick="onSearch('keyword','<?=$linkMan?>')">
          <i class="fas fa-search"></i>
        </button>
      </div>
    </div>
  </div>
</div>
<div class="card card-primary card-outline text-sm mb-0">
  <div class="card-header">
    <h3 class="card-title card-title-order d-inline-block align-middle float-none">Danh sách comment</h3>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover">
      <thead>
        <tr>
          <th class="align-middle" width="5%">
            <div class="custom-control custom-checkbox my-checkbox">
              <input type="checkbox" class="custom-control-input" id="selectall-checkbox">
              <label for="selectall-checkbox" class="custom-control-label"></label>
            </div>
          </th>
          <th class="align-middle">Sản phẩm</th>
          <th class="align-middle" style="width:15%">Họ tên</th>
          <th class="align-middle">Nội dung</th>
          <th class="align-middle">Ngày comment</th>
          <th class="align-middle text-center">Hiển thị</th>
          <th class="align-middle text-center">Thao tác</th>
        </tr>
      </thead>
      <?php if(empty($items)) { ?>
        <tbody><tr><td colspan="100" class="text-center">Không có dữ liệu</td></tr></tbody>
      <?php } else { ?>
        <tbody>
          <?php for($i=0;$i<count($items);$i++) { ?>
            <tr>
              <td class="align-middle">
                <div class="custom-control custom-checkbox my-checkbox">
                  <input type="checkbox" class="custom-control-input select-checkbox" id="select-checkbox-<?=$items[$i]['id']?>" value="<?=$items[$i]['id']?>">
                  <label for="select-checkbox-<?=$items[$i]['id']?>" class="custom-control-label"></label>
                </div>
              </td>

              <td class="align-middle">
                <?php
                $proinfo = $row = $d->rawQueryOne("select tenvi,tenen,tenkhongdauvi,tenkhongdauen from #_product where id = ? limit 0,1",array($items[$i]['sanpham']));
                ?>  
                <a href="../<?=$proinfo['tenkhongdauvi']?>" target="_blank" <?php if($items[$i]['view']==0){ echo "style='font-weight:bold;'";}?>><?=$proinfo['tenvi']?></a>    
              </td>
              <td class="align-middle">
                <a class="text-primary" href="<?=$linkEdit?>&id=<?=$items[$i]['id']?>" title="<?=$items[$i]['hoten']?>"><?=$items[$i]['hoten']?></a>
                <div class="">
                  <?php for ($j=0; $j < $items[$i]['diem']; $j++) { echo'<img alt="1" src="../assets/images/star-on-big.png" title="bad">'; } ?>
                </div>
              </td>
              <td class="align-middle">
                <span class="text-info"><?=(isset($items[$i]['noidung']) && $items[$i]['noidung'] != '') ? htmlspecialchars_decode($items[$i]['noidung']) : ''?></span>
              </td>
              <td class="align-middle">
                <div class="">
                  <?=$func->humanTiming($items[$i]['ngaytao'])?>
                </div>
              </td>
              <td class="align-middle text-center">
                <div class="custom-control custom-checkbox my-checkbox">
                  <input type="checkbox" class="custom-control-input show-checkbox" id="show-checkbox-hienthi" data-table="comment" data-id="<?=$items[$i]['id']?>" data-loai="hienthi" <?=($items[$i]['hienthi'])?'checked':''?>>
                  <label for="show-checkbox-hienthi" class="custom-control-label"></label>
                </div>
              </td>
              <td class="align-middle text-center text-md text-nowrap">
                <a class="text-primary mr-2" href="<?=$linkEdit?>&id=<?=$items[$i]['id']?>" title="Chỉnh sửa"><i class="fas fa-edit"></i></a>
                <a class="text-danger" id="delete-item" data-url="<?=$linkDelete?>&id=<?=$items[$i]['id']?>" title="Xóa"><i class="fas fa-trash-alt"></i></a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      <?php } ?>
    </table>
  </div>
</div>
<?php if($paging) { ?>
  <div class="card-footer text-sm pb-0">
    <?=$paging?>
  </div>
<?php } ?>
<div class="card-footer text-sm">
  <a class="btn btn-sm bg-gradient-danger text-white" id="delete-all" data-url="<?=$linkDelete?>" title="Xóa tất cả"><i class="far fa-trash-alt mr-2"></i>Xóa tất cả</a>
</div>
</section>