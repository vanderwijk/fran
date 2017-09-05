<?php get_header(); ?>

		<?php if ( is_active_sidebar( 'main' ) ) { ?>
		<div class="row">
			<div class="col">
				<?php dynamic_sidebar( 'main' ); ?>
			</div>
		</div>
		<?php }; ?>

		<div class="row content">
		<?php
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
					get_template_part( 'content', get_post_type() );
				endwhile;
			else :
				get_template_part( 'content', 'none' );
			endif;
		?>
		</div>

<?php get_template_part( 'module-pagination', get_post_format() ); ?>

<?php get_footer();