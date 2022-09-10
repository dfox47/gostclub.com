
<?php get_header(); ?>

<main data-tmp="index.php">
	<div class="content">
		<div class="content_main">


			<?php // content
			the_content(); ?>

			<?php // posts
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
				}
			}
			else { ?>
				<div class="hidden">empty</div>
			<?php } ?>
		</div>

		<div class="aside">
			<div id="sidebar-section-top" class="widget-area sidebar clearfix">
				<aside id="supermag_ad-36" class="widget widget_supermag_ad">
					<h3 class="widget-title"><span>ЧЕТИ ON-LINE</span></h3>

					<div class="supermag-ad-widget">
						<a href="https://issuu.com/zenitafish/docs/_____11" target="_blank"><img src="https://gostclub.com/wp-content/uploads/2019/01/ГОСТ-11-01.jpg" alt=""></a></div></aside><aside id="supermag_ad-34" class="widget widget_supermag_ad"><div class="supermag-ad-widget"><a href="https://issuu.com/zenitafish/docs/small" target="_blank"><img src="https://gostclub.com/wp-content/uploads/2018/08/10-web.jpg" alt="ГОСТ журнал #10"></a></div></aside><aside id="supermag_ad-32" class="widget widget_supermag_ad"><div class="supermag-ad-widget"><a href="https://issuu.com/zenitafish/docs/web-isuu" target="_blank"><img src="https://gostclub.com/wp-content/uploads/2018/05/web-isuu-1-01.jpg" alt=""></a></div></aside><aside id="supermag_ad-30" class="widget widget_supermag_ad"><div class="supermag-ad-widget"><a href="https://issuu.com/zenitafish/docs/____8" target="_blank"><img src="https://gostclub.com/wp-content/uploads/2018/02/Безымянный-1.png" alt=""></a></div></aside><aside id="supermag_ad-26" class="widget widget_supermag_ad"><div class="supermag-ad-widget"><a href="https://issuu.com/zenitafish/docs/spisanie_br_7_fina" target="_blank"><img src="https://gostclub.com/wp-content/uploads/2017/10/корица-1-1.jpg" alt=""></a></div></aside><aside id="supermag_ad-24" class="widget widget_supermag_ad"><div class="supermag-ad-widget"><a href="https://issuu.com/zenitafish/docs/magazine_01" target="_blank"><img src="https://gostclub.com/wp-content/uploads/2017/07/unnamed.jpg" alt=""></a></div></aside><aside id="supermag_ad-22" class="widget widget_supermag_ad"><div class="supermag-ad-widget"><a href="https://issuu.com/zenitafish" target="_blank"><img src="https://gostclub.com/wp-content/uploads/2017/03/16939560_10212179764554476_5983755582056700709_n.jpg" alt=""></a></div></aside><aside id="supermag_ad-18" class="widget widget_supermag_ad"><div class="supermag-ad-widget"><a href="https://issuu.com/zenitafish" target="_blank"><img src="https://gostclub.com/wp-content/uploads/2016/11/14962663_1825682554381318_8943749872767880756_n.jpg" alt=""></a></div></aside><aside id="supermag_ad-3" class="widget widget_supermag_ad"><div class="supermag-ad-widget"><a href="https://issuu.com/zenitafish" target="_blank"><img src="https://gostclub.com/wp-content/uploads/2016/07/гост_лято_корица.jpg" alt=""></a></div></aside><aside id="supermag_ad-9" class="widget widget_supermag_ad"><div class="supermag-ad-widget"><a href="https://issuu.com/zenitafish/docs/gost_web" target="_blank"><img src="https://gostclub.com/wp-content/uploads/2016/08/GOST_web1-1_640-907.jpg" alt=""></a></div></aside><aside id="supermag_ad-10" class="widget widget_supermag_ad"><div class="supermag-ad-widget"><a href="https://issuu.com/zenitafish/docs/spisanie_internet.compressed" target="_blank"><img src="https://gostclub.com/wp-content/uploads/2016/08/spisanie-internet-1_640-907.jpg" alt=""></a></div></aside>		</div>
		</div>
	</div>
</main>

<?php get_footer(); ?>
