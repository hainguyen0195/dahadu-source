<?php
    /* Giới thiệu */
    $nametype = "gioi-thieu";
    $config['static'][$nametype]['title_main'] = "Giới thiệu";
    $config['static'][$nametype]['file'] = false;
    $config['static'][$nametype]['tieude'] = true;
    $config['static'][$nametype]['mota'] = false;
    $config['static'][$nametype]['mota_cke'] = false;
    $config['static'][$nametype]['noidung'] = true;
    $config['static'][$nametype]['noidung_cke'] = true;
    $config['static'][$nametype]['seo'] = true;
    $config['static'][$nametype]['images'] = false;
    $config['static'][$nametype]['width'] = 600;
    $config['static'][$nametype]['height'] = 400;
    $config['static'][$nametype]['images2'] = true;
    $config['static'][$nametype]['width2'] = 600;
    $config['static'][$nametype]['height2'] = 400;
    $config['static'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
    $config['static'][$nametype]['file_type'] = 'doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP|PPT|PPTX|xls|jpg|png|gif|JPG|PNG|GIF|xls|XLS';

  /* text index */
    $nametype = "text_index";
    $config['static'][$nametype]['title_main'] = "text index";
    $config['static'][$nametype]['tieude'] = true; 
    $config['static'][$nametype]['info_more'] = array("text_tt"=>"Text tin tức","text_dt"=>"Text đối tác");

    /* Liên hệ */
    $nametype = "lienhe";
    $config['static'][$nametype]['title_main'] = "Liên hệ";
    $config['static'][$nametype]['noidung'] = true;
    $config['static'][$nametype]['noidung_cke'] = true;

    /* Footer */
    $nametype = "footer";
    $config['static'][$nametype]['title_main'] = "Footer";
    $config['static'][$nametype]['tieude'] = true;
    $config['static'][$nametype]['noidung'] = true;
    $config['static'][$nametype]['noidung_cke'] = true;
?>