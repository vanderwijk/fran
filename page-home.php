<?php
/*
Template Name: Home
*/
get_header(); ?>

<div class="row content">
	<?php 
	if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<div class="col">
	<div <?php post_class( 'block' ); ?>>
		<?php if ( has_post_thumbnail( $post -> ID ) ) { ?>
			<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'hero' ); 
			$thumb_img = get_post( get_post_thumbnail_id() );
			?>
			<img src="<?php echo $image[0]; ?>" alt="<?php the_title_attribute(); ?>" itemprop="image" />
			<div class="caption"><?php echo $thumb_img->post_content; ?></div>
		<?php }; ?>
		<?php the_content(); ?>
	</div>
</div>

	<?php endwhile;

	else :
		get_template_part( 'content', 'none' );
	endif; ?>
</div>
<div class="row">

		<?php if ( ! dynamic_sidebar( 'home' ) ) : endif ?>

</div>

<?php get_footer();