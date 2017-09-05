<?php get_header(); ?>

<?php 
$object = get_queried_object();
$term_id = $object -> term_id;
$term_taxonomy = $object -> taxonomy;
if ( defined( 'WPSEO_VERSION' ) ) {
	$meta = get_option( 'wpseo_taxonomy_meta' );
	$seo_title = $meta[$term_taxonomy][$term_id]['wpseo_title'];
} ?>

<div class="row intro">
	<div class="col">
		<div class="block">
			<h2><?php if ( isset ( $seo_title ) ) { echo $seo_title; } else { echo single_term_title(); } ?></h2>
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

<?php get_template_part( 'module-call-to-action', get_post_format() ); ?>

<?php get_footer();