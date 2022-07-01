<!-- Main Sidebar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 text-sm">
    <!-- Logo -->
    <a class="brand-link brand-link-logo" href="index.php">
        <img class="brand-image" src="assets/images/favicon.png" alt="Hcode">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent text-sm" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Bảng điều khiển -->
                <?php
                $active = "";
                if ($com == 'index' || $com == '') $active = 'active';
                ?>
                <li class="nav-item <?= $active ?>">
                    <a class="nav-link <?= $active ?>" href="index.php" title="Bảng điều khiển">
                        <i class="nav-icon text-sm fas fa-tachometer-alt"></i>
                        <p>Bảng điều khiển</p>
                    </a>
                </li>

                <!-- Group -->
                <?php $disabled = array();
                if (isset($config['group'])) {
                    foreach ($config['group'] as $key => $value) {
                        $l = false;
                        foreach ($value as $k => $v) {
                            foreach ($v as $k2 => $v2) {
                                if (isset($config[$k][$v2])) {
                                    $l = true;
                                }
                            }
                        }
                        if ($l) { ?>
                            <li class="nav-item has-treeview menu-group">
                                <a class="nav-link" href="#" title="Quản lý <?= $key ?>">
                                    <i class="nav-icon text-sm fas fa-layer-group"></i>
                                    <p>
                                        <?= $key ?>
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <?php if (isset($value['product'])) {
                                        foreach ($value['product'] as $k) { ?>
                                            <?php
                                            $disabled['product'][$k] = 1;
                                            $v = $config['product'][$k];
                                            $none = "";
                                            $active = "";
                                            $menuopen = "";
                                            if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('product', 'man_list', $k, null, 'phrase-1') && $func->check_access('product', 'man_cat', $k, null, 'phrase-1') && $func->check_access('product', 'man_item', $k, null, 'phrase-1') && $func->check_access('product', 'man_sub', $k, null, 'phrase-1') && $func->check_access('product', 'man_brand', $k, null, 'phrase-1') && $func->check_access('product', 'man', $k, null, 'phrase-1') && $func->check_access('import', 'man', $k, null, 'phrase-1') && $func->check_access('export', 'man', $k, null, 'phrase-1')) $none = "d-none";
                                            if ((($com == 'product') || ($com == 'import') || ($com == 'export')) && ($k == $_GET['type'])) {
                                                $active = 'active';
                                                $menuopen = 'menu-open';
                                            }
                                            ?>
                                            <li class="nav-item has-treeview <?= $menuopen ?> <?= $none ?>">
                                                <a class="nav-link <?= $active ?>" href="#" title="Quản lý <?= $v['title_main'] ?>">
                                                    <i class="nav-icon text-sm fas fa-boxes"></i>
                                                    <p>
                                                        Quản lý <?= $v['title_main'] ?>
                                                        <i class="right fas fa-angle-left"></i>
                                                    </p>
                                                </a>
                                                <ul class="nav nav-treeview">
                                                    <?php if (isset($v['list']) && $v['list'] == true) {
                                                        $none = "";
                                                        $active = "";
                                                        if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('product', 'man_list', $k, null, 'phrase-1')) $none = "d-none";
                                                        if ($com == 'product' && ($act == 'man_list' || $act == 'add_list' || $act == 'edit_list' || $kind == 'man_list') && $k == $_GET['type']) $active = "active"; ?>
                                                        <li class="nav-item <?= $none ?>"><a class="nav-link <?= $active ?>" href="index.php?com=product&act=man_list&type=<?= $k ?>" title="Danh mục cấp 1"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                                                <p>Danh mục cấp 1</p>
                                                            </a></li>
                                                    <?php } ?>
                                                    <?php if (isset($v['cat']) && $v['cat'] == true) {
                                                        $none = "";
                                                        $active = "";
                                                        if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('product', 'man_cat', $k, null, 'phrase-1')) $none = "d-none";
                                                        if ($com == 'product' && ($act == 'man_cat' || $act == 'add_cat' || $act == 'edit_cat' || $kind == 'man_cat') && $k == $_GET['type']) $active = "active"; ?>
                                                        <li class="nav-item <?= $none ?>"><a class="nav-link <?= $active ?>" href="index.php?com=product&act=man_cat&type=<?= $k ?>" title="Danh mục cấp 2"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                                                <p>Danh mục cấp 2</p>
                                                            </a></li>
                                                    <?php } ?>
                                                    <?php if (isset($v['item']) && $v['item'] == true) {
                                                        $none = "";
                                                        $active = "";
                                                        if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('product', 'man_item', $k, null, 'phrase-1')) $none = "d-none";
                                                        if ($com == 'product' && ($act == 'man_item' || $act == 'add_item' || $act == 'edit_item' || $kind == 'man_item') && $k == $_GET['type']) $active = "active"; ?>
                                                        <li class="nav-item <?= $none ?>"><a class="nav-link <?= $active ?>" href="index.php?com=product&act=man_item&type=<?= $k ?>" title="Danh mục cấp 3"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                                                <p>Danh mục cấp 3</p>
                                                            </a></li>
                                                    <?php } ?>
                                                    <?php if (isset($v['sub']) && $v['sub'] == true) {
                                                        $none = "";
                                                        $active = "";
                                                        if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('product', 'man_sub', $k, null, 'phrase-1')) $none = "d-none";
                                                        if ($com == 'product' && ($act == 'man_sub' || $act == 'add_sub' || $act == 'edit_sub' || $kind == 'man_sub') && $k == $_GET['type']) $active = "active"; ?>
                                                        <li class="nav-item <?= $none ?>"><a class="nav-link <?= $active ?>" href="index.php?com=product&act=man_sub&type=<?= $k ?>" title="Danh mục cấp 4"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                                                <p>Danh mục cấp 4</p>
                                                            </a></li>
                                                    <?php } ?>
                                                    <?php if (isset($v['brand']) && $v['brand'] == true) {
                                                        $none = "";
                                                        $active = "";
                                                        if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('product', 'man_brand', $k, null, 'phrase-1')) $none = "d-none";
                                                        if ($com == 'product' && ($act == 'man_brand' || $act == 'add_brand' || $act == 'edit_brand') && $k == $_GET['type']) $active = "active"; ?>
                                                        <li class="nav-item <?= $none ?>"><a class="nav-link <?= $active ?>" href="index.php?com=product&act=man_brand&type=<?= $k ?>" title="Danh mục hãng"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                                                <p>Danh mục hãng</p>
                                                            </a></li>
                                                    <?php } ?>
                                                    <?php if (isset($v['mau']) && $v['mau'] == true) {
                                                        $none = "";
                                                        $active = "";
                                                        if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('product', 'man_mau', $k, null, 'phrase-1')) $none = "d-none";
                                                        if ($com == 'product' && ($act == 'man_mau' || $act == 'add_mau' || $act == 'edit_mau') && $k == $_GET['type']) $active = "active"; ?>
                                                        <li class="nav-item <?= $none ?>"><a class="nav-link <?= $active ?>" href="index.php?com=product&act=man_mau&type=<?= $k ?>" title="Danh mục màu sắc"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                                                <p>Danh mục màu sắc</p>
                                                            </a></li>
                                                    <?php } ?>
                                                    <?php if (isset($v['size']) && $v['size'] == true) {
                                                        $none = "";
                                                        $active = "";
                                                        if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('product', 'man_size', $k, null, 'phrase-1')) $none = "d-none";
                                                        if ($com == 'product' && ($act == 'man_size' || $act == 'add_size' || $act == 'edit_size') && $k == $_GET['type']) $active = "active"; ?>
                                                        <li class="nav-item <?= $none ?>"><a class="nav-link <?= $active ?>" href="index.php?com=product&act=man_size&type=<?= $k ?>" title="Danh mục kích thước"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                                                <p>Danh mục kích thước</p>
                                                            </a></li>
                                                    <?php } ?>
                                                    <?php
                                                    $none = "";
                                                    $active = "";
                                                    if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('product', 'man', $k, null, 'phrase-1')) $none = "d-none";
                                                    if ($com == 'product' && ($act == 'man' || $act == 'add' || $act == 'edit' || $act == 'copy' || $kind == 'man') && $k == $_GET['type']) $active = "active";
                                                    ?>
                                                    <li class="nav-item <?= $none ?>"><a class="nav-link <?= $active ?>" href="index.php?com=product&act=man&type=<?= $k ?>" title="<?= $v['title_main'] ?>"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                                            <p><?= $v['title_main'] ?></p>
                                                        </a></li>
                                                    <?php if (isset($v['import']) && $v['import'] == true) {
                                                        $none = "";
                                                        $active = "";
                                                        if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('import', 'man', $k, null, 'phrase-1')) $none = "d-none";
                                                        if (($com == 'import') && ($k == $_GET['type'])) $active = "active"; ?>
                                                        <li class="nav-item <?= $none ?>">
                                                            <a class="nav-link <?= $active ?>" href="index.php?com=import&act=man&type=<?= $k ?>" title="Import"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                                                <p>Import</p>
                                                            </a>
                                                        </li>
                                                    <?php } ?>
                                                    <?php if (isset($v['export']) && $v['export'] == true) {
                                                        $none = "";
                                                        $active = "";
                                                        if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('export', 'man', $k, null, 'phrase-1')) $none = "d-none";
                                                        if (($com == 'export') && ($act == 'man') && ($k == $_GET['type'])) $active = "active"; ?>
                                                        <li class="nav-item <?= $none ?>">
                                                            <a class="nav-link <?= $active ?>" href="index.php?com=export&act=man&type=<?= $k ?>" title="Export"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                                                <p>Export</p>
                                                            </a>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                    <?php }
                                    } ?>
                                    <!-- Thuộc tính group -->
                                    <?php if (isset($value['thuoctinh'])) {
                                        $disabled['thuoctinh'][$k] = 1;
                                        $none = "";
                                        $active = "";
                                        $menuopen = "";
                                        if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('thuoctinh', 'man', '', $config['thuoctinh'], 'phrase-2', false)) $none = "d-none";
                                        if (($com == 'thuoctinh') && !isset($disabled['thuoctinh'][$_GET['type']]) && (!isset($config['thuoctinh'][$_GET['type']]['dropdown']) || (isset($config['thuoctinh'][$_GET['type']]['dropdown']) && $config['thuoctinh'][$_GET['type']]['dropdown'] == false))) {
                                            $active = 'active';
                                            $menuopen = 'menu-open';
                                        }
                                    ?>
                                        <li class="nav-item has-treeview <?= $menuopen ?> <?= $none ?>">
                                            <a class="nav-link <?= $active ?>" href="#" title="Quản lý <?= $v['title_main'] ?>">
                                                <i class="nav-icon text-sm fas fa-book"></i>
                                                <p>
                                                    Quản lý thuộc tính
                                                    <i class="right fas fa-angle-left"></i>
                                                </p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <?php
                                                foreach ($value['thuoctinh'] as $k) {
                                                    $v = $config['thuoctinh'][$k];
                                                    $none = "";
                                                    $active = "";
                                                    if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('thuoctinh', 'man', $k, null, 'phrase-1')) $none = "d-none";
                                                    if ($com == 'thuoctinh' && $_GET['type'] == $k && ($act == 'man' || $act == 'add' || $act == 'edit')) $active = "active"; ?>
                                                    <li class="nav-item <?= $none ?>">
                                                        <a class="nav-link <?= $active ?>" href="index.php?com=thuoctinh&act=man&type=<?= $k ?>" title="<?= $v['title_main'] ?>"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                                            <p><?= $v['title_main'] ?></p>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    <?php
                                    } ?>

                                    <!-- Địa chỉ group -->
                                    <?php if (isset($value['places'])) {
                                        $disabled['places'] = 1;
                                        $none = "";
                                        $active = "";
                                        $menuopen = "";
                                        if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('places', 'man', '', $config['places'], 'phrase-2', false)) $none = "d-none";
                                        if (($com == 'places') && !isset($disabled['places'][$_GET['act']]) && (!isset($config['places'][$_GET['act']]['dropdown']) || (isset($config['places'][$_GET['act']]['dropdown']) && $config['places'][$_GET['act']]['dropdown'] == false))) {
                                            $active = 'active';
                                            $menuopen = 'menu-open';
                                        }
                                    ?>
                                        <li class="nav-item has-treeview <?= $menuopen ?> <?= $none ?>">
                                            <a class="nav-link <?= $active ?>" href="#" title="Quản lý <?= $v['title_main'] ?>">
                                                <i class="nav-icon text-sm fas fa-book"></i>
                                                <p>
                                                    Quản lý địa điểm
                                                    <i class="right fas fa-angle-left"></i>
                                                </p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <?php
                                                foreach ($value['places'] as $k) {
                                                    $v = $config['places'][$k];
                                                    $none = "";
                                                    $active = "";
                                                    if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('places', 'man', $k, null, 'phrase-1')) $none = "d-none";
                                                    if ($com == 'places' && $_GET['act'] == $k && ($act == 'man_city' || $act == 'man_district' || $act == 'man_wards')) $active = "active"; ?>
                                                    <li class="nav-item <?= $none ?>">
                                                        <a class="nav-link <?= $active ?>" href="index.php?com=places&act=<?= $k ?>" title="<?= $v['title_main'] ?>"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                                            <p><?= $v['title_main'] ?></p>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    <?php
                                    } ?>
                                    <?php if (isset($value['news'])) {
                                        foreach ($value['news'] as $k) { ?>
                                            <?php
                                            $disabled['news'][$k] = 1;
                                            $v = $config['news'][$k];
                                            $none = "";
                                            $active = "";
                                            $menuopen = "";
                                            if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('news', 'man_list', $k, null, 'phrase-1') && $func->check_access('news', 'man_cat', $k, null, 'phrase-1') && $func->check_access('news', 'man_item', $k, null, 'phrase-1') && $func->check_access('news', 'man_sub', $k, null, 'phrase-1') && $func->check_access('news', 'man', $k, null, 'phrase-1')) $none = "d-none";
                                            if (($com == 'news') && ($k == $_GET['type'])) {
                                                $active = 'active';
                                                $menuopen = 'menu-open';
                                            }
                                            ?>
                                            <li class="nav-item has-treeview <?= $menuopen ?> <?= $none ?>">
                                                <a class="nav-link <?= $active ?>" href="#" title="Quản lý <?= $v['title_main'] ?>">
                                                    <i class="nav-icon text-sm fas fa-book"></i>
                                                    <p>
                                                        Quản lý <?= $v['title_main'] ?>
                                                        <i class="right fas fa-angle-left"></i>
                                                    </p>
                                                </a>
                                                <ul class="nav nav-treeview">
                                                    <?php if (isset($v['list']) && $v['list'] == true) {
                                                        $none = "";
                                                        $active = "";
                                                        if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('news', 'man_list', $k, null, 'phrase-1')) $none = "d-none";
                                                        if ($com == 'news' && ($act == 'man_list' || $act == 'add_list' || $act == 'edit_list' || $kind == 'man_list' || $kind == 'man_list') && $k == $_GET['type']) $active = "active"; ?>
                                                        <li class="nav-item <?= $none ?>"><a class="nav-link <?= $active ?>" href="index.php?com=news&act=man_list&type=<?= $k ?>" title="Danh mục cấp 1"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                                                <p>Danh mục cấp 1</p>
                                                            </a></li>
                                                    <?php } ?>
                                                    <?php if (isset($v['cat']) && $v['cat'] == true) {
                                                        $none = "";
                                                        $active = "";
                                                        if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('news', 'man_cat', $k, null, 'phrase-1')) $none = "d-none";
                                                        if ($com == 'news' && ($act == 'man_cat' || $act == 'add_cat' || $act == 'edit_cat' || $kind == 'man_cat' || $kind == 'man_cat') && $k == $_GET['type']) $active = "active"; ?>
                                                        <li class="nav-item <?= $none ?>"><a class="nav-link <?= $active ?>" href="index.php?com=news&act=man_cat&type=<?= $k ?>" title="Danh mục cấp 2"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                                                <p>Danh mục cấp 2</p>
                                                            </a></li>
                                                    <?php } ?>
                                                    <?php if (isset($v['item']) && $v['item'] == true) {
                                                        $none = "";
                                                        $active = "";
                                                        if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('news', 'man_item', $k, null, 'phrase-1')) $none = "d-none";
                                                        if ($com == 'news' && ($act == 'man_item' || $act == 'add_item' || $act == 'edit_item' || $kind == 'man_item' || $kind == 'man_item') && $k == $_GET['type']) $active = "active"; ?>
                                                        <li class="nav-item <?= $none ?>"><a class="nav-link <?= $active ?>" href="index.php?com=news&act=man_item&type=<?= $k ?>" title="Danh mục cấp 3"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                                                <p>Danh mục cấp 3</p>
                                                            </a></li>
                                                    <?php } ?>
                                                    <?php if (isset($v['sub']) && $v['sub'] == true) {
                                                        $none = "";
                                                        $active = "";
                                                        if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('news', 'man_sub', $k, null, 'phrase-1')) $none = "d-none";
                                                        if ($com == 'news' && ($act == 'man_sub' || $act == 'add_sub' || $act == 'edit_sub' || $kind == 'man_sub' || $kind == 'man_sub') && $k == $_GET['type']) $active = "active"; ?>
                                                        <li class="nav-item <?= $none ?>"><a class="nav-link <?= $active ?>" href="index.php?com=news&act=man_sub&type=<?= $k ?>" title="Danh mục cấp 4"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                                                <p>Danh mục cấp 4</p>
                                                            </a></li>
                                                    <?php } ?>
                                                    <?php
                                                    $none = "";
                                                    $active = "";
                                                    if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('news', 'man', $k, null, 'phrase-1')) $none = "d-none";
                                                    if ($com == 'news' && ($act == 'man' || $act == 'add' || $act == 'edit' || $act == 'copy' || $kind == 'man') && $k == $_GET['type']) $active = "active";
                                                    ?>
                                                    <li class="nav-item <?= $none ?>"><a class="nav-link <?= $active ?>" href="index.php?com=news&act=man&type=<?= $k ?>" title="<?= $v['title_main'] ?>"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                                            <p><?= $v['title_main'] ?></p>
                                                        </a></li>
                                                </ul>
                                            </li>
                                    <?php }
                                    } ?>

                                    <?php if (isset($value['static'])) {
                                        foreach ($value['static'] as $k) { ?>
                                            <?php
                                            $disabled['static'][$k] = 1;
                                            $v = $config['static'][$k];
                                            $none = "";
                                            $active = "";
                                            if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('static', 'capnhat', $k, null, 'phrase-1')) $none = "d-none";
                                            if ($com == 'static' && $k == $_GET['type']) $active = "active";
                                            ?>
                                            <li class="nav-item <?= $none ?>">
                                                <a class="nav-link <?= $active ?>" href="index.php?com=static&act=capnhat&type=<?= $k ?>" title="<?= $v['title_main'] ?>"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                                    <p><?= $v['title_main'] ?></p>
                                                </a>
                                            </li>
                                    <?php }
                                    } ?>

                                    <?php if (isset($value['photo'])) {
                                        foreach ($value['photo'] as $k) {
                                            $disabled['photo'][$k] = 1;
                                            $v = $config['photo']['man_photo'][$k];
                                            $none = "";
                                            $active = "";
                                            if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('photo', 'man_photo', $k, null, 'phrase-1')) $none = "d-none";
                                            if ($com == 'photo' && $_GET['type'] == $k && ($act == 'man_photo' || $act == 'add_photo' || $act == 'edit_photo')) $active = "active"; ?>
                                            <li class="nav-item <?= $none ?>">
                                                <a class="nav-link <?= $active ?>" href="index.php?com=photo&act=man_photo&type=<?= $k ?>" title="<?= $v['title_main_photo'] ?>"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                                    <p><?= $v['title_main_photo'] ?></p>
                                                </a>
                                            </li>
                                    <?php }
                                    } ?>

                                    <?php if (isset($value['photo_static'])) {
                                        foreach ($value['photo_static'] as $k) {
                                            $disabled['photo_static'][$k] = 1;
                                            $v = $config['photo']['photo_static'][$k];
                                            $none = "";
                                            $active = "";
                                            if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('photo', 'photo_static', $k, null, 'phrase-1')) $none = "d-none";
                                            if ($com == 'photo' && $_GET['type'] == $k && $act == 'photo_static') $active = "active"; ?>
                                            <li class="nav-item <?= $none ?>">
                                                <a class="nav-link <?= $active ?>" href="index.php?com=photo&act=photo_static&type=<?= $k ?>" title="<?= $v['title_main'] ?>"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                                    <p><?= $v['title_main'] ?></p>
                                                </a>
                                            </li>
                                    <?php }
                                    } ?>

                                </ul>
                            </li>
                <?php }
                    }
                } ?>

                <!-- Sản phẩm -->
                <?php if (isset($config['product'])) { ?>
                    <?php foreach ($config['product'] as $k => $v) {
                        if (!isset($disabled['product'][$k])) { ?>
                            <?php
                            $none = "";
                            $active = "";
                            $menuopen = "";
                            if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('product', 'man_list', $k, null, 'phrase-1') && $func->check_access('product', 'man_cat', $k, null, 'phrase-1') && $func->check_access('product', 'man_item', $k, null, 'phrase-1') && $func->check_access('product', 'man_sub', $k, null, 'phrase-1') && $func->check_access('product', 'man_brand', $k, null, 'phrase-1') && $func->check_access('product', 'man', $k, null, 'phrase-1') && $func->check_access('import', 'man', $k, null, 'phrase-1') && $func->check_access('export', 'man', $k, null, 'phrase-1')) $none = "d-none";
                            if ((($com == 'product') || ($com == 'import') || ($com == 'export')) && ($k == $_GET['type'])) {
                                $active = 'active';
                                $menuopen = 'menu-open';
                            }
                            ?>
                            <li class="nav-item has-treeview <?= $menuopen ?> <?= $none ?>">
                                <a class="nav-link <?= $active ?>" href="#" title="Quản lý <?= $v['title_main'] ?>">
                                    <i class="nav-icon text-sm fas fa-boxes"></i>
                                    <p>
                                        Quản lý <?= $v['title_main'] ?>
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <?php if (isset($v['list']) && $v['list'] == true) {
                                        $none = "";
                                        $active = "";
                                        if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('product', 'man_list', $k, null, 'phrase-1')) $none = "d-none";
                                        if ($com == 'product' && ($act == 'man_list' || $act == 'add_list' || $act == 'edit_list' || $kind == 'man_list') && $k == $_GET['type']) $active = "active"; ?>
                                        <li class="nav-item <?= $none ?>"><a class="nav-link <?= $active ?>" href="index.php?com=product&act=man_list&type=<?= $k ?>" title="Danh mục cấp 1"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                                <p>Danh mục cấp 1</p>
                                            </a></li>
                                    <?php } ?>
                                    <?php if (isset($v['cat']) && $v['cat'] == true) {
                                        $none = "";
                                        $active = "";
                                        if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('product', 'man_cat', $k, null, 'phrase-1')) $none = "d-none";
                                        if ($com == 'product' && ($act == 'man_cat' || $act == 'add_cat' || $act == 'edit_cat' || $kind == 'man_cat') && $k == $_GET['type']) $active = "active"; ?>
                                        <li class="nav-item <?= $none ?>"><a class="nav-link <?= $active ?>" href="index.php?com=product&act=man_cat&type=<?= $k ?>" title="Danh mục cấp 2"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                                <p>Danh mục cấp 2</p>
                                            </a></li>
                                    <?php } ?>
                                    <?php if (isset($v['item']) && $v['item'] == true) {
                                        $none = "";
                                        $active = "";
                                        if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('product', 'man_item', $k, null, 'phrase-1')) $none = "d-none";
                                        if ($com == 'product' && ($act == 'man_item' || $act == 'add_item' || $act == 'edit_item' || $kind == 'man_item') && $k == $_GET['type']) $active = "active"; ?>
                                        <li class="nav-item <?= $none ?>"><a class="nav-link <?= $active ?>" href="index.php?com=product&act=man_item&type=<?= $k ?>" title="Danh mục cấp 3"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                                <p>Danh mục cấp 3</p>
                                            </a></li>
                                    <?php } ?>
                                    <?php if (isset($v['sub']) && $v['sub'] == true) {
                                        $none = "";
                                        $active = "";
                                        if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('product', 'man_sub', $k, null, 'phrase-1')) $none = "d-none";
                                        if ($com == 'product' && ($act == 'man_sub' || $act == 'add_sub' || $act == 'edit_sub' || $kind == 'man_sub') && $k == $_GET['type']) $active = "active"; ?>
                                        <li class="nav-item <?= $none ?>"><a class="nav-link <?= $active ?>" href="index.php?com=product&act=man_sub&type=<?= $k ?>" title="Danh mục cấp 4"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                                <p>Danh mục cấp 4</p>
                                            </a></li>
                                    <?php } ?>
                                    <?php if (isset($v['brand']) && $v['brand'] == true) {
                                        $none = "";
                                        $active = "";
                                        if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('product', 'man_brand', $k, null, 'phrase-1')) $none = "d-none";
                                        if ($com == 'product' && ($act == 'man_brand' || $act == 'add_brand' || $act == 'edit_brand') && $k == $_GET['type']) $active = "active"; ?>
                                        <li class="nav-item <?= $none ?>"><a class="nav-link <?= $active ?>" href="index.php?com=product&act=man_brand&type=<?= $k ?>" title="Danh mục hãng"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                                <p>Danh mục hãng</p>
                                            </a></li>
                                    <?php } ?>
                                    <?php if (isset($v['mau']) && $v['mau'] == true) {
                                        $none = "";
                                        $active = "";
                                        if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('product', 'man_mau', $k, null, 'phrase-1')) $none = "d-none";
                                        if ($com == 'product' && ($act == 'man_mau' || $act == 'add_mau' || $act == 'edit_mau') && $k == $_GET['type']) $active = "active"; ?>
                                        <li class="nav-item <?= $none ?>"><a class="nav-link <?= $active ?>" href="index.php?com=product&act=man_mau&type=<?= $k ?>" title="Danh mục màu sắc"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                                <p>Danh mục màu sắc</p>
                                            </a></li>
                                    <?php } ?>
                                    <?php if (isset($v['size']) && $v['size'] == true) {
                                        $none = "";
                                        $active = "";
                                        if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('product', 'man_size', $k, null, 'phrase-1')) $none = "d-none";
                                        if ($com == 'product' && ($act == 'man_size' || $act == 'add_size' || $act == 'edit_size') && $k == $_GET['type']) $active = "active"; ?>
                                        <li class="nav-item <?= $none ?>"><a class="nav-link <?= $active ?>" href="index.php?com=product&act=man_size&type=<?= $k ?>" title="Danh mục kích thước"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                                <p>Danh mục kích thước</p>
                                            </a></li>
                                    <?php } ?>
                                    <?php
                                    $none = "";
                                    $active = "";
                                    if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('product', 'man', $k, null, 'phrase-1')) $none = "d-none";
                                    if ($com == 'product' && ($act == 'man' || $act == 'add' || $act == 'edit' || $act == 'copy' || $kind == 'man') && $k == $_GET['type']) $active = "active";
                                    ?>
                                    <li class="nav-item <?= $none ?>"><a class="nav-link <?= $active ?>" href="index.php?com=product&act=man&type=<?= $k ?>" title="<?= $v['title_main'] ?>"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                            <p><?= $v['title_main'] ?></p>
                                        </a></li>
                                    <?php if (isset($v['import']) && $v['import'] == true) {
                                        $none = "";
                                        $active = "";
                                        if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('import', 'man', $k, null, 'phrase-1')) $none = "d-none";
                                        if (($com == 'import') && ($k == $_GET['type'])) $active = "active"; ?>
                                        <li class="nav-item <?= $none ?>">
                                            <a class="nav-link <?= $active ?>" href="index.php?com=import&act=man&type=<?= $k ?>" title="Import"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                                <p>Import</p>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if (isset($v['export']) && $v['export'] == true) {
                                        $none = "";
                                        $active = "";
                                        if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('export', 'man', $k, null, 'phrase-1')) $none = "d-none";
                                        if (($com == 'export') && ($act == 'man') && ($k == $_GET['type'])) $active = "active"; ?>
                                        <li class="nav-item <?= $none ?>">
                                            <a class="nav-link <?= $active ?>" href="index.php?com=export&act=man&type=<?= $k ?>" title="Export"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                                <p>Export</p>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li>
                    <?php }
                    } ?>
                <?php } ?>
                <!-- Thuộc tính -->
                <?php if (isset($config['showthuoctinh']) && $config['showthuoctinh'] == true && !isset($disabled['thuoctinh'])) { ?>
                    <?php
                    $none = "";
                    $active = "";
                    $menuopen = "";
                    if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('thuoctinh', 'man', '', $config['thuoctinh'], 'phrase-2', false)) $none = "d-none";
                    if (($com == 'thuoctinh') && !isset($disabled['thuoctinh'][$_GET['type']]) && (!isset($config['thuoctinh'][$_GET['type']]['dropdown']) || (isset($config['thuoctinh'][$_GET['type']]['dropdown']) && $config['thuoctinh'][$_GET['type']]['dropdown'] == false))) {
                        $active = 'active';
                        $menuopen = 'menu-open';
                    }
                    ?>
                    <li class="nav-item has-treeview <?= $menuopen ?> <?= $none ?>">
                        <a class="nav-link <?= $active ?>" href="#" title="Quản lý bài viết">
                            <i class="nav-icon text-sm fas fa-boxes"></i>
                            <p>
                                Quản lý thuộc tính
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php foreach ($config['thuoctinh'] as $k => $v) {
                                if (!isset($disabled['thuoctinh'][$k]) && (!isset($v['dropdown']) || (isset($v['dropdown']) && $v['dropdown'] == false))) { ?>
                                    <?php
                                    $none = "";
                                    $active = "";
                                    if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('thuoctinh', 'man', $k, null, 'phrase-1')) $none = "d-none";
                                    if ($com == 'thuoctinh' && ($act == 'man' || $act == 'add' || $act == 'edit' || $act == 'copy' || $kind == 'man') && $k == $_GET['type']) $active = "active";
                                    ?>
                                    <li class="nav-item <?= $none ?>">
                                        <a class="nav-link <?= $active ?>" href="index.php?com=thuoctinh&act=man&type=<?= $k ?>" title="<?= $v['title_main'] ?>"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                            <p><?= $v['title_main'] ?></p>
                                        </a>
                                    </li>
                            <?php }
                            } ?>
                        </ul>
                    </li>
                <?php } ?>
                <!-- Bài viết (Có cấp) -->
                <?php if (isset($config['news'])) { ?>
                    <?php foreach ($config['news'] as $k => $v) {
                        if (!isset($disabled['news'][$k])) {
                            if (isset($v['dropdown']) && $v['dropdown'] == true) { ?>
                                <?php
                                $none = "";
                                $active = "";
                                $menuopen = "";
                                if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('news', 'man_list', $k, null, 'phrase-1') && $func->check_access('news', 'man_cat', $k, null, 'phrase-1') && $func->check_access('news', 'man_item', $k, null, 'phrase-1') && $func->check_access('news', 'man_sub', $k, null, 'phrase-1') && $func->check_access('news', 'man', $k, null, 'phrase-1')) $none = "d-none";
                                if (($com == 'news') && ($k == $_GET['type'])) {
                                    $active = 'active';
                                    $menuopen = 'menu-open';
                                }
                                ?>
                                <li class="nav-item has-treeview <?= $menuopen ?> <?= $none ?>">
                                    <a class="nav-link <?= $active ?>" href="#" title="Quản lý <?= $v['title_main'] ?>">
                                        <i class="nav-icon text-sm fas fa-book"></i>
                                        <p>
                                            Quản lý <?= $v['title_main'] ?>
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <?php if (isset($v['list']) && $v['list'] == true) {
                                            $none = "";
                                            $active = "";
                                            if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('news', 'man_list', $k, null, 'phrase-1')) $none = "d-none";
                                            if ($com == 'news' && ($act == 'man_list' || $act == 'add_list' || $act == 'edit_list' || $kind == 'man_list' || $kind == 'man_list') && $k == $_GET['type']) $active = "active"; ?>
                                            <li class="nav-item <?= $none ?>"><a class="nav-link <?= $active ?>" href="index.php?com=news&act=man_list&type=<?= $k ?>" title="Danh mục cấp 1"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                                    <p>Danh mục cấp 1</p>
                                                </a></li>
                                        <?php } ?>
                                        <?php if (isset($v['cat']) && $v['cat'] == true) {
                                            $none = "";
                                            $active = "";
                                            if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('news', 'man_cat', $k, null, 'phrase-1')) $none = "d-none";
                                            if ($com == 'news' && ($act == 'man_cat' || $act == 'add_cat' || $act == 'edit_cat' || $kind == 'man_cat' || $kind == 'man_cat') && $k == $_GET['type']) $active = "active"; ?>
                                            <li class="nav-item <?= $none ?>"><a class="nav-link <?= $active ?>" href="index.php?com=news&act=man_cat&type=<?= $k ?>" title="Danh mục cấp 2"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                                    <p>Danh mục cấp 2</p>
                                                </a></li>
                                        <?php } ?>
                                        <?php if (isset($v['item']) && $v['item'] == true) {
                                            $none = "";
                                            $active = "";
                                            if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('news', 'man_item', $k, null, 'phrase-1')) $none = "d-none";
                                            if ($com == 'news' && ($act == 'man_item' || $act == 'add_item' || $act == 'edit_item' || $kind == 'man_item' || $kind == 'man_item') && $k == $_GET['type']) $active = "active"; ?>
                                            <li class="nav-item <?= $none ?>"><a class="nav-link <?= $active ?>" href="index.php?com=news&act=man_item&type=<?= $k ?>" title="Danh mục cấp 3"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                                    <p>Danh mục cấp 3</p>
                                                </a></li>
                                        <?php } ?>
                                        <?php if (isset($v['sub']) && $v['sub'] == true) {
                                            $none = "";
                                            $active = "";
                                            if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('news', 'man_sub', $k, null, 'phrase-1')) $none = "d-none";
                                            if ($com == 'news' && ($act == 'man_sub' || $act == 'add_sub' || $act == 'edit_sub' || $kind == 'man_sub' || $kind == 'man_sub') && $k == $_GET['type']) $active = "active"; ?>
                                            <li class="nav-item <?= $none ?>"><a class="nav-link <?= $active ?>" href="index.php?com=news&act=man_sub&type=<?= $k ?>" title="Danh mục cấp 4"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                                    <p>Danh mục cấp 4</p>
                                                </a></li>
                                        <?php } ?>
                                        <?php
                                        $none = "";
                                        $active = "";
                                        if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('news', 'man', $k, null, 'phrase-1')) $none = "d-none";
                                        if ($com == 'news' && ($act == 'man' || $act == 'add' || $act == 'edit' || $act == 'copy' || $kind == 'man') && $k == $_GET['type']) $active = "active";
                                        ?>
                                        <li class="nav-item <?= $none ?>"><a class="nav-link <?= $active ?>" href="index.php?com=news&act=man&type=<?= $k ?>" title="<?= $v['title_main'] ?>"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                                <p><?= $v['title_main'] ?></p>
                                            </a></li>
                                    </ul>
                                </li>
                    <?php }
                        }
                    } ?>
                <?php } ?>

                <!-- Bài viết (Không cấp) -->
                <?php if (isset($config['shownews']) && $config['shownews'] == true) { ?>
                    <?php
                    $none = "";
                    $active = "";
                    $menuopen = "";
                    if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('news', 'man', '', $config['news'], 'phrase-2', false)) $none = "d-none";
                    if (($com == 'news') && !isset($disabled['news'][$_GET['type']]) && (!isset($config['news'][$_GET['type']]['dropdown']) || (isset($config['news'][$_GET['type']]['dropdown']) && $config['news'][$_GET['type']]['dropdown'] == false))) {
                        $active = 'active';
                        $menuopen = 'menu-open';
                    }
                    ?>
                    <li class="nav-item has-treeview <?= $menuopen ?> <?= $none ?>">
                        <a class="nav-link <?= $active ?>" href="#" title="Quản lý bài viết">
                            <i class="nav-icon text-sm far fa-newspaper"></i>
                            <p>
                                Quản lý bài viết
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php foreach ($config['news'] as $k => $v) {
                                if (!isset($disabled['news'][$k]) && (!isset($v['dropdown']) || (isset($v['dropdown']) && $v['dropdown'] == false))) { ?>
                                    <?php
                                    $none = "";
                                    $active = "";
                                    if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('news', 'man', $k, null, 'phrase-1')) $none = "d-none";
                                    if ($com == 'news' && ($act == 'man' || $act == 'add' || $act == 'edit' || $act == 'copy' || $kind == 'man') && $k == $_GET['type']) $active = "active";
                                    ?>
                                    <li class="nav-item <?= $none ?>">
                                        <a class="nav-link <?= $active ?>" href="index.php?com=news&act=man&type=<?= $k ?>" title="<?= $v['title_main'] ?>"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                            <p><?= $v['title_main'] ?></p>
                                        </a>
                                    </li>
                            <?php }
                            } ?>
                        </ul>
                    </li>
                <?php } ?>


                <!-- Cart -->
                <?php if (isset($config['order']['active']) && $config['order']['active'] == true) { ?>
                    <?php
                    $none = "";
                    $active = "";
                    if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('order', 'man', '', null, 'phrase-1')) $none = "d-none";
                    if ($com == 'order') $active = 'active';
                    ?>
                    <li class="nav-item <?= $active ?> <?= $none ?>">
                        <a class="nav-link <?= $active ?>" href="index.php?com=order&act=man" title="Quản lý đơn hàng">
                            <i class="nav-icon text-sm fas fa-shopping-bag"></i>
                            <p>Quản lý đơn hàng</p>
                        </a>
                    </li>
                <?php } ?>

                <!-- Tags -->
                <?php if (isset($config['tags'])) { ?>
                    <?php
                    $none = "";
                    $active = "";
                    $menuopen = "";
                    if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('tags', 'man', '', $config['tags'], 'phrase-2')) $none = "d-none";
                    if ($com == 'tags') {
                        $active = 'active';
                        $menuopen = 'menu-open';
                    }
                    ?>
                    <li class="nav-item has-treeview <?= $menuopen ?> <?= $none ?>">
                        <a class="nav-link <?= $active ?>" href="#" title="Quản lý tags">
                            <i class="nav-icon text-sm fas fa-tags"></i>
                            <p>
                                Quản lý tags
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php foreach ($config['tags'] as $k => $v) { ?>
                                <?php
                                $none = "";
                                $active = "";
                                if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('tags', 'man', $k, null, 'phrase-1')) $none = "d-none";
                                if ($com == 'tags' && $k == $_GET['type']) $active = "active";
                                ?>
                                <li class="nav-item <?= $none ?>">
                                    <a class="nav-link <?= $active ?>" href="index.php?com=tags&act=man&type=<?= $k ?>" title="<?= $v['title_main'] ?>"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                        <p><?= $v['title_main'] ?></p>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>

                <!-- Newsletter -->
                <?php if (isset($config['newsletter'])) { ?>
                    <?php
                    $none = "";
                    $active = "";
                    $menuopen = "";
                    if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('newsletter', 'man', '', $config['newsletter'], 'phrase-2')) $none = "d-none";
                    if ($com == 'newsletter') {
                        $active = 'active';
                        $menuopen = 'menu-open';
                    }
                    ?>
                    <li class="nav-item has-treeview <?= $menuopen ?> <?= $none ?>">
                        <a class="nav-link <?= $active ?>" href="#" title="Quản lý nhận tin">
                            <i class="nav-icon text-sm fas fa-envelope"></i>
                            <p>
                                Quản lý nhận tin
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php foreach ($config['newsletter'] as $k => $v) { ?>
                                <?php
                                $none = "";
                                $active = "";
                                if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('newsletter', 'man', $k, null, 'phrase-1')) $none = "d-none";
                                if ($com == 'newsletter' && $k == $_GET['type']) $active = "active";
                                ?>
                                <li class="nav-item <?= $none ?>">
                                    <a class="nav-link <?= $active ?>" href="index.php?com=newsletter&act=man&type=<?= $k ?>" title="<?= $v['title_main'] ?>"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                        <p><?= $v['title_main'] ?></p>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>

                <!-- Static -->
                <?php if (isset($config['static'])) { ?>
                    <?php
                    $none = "";
                    $active = "";
                    $menuopen = "";
                    if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('static', 'capnhat', '', $config['static'], 'phrase-2')) $none = "d-none";
                    if ($com == 'static' && !isset($disabled['static'][$_GET['type']])) {
                        $active = 'active';
                        $menuopen = 'menu-open';
                    }
                    ?>
                    <li class="nav-item has-treeview <?= $menuopen ?> <?= $none ?>">
                        <a class="nav-link <?= $active ?>" href="#" title="Quản lý trang tĩnh">
                            <i class="nav-icon text-sm fas fa-bookmark"></i>
                            <p>
                                Quản lý trang tĩnh
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php foreach ($config['static'] as $k => $v) {
                                if (!isset($disabled['static'][$k])) { ?>
                                    <?php
                                    $none = "";
                                    $active = "";
                                    if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('static', 'capnhat', $k, null, 'phrase-1')) $none = "d-none";
                                    if ($com == 'static' && $k == $_GET['type']) $active = "active";
                                    ?>
                                    <li class="nav-item <?= $none ?>">
                                        <a class="nav-link <?= $active ?>" href="index.php?com=static&act=capnhat&type=<?= $k ?>" title="<?= $v['title_main'] ?>"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                            <p><?= $v['title_main'] ?></p>
                                        </a>
                                    </li>
                            <?php }
                            } ?>
                        </ul>
                    </li>
                <?php } ?>

                <!-- Gallery -->
                <?php if (isset($config['photo'])) { ?>
                    <?php
                    $none = "";
                    $active = "";
                    $menuopen = "";
                    if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('photo', 'photo_static', '', $config['photo']['photo_static'], 'phrase-2') && $func->check_access('photo', 'man_photo', '', $config['photo']['man_photo'], 'phrase-2')) $none = "d-none";
                    if ($com == 'photo' && !isset($disabled['photo'][$_GET['type']]) && !isset($disabled['photo_static'][$_GET['type']])) {
                        $active = 'active';
                        $menuopen = 'menu-open';
                    }
                    ?>
                    <li class="nav-item has-treeview <?= $menuopen ?> <?= $none ?>">
                        <a class="nav-link <?= $active ?>" href="#" title="Quản lý hình ảnh ">
                            <i class="nav-icon text-sm fas fa-photo-video"></i>
                            <p>
                                Quản lý hình ảnh - video
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if (isset($config['photo']['photo_static'])) { ?>
                                <?php foreach ($config['photo']['photo_static'] as $k => $v) {
                                    if (!isset($disabled['photo_static'][$k])) {
                                        $none = "";
                                        $active = "";
                                        if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('photo', 'photo_static', $k, null, 'phrase-1')) $none = "d-none";
                                        if ($com == 'photo' && $_GET['type'] == $k && $act == 'photo_static') $active = "active"; ?>
                                        <li class="nav-item <?= $none ?>">
                                            <a class="nav-link <?= $active ?>" href="index.php?com=photo&act=photo_static&type=<?= $k ?>" title="<?= $v['title_main'] ?>"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                                <p><?= $v['title_main'] ?></p>
                                            </a>
                                        </li>
                                <?php }
                                } ?>
                            <?php } ?>
                            <?php if (isset($config['photo']['man_photo'])) { ?>
                                <?php foreach ($config['photo']['man_photo'] as $k => $v) {
                                    if (!isset($disabled['photo'][$k])) {
                                        $none = "";
                                        $active = "";
                                        if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('photo', 'man_photo', $k, null, 'phrase-1')) $none = "d-none";
                                        if ($com == 'photo' && $_GET['type'] == $k && ($act == 'man_photo' || $act == 'add_photo' || $act == 'edit_photo')) $active = "active"; ?>
                                        <li class="nav-item <?= $none ?>">
                                            <a class="nav-link <?= $active ?>" href="index.php?com=photo&act=man_photo&type=<?= $k ?>" title="<?= $v['title_main_photo'] ?>"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                                <p><?= $v['title_main_photo'] ?></p>
                                            </a>
                                        </li>
                                <?php }
                                } ?>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>

                <!-- Địa điểm -->
                <?php if (isset($config['places']['active']) && $config['places']['active'] == true && !isset($disabled['places'])) { ?>
                    <?php
                    $none = "";
                    $active = "";
                    $menuopen = "";
                    if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('places', 'man_city', '', null, 'phrase-1') && $func->check_access('places', 'man_district', '', null, 'phrase-1') && $func->check_access('places', 'man_wards', '', null, 'phrase-1') && $func->check_access('places', 'man_street', '', null, 'phrase-1')) $none = "d-none";
                    if ($com == 'places') {
                        $active = 'active';
                        $menuopen = 'menu-open';
                    }
                    ?>
                    <li class="nav-item has-treeview <?= $menuopen ?> <?= $none ?>">
                        <a class="nav-link <?= $active ?>" href="#" title="Quản lý địa điểm">
                            <i class="nav-icon text-sm fas fa-building"></i>
                            <p>
                                Quản lý địa điểm
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php
                            if (isset($config['places']['man_city']['active']) && $config['places']['man_city']['active'] == true) {
                                $none = "";
                                $active = "";
                                if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('places', 'man_city', '', null, 'phrase-1')) $none = "d-none";
                                if ($com == 'places' && ($act == 'man_city' || $act == 'add_city' || $act == 'edit_city')) $active = "active";
                            ?>
                                <li class="nav-item <?= $none ?>">
                                    <a class="nav-link <?= $active ?>" href="index.php?com=places&act=man_city" title="Tỉnh thành"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                        <p>Tỉnh thành</p>
                                    </a>
                                </li>
                            <?php }
                            if (isset($config['places']['man_district']['active']) && $config['places']['man_district']['active'] == true) {
                                $none = "";
                                $active = "";
                                if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('places', 'man_district', '', null, 'phrase-1')) $none = "d-none";
                                if ($com == 'places' && ($act == 'man_district' || $act == 'add_district' || $act == 'edit_district')) $active = "active";
                            ?>
                                <li class="nav-item <?= $none ?>">
                                    <a class="nav-link <?= $active ?>" href="index.php?com=places&act=man_district" title="Quận huyện"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                        <p>Quận huyện</p>
                                    </a>
                                </li>
                            <?php }
                            if (isset($config['places']['man_wards']['active']) && $config['places']['man_wards']['active'] == true) {
                                $none = "";
                                $active = "";
                                if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('places', 'man_wards', '', null, 'phrase-1')) $none = "d-none";
                                if ($com == 'places' && ($act == 'man_wards' || $act == 'add_wards' || $act == 'edit_wards')) $active = "active";
                            ?>
                                <li class="nav-item <?= $none ?>">
                                    <a class="nav-link <?= $active ?>" href="index.php?com=places&act=man_wards" title="Phường xã"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                        <p>Phường xã</p>
                                    </a>
                                </li>
                            <?php
                            }
                            if (isset($config['places']['man_street']['active']) && $config['places']['man_street']['active'] == true) {
                                $none = "";
                                $active = "";
                                if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('places', 'man_street', '', null, 'phrase-1')) $none = "d-none";
                                if ($com == 'places' && ($act == 'man_street' || $act == 'add_street' || $act == 'edit_street')) $active = "active";
                            ?>
                                <li class="nav-item <?= $none ?>">
                                    <a class="nav-link <?= $active ?>" href="index.php?com=places&act=man_street" title="Đường"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                        <p>Đường</p>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>

                <!-- User -->
                <?php if (isset($config['user']['active']) && $config['user']['active'] == true && !$func->check_permission()) { ?>
                    <?php
                    $none = "";
                    $active = "";
                    $menuopen = "";
                    if ($com == 'user' && $act != 'login' && $act != 'logout') {
                        $active = 'active';
                        $menuopen = 'menu-open';
                    }
                    ?>
                    <li class="nav-item has-treeview <?= $menuopen ?> <?= $none ?>">
                        <a class="nav-link <?= $active ?>" href="#" title="Quản lý user">
                            <i class="nav-icon text-sm fas fa-users"></i>
                            <p>
                                Quản lý user
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if (isset($config['permission']) && $config['permission'] == true) {
                                $active = "";
                                if ($act == 'permission_group' || $act == 'add_permission_group' || $act == 'edit_permission_group') $active = "active"; ?>
                                <li class="nav-item"><a class="nav-link <?= $active ?>" href="index.php?com=user&act=permission_group" title="Nhóm quyền"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                        <p>Nhóm quyền</p>
                                    </a></li>
                            <?php } ?>
                            <?php
                            $active = "";
                            if ($act == 'admin_edit') $active = "active";
                            ?>
                            <li class="nav-item"><a class="nav-link <?= $active ?>" href="index.php?com=user&act=admin_edit" title="Thông tin admin"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p>Thông tin admin</p>
                                </a></li>
                            <?php if (isset($config['user']['admin']) && $config['user']['admin'] == true) {
                                $active = "";
                                if ($act == 'man_admin' || $act == 'add_admin' || $act == 'edit_admin') $active = "active"; ?>
                                <li class="nav-item"><a class="nav-link <?= $active ?>" href="index.php?com=user&act=man_admin" title="Tài khoản admin"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                        <p>Tài khoản admin</p>
                                    </a></li>
                            <?php } ?>
                            <?php if (isset($config['user']['visitor']) && $config['user']['visitor'] == true) {
                                $active = "";
                                if ($com == 'user' && ($act == 'man' || $act == 'add' || $act == 'edit')) $active = "active"; ?>
                                <li class="nav-item"><a class="nav-link <?= $active ?>" href="index.php?com=user&act=man" title="Tài khoản khách"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                        <p>Tài khoản khách</p>
                                    </a></li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>

                <!-- Onesignal -->
                <?php if (isset($config['onesignal']) && $config['onesignal'] == true) { ?>
                    <?php
                    $none = "";
                    $active = "";
                    if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('pushOnesignal', 'man', '', null, 'phrase-1')) $none = "d-none";
                    if ($com == 'pushOnesignal') $active = 'active';
                    ?>
                    <li class="nav-item <?= $active ?> <?= $none ?>">
                        <a class="nav-link <?= $active ?>" href="index.php?com=pushOnesignal&act=man" title="Quản lý thông báo đẩy">
                            <i class="nav-icon text-sm fas fa-bell"></i>
                            <p>Quản lý thông báo đẩy</p>
                        </a>
                    </li>
                <?php } ?>

                <!-- SEO page -->
                <?php if (isset($config['seopage']) && count($config['seopage']['page']) > 0) { ?>
                    <?php
                    $none = "";
                    $active = "";
                    $menuopen = "";
                    if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('seopage', 'capnhat', '', $config['seopage']['page'], 'phrase-2')) $none = "d-none";
                    if ($com == 'seopage') {
                        $active = 'active';
                        $menuopen = 'menu-open';
                    }
                    ?>
                    <li class="nav-item has-treeview <?= $menuopen ?> <?= $none ?>">
                        <a class="nav-link <?= $active ?>" href="#" title="Quản lý SEO page">
                            <i class="nav-icon text-sm fas fa-share-alt"></i>
                            <p>
                                Quản lý SEO page
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php foreach ($config['seopage']['page'] as $k => $v) { ?>
                                <?php
                                $none = "";
                                $active = "";
                                if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('seopage', 'capnhat', $k, null, 'phrase-1')) $none = "d-none";
                                if ($com == 'seopage' && $k == $_GET['type']) $active = "active";
                                ?>
                                <li class="nav-item <?= $none ?>">
                                    <a class="nav-link <?= $active ?>" href="index.php?com=seopage&act=capnhat&type=<?= $k ?>" title="<?= $v ?>"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                        <p><?= $v ?></p>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>

                <!-- Thiết lập thông tin -->
                <?php
                $none = "";
                $active = "";
                if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('setting', 'capnhat', '', null, 'phrase-1')) $none = "d-none";
                if ($com == 'setting') $active = 'active';
                ?>
                <li class="nav-item <?= $active ?> <?= $none ?>">
                    <a class="nav-link <?= $active ?>" href="index.php?com=setting&act=capnhat" title="Thiết lập thông tin">
                        <i class="nav-icon text-sm fas fa-cogs"></i>
                        <p>Thiết lập thông tin</p>
                    </a>
                </li>
                <!-- Comment đánh giá -->
                <?php
                if (isset($config['comment']['active']) && $config['comment']['active'] == true) {
                $none = "";
                $active = "";
                if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('comment', 'man', '', null, 'phrase-1')) $none = "d-none";
                if ($com == 'comment') $active = 'active';
                ?>
                <li class="nav-item <?= $active ?> <?= $none ?>">
                    <a class="nav-link <?= $active ?>" href="index.php?com=comment&act=man&type=rating" title="Comment đánh giá">
                        <i class="nav-icon far fa-comments"></i>
                        <p>Comment đánh giá</p>
                    </a>
                </li>
            <?php } ?>
            </ul>
        </nav>
    </div>
</aside>

<script type="text/javascript">
    $(document).ready(function() {
        if ($(".menu-group").length) {
            var navlink = $(".menu-group").find(".nav-link.active").first();
            if (navlink.length) {
                var menugroup = navlink.parents(".menu-group");
                menugroup.addClass("menu-open");
                menugroup.find(">.nav-link").addClass("active");
            }
        }
    })
</script>