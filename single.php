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
	if ( have_posts() ) : while ( have_posts() ) : the_post();
		get_template_part( 'content', get_post_type() );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

	endwhile;

	else :
		get_template_part( 'content', 'none' );
	endif; ?>
		</div>

<nav class="post-navigation">
	<?php previous_post_link( '%link' ); ?> 
	<?php next_post_link( '%link' ); ?> 
</nav>

<?php get_footer();