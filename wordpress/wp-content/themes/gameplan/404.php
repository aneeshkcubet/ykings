<?php
/**
 * The template for displaying 404 pages (Not Found).
 */

get_header();
?>
<div class="bg-container single-post-body"> 
    <div class="body-top-color"><!----></div>
    <div class="background-color"><!----></div> 
    <div class="container">
    	<div class="container-pad">
            <div class="row-fluid">
            	<div class="span4">&nbsp;</div>
                <div class="span4">
					<h1 class="entry-title title-404">404</h1>
                    <div class="dotted"></div>
                    <div class="entry-content content-404">
                        <div class="p"><?php echo ot_get_option('page404_content','Page not found'); ?></div>
                        <div class="dotted" style="margin-bottom:9px;"></div>
                        <div class="dotted"></div>
                    </div><!-- .entry-content -->
                </div>
                <div class="span4">&nbsp;</div>
            </div>
		</div>
    </div>
</div>
<div class="bg-container">
<?php get_template_part( 'body', 'bottom' ); // load body-bottom.php ?>
<?php get_template_part( 'main', 'bottom' ); // load main-bottom.php ?>
</div>
<?php get_footer(); ?>