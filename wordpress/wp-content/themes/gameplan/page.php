<?php 
/* This is default template for page: Right Sidebar 
 *
 * Check theme option to display default layout
 */
$layout = ot_get_option('page_layout');

$in_woocommerce_page = 0;

if(function_exists('is_woocommerce_page') && is_woocommerce_page()){
	$in_woocommerce_page = 1;
}

$woocommerce_class = '';
if(function_exists('is_woocommerce_thanks_page')){
	$woocommerce_class = is_woocommerce_thanks_page() ? "woo-page thanks":(is_woocommerce_myaccount_page() ? "woo-page myaccount":(is_woocommerce_editaddress_page() ? "woo-page editaddress":(is_woocommerce_changepassword_page() ? "woo-page changepassword":(is_woocommerce_lostpassword_page() ? "woo-page lostpassword":(is_woocommerce_vieworder_page() ? "woo-page vieworder":(is_woocommerce_logout_page() ? "woo-page logout":""))))));
}

get_header(); ?>
<div class="bg-container single-page-body <?php echo $woocommerce_class;?>"> 
    <div class="body-top-color"><!----></div>
    <div class="background-color"><!----></div> 
    <div class="container">    	
		<?php if($layout != 'full'){?>
		<div class="container-pad">
		<?php }?>
            <div class="row-fluid <?php echo ($layout == 'left') ? "revert-layout":"";?>">
                <div class="<?php if($layout == 'full') echo 'span12'; else echo 'span9';?>">
					<div <?php post_class(); ?>>					
						<?php get_template_part('content','page');?>
					</div>
                </div>
				<?php if($layout != 'full'){?>
                <div class="span3">
                	<div id="mainsidebar">
						<?php
						if($in_woocommerce_page){
							if(is_active_sidebar('woocommerce')){
								echo get_dynamic_sidebar('woocommerce');
							} else {
								echo get_dynamic_sidebar(get_post_meta(get_the_ID(),'sidebar_name',true)?get_post_meta(get_the_ID(),'sidebar_name',true):'main_sidebar');
							}
						} else 
							echo get_dynamic_sidebar(get_post_meta(get_the_ID(),'sidebar_name',true)?get_post_meta(get_the_ID(),'sidebar_name',true):'main_sidebar');
						?>
                    </div>
                </div>
				<?php }?>
            </div>
		<?php if($layout != 'full'){?>
		</div>
		<?php }?>
    </div>
</div>
<div class="bg-container">
<?php get_template_part( 'body', 'bottom' ); // load body-bottom.php ?>
<?php get_template_part( 'main', 'bottom' ); // load main-bottom.php ?>
</div>
<?php get_footer(); ?>