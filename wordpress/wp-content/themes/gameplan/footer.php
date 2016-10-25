<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 */
global $font_awesome;
?>
		<footer>
            <div class="bg-container">
                <div id="copyright">
                    <div class="container">
						<div id="footlogo">
                        <?php if(ot_get_option('footerlogo_show') != 0){?>
                        	<?php if(ot_get_option('logo_image') == ''):?>
                                <a class="logo" href="<?php echo get_home_url(); ?>" title="<?php wp_title( '|', true, 'right' ); ?>"><img src="<?php echo get_template_directory_uri()?>/images/logo-1.png" /></a>
                            <?php else:?>
                                <a class="logo" href="<?php echo get_home_url(); ?>" title="<?php wp_title( '|', true, 'right' ); ?>"><img src="<?php echo ot_get_option('logo_image'); ?>" alt="<?php wp_title( '|', true, 'right' ); ?>"/></a>
                            <?php endif;?>	
                        <?php }?>				
						</div>
                        <?php if(is_active_sidebar('copyright')) echo do_shortcode(get_dynamic_sidebar('copyright'));?>
                    </div>
                </div>
            </div>
        </footer>
    </div>        
</div>
<a href="#top" id="gototop" class="notshow" title="Go to top"><i class="icon-angle-up <?php echo $font_awesome==4?'fa fa-angle-up':''; ?>"></i></a>
<?php $gcode = ot_get_option( 'google_analytics_code', ''); if($gcode != ''){ echo $gcode;}?>
<?php wp_footer(); ?>
</body>
</html>