
</div>
<footer>
	<div class="container-block">
		<div class="clearfix">
			<div class="lofo-footer"><img src="<?php echo asset_url();?>yoga_template/image/logo_footer.png" alt="логотип"></div>
			<div class="footer-social-network">
				<a href="https://www.facebook.com/globe.yoga/" target="_blank"><img src="<?php echo asset_url();?>yoga_template/image/facebook.png" alt="facebook"></a>
				<a href="https://www.instagram.com/globe.yoga/" target="_blank"><img src="<?php echo asset_url();?>yoga_template/image/instagram.png" alt="instagram"></a>
				<a href="https://vk.com/globe.yoga" target="_blank"><img src="<?php echo asset_url();?>yoga_template/image/vk.png" alt="vk"></a>
				<!-- <a href="#"><img src="<?php echo asset_url();?>yoga_template/image/utube.png" alt="youtube"></a> -->

				<p><?=$constants['join_us'][$lang]?></p>
			</div>
		</div>
		<div class="footer-wrapper-link clearfix">
			<div class="col-sm-3 col-xs-4 col-xxs">
				<div>
					<ul class="nav footer-first-block">
						<li><a href="/<?=$lang.'/'?>about"><span><?=$constants['aboutProject'][$lang]?></span></a></li>
						<li><a href="/<?=$lang.'/'?>partners"><span><?=$constants['bePartner'][$lang]?></span></a></li>
						<li><a href="/<?=$lang.'/'?>contacts"><span><?=$constants['Contacts'][$lang]?></span></a></li>
					</ul>
				</div>
			</div>
			<div class="col-sm-3 col-xs-4 col-xxs">
				<div>
				<?php if (!empty($menu)): ?>
					
				
					<ul class="nav footer-second-block">
					<?php if (!empty($menu) and count($menu)>=4): ?>
						<?php for ($i = 0; $i <= 3; $i++): ?>
					<?php	if(!empty($menu[$i]['alias'])):?> 
						   <?php echo '<li><a href="/'.$lang.'/'.$menu[$i]['alias'].'"><span>'.$menu[$i]['value'].'</span></a></li>';?>
						<?php endif ?>
						<?php endfor ?> 
						<?php endif ?>
					</ul>
				</div>
			</div>
			<div class="col-sm-3 col-xs-4 col-xxs">
				<div>
					<ul class="nav footer-third-block">
						<?php if (!empty($menu) and count($menu)>=4): ?>
						<?php for ($i = 4; $i <= 7; $i++) : ?>
					<?php	if(!empty($menu[$i]['alias'])):?> 
						   <?php echo '<li><a href="/'.$lang.'/'.$menu[$i]['alias'].'"><span>'.$menu[$i]['value'].'</span></a></li>';?>
						<?php endif ?>
						<?php endfor ?> 
						<?php endif ?>
					</ul>
				</div>
			</div>
			<?php endif ?>
		</div>
		<div class="footer-copyright">
			<p>&copy; 2016 globe.yoga</p>
		</div>
	</div>
</footer>


<!-- BEGIN PAGE LEVEL PLUGINS -->
<?php if (!empty($this->data['page_level_plugin'])): ?>
<?php foreach ($this->data['page_level_plugin'] as $key => $value): ?>
   <?php foreach ($value as $key => $value): ?>
   	<?php if ($value!=TEMPLATE_PATH): ?>
   		<script src="<?=$value?>" type="text/javascript"></script>
   	<?php endif ?>
   <?php endforeach ?>
<?php endforeach ?>
<?php endif ?>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<?php if (!empty($this->data['page_level_scripting'])): ?>
	<?php foreach ($this->data['page_level_scripting'] as $key => $value): ?>
	<?php foreach ($value as $key => $value): ?>
	   <script type="text/javascript"><?=$value?></script>
	<?php endforeach ?>
	<?php endforeach ?>
<?php endif ?>
<?php if (!empty($this->data['page_level_script'])): ?>
	<?php foreach ($this->data['page_level_script'] as $key => $value): ?>
	<?php foreach ($value as $key => $value): ?>
	   <script src="<?=$value?>" type="text/javascript"></script>
	<?php endforeach ?>
	<?php endforeach ?>
<?php endif ?>


<script>
	var isMobile = {
		Android: function() {
			return navigator.userAgent.match(/Android/i);
		},
		BlackBerry: function() {
			return navigator.userAgent.match(/BlackBerry/i);
		},
		iOS: function() {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
		Opera: function() {
			return navigator.userAgent.match(/Opera Mini/i);
		},
		Windows: function() {
			return navigator.userAgent.match(/IEMobile/i);
		},
		any: function() {
			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		}
	};
	if( !isMobile.any() ) {
		$.stellar();
	}
</script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter39910795 = new Ya.Metrika({
                    id:39910795,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true,
                    trackHash:true,
                    ut:"noindex"
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/39910795?ut=noindex" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-87097321-1', 'auto');
  ga('send', 'pageview');

</script>
</body>

</html>