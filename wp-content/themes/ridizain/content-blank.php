<?php
/**
 * The template used for displaying page content on the blank template - ideal for use with page builders
 *
 *
 * @package Ridizain
 * @since Ridizain 1.0
 */
?>
<?php tha_entry_before(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php tha_entry_top(); ?>
	<div class="entry-content">
		<?php
			the_content();
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'ridizain' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );

			edit_post_link( __( 'Edit', 'ridizain' ), '<span class="edit-link">', '</span>' );
		?>
		<?php tha_entry_bottom(); ?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
<?php tha_entry_after(); ?>