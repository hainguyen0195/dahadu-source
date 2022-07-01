<?php
	if(!defined('SOURCES')) die("Error");

	/* Kiểm tra active static */
	if(isset($config['static']))
	{
		$arrCheck = array();
		foreach($config['static'] as $k => $v) $arrCheck[] = $k;
		if(!count($arrCheck) || !in_array($type,$arrCheck)) $func->transfer("Trang không tồn tại", "index.php", false);
	}
	else
	{
		$func->transfer("Trang không tồn tại", "index.php", false);
	}

	switch($act)
	{
		case "capnhat":
			get_static();
			$template = "static/man/item_add";
			break;
		case "save":
			save_static();
			break;

		default:
			$template = "404";
	}

	/* Get static */
	function get_static()
	{
		global $d, $item, $type;

		$item = $d->rawQueryOne("select * from #_static where type = ? limit 0,1",array($type));
	}

	/* Save static */
	function save_static()
	{
		global $d, $config, $func, $com, $type;
		
		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=static&act=capnhat&type=".$type, false);

		$static = $d->rawQueryOne("select * from #_static where type = ? limit 0,1",array($type));

		$info_more = json_decode($static['info_more'],true);
		/* Post dữ liệu */
		$data = (isset($_POST['data'])) ? $_POST['data'] : null;
		if($data)
		{
			foreach($data as $column => $value)
			{
				if(is_array($value))
				{
					foreach($value as $k2 => $v2) $info_more[$k2] = $v2;
					$data[$column] = json_encode($info_more);
				}
				else
				{
					$data[$column] = htmlspecialchars($value);
				}
			}

			$data['tenkhongdauvi'] = (isset($data['tenvi'])) ? $func->changeTitle($data['tenvi']) : '';
			$data['tenkhongdauen'] = (isset($data['tenen'])) ? $func->changeTitle($data['tenen']) : '';
			$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
			$data['type'] = $type;
		}

		/* Post Seo */
		if(isset($config['static'][$type]['seo']) && $config['static'][$type]['seo'] == true)
		{
			$dataSeo = (isset($_POST['dataSeo'])) ? $_POST['dataSeo'] : null;
			if($dataSeo)
			{
				foreach($dataSeo as $column => $value)
				{
					$dataSeo[$column] = htmlspecialchars($value);
				}
			}
		}

		if(isset($_FILES['file']))
		{
			$file_name = $func->uploadName($_FILES['file']["name"]);
			if($photo = $func->uploadImage("file", $config['static'][$type]['img_type'],UPLOAD_NEWS,$file_name))
			{
				$data['photo'] = $photo;
				$row = $d->rawQueryOne("select id, photo from #_static where type = ? limit 0,1",array($type));
				if($row['id']) $func->delete_file(UPLOAD_NEWS.$row['photo']);
			}
		}
		if(isset($_FILES['file2']))
		{
			$file_name2 = $func->uploadName($_FILES['file2']["name"]);
			if($photo2 = $func->uploadImage("file2", $config['static'][$type]['img_type'],UPLOAD_NEWS,$file_name2))
			{
				$data['photo2'] = $photo2;
				$row = $d->rawQueryOne("select id, photo2 from #_static where type = ? limit 0,1",array($type));
				if($row['id']) $func->delete_file(UPLOAD_NEWS.$row['photo2']);
			}
			
		}
		if(isset($_FILES['file-taptin']))
		{
			$file_name = $func->uploadName($_FILES['file-taptin']["name"]);
			if($taptin = $func->uploadImage("file-taptin", $config['static'][$type]['file_type'],UPLOAD_FILE,$file_name))
			{
				$data['taptin'] = $taptin;
				$row = $d->rawQueryOne("select id, taptin from #_static where type = ? limit 0,1",array($type));
				if($row['id']) $func->delete_file(UPLOAD_FILE.$row['taptin']);
			}
		}

		if($static['id'])
		{
			$data['ngaysua'] = time();

			$d->where('type',$type);
			if($d->update('static',$data))
			{
				/* SEO */
				if(isset($config['static'][$type]['seo']) && $config['static'][$type]['seo'] == true)
				{
					$d->rawQuery("delete from #_seo where com = ? and act = ? and type = ?",array($com,'capnhat',$type));

					$dataSeo['idmuc'] = 0;
					$dataSeo['com'] = $com;
					$dataSeo['act'] = 'capnhat';
					$dataSeo['type'] = $type;
					$d->insert('seo',$dataSeo);
				}

				$func->transfer("Cập nhật dữ liệu thành công", "index.php?com=static&act=capnhat&type=".$type);
			}
			else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=static&act=capnhat&type=".$type, false);
		}
		else
		{
			if(
				(isset($data['tenvi']) && $data['tenvi'] != '') || 
				(isset($data['motavi']) && $data['motavi'] != '') || 
				(isset($data['noidungvi']) && $data['noidungvi'] != ''))
			{
				$data['ngaytao'] = time();

				if($d->insert('static',$data))
				{
					/* SEO */
					if(isset($config['static'][$type]['seo']) && $config['static'][$type]['seo'] == true)
					{
						$dataSeo['idmuc'] = 0;
						$dataSeo['com'] = $com;
						$dataSeo['act'] = 'capnhat';
						$dataSeo['type'] = $type;
						$d->insert('seo',$dataSeo);
					}

					$func->transfer("Lưu dữ liệu thành công", "index.php?com=static&act=capnhat&type=".$type);
				}
				else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=static&act=capnhat&type=".$type, false);
			}
			$func->transfer("Dữ liệu rỗng", "index.php?com=static&act=capnhat&type=".$type, false);
		}
	}
?>