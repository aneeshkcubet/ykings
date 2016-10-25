<?php 
/*
 * Template Name: Front Page
 */
get_header();
?>
<div class="bg-container single-post-body"> 
    <div class="body-top-color"><!----></div>
    <div class="background-color"><!----></div> 
    <div class="container">
		<div class="row-fluid">
			<div class="span12">
				<?php get_template_part('content','page');?>
			</div>
		</div>
    </div>
</div>
<div class="bg-container">	
	<?php get_template_part( 'body', 'bottom' ); // load body-bottom.php ?>
	<?php get_template_part( 'main', 'bottom' ); // load main-bottom.php ?>
</div>
<?php get_footer(); ?>