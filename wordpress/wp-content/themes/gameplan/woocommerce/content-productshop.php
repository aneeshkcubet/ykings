<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

$column_class = '';

switch($woocommerce_loop['columns']){
	case 3: $column_class = 'span4';break;
	case 4: $column_class = 'span3';break;
	case 6: $column_class = 'span2';break;
	case 2: $column_class = 'span6';break;
}
	
// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
$classes[] = $column_class;
?>
<div <?php post_class( $classes ); ?>>

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<a href="<?php the_permalink(); ?>">

	<?php if ($product->is_on_sale()) : ?>
    
        <?php echo apply_filters('woocommerce_sale_flash', '<span class="onsale">' . esc_html__( 'Sale!', 'woocommerce' ) . '</span>', $post, $product); ?>
    
    <?php endif; ?>
		<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			//do_action( 'woocommerce_before_shop_loop_item_title' );
			if(has_post_thumbnail(get_the_ID())){
				echo '<div class="thumb item-thumbnail">
						<div class="item-thumbnail">
							'.get_the_post_thumbnail(get_the_ID(),'thumb_279x358').'
						</div>
				</div>';
			}
		?>
	</a>
	<div class="description">
		<h3><a href="<?php the_permalink(); ?>">
			<?php the_title(); ?>
			</a>
		</h3>
		<?php
			/**
			 * woocommerce_after_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );
		?>
		<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
	</div>
</div>
<?php
// end a row
global $count_it;
global $item_c;
if((0 == $item_c % $woocommerce_loop['columns']) && ($item_c < $count_it)){
?>
</div> <!-- end <div class="products row-fluid"> -->
<div class="products row-fluid">
<?php
}
if($item_c==$count_it){
?>
</div> <!-- end <div class="products row-fluid"> -->
<?php
}