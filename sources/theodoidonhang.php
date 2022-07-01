<?php  
	if(!defined('SOURCES')) die("Error");

	/* Tìm kiếm sản phẩm */
	if(isset($_GET['madh']))
	{
		$madh = htmlspecialchars($_GET['madh']);
		$madh = $func->changeTitle($madh);

		if($madh)
		{
			$detail_order=$d->rawQueryOne("select * from #_order where madonhang = ? order by stt,id desc",array($madh));
		}
	}

	/* SEO */
	$seo->setSeo('title',$title_crumb);

	/* breadCrumbs */
	$breadcr->setBreadCrumbs('',$title_crumb);
	$breadcrumbs = $breadcr->getBreadCrumbs();
?>