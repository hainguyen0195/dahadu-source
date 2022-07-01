<?php
include "ajax_config.php";

$id_size = (isset($_POST['id_size']) && $_POST['id_size'] > 0) ? htmlspecialchars($_POST['id_size']) : 0;

$data_ = array();
$data_['hoten'] = (isset($_POST['name-rate']) && $_POST['name-rate'] !='') ? htmlspecialchars($_POST['name-rate']) : '';
$data_['dienthoai'] = (isset($_POST['dienthoai-rate']) && $_POST['dienthoai-rate'] !='') ? htmlspecialchars($_POST['dienthoai-rate']) : '';

$data_['email'] = (isset($_POST['email-rate']) && $_POST['email-rate'] !='') ? htmlspecialchars($_POST['email-rate']) : '';
$data_['noidung'] = (isset($_POST['rate-ct']) && $_POST['rate-ct'] !='') ? htmlspecialchars($_POST['rate-ct']) : '';
$data_['diem'] = (isset($_POST['score_input']) && $_POST['score_input'] > 0) ? htmlspecialchars($_POST['score_input']) : '';
$data_['sanpham'] = (isset($_POST['sanpham']) && $_POST['sanpham'] > 0) ? htmlspecialchars($_POST['sanpham']) : '';;
$data_['type'] = 'rating';

$data_['ngaytao'] = time();
$data_['hienthi'] = 0;
$data_['view'] = 0;

$data=0;

if($d->insert('comment',$data_))
{
	$data=2;
}
else
{
	$data=3;
}

echo $data;
?>