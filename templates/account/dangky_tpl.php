<div class="wrap-user wrap-user-dk">
    <div class="title-user">
        <span><?= dangky ?></span>
    </div>
    <form class="form-user validation-user" novalidate method="post" action="account/dang-ky" enctype="multipart/form-data" autocomplete="off">
        <div class="input-group input-user">
            <i class="fa fa-user"></i>
            <input type="text" class="form-control" id="ten" name="ten" placeholder="<?= nhaphoten ?>" required>
            <div class="invalid-feedback"><?= vuilongnhaphoten ?></div>
        </div>
        <div class="input-group input-user">
            <i class="fa fa-envelope"></i>
            <input type="email" class="form-control" id="email" name="email" placeholder="<?= nhapemail ?>" required autocomplete="off">
            <div class="invalid-feedback"><?= vuilongnhapdiachiemail ?></div>
        </div>
        <div class="input-group input-user">
            <i class="fa fa-lock"></i>
            <input type="password" class="form-control" id="password" name="password" placeholder="<?= nhapmatkhau ?>" required>
            <div class="invalid-feedback"><?= vuilongnhapmatkhau ?></div>
        </div>
        <div class="input-group input-user">
            <i class="fa fa-lock"></i>
            <input type="password" class="form-control" id="repassword" name="repassword" placeholder="<?= nhaplaimatkhau ?>" required>
            <div class="invalid-feedback"><?= vuilongnhaplaimatkhau ?></div>
        </div>
        <div class="button-user">
            <input type="submit" class="btn  btn-block" name="dangky" value="<?= dangky ?>" disabled>
        </div>
    </form>
</div>