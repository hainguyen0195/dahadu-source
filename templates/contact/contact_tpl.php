<div class="container">
    <div class="title-main"><span><?=$title_crumb?></span></div>
    <div class="top-contact row rowrp">
        <div class="article-contact col-md-6 col-sm-6 col-xs-12"><?=(isset($lienhe['noidung'.$lang]) && $lienhe['noidung'.$lang] != '') ? htmlspecialchars_decode($lienhe['noidung'.$lang]) : ''?></div>
        <div class="form_contact col-md-6 col-sm-6 col-xs-12">
            <form class="form-contact validation-contact" novalidate method="post" action="" enctype="multipart/form-data" autocomplete="off">
                <div class="row row_label_input">
                    <div class="input-contact col-sm-6 col-xs-12 label_input">
                        <input type="text" class="form-control" id="ten" name="ten" required />
                        <label for="ten"><span><?=hoten?></span></label>
                        <div class="invalid-feedback"><?=vuilongnhaphoten?></div>
                    </div>
                    <div class="input-contact col-sm-6 col-xs-12  label_input">
                        <input type="text" class="form-control" id="dienthoai" name="dienthoai" required />
                        <label for="dienthoai"><span><?=sodienthoai?></span></label>
                        <div class="invalid-feedback"><?=vuilongnhapsodienthoai?></div>
                    </div>         
                </div>
                <div class="row">
                    <div class="input-contact col-sm-6 col-xs-12  label_input">
                        <input type="text" class="form-control" id="diachi" name="diachi" required />
                        <label for="diachi"><span><?=diachi?></span></label>
                        <div class="invalid-feedback"><?=vuilongnhapdiachi?></div>
                    </div>
                    <div class="input-contact col-sm-6 col-xs-12  label_input">
                        <input type="email" class="form-control" id="email" name="email" required />
                        <label for="email"><span>Email</span></label>
                        <div class="invalid-feedback"><?=vuilongnhapdiachiemail?></div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-contact col-xs-12 label_input">
                        <input type="text" class="form-control" id="tieude" name="tieude" required />
                        <label for="tieude"><span><?=chude?></span></label>
                        <div class="invalid-feedback"><?=vuilongnhapchude?></div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-contact col-xs-12 label_input">
                        <textarea class="form-control" id="noidung" name="noidung" required /></textarea>
                        <label for="noidung"><span><?=noidung?></span></label>
                        <div class="invalid-feedback"><?=vuilongnhapnoidung?></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="input-contact ">
                            <input type="file" class="custom-file-input" name="file">
                        </div>
                    </div>
                </div>
                <div class="btn_input-contact flex">
                    <input type="submit" class="btn btn-primary" name="submit-contact" value="<?=gui?>" disabled />
                    <input type="reset" class="btn btn-secondary" value="<?=nhaplai?>" />
                    <input type="hidden" name="recaptcha_response_contact" id="recaptchaResponseContact">
                </div>
            </form>
        </div>
    </div>
</div>