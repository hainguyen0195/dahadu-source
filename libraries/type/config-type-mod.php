<?php
/* Diện tích */
$nametype = "mod_dientich";
$config['thuoctinh'][$nametype]['title_main'] = "Diện tích";

/* Hướng */
$nametype = "mod_huong";
$config['thuoctinh'][$nametype]['title_main'] = "Hướng";

/* Giá */
$nametype = "mod_gia";
$config['thuoctinh'][$nametype]['title_main'] = "Mức giá";

/* Quản lý mục (Không cấp) */
if(isset($config['thuoctinh']))
{
    foreach($config['thuoctinh'] as $key => $value)
    {
        if(!isset($value['dropdown']) || (isset($value['dropdown']) && $value['dropdown'] == false))
        { 
            $config['showthuoctinh'] = 1;
            break;
        }
    }
}
?>