<?php 
/* This is default template for page: Right Sidebar 
 *
 * Check theme option to display default layout
 */
$layout = ot_get_option('page_layout');
$layout_themes = ot_get_option('layout');
$page_layout = get_post_meta(get_current_woocommerce_page_ID(),'_wp_page_template', true);
if($page_layout == '') {
	$page_layout = $layout;
} else {
	switch($page_layout){
		case 'page-templates/sidebar-right.php':$page_layout = 'right';break;
		case 'page-templates/sidebar-left.php':$page_layout = 'left';break;
		case 'page-templates/full-width.php':$page_layout = 'full';break;
	}
}

get_header(); ?>
<div id="main-body" class="bg-container single-page-body"> 
    <div class="body-top-color"><!----></div>
    <div class="background-color"><!----></div> 
    <div class="container">    	
		<?php if($layout_themes != 'wide'){?>
		<div class="container-pad">
		<?php }?>
            <div class="row-fluid <?php echo ($page_layout == 'left') ? "revert-layout":"";?>">
                <div class="<?php if($page_layout == 'full') echo 'span12'; else echo 'span9';?>">
					<div <?php post_class(); ?>>					
						<?php 
						
						if ( is_singular( 'product' ) ) {

							while ( have_posts() ) : the_post();

								woocommerce_get_template_part( 'content', 'single-product' );

							endwhile;

						} else { ?>
<!--
							<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

								<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

							<?php endif; ?>
-->
							<?php do_action( 'woocommerce_archive_description' ); ?>

							<?php if ( have_posts() ) : ?>
								<div class="before_shop_loop">
									<?php do_action('woocommerce_before_shop_loop'); ?>
									<div class="clear"><!-- --></div>
								</div>

								<?php woocommerce_product_loop_start(); ?>

									<?php 
									$args = array(
										'hide_empty'        => true,
										'parent' => false, 
									); 
									//$term =;
									$childrens =1;
									if(is_tax()){
										$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
										$childrens = get_term_children($term->term_id, get_query_var('taxonomy'));
										$number =0;
										foreach ( $childrens as $children ) {
											 $slug_t = get_term_by('id', $children, 'product_cat')->count;
											 if($slug_t>0){$number++;}
										}
										if($number ==0){$childrens = 0;}
										else{$childrens = sizeof($childrens);}
										$count_term_pro = $number;
									}else{
										$count_term_pro = wp_count_terms('product_cat', $args);
									}
									global $count_term_pro;
									$option_sl = get_option('woocommerce_shop_page_display');
									if(is_tax()){ $option_sl = get_option('woocommerce_category_archive_display');}
									if($option_sl=='both' && $childrens>0){?>
                                    <div class="products row-fluid">
                                    <?php }
									woocommerce_product_subcategories(); ?>
									<?php 
									global $wp_query;
									$count_it = $wp_query->post_count; 
									global $count_it;
									$item_c='';?>
                                    <div class="products row-fluid">
                                    <?php
									while ( have_posts() ) : the_post();
									$item_c ++; global $item_c ; ?>

										<?php woocommerce_get_template_part( 'content', 'productshop' ); ?>

									<?php endwhile; // end of the loop. ?>

								<?php woocommerce_product_loop_end(); ?>

								<?php do_action('woocommerce_after_shop_loop'); ?>

							<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

								<?php woocommerce_get_template( 'loop/no-products-found.php' ); ?>

							<?php endif;

						}
						
						?>
					</div>
                </div>
				<?php if($page_layout != 'full'){?>
                <div class="span3">
                	<div id="mainsidebar">						
						<?php 
						if(is_active_sidebar('woocommerce')){
							echo get_dynamic_sidebar('woocommerce');
						} else {
							echo get_dynamic_sidebar(get_post_meta(get_the_ID(),'sidebar_name',true)?get_post_meta(get_the_ID(),'sidebar_name',true):'main_sidebar');
						}?>
                    </div>
                </div>
				<?php }?>
            </div>
		<?php if($layout_themes != 'wide'){?>
		</div>
		<?php }?>
    </div>
</div>
<div class="bg-container">
<?php get_template_part( 'body', 'bottom' ); // load body-bottom.php ?>
<?php get_template_part( 'main', 'bottom' ); // load main-bottom.php ?>
</div>
<?php get_footer(); ?>