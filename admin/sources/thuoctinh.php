<?php
if(!defined('SOURCES')) die("Error");
/* Kiểm tra active thuoctinh */
if(isset($config['thuoctinh']))
{
	$arrCheck = array();
	foreach($config['thuoctinh'] as $k => $v) $arrCheck[] = $k;
	if(!count($arrCheck) || !in_array($type,$arrCheck)) $func->transfer("Trang không tồn tại", "index.php", false);
}
else
{
	$func->transfer("Trang không tồn tại", "index.php", false);	
}

/* Cấu hình đường dẫn trả về */
$strUrl = "";
$arrUrl = array('id_list','id_cat','id_item','id_sub','id_brand','id_city','id_district');
if(isset($_POST['data']))
{
	$dataUrl = isset($_POST['data']) ? $_POST['data'] : null;
	if($dataUrl)
	{
		foreach($arrUrl as $k => $v)
		{
			if(isset($dataUrl[$arrUrl[$k]])) $strUrl .= "&".$arrUrl[$k]."=".htmlspecialchars($dataUrl[$arrUrl[$k]]);
		}
	}
}
else
{
	foreach($arrUrl as $k => $v)
	{
		if(isset($_REQUEST[$arrUrl[$k]])) $strUrl .= "&".$arrUrl[$k]."=".htmlspecialchars($_REQUEST[$arrUrl[$k]]);
	}
	if(isset($_REQUEST['keyword'])) $strUrl .= "&keyword=".htmlspecialchars($_REQUEST['keyword']);
}

switch($act)
{
	case "man":
	get_items();
	$template = "thuoctinh/man/items";
	break;
	case "add":
	$template = "thuoctinh/man/item_add";
	break;
	case "edit":
	get_item();
	$template = "thuoctinh/man/item_add";
	break;
	case "save":
	save_item();
	break;
	case "delete":
	delete_item();
	break;

	default:
	$template = "404";
}


/* Get size */
function get_items()
{
	global $d, $func, $curPage, $items, $paging, $type;

	$where = "";

	if(isset($_REQUEST['keyword']))
	{
		$keyword = htmlspecialchars($_REQUEST['keyword']);
		$where .= " and (tenvi LIKE '%$keyword%' or tenen LIKE '%$keyword%')";
	}

	$per_page = 10;
	$startpoint = ($curPage * $per_page) - $per_page;
	$limit = " limit ".$startpoint.",".$per_page;
	$sql = "select * from #_thuoctinh where type = ? $where order by stt,id desc $limit";
	$items = $d->rawQuery($sql,array($type));
	$sqlNum = "select count(*) as 'num' from #_thuoctinh where type = ? $where order by stt,id desc";
	$count = $d->rawQueryOne($sqlNum,array($type));
	$total = $count['num'];
	$url = "index.php?com=thuoctinh&act=man&type=".$type;
	$paging = $func->pagination($total,$per_page,$curPage,$url);
}

/* Edit size */
function get_item()
{
	global $d, $func, $curPage, $item, $type;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=thuoctinh&act=man&type=".$type."&p=".$curPage, false);

	$item = $d->rawQueryOne("select * from #_thuoctinh where id = ? limit 0,1",array($id));

	if(!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=thuoctinh&act=man&type=".$type."&p=".$curPage, false);
}

/* Save size */
function save_item()
{
	global $d, $func, $curPage, $config, $type;

	if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=thuoctinh&act=man&type=".$type."&p=".$curPage, false);

	/* Post dữ liệu */
	$data = (isset($_POST['data'])) ? $_POST['data'] : null;
	if($data)
	{
		foreach($data as $column => $value)
		{
			$data[$column] = htmlspecialchars($value);
		}

		$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
		$data['type'] = $type;
	}

	$id = (isset($_POST['id'])) ? htmlspecialchars($_POST['id']) : 0;

	if($id)
	{
		$data['ngaysua'] = time();

		$d->where('id', $id);
		$d->where('type', $type);
		if($d->update('thuoctinh',$data)) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=thuoctinh&act=man&type=".$type."&p=".$curPage);
		else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=thuoctinh&act=man&type=".$type."&p=".$curPage, false);
	}
	else
	{
		$data['ngaytao'] = time();
		if($d->insert('thuoctinh',$data)) $func->transfer("Lưu dữ liệu thành công", "index.php?com=thuoctinh&act=man&type=".$type."&p=".$curPage);
		else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=thuoctinh&act=man&type=".$type."&p=".$curPage, false);
	}
}

/* Delete size */
function delete_item()
{
	global $d, $func, $curPage, $type;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	if($id)
	{
		$row = $d->rawQueryOne("select id from #_thuoctinh where id = ? and type = ? limit 0,1",array($id,$type));
		
		if($row['id'])
		{
			$d->rawQuery("delete from #_thuoctinh where id = ? and type = ?",array($id,$type));
			$func->transfer("Xóa dữ liệu thành công", "index.php?com=thuoctinh&act=man&type=".$type."&p=".$curPage);
		}
		else $func->transfer("Xóa dữ liệu bị lỗi", "index.php?com=thuoctinh&act=man&type=".$type."&p=".$curPage, false);
	}
	elseif(isset($_GET['listid']))
	{
		$listid = explode(",",$_GET['listid']);

		for($i=0;$i<count($listid);$i++)
		{
			$id = htmlspecialchars($listid[$i]);
			$row = $d->rawQueryOne("select id from #_thuoctinh where id = ? and type = ? limit 0,1",array($id,$type));

			if($row['id']) $d->rawQuery("delete from #_thuoctinh where id = ? and type = ?",array($id,$type));
		}

		$func->transfer("Xóa dữ liệu thành công", "index.php?com=thuoctinh&act=man&type=".$type."&p=".$curPage);
	} 
	else $func->transfer("Không nhận được dữ liệu", "index.php?com=thuoctinh&act=man&type=".$type."&p=".$curPage, false);
}

?>