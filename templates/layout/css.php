<!-- Css Files -->
<?php
$css->setCache("cached");
$css->setCss("./assets/css/animate.min.css");
$css->setCss("./assets/bootstrap/bootstrap.css");
$css->setCss("./assets/fontawesome512/all.css");
$css->setCss("./assets/fancybox3/jquery.fancybox.css");
$css->setCss("./assets/fancybox3/jquery.fancybox.style.css");
$css->setCss("./assets/login/login.css");
$css->setCss("./assets/css/cart.css");
$css->setCss("./assets/photobox/photobox.css");
$css->setCss("./assets/slick/slick.css");
$css->setCss("./assets/slick/slick-theme.css");
$css->setCss("./assets/slick/slick-style.css");
$css->setCss("./assets/css/jGrowl.css");
$css->setCss("./assets/simplyscroll/jquery.simplyscroll.css");
$css->setCss("./assets/simplyscroll/jquery.simplyscroll-style.css");
$css->setCss("./assets/fotorama/fotorama.css");
$css->setCss("./assets/fotorama/fotorama-style.css");
$css->setCss("./assets/magiczoomplus/magiczoomplus.css");
$css->setCss("./assets/datetimepicker/jquery.datetimepicker.css");
$css->setCss("./assets/owlcarousel2/owl.carousel.css");
$css->setCss("./assets/owlcarousel2/owl.theme.default.css");
$css->setCss("./assets/css/style_slider.css");
$css->setCss("./assets/css/rp-menu.css");
$css->setCss("./assets/css/style_hotro.css");
$css->setCss("./assets/css/style_product_detail.css");
$css->setCss("./assets/css/style_contact.css");
$css->setCss("./assets/css/style.css");
$css->setCss("./admin/assets/select2/select2.css");
$css->setCss("./assets/css/style_start.css");
$css->setCss("./assets/css/style_repon.css");
$css->setCss("./assets/css/style_thanhtoan.css");
echo $css->getCss();
?>

<!-- Js Google Analytic -->
<?= htmlspecialchars_decode($setting['analytics']) ?>

<!-- Js Head -->
<?= htmlspecialchars_decode($setting['headjs']) ?>