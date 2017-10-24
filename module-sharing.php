<ul class="share-this">
	<li>
		<?php _e( 'Share this:', 'fran'); ?>
	</li>
	<li>
		<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" rel="external nofollow" onClick="ga('send', 'event', 'share', 'facebook');" title="<?php _e( 'Share this on Facebook', 'fran'); ?>" class="icon facebook">
			<span><?php _e( 'Facebook', 'fran'); ?></span>
		</a>
	</li>
	<li>
		<a href="https://twitter.com/home?status=<?php the_title_attribute(); ?>%20<?php the_permalink(); ?>" title="<?php _e( 'Share this on Twitter', 'fran'); ?>" rel="external nofollow" onClick="ga('send', 'event', 'share', 'twitter');" class="icon twitter">
			<?php _e( 'Twitter', 'fran'); ?>
		</a>
	</li>
	<li>
		<a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title_attribute(); ?>" title="<?php _e( 'Share this on Linkedin', 'fran'); ?>" rel="external nofollow" onClick="ga('send', 'event', 'share', 'linkedin');" class="icon linkedin">
			<?php _e( 'Linkedin', 'fran'); ?>
		</a>
	</li>
	<li>
		<a href="mailto:?subject=<?php the_title_attribute(); ?>&amp;body=<?php the_permalink(); ?>" title="<?php _e( 'Share this via e-mail', 'fran'); ?>" onClick="ga('send', 'event', 'share', 'email');" class="icon email">
		<?php _e( 'E-mail', 'fran'); ?>
		</a>
	</li>
	<li>
		<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" title="<?php _e( 'Share this on Google+', 'fran'); ?>" rel="external nofollow" onClick="ga('send', 'event', 'share', 'google-plus');" class="icon google-plus">
			<?php _e( 'Google+', 'fran'); ?>
		</a>
	</li>
	<li class="show-on-smartphone">
		<a href="whatsapp://send?text=<?php _e( 'Take a look at this', 'fran'); ?>:%20<?php the_title_attribute(); ?>%20<?php the_permalink(); ?>" title="<?php _e( 'Share this via WhatsApp', 'fran'); ?>" onClick="ga('send', 'event', 'share', 'whatsapp');" rel="external nofollow" class="icon whatsapp">
			<?php _e( 'WhatsApp', 'fran'); ?>
		</a>
	</li>
</ul>