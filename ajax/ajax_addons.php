<?php
include "ajax_config.php";

$sqlCache = "select * from #_setting";
$setting = $cache->getCache($sqlCache,'fetch',7200);
$optsetting = (isset($setting['options']) && $setting['options'] != '') ? json_decode($setting['options'],true) : null;
$type = (isset($_GET["type"])) ? htmlspecialchars($_GET["type"]) : '';
?>
<?php if($type == 'video-slick') {
	$videonb = $d->rawQuery("select link_video, id, ten$lang from #_photo where type = ? and act <> ? and noibat > 0 and hienthi > 0 order by stt, id desc",array('video','photo_static')); if(count($videonb)) { ?>
		<div class="video_row flex_row">
			<div class="video_left">
				<div class="video-main">
					<iframe id="iframe_video" width="100%" height="100%" src="//www.youtube.com/embed/<?=$func->getYoutube($videonb[0]['link_video'])?>" frameborder="0" allowfullscreen></iframe>
				</div>
			</div>
			<div class="video_right">
				<div class="slick_video">
					<?php for($i=0;$i<count($videonb);$i++) { ?>
						<div class="">
							<div class="video_slick_it" data-id="<?=$func->getYoutube($videonb[$i]['link_video'])?>" >
								<img onerror="this.src='<?=THUMBS?>/380x280x2/assets/images/noimage.png';" src="https://img.youtube.com/vi/<?=$func->getYoutube($videonb[$i]['link_video'])?>/0.jpg" alt="<?=$videonb[$i]['ten'.$lang]?>"/>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function()
			{
				$(".slick_video").slick({
					slidesToShow: 3,
					slidesToScroll: 1,
					infinite: true,
					vertical: true,
					verticalSwiping: true,
					autoplay: true,
					autoplaySpeed: 3000,
					speed: 1000,
					arrows: false,
					dots: false,
					responsive: [
					{ breakpoint: 993, settings: { slidesToShow: 3 } },
					{ breakpoint: 580, settings: { slidesToShow: 3 } },
					{ breakpoint: 400, settings: { slidesToShow: 3 ,vertical: false } },
					]
				});
				$(".video_slick_it").click(function(){
					$("#iframe_video").attr("src","//www.youtube.com/embed/"+$(this).data('id')+"?autoplay=1");	
				})
			});
		</script>
	<?php }
} ?>
<?php if($type == 'video-fotorama') {
	$videonb = $d->rawQuery("select link_video, id, ten$lang from #_photo where type = ? and act <> ? and noibat > 0 and hienthi > 0 order by stt, id desc",array('video','photo_static')); if(count($videonb)) { ?>
		<!-- Video Fotorama -->
		<div id="fotorama-videos" data-width="100%" data-thumbmargin="5" data-height="360" data-fit="cover" data-thumbwidth="100" data-thumbheight="85" data-allowfullscreen="false" data-nav="thumbs">
			<?php for($i=0;$i<count($videonb);$i++) { ?>
				<a href="https://youtube.com/watch?v=<?=$func->getYoutube($videonb[$i]['link_video'])?>" title="<?=$videonb[$i]['ten'.$lang]?>"></a>
			<?php } ?>
		</div>
		<script type="text/javascript">
			$(document).ready(function()
			{
				$("#fotorama-videos").fotorama();
			});
		</script>
	<?php } } ?>

	<?php if($type == 'video-select') {
		$videonb = $d->rawQuery("select link_video, id, ten$lang from #_photo where type = ? and act <> ? and noibat > 0 and hienthi > 0 order by stt, id desc",array('video','photo_static')); if(count($videonb)) { ?>
			<!-- Video Select -->
			<div class="video-main">
				<iframe width="100%" height="100%" src="//www.youtube.com/embed/<?=$func->getYoutube($videonb[0]['link_video'])?>" frameborder="0" allowfullscreen></iframe>
			</div>
			<select class="listvideos">
				<?php for($i=0; $i<count($videonb); $i++) {?>
					<option value="<?=$videonb[$i]['id']?>"><?=$videonb[$i]['ten'.$lang]?></option>
				<?php } ?>
			</select>
			<script type="text/javascript">
				$(document).ready(function()
				{
					$('.listvideos').change(function() 
					{
						var id = $(this).val();
						$.ajax({
							url:'ajax/ajax_video.php',
							type: "POST",
							dataType: 'html',
							data: {id:id},
							success: function(result){
								$('.video-main').html(result);
							}
						});
					});
				});
			</script>
		<?php } } ?>

		<?php if($type == 'footer-map') {
			/* Map Footer */
			echo htmlspecialchars_decode($optsetting['toado_iframe']);
		} ?>

		<?php if($type == 'fanpage-facebook') { ?>
			<!-- Fanpage -->
			<div class="fb-page" 
			data-href="<?=$optsetting['fanpage']?>" 
			data-tabs="timeline" 
			data-width="600" 
			data-height="200" 
			data-small-header="true" 
			data-adapt-container-width="true" 
			data-hide-cover="false" data-show-facepile="true">
			<div class="fb-xfbml-parse-ignore">
				<blockquote cite="<?=$optsetting['fanpage']?>">
					<a href="<?=$optsetting['fanpage']?>">Facebook</a>
				</blockquote>
			</div>
		</div>
	<?php } ?>

	<?php if($type == 'messages-facebook') { ?>

		<div id="fb-root"></div>
		<div class="fb-livechat">
			<div class="ctrlq fb-overlay"></div>
			<div class="fb-widget">
				<div class="ctrlq fb-close"></div>
				<div class="fb-page" data-href="<?=$optsetting['fanpage']?>" data-tabs="messages" data-width="250" data-height="300" data-small-header="true" data-hide-cover="true" data-show-facepile="false"> </div>
				<div id="fb-root"></div>
			</div>
		</div>

		<script type="text/javascript">
			$(document).ready(function(){
				function detectmob() {
					if (navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i)) {
						return true;
					} else {
						return false;
					}
				}
				var t = {
					delay: 80,
					overlay: $(".fb-overlay"),
					widget: $(".fb-widget"),
					button: $(".fb-button")
				};
				setTimeout(function() {
					$("div.fb-livechat").fadeIn()
				}, 8 * t.delay);
				if (!detectmob()) {
					$(".ctrlq").on("click", function(e) {
						e.preventDefault(), t.overlay.is(":visible") ? (t.overlay.fadeOut(t.delay), t.widget.stop().animate({
							bottom: 0,
							opacity: 0
						}, 2 * t.delay, function() {
							$(this).hide("slow"), t.button.show()
						})) : t.button.fadeOut("medium", function() {
							t.widget.stop().show().animate({
								bottom: "245px",
								opacity: 1
							}, 2 * t.delay), t.overlay.fadeIn(t.delay)
						})
					})
				}
			});
		</script>
	<?php } ?>

	<?php if($type == 'script-main') { ?>
		<!-- SDK Facebook -->
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id; js.async=true;
			js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.6";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>

	<!-- Like Share -->
	<script src="//sp.zalo.me/plugins/sdk.js"></script>
	<script src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-55e11040eb7c994c" async="async"></script>
	<script type="text/javascript">
		var addthis_config = addthis_config||{};
		addthis_config.lang = 'vi'
	</script>
	<?php } ?>