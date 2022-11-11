<div class="hidden">
	<h3>
		<span class="lang_bg_only">Категории</span>
		<span class="lang_en_only">Categories</span>
		<span class="lang_ru_only">Категории</span>
	</h3>

	<ul class="aside_cat_list">
		<?php // separate categories
		$catArray = ('1,3,4,5,6,30,35,42,47,90,143,154,203,210,211,275,282,283,284,285,286,287,288,289,290,291,292');

		$categories = get_categories(array(
			'hide_empty'    => false,
			'include'       => $catArray,
			'order'         => 'ASC',
			'orderby'       => 'name',
			'parent'        => 0
		));

		$selected_category  = get_queried_object();
		$categoryCurrent    = '';

		if ($selected_category) {
			$categoryCurrent = $selected_category->term_id;
		}

		foreach ($categories as $category) {
			$categoryId     = $category->term_id;
			$categoryName   = $category->name; ?>

			<li class="aside_cat_list__item">
				<a class="aside_cat_list__link<?php if ($categoryCurrent == $categoryId) { ?> active<?php } ?>" href="<?php echo get_category_link($categoryId) ?>" title="<?php echo $categoryName ?>"><?php echo $categoryName ?></a>
			</li>
		<?php } ?>
	</ul>
</div>