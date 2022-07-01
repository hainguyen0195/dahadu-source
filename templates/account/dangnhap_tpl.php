<div class="wrap-user">
    <div class="title-user d-flex align-items-end justify-content-between">
        <span><?=dangnhap?></span>
    </div>
    <form class="form-user validation-user" novalidate method="post" action="account/dang-nhap" enctype="multipart/form-data">
        <div class="input-group input-user">
            <i class="fa fa-user"></i>
            <input type="text" class="form-control" id="username" name="username" placeholder="<?=taikhoan?>" value="<?=(isset($_COOKIE['login_member_username']) && $_COOKIE['login_member_username'] != '') ? htmlspecialchars_decode($_COOKIE['login_member_username']) : ''?>" required>
            <div class="invalid-feedback"><?=vuilongnhaptaikhoan?></div>
        </div>
        <div class="input-group input-user">
            <i class="fa fa-lock"></i>
            <input type="password" class="form-control" id="password" name="password" placeholder="<?=matkhau?>" required value="<?=(isset($_COOKIE['login_member_password']) && $_COOKIE['login_member_password'] != '') ? htmlspecialchars_decode($_COOKIE['login_member_password']) : ''?>" >
            <div class="invalid-feedback"><?=vuilongnhapmatkhau?></div>
        </div>
        <div class="flex_row row_gioitinh_ngaysinh">
            <div class="col_gtns">
                <div class="button-user button-userleft">
                    <input type="submit" class="btn btn-primary" name="dangnhap" value="<?=dangnhap?>" disabled>
                </div>
            </div>
            <div class="col_gtns flex_row">
                <div class="checkbox-user custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="remember-user" id="remember-user" value="1"checked>
                    <label class="custom-control-label" for="remember-user"><?=nhomatkhau?></label>
                </div>
                <a href="account/quen-mat-khau" title="<?=quenmatkhau?>"><?=quenmatkhau?> ?</a>
            </div>
        </div>
        <div class="note-user">
            <span><?=banchuacotaikhoan?> ! </span>
            <a href="account/dang-ky" title="<?=dangkytaiday?>"><?=dangkytaiday?></a>
        </div>
    </form>
</div>