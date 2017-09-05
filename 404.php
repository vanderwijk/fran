<?php get_header(); ?>

<div class="row content">
	<?php
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
					get_template_part( 'content', 'none' );
				endwhile;
			else :
				get_template_part( 'content', 'none' );
			endif;
		?>
</div>

<?php get_template_part( 'module-pagination', get_post_format() ); ?>

<?php get_footer();