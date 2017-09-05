<?php $post_meta=get_post_custom( $post ->ID ); ?>

<div class="col one-third">
	<div <?php post_class( 'block' ); ?>> <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
		<h2 class="entry-title">
			<?php the_title(); ?>
		</h2>
		<div class="thumbnail">
			<?php if (has_post_thumbnail( $post ->ID ) ){ ?>
			<?php $image=wp_get_attachment_image_src( get_post_thumbnail_id( $post ->ID ), 'archive' ); ?>
			<img src="<?php echo $image[0]; ?>" alt="<?php the_title_attribute(); ?>" />
			<?php }; ?>
		</div>
		</a>
		<div class="summary">
			<?php 
				$category = get_the_category();
				if ( $category[0] ) {
					echo '<div class="label">' . '<a href="' . get_category_link( $category[0] -> term_id ) . '">' . $category[0] -> cat_name . '</a></div>';
				}; ?>
			<div class="entry-meta">
				<span class="vcard author">
					<span class="fn">
						<?php the_author(); ?>
					</span>
				</span>
				<span class="date updated">
					<?php the_time( get_option( 'date_format' ) ); ?>
				</span>
			</div>
			<?php the_excerpt(); ?>
		</div>
	</div>
</div>