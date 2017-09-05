<?php get_header(); ?>

<div class="row intro">
	<div class="col">
		<div class="block">
			<?php if ( have_posts() ) : ?>
				<h2><?php printf( __( 'Search Results for: %s', 'fran' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
			<?php else : ?>
				<h2><?php _e( 'Nothing Found', 'twentyseventeen' ); ?></h2>
			<?php endif; ?>
		</div>
	</div>
</div>

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