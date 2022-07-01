<?php
	if(!defined('SOURCES')) die("Error");

	$action = htmlspecialchars($match['params']['action']);

	switch($action)
	{
		case 'dang-nhap':
			$title_crumb = dangnhap;
			$template = "account/dangnhap";
			if(isset($_SESSION[$login_member]['active']) && $_SESSION[$login_member]['active'] == true) $func->transfer(bandadangnhap,$config_base, false);
			if(isset($_POST['dangnhap'])) login();
			break;

		case 'dang-ky':
			$title_crumb = dangky;
			$template = "account/dangky";
			if(isset($_SESSION[$login_member]['active']) && $_SESSION[$login_member]['active'] == true) $func->transfer(bandadangnhap,$config_base, false);
			if(isset($_POST['dangky'])) signup();
			break;

		case 'quen-mat-khau':
			$title_crumb = quenmatkhau;
			$template = "account/quenmatkhau";
			if(isset($_SESSION[$login_member]['active']) && $_SESSION[$login_member]['active'] == true) $func->transfer(trangkhongtontai,$config_base, false);
			if(isset($_POST['quenmatkhau'])) doimatkhau_user();
			break;

		case 'kich-hoat':
			$title_crumb = kichhoat;
			$template = "account/kichhoat";
			// if(isset($_SESSION[$login_member]['active']) && $_SESSION[$login_member]['active'] == true) $func->transfer("Trang không tồn tại",$config_base, false);
			if(isset($_POST['kichhoat'])) active_user();
			break;

		case 'thong-tin':
			if(!isset($_SESSION[$login_member]['active']) || !$_SESSION[$login_member]['active']) $func->transfer(banchuadangnhap,$config_base, false);
			$template = "account/thongtin";
			$title_crumb = capnhatthongtin;
			info_user();
			break;

		case 'dang-xuat':
			if(!isset($_SESSION[$login_member]['active']) || !$_SESSION[$login_member]['active']) $func->transfer(banchuadangnhap,$config_base, false);
			logout();
		case 'yeu-thich':
			if(!isset($_SESSION[$login_member]['active']) || !$_SESSION[$login_member]['active']) $func->transfer(banchuadangnhap,$config_base, false);
			$template = "account/xem_yeuthich";
			$title_crumb = sanphamyeuthich;
			product_like_view('liked');
			break;
		case 'da-xem':
			if(!isset($_SESSION[$login_member]['active']) || !$_SESSION[$login_member]['active']) $func->transfer(banchuadangnhap,$config_base, false);
			$template = "account/xem_yeuthich";
			$title_crumb = sanphamdaxem;
			product_like_view('viewed');
			break;
		case 'lich-su-mua-hang':
			if(!isset($_SESSION[$login_member]['active']) || !$_SESSION[$login_member]['active']) $func->transfer(banchuadangnhap,$config_base, false);
			$template = "account/lichsumuahang";
			$title_crumb = lichsumuahang;
			lichsumuahang();
			break;
		default:
			header('HTTP/1.0 404 Not Found', true, 404);
			include("404.php");
			exit();
	}

	/* SEO */
	$seo->setSeo('title',$title_crumb);

	/* breadCrumbs */
	if(isset($title_crumb) && $title_crumb != '') $breadcr->setBreadCrumbs('',$title_crumb);
	$breadcrumbs = $breadcr->getBreadCrumbs();

	function product_like_view($keydl='liked')
	{
		global $d, $func, $ds_sp, $config_base, $login_member;
		$if_tv = $d->rawQueryOne("select liked,viewed,id from #_member where id = ? limit 0,1",array($_SESSION[$login_member]['id']));
		if($if_tv['id']!=''){

			if($if_tv[$keydl]){
				$ds_sp[]=array();
				$ds_sp = explode(",", $if_tv[$keydl]) ;
			}
			
		}
	}
	function lichsumuahang()
	{
		global $d, $ds_order, $login_member;
		
		$ds_order = $d->rawQuery("select * from #_order where id_user = ? order by stt,id desc",array($_SESSION[$login_member]['id']));
	}
	function info_user()
	{
		global $d, $func, $row_detail, $config_base, $login_member;

		$iduser = $_SESSION[$login_member]['id'];

		if($iduser)
		{
			$row_detail = $d->rawQueryOne("select ten, username, gioitinh, ngaysinh, email, dienthoai, diachi from #_member where id = ? limit 0,1",array($iduser));

		    if(isset($_POST['capnhatthongtin']))
		    {
		    	$password = (isset($_POST['password'])) ? htmlspecialchars($_POST['password']) : '';
		    	$passwordMD5 = md5($password);
	            $new_password = (isset($_POST['new-password'])) ? htmlspecialchars($_POST['new-password']) : '';
	            $new_passwordMD5 = md5($new_password);
	            $new_password_confirm = (isset($_POST['new-password-confirm'])) ? htmlspecialchars($_POST['new-password-confirm']) : '';

		        if($password)
		        {
		            $row = $d->rawQueryOne("select id from #_member where id = ? and password = ? limit 0,1",array($iduser,$passwordMD5));

		            if(!$row['id']) $func->transfer(matkhaucukhongchinhxac,"", false);
		            if(!$new_password || ($new_password != $new_password_confirm)) $func->transfer(matkhaumoikhongchinhxac,"", false);

		            $data['password'] = $new_passwordMD5;
		        }

		        $data['email'] = (isset($_POST['email'])) ? htmlspecialchars($_POST['email']) : '';
		        // lay danh sach user de kiem tra email trung
		        $ds_us = $d->rawQuery("select username, email from #_member ");
		        foreach ($ds_us as $k => $v) {
		        	if($v['email']==$data['email'] && $data['email']!=$row_detail['email'] ){
		        		 $func->transfer(emaildatontai,"", false);
		        	}
		        }


		        $data['ten'] = (isset($_POST['ten'])) ? htmlspecialchars($_POST['ten']) : '';
		        $data['diachi'] = (isset($_POST['diachi'])) ? htmlspecialchars($_POST['diachi']) : '';
		        $data['dienthoai'] = (isset($_POST['dienthoai'])) ? htmlspecialchars($_POST['dienthoai']) : 0;
		        $data['ngaysinh'] = (isset($_POST['ngaysinh'])) ? strtotime(str_replace("/","-",htmlspecialchars($_POST['ngaysinh']))) : 0;
		        $data['gioitinh'] = (isset($_POST['gioitinh'])) ? htmlspecialchars($_POST['gioitinh']) : 0;

		        $d->where('id', $iduser);
		        if($d->update('member',$data))
		        {
		        	if($password)
		        	{
			            unset($_SESSION[$login_member]);
			            setcookie('login_member_id',"",-1,'/');
						setcookie('login_member_session',"",-1,'/');
		            	$func->transfer(capnhatthongtinthanhcong,$config_base."account/dang-nhap");
		        	}
		        	$func->transfer(capnhatthongtinthanhcong,$config_base."account/thong-tin");	            
		        }
		    }
		}
		else
		{
			$func->transfer(trangkhongtontai,$config_base, false);
		}
	}

	function active_user()
	{
		global $d, $func, $row_detail, $config_base;

		$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;
		$maxacnhan = (isset($_POST['maxacnhan'])) ? htmlspecialchars($_POST['maxacnhan']) : '';

		/* Kiểm tra thông tin */
        $row_detail = $d->rawQueryOne("select hienthi, maxacnhan, id from #_member where id = ? limit 0,1",array($id));

        if(!$row_detail['id']) $func->transfer(taikhoankhongtontai,$config_base, false);
        else if($row_detail['hienthi']==1) $func->transfer(taikhoandaduockichhoattruocdo,$config_base);
        else
        {
    		if($row_detail['maxacnhan'] == $maxacnhan)
        	{
        		$data['hienthi'] = 1;
        		$data['maxacnhan'] = '';
				$d->where('id', $id);
				if($d->update('member',$data)) $func->transfer(kichhoatthanhcong,$config_base."account/dang-nhap");
        	}
        	else
        	{
        		$func->transfer(maxacnhankhongdungnhaplai,$config_base."account/kich-hoat?id=".$id, false);
        	}
        }
	}

	function login()
	{
		global $d, $func, $login_member, $config_base;

		$username = (isset($_POST['username'])) ? htmlspecialchars($_POST['username']) : '';
		$password = (isset($_POST['password'])) ? htmlspecialchars($_POST['password']) : '';
		$passwordMD5 = md5($password);
		$remember = (isset($_POST['remember-user'])) ? htmlspecialchars($_POST['remember-user']) : false;

		if(!$username) $func->transfer(chuanhaptentk,'account/dang-nhap', false);
		if(!$password) $func->transfer(chuanhapmk,'account/dang-nhap', false);
		
		$row = $d->rawQueryOne("select id, password, username, dienthoai, diachi, email, ten from #_member where email = ? and hienthi > 0 limit 0,1",array($username));

		if($row['id'])
		{
			if($row['password'] == $passwordMD5)
			{
				/* Tạo login session */
				$id_user = $row['id'];
				$lastlogin = time();
				$login_session = md5($row['password'].$lastlogin);
				$d->rawQuery("update #_member set login_session = ?, lastlogin = ? where id = ?",array($login_session,$lastlogin,$id_user));

				/* Lưu session login */
				$_SESSION[$login_member]['active'] = true;
				$_SESSION[$login_member]['id'] = $row['id'];
				$_SESSION[$login_member]['username'] = $row['username'];
				$_SESSION[$login_member]['dienthoai'] = $row['dienthoai'];
				$_SESSION[$login_member]['diachi'] = $row['diachi'];
				$_SESSION[$login_member]['email'] = $row['email'];
				$_SESSION[$login_member]['ten'] = $row['ten'];
				$_SESSION[$login_member]['login_session'] = $login_session;

				/* Nhớ mật khẩu */
				setcookie('login_member_id',"",-1,'/');
				setcookie('login_member_session',"",-1,'/');
				if($remember)
				{
					$time_expiry = time()+3600*24;
					setcookie('login_member_id',$row['id'],$time_expiry,'/');
					setcookie('login_member_session',$login_session,$time_expiry,'/');
					setcookie('login_member_username',$row['username'],$time_expiry,'/');
					setcookie('login_member_password',$password,$time_expiry,'/');
				}

				$func->transfer(dangnhapthanhcong, $config_base);
			}
			else
			{
				$func->transfer(tdkmktkchuachinhxac, $config_base."account/dang-nhap", false);
			}
		}
		else
		{
			$func->transfer(tdkmktkchuachinhxac, $config_base."account/dang-nhap", false);
		}
	}

	function signup()
	{
		global $d, $func, $config_base;

		$username = (isset($_POST['username'])) ? htmlspecialchars($_POST['username']) : '';
		$password = (isset($_POST['password'])) ? htmlspecialchars($_POST['password']) : '';
		$passwordMD5 = md5($password);
		$repassword = (isset($_POST['repassword'])) ? htmlspecialchars($_POST['repassword']) : '';
		$email = (isset($_POST['email'])) ? htmlspecialchars($_POST['email']) : '';
		$maxacnhan = $func->digitalRandom(0,3,6);

		if($password != $repassword) $func->transfer(xnmkkhongtrung, $config_base."account/dang-ky", false);

		/* Kiểm tra tên đăng ký */
		$row = $d->rawQueryOne("select id from #_member where username = ? limit 0,1",array($username));
		if($row['id']) $func->transfer(tdndatontai, $config_base."account/dang-ky", false);

		/* Kiểm tra email đăng ký */
		$row = $d->rawQueryOne("select id from #_member where email = ? limit 0,1",array($email));
		if($row['id']) $func->transfer(emaildatontai, $config_base."account/dang-ky", false);

		$data['ten'] = (isset($_POST['ten'])) ? htmlspecialchars($_POST['ten']) : '';
		$data['username'] = $username;
		$data['password'] = md5($password);
		$data['email'] = $email;
		$data['dienthoai'] = (isset($_POST['dienthoai'])) ? htmlspecialchars($_POST['dienthoai']) : 0;
		$data['diachi'] = (isset($_POST['diachi'])) ? htmlspecialchars($_POST['diachi']) : '';
		$data['gioitinh'] = (isset($_POST['gioitinh'])) ? htmlspecialchars($_POST['gioitinh']) : 0;
		$data['ngaysinh'] = (isset($_POST['ngaysinh'])) ? strtotime(str_replace("/","-",$_POST['ngaysinh'])) : 0;
		$data['maxacnhan'] = $maxacnhan;
		$data['hienthi'] = 0;
		
		if($d->insert('member',$data))
		{
			send_active_user($username);
			$func->transfer(kytvtcvuilongkt.' '.$data['email'].' '.dekichhoattk, $config_base."account/dang-nhap");
		}
		else
		{
			$func->transfer(dktvthatbai, $config_base, false);
		}
	}

	function send_active_user($username)
	{
		global $d, $setting, $emailer, $func, $config_base, $lang;

		/* Lấy thông tin người dùng */
		$row = $d->rawQueryOne("select id, maxacnhan, username, password, ten, email, dienthoai, diachi from #_member where username = ? limit 0,1",array($username));

		/* Gán giá trị gửi email */
		$iduser = $row['id'];
		$maxacnhan = $row['maxacnhan'];
		$tendangnhap = $row['username'];
		$matkhau = $row['password'];
		$tennguoidung = $row['ten'];
		$emailnguoidung = $row['email'];
		$dienthoainguoidung = $row['dienthoai'];
		$diachinguoidung = $row['diachi'];
		$linkkichhoat = $config_base."account/kich-hoat?id=".$iduser;

		/* Thông tin đăng ký */
		$thongtindangky='<td style="padding:3px 9px 9px 0px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top"><span style="text-transform:normal">Username: '.$tendangnhap.'</span><br>Mã kích hoạt: '.$maxacnhan.'</td><td style="padding:3px 0px 9px 9px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">';
		if($tennguoidung)
		{
			$thongtindangky.='<span style="text-transform:capitalize">'.$tennguoidung.'</span><br>';
		}
		if($emailnguoidung)
		{
			$thongtindangky.='<a href="mailto:'.$emailnguoidung.'" target="_blank">'.$emailnguoidung.'</a><br>';
		}
		if($diachinguoidung)
		{
			$thongtindangky.=$diachinguoidung.'<br>';
		}
		if($dienthoainguoidung)
		{
			$thongtindangky.='Tel: '.$dienthoainguoidung.'</td>';
		}

		$contentMember = '
		<table align="center" bgcolor="#dcf0f8" border="0" cellpadding="0" cellspacing="0" style="margin:0;padding:0;background-color:#f2f2f2;width:100%!important;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px" width="100%">
			<tbody>
				<tr>
					<td align="center" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">
						<table border="0" cellpadding="0" cellspacing="0" style="margin-top:15px" width="600">
							<tbody>
								<tr>
									<td align="center" id="m_-6357629121201466163headerImage" valign="bottom">
										<table cellpadding="0" cellspacing="0" style="border-bottom:3px solid '.$emailer->getEmail('color').';padding-bottom:10px;background-color:#fff" width="100%">
											<tbody>
												<tr>
													<td bgcolor="#FFFFFF" style="padding:0" valign="top" width="100%">
														<div style="color:#fff;background-color:f2f2f2;font-size:11px">&nbsp;</div>
														<div style="display:flex;justify-content:space-between;align-items:center;">
															<table style="width:100%;">
																<tbody>
																	<tr>
																		<td>
																			<a href="'.$emailer->getEmail('home').'" style="border:medium none;text-decoration:none;color:#007ed3;margin:0px 0px 0px 20px" target="_blank">'.$emailer->getEmail('logo').'</a>
																		</td>
																		<td style="padding:15px 20px 0 0;text-align:right">'.$emailer->getEmail('social').'</td>
																	</tr>
																</tbody>
															</table>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr style="background:#fff">
									<td align="left" height="auto" style="padding:15px" width="600">
										<table>
											<tbody>
												<tr>
													<td>
														<h1 style="font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0">Cảm ơn quý khách đã đăng ký tại '.$emailer->getEmail('company:website').'</h1>
														<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">Thông tin tài khoản của quý khách đã được '.$emailer->getEmail('company:website').' cập nhật. Quý khách vui lòng kích hoạt tài khoản bằng cách truy cập vào đường link phía dưới.</p>
														<h3 style="font-size:13px;font-weight:bold;color:'.$emailer->getEmail('color').';text-transform:uppercase;margin:20px 0 0 0;padding: 0 0 5px;border-bottom:1px solid #ddd">Thông tin tài khoản <span style="font-size:12px;color:#777;text-transform:none;font-weight:normal">(Ngày '.date('d',$emailer->getEmail('datesend')).' tháng '.date('m',$emailer->getEmail('datesend')).' năm '.date('Y H:i:s',$emailer->getEmail('datesend')).')</span></h3>
													</td>
												</tr>
											<tr>
											<td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
											<table border="0" cellpadding="0" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th align="left" style="padding:6px 9px 0px 0px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">Thông tin tài khoản</th>
														<th align="left" style="padding:6px 0px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">Thông tin người dùng</th>
													</tr>
												</thead>
												<tbody>
													<tr>'.$thongtindangky.'</tr>
												</tbody>
											</table>
											</td>
										</tr>
										<tr>
											<td>
											<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><i>Lưu ý: Quý khách vui lòng truy cập vào đường link phía dưới để hoàn tất quá trình đăng ký tài khoản.</i>
											<div style="margin:auto"><a href="'.$linkkichhoat.'" style="display:inline-block;text-decoration:none;background-color:'.$emailer->getEmail('color').'!important;margin-right:30px;text-align:center;border-radius:3px;color:#fff;padding:5px 10px;font-size:12px;font-weight:bold;margin-left:38%;margin-top:5px" target="_blank">Kích hoạt tài khoản</a></div>
											</p>
											</td>
										</tr>
										<tr>
											<td>&nbsp;
												<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;border:1px '.$emailer->getEmail('color').' dashed;padding:10px;list-style-type:none">Bạn cần được hỗ trợ ngay? Chỉ cần gửi mail về <a href="mailto:'.$emailer->getEmail('company:email').'" style="color:'.$emailer->getEmail('color').';text-decoration:none" target="_blank"> <strong>'.$emailer->getEmail('company:email').'</strong> </a>, hoặc gọi về hotline <strong style="color:'.$emailer->getEmail('color').'">'.$emailer->getEmail('company:hotline').'</strong> '.$emailer->getEmail('company:worktime').'. '.$emailer->getEmail('company:website').' luôn sẵn sàng hỗ trợ bạn bất kì lúc nào.</p>
											</td>
										</tr>
										<tr>
											<td>&nbsp;
											<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;margin:0;padding:0;line-height:18px;color:#444;font-weight:bold">Một lần nữa '.$emailer->getEmail('company:website').' cảm ơn quý khách.</p>
											<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;text-align:right"><strong><a href="'.$emailer->getEmail('home').'" style="color:'.$emailer->getEmail('color').';text-decoration:none;font-size:14px" target="_blank">'.$emailer->getEmail('company').'</a> </strong></p>
											</td>
										</tr>
									</tbody>
								</table>
								</td>
							</tr>
						</tbody>
					</table>
					</td>
				</tr>
				<tr>
					<td align="center">
					<table width="600">
						<tbody>
							<tr>
								<td>
								<p align="left" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;line-height:18px;color:#4b8da5;padding:10px 0;margin:0px;font-weight:normal">Quý khách nhận được email này vì đã đăng ký tại '.$emailer->getEmail('company:website').'.<br>
								Để chắc chắn luôn nhận được email thông báo, phản hồi từ '.$emailer->getEmail('company:website').', quý khách vui lòng thêm địa chỉ <strong><a href="mailto:'.$emailer->getEmail('email').'" target="_blank">'.$emailer->getEmail('email').'</a></strong> vào số địa chỉ (Address Book, Contacts) của hộp email.<br>
								<b>Địa chỉ:</b> '.$emailer->getEmail('company:address').'</p>
								</td>
							</tr>
						</tbody>
					</table>
					</td>
				</tr>
			</tbody>
		</table>';

		/* Send email admin */
		$arrayEmail = array(
			"dataEmail" => array(
				"name" => $row['username'],
				"email" => $row['email']
			)
		);
		$subject = "Thư kích hoạt tài khoản thành viên từ ".$setting['ten'.$lang];
		$message = $contentMember;
		$file = '';

		if(!$emailer->sendEmail("customer", $arrayEmail, $subject, $message, $file)) $func->transfer(coloikhikichhoattk,$config_base."lien-he", false);
	}

	function doimatkhau_user()
	{
		global $d, $setting, $emailer, $func, $login_member, $config_base, $lang;

		$username = (isset($_POST['username'])) ? htmlspecialchars($_POST['username']) : '';
		$email = (isset($_POST['email'])) ? htmlspecialchars($_POST['email']) : '';
		$newpass = substr(md5(rand(0,999)*time()), 15, 6);
		$newpassMD5 = md5($newpass);

		if(!$username) $func->transfer(chuanhaptentk, $config_base."account/quen-mat-khau", false);
		if(!$email) $func->transfer(chuanhapemaildktk, $config_base."account/quen-mat-khau", false);

		/* Kiểm tra username và email */
		$row = $d->rawQueryOne("select id from #_member where username = ? and email = ? limit 0,1",array($username,$email));
		if(!$row['id']) $func->transfer(tdkemailktt, $config_base."account/quen-mat-khau", false);

		/* Cập nhật mật khẩu mới */
		$data['password'] = $newpassMD5;
		$d->where('username', $username);
		$d->where('email', $email);
		$d->update('member',$data);

		/* Lấy thông tin người dùng */
		$row = $d->rawQueryOne("select id, username, password, ten, email, dienthoai, diachi from #_member where username = ? limit 0,1",array($username));

		/* Gán giá trị gửi email */
		$iduser = $row['id'];
		$tendangnhap = $row['username'];
		$matkhau = $row['password'];
		$tennguoidung = $row['ten'];
		$emailnguoidung = $row['email'];
		$dienthoainguoidung = $row['dienthoai'];
		$diachinguoidung = $row['diachi'];

	    /* Thông tin đăng ký */
	    $thongtindangky='<td style="padding:3px 9px 9px 0px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top"><span style="text-transform:normal">Username: '.$tendangnhap.'</span></td><td style="padding:3px 0px 9px 9px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">';
	    if($tennguoidung)
	    {
	    	$thongtindangky.='<span style="text-transform:capitalize">'.$tennguoidung.'</span><br>';
	    }

	    if($emailnguoidung)
	    {
	    	$thongtindangky.='<a href="mailto:'.$emailnguoidung.'" target="_blank">'.$emailnguoidung.'</a><br>';
	    }

	    if($diachinguoidung)
	    {
	    	$thongtindangky.=$diachinguoidung.'<br>';
	    }

	    if($dienthoainguoidung)
	    {
	    	$thongtindangky.='Tel: '.$dienthoainguoidung.'</td>';
	    }

	    $contentMember = '
		<table align="center" bgcolor="#dcf0f8" border="0" cellpadding="0" cellspacing="0" style="margin:0;padding:0;background-color:#f2f2f2;width:100%!important;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px" width="100%">
			<tbody>
				<tr>
					<td align="center" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">
						<table border="0" cellpadding="0" cellspacing="0" style="margin-top:15px" width="600">
							<tbody>
								<tr>
									<td align="center" id="m_-6357629121201466163headerImage" valign="bottom">
										<table cellpadding="0" cellspacing="0" style="border-bottom:3px solid '.$emailer->getEmail('color').';padding-bottom:10px;background-color:#fff" width="100%">
											<tbody>
												<tr>
													<td bgcolor="#FFFFFF" style="padding:0" valign="top" width="100%">
														<div style="color:#fff;background-color:f2f2f2;font-size:11px">&nbsp;</div>
														<table style="width:100%;">
															<tbody>
																<tr>
																	<td>
																		<a href="'.$emailer->getEmail('home').'" style="border:medium none;text-decoration:none;color:#007ed3;margin:0px 0px 0px 20px" target="_blank">'.$emailer->getEmail('logo').'</a>
																	</td>
																	<td style="padding:15px 20px 0 0;text-align:right">'.$emailer->getEmail('social').'</td>
																</tr>
															</tbody>
														</table>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr style="background:#fff">
									<td align="left" height="auto" style="padding:15px" width="600">
										<table>
											<tbody>
												<tr>
													<td>
														<h1 style="font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0">Kính chào Quý khách</h1>
														<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">Yêu cầu cung cấp lại mật khẩu của quý khách đã được tiếp nhận và đang trong quá trình xử lý. Quý khách vui lòng xác nhận vào đường dẫn phía dưới để được cấp mấtu khẩu mới.</p>
														<h3 style="font-size:13px;font-weight:bold;color:'.$emailer->getEmail('color').';text-transform:uppercase;margin:20px 0 0 0;padding: 0 0 5px;border-bottom:1px solid #ddd">Thông tin tài khoản <span style="font-size:12px;color:#777;text-transform:none;font-weight:normal">(Ngày '.date('d',$emailer->getEmail('datesend')).' tháng '.date('m',$emailer->getEmail('datesend')).' năm '.date('Y H:i:s',$emailer->getEmail('datesend')).')</span></h3>
													</td>
												</tr>
											<tr>
											<td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
											<table border="0" cellpadding="0" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th align="left" style="padding:6px 9px 0px 0px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">Thông tin tài khoản</th>
														<th align="left" style="padding:6px 0px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">Thông tin người dùng</th>
													</tr>
												</thead>
												<tbody>
													<tr>'.$thongtindangky.'</tr>
												</tbody>
											</table>
											</td>
										</tr>
										<tr>
											<td>
											<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><i>Lưu ý: Quý khách vui lòng thay đổi mật khẩu ngay khi đăng nhập bằng mật khẩu mới bên dưới.</i>
											<div style="margin:auto"><p style="display:inline-block;text-decoration:none;background-color:'.$emailer->getEmail('color').'!important;margin-right:30px;text-align:center;border-radius:3px;color:#fff;padding:5px 10px;font-size:12px;font-weight:bold;margin-left:33%;margin-top:5px" target="_blank">Mật khẩu mới: '.$newpass.'</p></div>
											</p>
											</td>
										</tr>
										<tr>
											<td>&nbsp;
												<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;border:1px '.$emailer->getEmail('color').' dashed;padding:10px;list-style-type:none">Bạn cần được hỗ trợ ngay? Chỉ cần gửi mail về <a href="mailto:'.$emailer->getEmail('company:email').'" style="color:'.$emailer->getEmail('color').';text-decoration:none" target="_blank"> <strong>'.$emailer->getEmail('company:email').'</strong> </a>, hoặc gọi về hotline <strong style="color:'.$emailer->getEmail('color').'">'.$emailer->getEmail('company:hotline').'</strong> '.$emailer->getEmail('company:worktime').'. '.$emailer->getEmail('company:website').' luôn sẵn sàng hỗ trợ bạn bất kì lúc nào.</p>
											</td>
										</tr>
										<tr>
											<td>&nbsp;
											<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;margin:0;padding:0;line-height:18px;color:#444;font-weight:bold">Một lần nữa '.$emailer->getEmail('company:website').' cảm ơn quý khách.</p>
											<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;text-align:right"><strong><a href="'.$emailer->getEmail('home').'" style="color:'.$emailer->getEmail('color').';text-decoration:none;font-size:14px" target="_blank">'.$emailer->getEmail('company').'</a> </strong></p>
											</td>
										</tr>
									</tbody>
								</table>
								</td>
							</tr>
						</tbody>
					</table>
					</td>
				</tr>
				<tr>
					<td align="center">
					<table width="600">
						<tbody>
							<tr>
								<td>
								<p align="left" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;line-height:18px;color:#4b8da5;padding:10px 0;margin:0px;font-weight:normal">Quý khách nhận được email này vì đã liên hệ tại '.$emailer->getEmail('company:website').'.<br>
								Để chắc chắn luôn nhận được email thông báo, phản hồi từ '.$emailer->getEmail('company:website').', quý khách vui lòng thêm địa chỉ <strong><a href="mailto:'.$emailer->getEmail('email').'" target="_blank">'.$emailer->getEmail('email').'</a></strong> vào số địa chỉ (Address Book, Contacts) của hộp email.<br>
								<b>Địa chỉ:</b> '.$emailer->getEmail('company:address').'</p>
								</td>
							</tr>
						</tbody>
					</table>
					</td>
				</tr>
			</tbody>
		</table>';

		/* Send email admin */
		$arrayEmail = array(
			"dataEmail" => array(
				"name" => $tennguoidung,
				"email" => $email
			)
		);
		$subject = "Thư cấp lại mật khẩu từ ".$setting['ten'.$lang];
		$message = $contentMember;
		$file = '';

		if($emailer->sendEmail("customer", $arrayEmail, $subject, $message, $file))
		{
			unset($_SESSION[$login_member]);
			setcookie('login_member_id',"",-1,'/');
			setcookie('login_member_session',"",-1,'/');
			$func->transfer(capmkthanhcong.$email, $config_base);
		}
		else
		{
			$func->transfer(coloikhiclmk, $config_base."account/quen-mat-khau", false);
		}
	}

	function logout()
	{
		global $d, $func, $login_member, $config_base;

		unset($_SESSION[$login_member]);
		setcookie('login_member_id',"",-1,'/');
		setcookie('login_member_session',"",-1,'/');

		$func->redirect($config_base);
	}
