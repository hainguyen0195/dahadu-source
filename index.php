<?php
    session_start();
    define('LIBRARIES','./libraries/');
    define('SOURCES','./sources/');
    define('LAYOUT','layout/');
    define('THUMBS','thumbs');
    define('WATERMARK','watermark');

    /* Config */
    require_once LIBRARIES."config.php";
    require_once LIBRARIES.'autoload.php';
    new AutoLoad();
    $injection = new AntiSQLInjection();
    $d = new PDODb($config['database']);
    $seo = new Seo($d);
    $emailer = new Email($d);
    $router = new AltoRouter();
    $cache = new FileCache($d);
    $func = new Functions($d);
    $breadcr = new BreadCrumbs($d);
    $statistic = new Statistic($d, $cache);
    $cart = new Cart($d);
    $addons = new AddonsOnline();
    $css = new CssMinify($config['website']['debug-css'], $func);
    $js = new JsMinify($config['website']['debug-js'], $func);

    /* Router */
    require_once LIBRARIES."router.php";

    /* Template */
    include TEMPLATE."index.php";
?>