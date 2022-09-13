
<div class="aside">
	<h3>
		<span class="lang_bg_only">Категории</span>
		<span class="lang_en_only">Categories</span>
		<span class="lang_ru_only">Рубрики</span>
	</h3>

	<ul class="aside_cat_list">
		<?php $categories = get_categories(array(
			'hide_empty'    => true,
			'order'         => 'ASC',
			'orderby'       => 'name',
			'parent'        => 0
		));

		$selected_category  = get_queried_object();
		$categoryCurrent = $selected_category->term_id;

		foreach ($categories as $category) { ?>
			<li class="aside_cat_list__item">
				<a class="aside_cat_list__link <?php if ($categoryCurrent == $category->term_id) {?>active<?php } ?>" href="<?php echo get_category_link($category->term_id) ?>" title="<?php echo $category->name ?>"><?php echo $category->name ?></a>
			</li>
		<?php } ?>
	</ul>

	<h3>
		<span class="lang_bg_only">Чети онлайн</span>
		<span class="lang_en_only">Read online</span>
		<span class="lang_ru_only">Читайте онлайн</span>
	</h3>

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
