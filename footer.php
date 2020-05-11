</main>
	<footer class="footer" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
		<div class="breadcrumbs">
			<div class="row">
				<div class="col">
					<div class="block">
	<?php if ( function_exists('yoast_breadcrumb') ) {
	yoast_breadcrumb('<p>','</p>');
	}; ?>
	
						<p id="scroll-up" class="scroll-up animated fadeIn">
							<?php _e( 'Back to top', 'fran' ); ?>
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="bottom">
			<div class="row">
				<?php if ( ! dynamic_sidebar( 'footer' ) ) : endif ?>
			</div>
		</div>
		<div class="copyright">
			<div class="row">
				<div class="col half">
					<div class="block">
						&copy; 1998-<?php echo date("Y"); ?> <?php _e('All rights reserved', 'fran'); ?>
					</div>
				</div>
				<?php if ( is_front_page() ) { ?>
				<div class="col half">
					<div class="block credits">
					<?php _e('Fran WordPress theme by', 'fran'); ?> <a href="https://thewebworks.nl" title="The Web Works" rel="external">The Web Works</a>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</footer>
<?php wp_footer(); ?>
</body>
</html>