<?php	
if(!defined('SOURCES')) die("Error");

/* Kiểm tra active comment */
if(!isset($config['comment']['active']) || $config['comment']['active'] == false) $func->transfer("Trang không tồn tại", "index.php", false);

/* Cấu hình đường dẫn trả về */
$strUrl = "";
$strUrl .= (isset($_REQUEST['tinhtrang'])) ? "&tinhtrang=".htmlspecialchars($_REQUEST['tinhtrang']) : "";
$strUrl .= (isset($_REQUEST['httt'])) ? "&httt=".htmlspecialchars($_REQUEST['httt']) : "";
$strUrl .= (isset($_REQUEST['ngaydat'])) ? "&ngaydat=".htmlspecialchars($_REQUEST['ngaydat']) : "";
$strUrl .= (isset($_REQUEST['khoanggia'])) ? "&khoanggia=".htmlspecialchars($_REQUEST['khoanggia']) : "";
$strUrl .= (isset($_REQUEST['city'])) ? "&city=".htmlspecialchars($_REQUEST['city']) : "";
$strUrl .= (isset($_REQUEST['district'])) ? "&district=".htmlspecialchars($_REQUEST['district']) : "";
$strUrl .= (isset($_REQUEST['wards'])) ? "&wards=".htmlspecialchars($_REQUEST['wards']) : "";
$strUrl .= (isset($_REQUEST['keyword'])) ? "&keyword=".htmlspecialchars($_REQUEST['keyword']) : "";

switch($act){
	case "man":
	get_items();
	$template = "comment/items";
	break;

	case "reply":
	get_item_reply();
	$template = "comment/item_reply";
	break;

	case "delete":
	delete_item();
	break;
	default:
	$template = "404";
}

function get_items(){
	global $d, $func, $strUrl, $curPage, $items, $paging,$type,$page;
	
	$where = "";
	$per_page = 10;
	$startpoint = ($curPage * $per_page) - $per_page;
	$limit = " limit ".$startpoint.",".$per_page;
	$sql = "select * from #_comment where type = ? $where order by stt,id desc $limit";
	$items = $d->rawQuery($sql,array($type));

	$sqlNum = "select count(*) as 'num' from #_comment where type = ? $where order by stt,id desc";
	$count = $d->rawQueryOne($sqlNum,array($type));
	$total = $count['num'];
	$url = "index.php?com=comment&act=man".$strUrl."&type=".$type;
	$paging = $func->pagination($total,$per_page,$curPage,$url);

	$per_page = 10;
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
}

function get_item_reply(){
	global $d, $strUrl, $func, $curPage, $items, $gallery, $type, $com, $act;

	$id = 0;
	if(isset($_GET['id'])) $id = htmlspecialchars($_GET['id']);

	if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=comment&act=man&type=".$type."&p=".$curPage.$strUrl, false);

	$items = $d->rawQueryOne("select * from #_comment where id = ? and type = ? limit 0,1",array($id,$type));

	if(!$items['id']){
		$func->transfer("Dữ liệu không có thực", "index.php?com=comment&act=man&type=".$type."&p=".$curPage.$strUrl, false);
	}else{
		$data_['view'] = 1;
		$d->where('id',$id);
		$d->update('comment',$data_);
	}

}

