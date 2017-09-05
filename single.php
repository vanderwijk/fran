<?php get_header(); ?>

		<div class="row content">
	<?php 
	if ( have_posts() ) : while ( have_posts() ) : the_post();
		get_template_part( 'content', get_post_type() );
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