<?php
include "ajax_config.php";

$id_size = (isset($_POST['id_size']) && $_POST['id_size'] > 0) ? htmlspecialchars($_POST['id_size']) : 0;
$classs = (isset($_POST['classs']) && $_POST['classs'] != '' ) ? htmlspecialchars($_POST['classs']) : 0;

$row_detail_size = $d->rawQueryOne("select * from #_size_color_price where id= ? order by stt desc ",array($id_size)); 


if(($row_detail_size['gia']>0) & ($row_detail_size['giaban']>0)){
	$rt.='<span class="giamoi">'.number_format($row_detail_size['giaban']). ' đ</span> <span class="giacu">(' .number_format($row_detail_size['gia']). ' đ)</span>';
}else{
	if($row_detail_size['gia']>0){
		$rt.='<span class="giamoi">' .number_format($row_detail_size['gia']). ' đ</span>';
	}else{
		if($row_detail_size['giaban']>0){
			$rt.='<span class="giamoi">' .number_format($row_detail_size['giaban']). ' đ</span>';
		}else{
			$rt.='<a href="lien-he.html" title="'.lienhe.'">'.lienhe.'</a>';
		}
	}
}

$data = array('html' => $rt, 'classs' => '.'.$classs);
echo json_encode($data);
?>
