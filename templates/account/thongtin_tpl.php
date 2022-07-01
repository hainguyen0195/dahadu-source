<div class="container">
    <div class="flex_row row-users">
        <div class="col-users-left">
            <?php include TEMPLATE . "account/menu_tpl.php"; ?>
        </div>
        <div class="col-users-right">
            <div class="wrap-user">
                <div class="title-user">
                    <span><?= thongtincanhan ?></span>
                </div>
                <form class="form-user validation-user" novalidate method="post" action="account/thong-tin" enctype="multipart/form-data">
                    <div class="input-group input-user">
                        <i class="fa fa-user"></i>
                        <input type="text" class="form-control" id="ten" name="ten" placeholder="<?= nhaphoten ?>" value="<?= $row_detail['ten'] ?>" required>
                        <div class="invalid-feedback"><?= vuilongnhaphoten ?></div>
                    </div>
                    <div class="input-group input-user">
                        <i class="fa fa-envelope"></i>
                        <input type="email" class="form-control" id="email" name="email" placeholder="<?= nhapemail ?>" value="<?= $row_detail['email'] ?>" required>
                        <div class="invalid-feedback"><?= vuilongnhapdiachiemail ?></div>
                    </div>
                    <div class="input-group input-user">
                        <i class="fa fa-lock"></i>
                        <input type="password" class="form-control" id="password" name="password" placeholder="<?= nhapmatkhaucu ?>">
                    </div>
                    <div class="input-group input-user">
                        <i class="fa fa-lock"></i>
                        <input type="password" class="form-control" id="new-password" name="new-password" placeholder="<?= nhapmatkhaumoi ?>">
                    </div>
                    <div class="input-group input-user">
                        <i class="fa fa-lock"></i>
                        <input type="password" class="form-control" id="new-password-confirm" name="new-password-confirm" placeholder="<?= nhaplaimatkhaumoi ?>">
                    </div>
                    <div class="flex_row row_gioitinh_ngaysinh">
                        <div class="col_gtns">
                            <div class="input-group input-user">
                                <div class="radio-user custom-control custom-radio">
                                    <input type="radio" id="nam" name="gioitinh" class="custom-control-input" <?= ($row_detail['gioitinh'] == 1) ? 'checked' : '' ?> value="1" required>
                                    <label class="custom-control-label" for="nam"><?= nam ?></label>
                                </div>
                                <div class="radio-user custom-control custom-radio">
                                    <input type="radio" id="nu" name="gioitinh" class="custom-control-input" <?= ($row_detail['gioitinh'] == 2) ? 'checked' : '' ?> value="2" required>
                                    <label class="custom-control-label" for="nu"><?= nu ?></label>
                                </div>
                            </div>
                        </div>
                        <div class="col_gtns">
                            <div class="input-group input-user">
                                <i class="fa fa-lock"></i>
                                <input type="text" class="form-control" id="ngaysinh" name="ngaysinh" placeholder="<?= nhapngaysinh ?>" value="<?= date("d/m/Y", $row_detail['ngaysinh']) ?>" required>
                                <div class="invalid-feedback"><?= vuilongnhapsodienthoai ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="input-group input-user">
                        <i class="fa fa-phone-square"></i>
                        <input type="number" class="form-control" id="dienthoai" name="dienthoai" placeholder="<?= nhapdienthoai ?>" value="<?= $row_detail['dienthoai'] ?>" required>
                        <div class="invalid-feedback"><?= vuilongnhapsodienthoai ?></div>
                    </div>
                    <div class="input-group input-user">
                        <i class="fa fa-map"></i>
                        <input type="text" class="form-control" id="diachi" name="diachi" placeholder="<?= nhapdiachi ?>" value="<?= $row_detail['diachi'] ?>" required>
                        <div class="invalid-feedback"><?= vuilongnhapdiachi ?></div>
                    </div>
                    <div class="button-user">
                        <input type="submit" class="btn btn-primary btn-block" name="capnhatthongtin" value="<?= capnhat ?>" disabled>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>