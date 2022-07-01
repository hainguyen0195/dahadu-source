<?php
/* Config type - Group */
$config['group'] = array(
    "Group Sản Phẩm" => array(
        "product" => array("san-pham"),
        "photo_static" => array("watermark"),
        //"thuoctinh" => array("mod_dientich","mod_huong","mod_gia"),
        //"places" => array("man_city","man_district","man_wards")
    ),
);
/* Config type - Product */
require_once LIBRARIES . 'type/config-type-product.php';

/* Config type - thuộc tính */
//require_once LIBRARIES.'type/config-type-mod.php';

/* Config type - địa chỉ */
//require_once LIBRARIES.'type/config-type-places.php';

/* Config type - Tags */
require_once LIBRARIES . 'type/config-type-tags.php';

/* Config type - Newsletter */
require_once LIBRARIES . 'type/config-type-newsletter.php';

/* Config type - News */
require_once LIBRARIES . 'type/config-type-news.php';

/* Config type - Static */
require_once LIBRARIES . 'type/config-type-static.php';

/* Config type - Photo */
require_once LIBRARIES . 'type/config-type-photo.php';

/* Seo page */
$config['seopage']['page'] = array(
    "gioi-thieu" => "Giới thiệu",
    "san-pham" => "Sản phẩm",
    "dich-vu" => "Dịch vụ",
    "tuyen-dung" => "Tuyển dụng",
    "cong-trinh" => "Công trình",
    "tin-tuc" => "Tin tức",
    "lien-he" => "Liên hệ"
);
$config['seopage']['width'] = 300;
$config['seopage']['height'] = 200;
$config['seopage']['thumb'] = '300x200x1';
$config['seopage']['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

/* Setting */
$config['setting']['slogan'] = false;
$config['setting']['diachi'] = true;
$config['setting']['dienthoai'] = true;
$config['setting']['hotline'] = true;
$config['setting']['zalo'] = true;
$config['setting']['oaidzalo'] = false;
$config['setting']['email'] = true;
$config['setting']['website'] = true;
$config['setting']['fanpage'] = true;
$config['setting']['messenger'] = true;
$config['setting']['toado'] = false;
$config['setting']['time_open'] = false;
$config['setting']['coppyright'] = false;
$config['setting']['toado_iframe'] = true;
$config['setting']['paging_product'] = true;
$config['setting']['paging_news'] = true;
$config['setting']['paging_index'] = true;

/* Quản lý import */
$config['import']['images'] = false;
$config['import']['thumb'] = '100x100x1';
$config['import']['img_type'] = ".jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF";

/* Quản lý export */
$config['export']['category'] = false;

/* Quản lý tài khoản */
$config['user']['active'] = true;
$config['user']['admin'] = false;
$config['user']['visitor'] = false;

/* Quản lý phân quyền */
$config['permission'] = false;

/* Quản lý giỏ hàng */
$config['order']['active'] = false;
$config['order']['search'] = false;
$config['order']['excel'] = false;
$config['order']['word'] = false;
$config['order']['excelall'] = false;
$config['order']['wordall'] = false;
$config['order']['thumb'] = '100x100x1';
/* Quản lý ma giam gia */
$config['order']['magiamgia'] = false;

/* Quản lý comment đánh giá */
$config['comment']['active'] = false;


/* Quản lý thông báo đẩy */
$config['onesignal'] = false;
