<?php
include "ajax_config.php";

if(isset($_POST['id']))
{
	$id = (isset($_POST['id'])) ? htmlspecialchars($_POST['id']) : 0;

	$d->rawQuery("delete from #_product_mau where id = ? ",array($id));
	
	$cache->DeleteCache();
}

?>
