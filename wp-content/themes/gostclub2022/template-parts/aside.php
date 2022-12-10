<?php $i        = '/wp-content/themes/gostclub2022/i';
$journalImg     = $i . '/journal';
$dummImg        = $i . '/dumm.png';

$currentLang = substr(get_bloginfo("language"), 0, 2);

$txtGostJournal = "ГОСТ журнал";

if ($currentLang == 'bg') {
	$txtGostJournal = "ГОСТ списание";
}
elseif ($currentLang == 'en') {
	$txtGostJournal = "GOST journal";
}

?>

<div class="aside">
	<div class="mobile_hide">
		<?php // aside
		include "cat_list_1.php"; ?>
	</div>

	<div>
		<h3>
			<span class="lang_bg_only">Рубрики</span>
			<span class="lang_en_only">Topics</span>
			<span class="lang_ru_only">Рубрики</span>
		</h3>

		<ul class="aside_cat_list">
			<?php // separate categories
			$catArray = ('1,3,4,5,6,30,35,42,47,90,143,154,203,210,211,275,282,283,284,285,286,287,288,289,290,291,292');

			$categories = get_categories(array(
				'exclude'       => $catArray,
				'hide_empty'    => false,
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
					<a class="aside_cat_list__link <?php if ($categoryCurrent == $categoryId) {?>active<?php } ?>" href="<?php echo get_category_link($categoryId) ?>" title="<?php echo $categoryName ?>"><?php echo $categoryName ?></a>
				</li>
			<?php } ?>
		</ul>
	</div>

	<h3>
		<span class="lang_bg_only">Чети онлайн</span>
		<span class="lang_en_only">Read online</span>
		<span class="lang_ru_only">Читайте онлайн</span>
	</h3>

	<ul class="aside_list">
		<li class="aside_list__item">
			<a class="aside_list__link" href="//issuu.com/zenitafish/docs/_____11" target="_blank" title="<?= $txtGostJournal ?> #11">
				<img class="js-img-scroll" src="<?php echo $dummImg; ?>" data-src="<?php echo $journalImg; ?>/1.jpg" alt="<?= $txtGostJournal ?> #11">
			</a>
		</li>
 
		<li class="aside_list__item">
			<a class="aside_list__link" href="//issuu.com/zenitafish/docs/small" target="_blank" title="<?= $txtGostJournal ?> #10">
				<img class="js-img-scroll" src="<?php echo $dummImg; ?>" data-src="<?php echo $journalImg; ?>/2.jpg" alt="<?= $txtGostJournal ?> #10">
			</a>
		</li>

		<li class="aside_list__item">
			<a class="aside_list__link" href="//issuu.com/zenitafish/docs/web-isuu" target="_blank" title="<?= $txtGostJournal ?> #9">
				<img class="js-img-scroll" src="<?php echo $dummImg; ?>" data-src="<?php echo $journalImg; ?>/3.jpg" alt="<?= $txtGostJournal ?> #9">
			</a>
		</li>

		<li class="aside_list__item">
			<a class="aside_list__link" href="//issuu.com/zenitafish/docs/____8" target="_blank" title="<?= $txtGostJournal ?> #8">
				<img class="js-img-scroll" src="<?php echo $dummImg; ?>" data-src="<?php echo $journalImg; ?>/4.jpg" alt="<?= $txtGostJournal ?> #8">
			</a>
		</li>

		<li class="aside_list__item">
			<a class="aside_list__link" href="//issuu.com/zenitafish/docs/spisanie_br_7_fina" target="_blank" title="<?= $txtGostJournal ?> #7">
				<img class="js-img-scroll" src="<?php echo $dummImg; ?>" data-src="<?php echo $journalImg; ?>/5.jpg" alt="<?= $txtGostJournal ?> #7">
			</a>
		</li>

		<li class="aside_list__item">
			<a class="aside_list__link" href="//issuu.com/zenitafish/docs/magazine_01" target="_blank" title="<?= $txtGostJournal ?> #6">
				<img class="js-img-scroll" src="<?php echo $dummImg; ?>" data-src="<?php echo $journalImg; ?>/6.jpg" alt="<?= $txtGostJournal ?> #6">
			</a>
		</li>

		<li class="aside_list__item">
			<a class="aside_list__link" href="//issuu.com/zenitafish" target="_blank" title="<?= $txtGostJournal ?> #5">
				<img class="js-img-scroll" src="<?php echo $dummImg; ?>" data-src="<?php echo $journalImg; ?>/7.jpg" alt="<?= $txtGostJournal ?> #5">
			</a>
		</li>

		<li class="aside_list__item">
			<a class="aside_list__link" href="//issuu.com/zenitafish" target="_blank" title="<?= $txtGostJournal ?> #4">
				<img class="js-img-scroll" src="<?php echo $dummImg; ?>" data-src="<?php echo $journalImg; ?>/8.jpg" alt="<?= $txtGostJournal ?> #4">
			</a>
		</li>

		<li class="aside_list__item">
			<a class="aside_list__link" href="//issuu.com/zenitafish" target="_blank" title="<?= $txtGostJournal ?> #3">
				<img class="js-img-scroll" src="<?php echo $dummImg; ?>" data-src="<?php echo $journalImg; ?>/9.jpg" alt="<?= $txtGostJournal ?> #3">
			</a>
		</li>

		<li class="aside_list__item">
			<a class="aside_list__link" href="//issuu.com/zenitafish/docs/gost_web" target="_blank" title="<?= $txtGostJournal ?> #2">
				<img class="js-img-scroll" src="<?php echo $dummImg; ?>" data-src="<?php echo $journalImg; ?>/10.jpg" alt="<?= $txtGostJournal ?> #2">
			</a>
		</li>

		<li class="aside_list__item">
			<a class="aside_list__link" href="//issuu.com/zenitafish/docs/spisanie_internet.compressed" target="_blank" title="<?= $txtGostJournal ?> #1">
				<img class="js-img-scroll" src="<?php echo $dummImg; ?>" data-src="<?php echo $journalImg; ?>/11.jpg" alt="<?= $txtGostJournal ?> #1">
			</a>
		</li>
	</ul>
</div>