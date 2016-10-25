<?php
/**
 * The sidebar containing the main widget area.
 */
?>
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<div class="span3">
			<div id="secondary" class="widget-area" role="complementary">
				<?php dynamic_sidebar( 'sidebar-1' ); ?>
			</div><!-- #secondary -->
		</div>
	<?php endif; ?>