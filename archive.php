<?php get_header(); ?>

<div class="row intro">
	<div class="col">
		<div class="block">
			<h2><?php single_cat_title( '', true ); ?></h2>
			<?php echo category_description(); ?> 
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