<?php 
/**
 * Template Name: Shortcode Sidebar Left
 */
 
get_header(); ?>
<div class="bg-container single-post-body"> 
    <div class="body-top-color"><!----></div>
    <div class="background-color"><!----></div> 
    <div class="container">
		<div class="container-pad">
			<div class="row-fluid revert-layout">
				<div class="span9">
					<?php get_template_part('content','page');?>
				</div>
				<div id="mainsidebar" class="span3">
					<?php echo get_dynamic_sidebar('cs-shortcodes');?>
				</div>
			</div>
		</div>
    </div>
</div>
<div class="bg-container">
<?php get_template_part( 'body', 'bottom' ); // load body-bottom.php ?>
<?php get_template_part( 'main', 'bottom' ); // load main-bottom.php ?>
</div>
<?php get_footer(); ?>