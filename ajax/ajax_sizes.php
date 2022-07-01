<?php
include "ajax_config.php";

$id_size = (isset($_POST['id_size']) && $_POST['id_size'] > 0) ? htmlspecialchars($_POST['id_size']) : 0;
$row_detail_size = $d->rawQueryOne("select * from #_size_color_price where id= ? order by stt desc ", array($id_size));

$gia_km = 0;
if ($row_detail_size['gia'] > 0) {
	$gia_km = round(100 - (($row_detail_size['giaban'] * 100) / $row_detail_size['gia']), 0);
}
$func->get_price_detail($row_detail_size['gia'], $row_detail_size['giaban'], $gia_km);
