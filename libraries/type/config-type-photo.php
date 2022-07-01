<?php
    /* Logo */
    $nametype = "logo";
    $config['photo']['photo_static'][$nametype]['title_main'] = "Logo";
    $config['photo']['photo_static'][$nametype]['images'] = true;
    $config['photo']['photo_static'][$nametype]['width'] = 160;
    $config['photo']['photo_static'][$nametype]['height'] = 80;
    $config['photo']['photo_static'][$nametype]['thumb'] = '160x80x1';
    $config['photo']['photo_static'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';


    /* Favicon */
    $nametype = "favicon";
    $config['photo']['photo_static'][$nametype]['title_main'] = "Favicon";
    $config['photo']['photo_static'][$nametype]['images'] = true;
    $config['photo']['photo_static'][$nametype]['width'] = 48;
    $config['photo']['photo_static'][$nametype]['height'] = 48;
    $config['photo']['photo_static'][$nametype]['thumb'] = '48x48x1';
    $config['photo']['photo_static'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

    /* Watermark */
    $nametype = "watermark";
    $config['photo']['photo_static'][$nametype]['title_main'] = "Watermark";
    $config['photo']['photo_static'][$nametype]['images'] = true;
    $config['photo']['photo_static'][$nametype]['watermark'] = true;
    $config['photo']['photo_static'][$nametype]['watermark-advanced'] = false;
    $config['photo']['photo_static'][$nametype]['width'] = 50;
    $config['photo']['photo_static'][$nametype]['height'] = 50;
    $config['photo']['photo_static'][$nametype]['thumb'] = '50x50x1';
    $config['photo']['photo_static'][$nametype]['img_type'] = '.png|.PNG|.Png';


      /* Bannerqc */
    // $nametype = "Bannerqc";
    // $config['photo']['photo_static'][$nametype]['title_main'] = "Banner quảng cáo";
    // $config['photo']['photo_static'][$nametype]['images'] = true;
    // $config['photo']['photo_static'][$nametype]['tieude'] = true;
    // $config['photo']['photo_static'][$nametype]['link'] = true;
    // $config['photo']['photo_static'][$nametype]['width'] = 1366;
    // $config['photo']['photo_static'][$nametype]['height'] = 365;
    // $config['photo']['photo_static'][$nametype]['thumb'] = '1366x365x1';
    // $config['photo']['photo_static'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';


    /* Popup */
 /*   $nametype = "popup";
    $config['photo']['photo_static'][$nametype]['title_main'] = "Popup";
    $config['photo']['photo_static'][$nametype]['images'] = true;
    $config['photo']['photo_static'][$nametype]['tieude'] = true;
    $config['photo']['photo_static'][$nametype]['link'] = true;
    $config['photo']['photo_static'][$nametype]['width'] = 800;
    $config['photo']['photo_static'][$nametype]['height'] = 530;
    $config['photo']['photo_static'][$nametype]['thumb'] = '800x530x1';
    $config['photo']['photo_static'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
*/
    /* Slideshow */
    $nametype = "slide";
    $config['photo']['man_photo'][$nametype]['title_main_photo'] = "Slideshow";
    $config['photo']['man_photo'][$nametype]['number_photo'] = 2;
    $config['photo']['man_photo'][$nametype]['images_photo'] = true;
    $config['photo']['man_photo'][$nametype]['avatar_photo'] = true;
    $config['photo']['man_photo'][$nametype]['link_photo'] = true;
    $config['photo']['man_photo'][$nametype]['tieude_photo'] = true;
    $config['photo']['man_photo'][$nametype]['width_photo'] = 840;
    $config['photo']['man_photo'][$nametype]['height_photo'] = 480;
    $config['photo']['man_photo'][$nametype]['thumb_photo'] = '840x480x1';
    $config['photo']['man_photo'][$nametype]['img_type_photo'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';


    /* Mạng xã hội */
    $nametype = "mangxahoi_header";
    $config['photo']['man_photo'][$nametype]['title_main_photo'] = "Mạng xã hội header";
    $config['photo']['man_photo'][$nametype]['number_photo'] = 2;
    $config['photo']['man_photo'][$nametype]['images_photo'] = true;
    $config['photo']['man_photo'][$nametype]['avatar_photo'] = true;
    $config['photo']['man_photo'][$nametype]['link_photo'] = true;
    $config['photo']['man_photo'][$nametype]['width_photo'] = 25;
    $config['photo']['man_photo'][$nametype]['height_photo'] = 25;
    $config['photo']['man_photo'][$nametype]['thumb_photo'] = '25x25x1';
    $config['photo']['man_photo'][$nametype]['img_type_photo'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

    /* Mạng xã hội */
    $nametype = "mangxahoi_footer";
    $config['photo']['man_photo'][$nametype]['title_main_photo'] = "Mạng xã hội footer";
    $config['photo']['man_photo'][$nametype]['number_photo'] = 2;
    $config['photo']['man_photo'][$nametype]['images_photo'] = true;
    $config['photo']['man_photo'][$nametype]['avatar_photo'] = true;
    $config['photo']['man_photo'][$nametype]['link_photo'] = true;
    $config['photo']['man_photo'][$nametype]['width_photo'] = 37;
    $config['photo']['man_photo'][$nametype]['height_photo'] = 37;
    $config['photo']['man_photo'][$nametype]['thumb_photo'] = '37x37x1';
    $config['photo']['man_photo'][$nametype]['img_type_photo'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

 /* Liên kết */
    $nametype = "contact_right";
    $config['photo']['man_photo'][$nametype]['title_main_photo'] = "Liên kết left";
    $config['photo']['man_photo'][$nametype]['number_photo'] = 2;
    $config['photo']['man_photo'][$nametype]['images_photo'] = true;
    $config['photo']['man_photo'][$nametype]['avatar_photo'] = true;
    $config['photo']['man_photo'][$nametype]['link_photo'] = true;
    $config['photo']['man_photo'][$nametype]['width_photo'] = 57;
    $config['photo']['man_photo'][$nametype]['height_photo'] = 57;
    $config['photo']['man_photo'][$nametype]['thumb_photo'] = '57x57x1';
    $config['photo']['man_photo'][$nametype]['img_type_photo'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';


  /* Đối tác */
    $nametype = "doitac";
    $config['photo']['man_photo'][$nametype]['title_main_photo'] = "Đối tác";
    $config['photo']['man_photo'][$nametype]['number_photo'] = 2;
    $config['photo']['man_photo'][$nametype]['images_photo'] = true;
    $config['photo']['man_photo'][$nametype]['avatar_photo'] = true;
    $config['photo']['man_photo'][$nametype]['link_photo'] = true;
    $config['photo']['man_photo'][$nametype]['width_photo'] = 30;
    $config['photo']['man_photo'][$nametype]['height_photo'] = 30;
    $config['photo']['man_photo'][$nametype]['thumb_photo'] = '30x30x1';
    $config['photo']['man_photo'][$nametype]['img_type_photo'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';


    /* Video */
    $nametype = "video";
    $config['photo']['man_photo'][$nametype]['title_main_photo'] = "Video";
    $config['photo']['man_photo'][$nametype]['check_photo'] = array("noibat" => "Nổi bật");
    $config['photo']['man_photo'][$nametype]['number_photo'] = 2;
    $config['photo']['man_photo'][$nametype]['video_photo'] = true;
    $config['photo']['man_photo'][$nametype]['tieude_photo'] = true;
   
?>