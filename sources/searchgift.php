<?php  
if(!defined('SOURCES')) die("Error");

$ngaygiao = (isset($_GET['ngaygiao']) && $_GET['ngaygiao'] != '') ? htmlspecialchars($_GET['ngaygiao']) : '';
$id_l = (isset($_GET['id_l']) && $_GET['id_l'] !='') ? htmlspecialchars($_GET['id_l']) : '';
$pc = (isset($_GET['pc']) && $_GET['pc'] > 0) ? htmlspecialchars($_GET['pc']) : '';

$where='';
$where .= "type = ? and hienthi > 0";
if(isset($id_l) && $id_l > 0 ){
	$where.=" and id_list=".$id_l."  ";
}
if(isset($pc) && $pc > 0 )
{
	$where .= " and mod_postcode = $pc ";
}
if(isset($ngaygiao) && $ngaygiao !='' )
{
	$_SESSION['ngaygiao'] = $ngaygiao;
}

$params = array("san-pham");
$order_by="order by stt,id desc";
$curPage = $get_page;
$per_page = $optsetting['paging_product'];
$startpoint = ($curPage * $per_page) - $per_page;
$limit = " limit ".$startpoint.",".$per_page;
$select=' id, ten'.$lang.' ,tenkhongdauvi, tenkhongdauen , gia,giamoi,giakm ,photo, id_mau, id_size ';
$sql = "select $select from #_product where $where $order_by $limit";
$product = $d->rawQuery($sql,$params);
$sqlNum = "select count(*) as 'num' from #_product where $where $order_by";
$count = $d->rawQueryOne($sqlNum,$params);
$total = $count['num'];
$url = $func->getCurrentPageURL();
$paging = $func->pagination($total,$per_page,$curPage,$url);

/* SEO */
$seo->setSeo('title',$title_crumb);

/* breadCrumbs */
$breadcr->setBreadCrumbs('',$title_crumb);
$breadcrumbs = $breadcr->getBreadCrumbs();
?>