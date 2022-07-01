1/	Htaccess: Các bạn đổi lại tên của file **a.htaccess** -> **.htaccess**

2/  Database: **libraries > database > sneakerltepdo.sql**

3/  config-type.php: **libraries > config-type.php**

4/  Tạo lang column: **libraries > lang > langinit.php**

5/  Các phần nội dung liên quan đến ckeditor. Ra ngoài web lúc gọi mọi người sử dụng thêm hàm htmlspecialchars_decode(string)

6/  Các folder trong **UPLOAD** được **Tạo** và **Define** tự động. Các bạn muốn **Tạo** hoặc **Define** thêm thì nhập tên folder trong file **constant.php**. Ví dụ:

    $array_const = array('TEN_FOLDER1', 'TEN_FOLDER2', ...);

7/	**config['group']** trong **config-type.php** giúp mình **Group Các Config có cùng nội dung** với nhau. Các bạn cấu hình theo mẫu mình đã để trong file. Hiện tại hỗ trợ các loại sau: **product**, **news**, **static**, **photo**, **photo_static**

8/	Js có áp dụng code optimize nên các bạn lưu ý khi viết script hoặc nhúng các thư việc khác nhớ kiểm tra dấu **';'** ở cuối các đoạn script. Vì khi optimize thành file cached mà thiếu dấu **';'** . Js sẽ bị lỗi. Ví dụ:

	$(window).scroll(function(){
        // Do something
    });

    $('body').on("click",".element",function() {
        // Do something
    });

9/  Cần lưu ý các config sau:
    
    // 'url' để lại dấu '/' khi up lên host
    
    'database' => array(
		'url' => '/',
	),
	
	// Để FALSE các config sau khi up lên host
	
	'website' => array(
		// Khi bật: Các account admin sẽ có full, Cấu hình được email host, cấu hình được ngôn ngữ (Chi bật khi lập trình hoặc debug)
    	'debug-developer' => false,

    	// Khi bật: Website sẽ xuất ra từng đường dẫn CSS. Ngược lại sẽ tạo file cached.css (Tên file có thể thay đổi tùy ý)
		'debug-css' => false,

		// Khi bật: Website sẽ xuất ra từng đường dẫn JS. Ngược lại sẽ tạo file cached.js (Tên file có thể thay đổi tùy ý)
    	'debug-js' => false,
    ),

	// Upload: max-width - max-height. Dùng để giới hạn kích thước upload hình. Nếu vượt quá sẽ tự resize lại theo config
	
	'website' => array(
    	'upload' => array(
			'max-width' => 1600,
			'max-height' => 1600
		)
    ),
    
    // Slug - Seo chỉ nên để Tiếng Việt.
    // Chỉ sử dụng đa ngôn ngữ khi đường dẫn có yêu cầu vi/tenkhongdau hoặc en/tenkhongdau (Code các bạn tự làm phần này)

    'slug' => array(
		'lang' => array(
			"vi"=>"Tiếng Việt",
			// "en"=>"Tiếng Anh"
		)
	),
    'seo' => array(
		'lang' => array(
			"vi"=>"Tiếng Việt",
			// "en"=>"Tiếng Anh"
		)
	)
    
    // Dùng để tạo phần Ngôn Ngữ SEO cho **Trang tĩnh trong admin** . Nếu trang không có ngôn ngữ khác thì chỉ cần thiết lập 'vi'
    
    'comlang' => array(
		"gioi-thieu" => array("vi" => "gioi-thieu", "en" => "about-us"),
		"san-pham" => array("vi" => "san-pham", "en" => "product"),
		"tin-tuc" => array("vi" => "tin-tuc", "en" => "news"),
		"tuyen-dung" => array("vi" => "tuyen-dung", "en" => "recruitment"),
		"thu-vien-anh" => array("vi" => "thu-vien-anh", "en" => "gallery"),
		"video" => array("vi" => "video", "en" => "video"),
		"lien-he" => array("vi" => "lien-he", "en" => "contact")
	)
	
    // Khi làm ở local, các bạn nên để config 'active' này bằng **FALSE** để có thể test được khi ko có hoặc ko đăng ký mã captcha

    'googleAPI' => array(
		'recaptcha' => array(
			'active' => FALSE,
			'urlapi' => 'https://www.google.com/recaptcha/api/siteverify',
			'sitekey' => '6LezS5kUAAAAAF2A6ICaSvm7R5M-BUAcVOgJT_31',
			'secretkey' => '6LezS5kUAAAAAGCGtfV7C1DyiqlPFFuxvacuJfdq'
		)
	),