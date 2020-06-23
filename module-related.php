<?php // Related posts template, requires the SearchWP plugin with related posts extension

if ( class_exists('SearchWP_Related') ) {
	$searchwp_related = new SearchWP_Related();

	// Use the keywords as defined in the SearchWP Related meta box
	$keywords = get_post_meta( get_the_ID(), $searchwp_related->meta_key, true );

	$args = array(
		's'              => $keywords,
		'engine'         => 'posts',
		'posts_per_page' => 3,
	);

	// Retrieve Related content for the current post
	$related_content = $searchwp_related->get( $args );

	if ( $related_content ) { ?>

	<div class="col">
		<div class="block related">
			<h3><?php _e( 'Related posts', 'fran' ); ?></h3>
			<ul>
				<?php
					foreach ( $related_content as $related ) { ?>
						<li><a href="<?php echo get_permalink( $related); ?>"><?php echo get_the_title( $related ); ?></a></li>
					<?php
					}
				?>
			</ul>
		</div>
	</div>

	<?php wp_reset_postdata();
	}
}