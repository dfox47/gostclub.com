<?php $i        = '/wp-content/themes/gostclub2022/i';
$journalImg     = $i . '/journal';
$dummImg        = $i . '/dumm.png';

$currentLang = substr(get_bloginfo("language"), 0, 2);

$txtGostJournal = "ГОСТ журнал";
$txtTopics      = "Рубрики";
$txtReadOnline  = "Читайте онлайн";

if ($currentLang == 'bg') {
	$txtGostJournal = "ГОСТ списание";
	$txtTopics      = "Рубрики";
	$txtReadOnline  = "Чети онлайн";
}
elseif ($currentLang == 'en') {
	$txtGostJournal = "GOST journal";
	$txtTopics      = "Topics";
	$txtReadOnline  = "Read online";
} ?>

<div class="aside">
	<?php // aside
	include "cat_list_1.php"; ?>

	<div>
		<h3><?= $txtTopics; ?></h3>

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

	<h3><?= $txtReadOnline; ?></h3>

	<?php // journal Number | image number | link
	$arr2 = array(
		['11','1','/journal-11/'],
		['10','2', '/journal-10/'],
		['9','3', '/journal-9/'],
		['8','4', '/journal-8/'],
		['7','5', '//issuu.com/zenitafish/docs/spisanie_br_7_fina'],
		['6','6', '/journal-6/'],
		['5','7', '//issuu.com/zenitafish'],
		['4','8', '//issuu.com/zenitafish'],
		['3','9', '//issuu.com/zenitafish'],
		['2','10', '//issuu.com/zenitafish/docs/gost_web'],
		['1','11', '//issuu.com/zenitafish/docs/spisanie_internet.compressed'],
	); ?>

	<ul class="aside_list">
		<?php foreach ($arr2 as list($number, $i, $link)) { ?>
			<li class="aside_list__item">
				<a class="aside_list__link" href="<?php echo $link;?>" target="_blank" title="<?= $txtGostJournal ?> #<?php echo $number;?>">
					<img class="js-img-scroll" src="<?php echo $dummImg; ?>" data-src="<?php echo $journalImg; ?>/<?php echo $i; ?>.jpg" alt="<?= $txtGostJournal ?> #<?php echo $number;?>">
				</a>
			</li>
		<?php } ?>
	</ul>
</div>