<?php
include "ajax_config.php";

if (isset($_POST['id'])) {
	$table = (isset($_POST['table'])) ? htmlspecialchars($_POST['table']) : '';
	$id = (isset($_POST['id'])) ? htmlspecialchars($_POST['id']) : 0;
	$loai = (isset($_POST['loai'])) ? htmlspecialchars($_POST['loai']) : '';

	$tmp = $d->rawQueryOne("select $loai from #_$table where id = ? limit 0,1", array($id));

	if ($tmp[$loai] > 0) $data[$loai] = 0;
	else $data[$loai] = 1;

	$d->where('id', $id);
	$d->update($table, $data);
	$cache->DeleteCache();

	if ($table == 'comment') {
		if ($loai == 'hienthi') {
			$inf_cmt = $d->rawQueryOne("select sanpham from #_comment where id = ? limit 0,1", array($id));

			$rate_cmt = $d->rawQueryOne("select sum(diem) as tongdiem,count(id) as soluot from #_comment where hienthi = 1 and type=? and sanpham=? order by id asc", array('rating', $inf_cmt['sanpham']));
			$diem_new = 0;
			if (isset($rate_cmt) && $rate_cmt['soluot'] > 0) {
				$diem_new = round($rate_cmt['tongdiem'] / $rate_cmt['soluot'], 0);
			}
			$data_['rate'] = $diem_new;
			$d->where('id', $inf_cmt['sanpham']);
			if ($d->update('product', $data_)) {
				echo 'true';
			}
		}
	}
}
