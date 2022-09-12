
<?php function get_breadcrumbs() { ?>
	<div class="breadcrumbs">
		<?php echo '<li class="breadcrumbs__item"><a href="' . home_url() . '" rel="nofollow">Home</a></li>';

		if (is_category() || is_single()) { ?>
			<li class="breadcrumbs__item"><?php the_category('</li><li class="breadcrumbs__item">');?></li>

			<?php if (is_single()) { ?>
				<li class="breadcrumbs__item"><?php the_title(); ?></li>
			<?php }
		}
		elseif (is_page()) { ?>
			<li class="breadcrumbs__item"><?php echo the_title(); ?></li>
		<?php }
		elseif (is_search()) {
			echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;Search Results for... ";
			echo '"<em>';
			echo the_search_query();
			echo '</em>"';
		} ?>
	</div>
<?php }