function get_item(){
	global $d, $strUrl, $func, $curPage, $item, $gallery, $type, $com, $act;

	$id = 0;
	if(isset($_GET['id'])) $id = htmlspecialchars($_GET['id']);

	if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=comment&act=man&type=".$type."&p=".$curPage.$strUrl, false);

	$item = $d->rawQueryOne("select * from #_comment where id = ? and type = ? limit 0,1",array($id,$type));

	if(!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=comment&act=man&type=".$type."&p=".$curPage.$strUrl, false);


}

function save_item(){
	global $d;
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", $_SESSION['links_re']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
		
		//$data['email'] = $_POST['email'];
		//$data['hoten'] = $_POST['hoten'];
		//$data['dienthoai'] = $_POST['dienthoai'];
		//$data['diachi'] = $_POST['diachi'];
		//$data['noidung'] = $_POST['noidung'];
		
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaysua'] = time();
		
		$d->setTable('comment');
		$d->setWhere('id', $id);
		if($d->update($data))
			transfer("Dữ liệu đã được cập nhật", $_SESSION['links_re']);
		else
			transfer("Cập nhật dữ liệu bị lỗi", $_SESSION['links_re']);
	}else{
		
		$data['id_cat'] = $_POST['id_cat'];
		$data['email'] = $_SESSION['login']['email'];
		$data['hoten'] = $_SESSION['login']['ten'];
		$data['dienthoai'] = $_SESSION['login']['dienthoai'];
		$data['diachi'] = $_SESSION['login']['diachi'];
		$data['noidung'] = $_POST['noidung'];
		$data['com'] = $_POST['vitri'];
		$data['quantri'] = $_SESSION['login']['id'];
		$data['gianhang'] = $_SESSION['gianhang'];
		$data['sanpham'] = $_POST['sanpham'];

		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = 1;
		$data['ngaytao'] = time();
		
		$d->setTable('comment');
		if($d->insert($data))
			transfer("Dữ liệu đã được lưu", $_SESSION['links_re']);
		else
			transfer("Lưu dữ liệu bị lỗi", $_SESSION['links_re']);
	}
}
function delete_comment($id_){
	global $d;
	$url = "index.php?com=comment&act=man&type=rating";
	if(isset($id_)){
		$id =  themdau($id_);	

		//xóa hình
		$d->reset();
		$sql = "select id,photo,thumb from #_product_photo where id_product='".$id."'";
		$d->query($sql);
		$photo_lq = $d->result_array();
		if(count($photo_lq)>0){
			for($i=0;$i<count($photo_lq);$i++){
				delete_file(_upload_product.$photo_lq[$i]['photo']);
			}
		}
		$sql = "delete from #_product_photo where id_product='".$id."'";
		$d->query($sql);

		//xóa comment
		$sql = "delete from #_comment where id='".$id."'";
		$d->query($sql);
		if($d->query($sql)){
			//xóa comment con
			$d->reset();
			$sql = "select * from #_comment where id_parent='".$id."'";
			$d->query($sql);
			$comment_con = $d->result_array();
			if(count($comment_con)>0){
				for($i=0;$i<count($comment_con);$i++){
					delete_comment($comment_con[$i]['id']);
				}
			}		
		}
		else{
			transfer("Xóa dữ liệu bị lỗi", $url);
		}
	}
}


function delete_item()
{
	global $d, $strUrl, $func, $curPage, $com, $type;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	if($id)
	{
		$row = $d->rawQueryOne("select id,sanpham from #_comment where id = ? limit 0,1",array($id));

		if($row['id'])
		{
			$id_sp=$row['sanpham'];
			$d->rawQuery("delete from #_comment where id = ?",array($id));
			/*cap nhat lai diem cho san pham*/
			$rate_cmt = $d->rawQueryOne("select sum(diem) as tongdiem,count(id) as soluot from #_comment where hienthi = 1 and type=? and sanpham=? order by id asc",array('rating',$id_sp));
			$diem_new=0;
			if(isset($rate_cmt) && $rate_cmt['soluot']>0){
				$diem_new=round($rate_cmt['tongdiem']/$rate_cmt['soluot'],0);
			}
			$data_['rate'] = $diem_new;
			$d->where('id',$id_sp);
			$d->update('product',$data_);
			/*cap nhat lai diem cho san pham*/
			$func->transfer("Xóa dữ liệu thành công", "index.php?com=comment&act=man&type=".$type."&p=".$curPage);
		}
		else $func->transfer("Xóa dữ liệu bị lỗi", "index.php?com=comment&act=man&type=".$type."&p=".$curPage, false);
	}
	elseif(isset($_GET['listid']))
	{
		$listid = explode(",",$_GET['listid']);

		for($i=0;$i<count($listid);$i++)
		{
			$id = htmlspecialchars($listid[$i]);
			$row = $d->rawQueryOne("select id,sanpham from #_comment where id = ? limit 0,1",array($id));
			if($row['id'])
			{
				$id_sp=$row['sanpham'];
				$d->rawQuery("delete from #_comment where id = ?",array($id));
				/*cap nhat lai diem cho san pham*/
				$rate_cmt = $d->rawQueryOne("select sum(diem) as tongdiem,count(id) as soluot from #_comment where hienthi = 1 and type=? and sanpham=? order by id asc",array('rating',$id_sp));
				$diem_new=0;
				if(isset($rate_cmt) && $rate_cmt['soluot']>0){
					$diem_new=round($rate_cmt['tongdiem']/$rate_cmt['soluot'],0);
				}
				$data_['rate'] = $diem_new;
				$d->where('id',$id_sp);
				$d->update('product',$data_);
				/*cap nhat lai diem cho san pham*/
			}
		}

		$func->transfer("Xóa dữ liệu thành công", "index.php?com=comment&act=man&type=".$type."&p=".$curPage);
	}
	else $func->transfer("Không nhận được dữ liệu", "index.php?com=comment&act=man&type=".$type."&p=".$curPage, false);
}
?>