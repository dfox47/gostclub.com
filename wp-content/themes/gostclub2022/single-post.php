
<?php $currentUrl = $_SERVER['REQUEST_URI']; ?>

<?php get_header(); ?>

<?php // thumb img url
$thumbUrl = '';

if (get_the_post_thumbnail_url()) {
	$thumbUrl = str_replace('https://' . $_SERVER['SERVER_NAME'], '', get_the_post_thumbnail_url());
} ?>

<main class="content_wrap" data-tmp="single-post.php">
	<div class="wrap">
		<div class="content">
			<div class="content_main">
				<?php if (is_single() && $thumbUrl !== '') { ?>
					<div class="text-center"><img class="thumb_img" src="<?php echo $thumbUrl; ?>" alt="" /></div>
				<?php } ?>

				<?php // hide h1 at page About
				if ($currentUrl == '/o-kompanii/') {}
				else { ?>
					<h1><?php single_post_title(); ?></h1>
				<?php } ?>

				<?php // content
				the_content(); ?>

				<?php // posts
				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post();
					}
				} ?>
			</div>

			<div class="aside">
				<h3>ЧЕТИ ON-LINE</h3>

				<ul class="aside_list">
					<li class="aside_list__item">
						<a class="aside_list__link" href="//issuu.com/zenitafish/docs/_____11" target="_blank"><img src="/wp-content/uploads/2019/01/ГОСТ-11-01.jpg" alt=""></a>
					</li>

					<li class="aside_list__item">
						<a class="aside_list__link" href="//issuu.com/zenitafish/docs/small" target="_blank"><img src="/wp-content/uploads/2018/08/10-web.jpg" alt="ГОСТ журнал #10"></a>
					</li>

					<li class="aside_list__item">
						<a class="aside_list__link" href="//issuu.com/zenitafish/docs/web-isuu" target="_blank"><img src="/wp-content/uploads/2018/05/web-isuu-1-01.jpg" alt=""></a>
					</li>

					<li class="aside_list__item">
						<a class="aside_list__link" href="//issuu.com/zenitafish/docs/____8" target="_blank"><img src="/wp-content/uploads/2018/02/Безымянный-1.png" alt=""></a>
					</li>

					<li class="aside_list__item">
						<a class="aside_list__link" href="//issuu.com/zenitafish/docs/spisanie_br_7_fina" target="_blank"><img src="/wp-content/uploads/2017/10/корица-1-1.jpg" alt=""></a>
					</li>

					<li class="aside_list__item">
						<a class="aside_list__link" href="//issuu.com/zenitafish/docs/magazine_01" target="_blank"><img src="/wp-content/uploads/2017/07/unnamed.jpg" alt=""></a>
					</li>

					<li class="aside_list__item">
						<a class="aside_list__link" href="//issuu.com/zenitafish" target="_blank"><img src="/wp-content/uploads/2017/03/16939560_10212179764554476_5983755582056700709_n.jpg" alt=""></a>
					</li>

					<li class="aside_list__item">
						<a class="aside_list__link" href="//issuu.com/zenitafish" target="_blank"><img src="/wp-content/uploads/2016/11/14962663_1825682554381318_8943749872767880756_n.jpg" alt=""></a>
					</li>

					<li class="aside_list__item">
						<a class="aside_list__link" href="//issuu.com/zenitafish" target="_blank"><img src="/wp-content/uploads/2016/07/гост_лято_корица.jpg" alt=""></a>
					</li>

					<li class="aside_list__item">
						<a class="aside_list__link" href="//issuu.com/zenitafish/docs/gost_web" target="_blank"><img src="/wp-content/uploads/2016/08/GOST_web1-1_640-907.jpg" alt=""></a>
					</li>

					<li class="aside_list__item">
						<a class="aside_list__link" href="//issuu.com/zenitafish/docs/spisanie_internet.compressed" target="_blank"><img src="/wp-content/uploads/2016/08/spisanie-internet-1_640-907.jpg" alt=""></a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</main>

<?php get_footer(); ?>
