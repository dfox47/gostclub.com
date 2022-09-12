
<?php function get_breadcrumbs() { ?>
	<div class="breadcrumbs">
		<?php echo '<a href="' . home_url() . '" rel="nofollow">Home</a>';

		if (is_category() || is_single()) {
			the_category(' &bull; ');

			if (is_single()) {
				the_title();
			}
		}
		elseif (is_page()) {
			echo the_title();
		}
		elseif (is_search()) {
			echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;Search Results for... ";
			echo '"<em>';
			echo the_search_query();
			echo '</em>"';
		} ?>
	</div>
<?php }
