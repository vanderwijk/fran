<?php $object = get_object_taxonomies( $post ); ?>
<ul class="categories">
	<?php echo get_the_term_list( $post->ID, $object[0], '<li>', '</li><li>', '</li>' ); ?>
</ul>