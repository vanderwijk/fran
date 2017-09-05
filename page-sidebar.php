<?php
/*
Template Name: Page Right Sidebar
*/
get_header(); ?>

<div class="row content">
	<div class="col two-thirds">
		<?php 
		if ( have_posts() ) : while ( have_posts() ) : the_post();
			get_template_part( 'content', 'page' );
		endwhile;
	
		else :
			get_template_part( 'content', 'none' );
		endif; ?>
	</div>

	<div class="col one-third sidebar">
		<?php if ( ! dynamic_sidebar( 'sidebar' ) ) : endif ?>
	</div>

</div>

<?php get_footer();