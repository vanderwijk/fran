
<div <?php post_class( 'block' ); ?>>
	<div class="entry-meta">
		<span class="date updated"><?php the_modified_date( get_option( 'date_format' ) ); ?></span>
		<span class="vcard author">
			<?php _e( 'by', 'fran' ); ?>
			<span class="fn"><?php the_author(); ?></span>
		</span>
	</div>
	<h1 class="entry-title"><?php the_title(); ?></h1>
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
</div>