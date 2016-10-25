<?php
/**
 * The template for displaying product category thumbnails within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product_cat.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce_loop;

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

// Increase loop count
$woocommerce_loop['loop']++;
?>
<div class="<?php echo $column_class;?> product-category product<?php
    if ( ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] == 0 || $woocommerce_loop['columns'] == 1)
        echo ' first';
	if ( $woocommerce_loop['loop'] % $woocommerce_loop['columns'] == 0 )
		echo ' last';
	?>">

	<?php do_action( 'woocommerce_before_subcategory', $category ); ?>

	<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">

		<?php
			/**
			 * woocommerce_before_subcategory_title hook
			 *
			 * @hooked woocommerce_subcategory_thumbnail - 10
			 */
			do_action( 'woocommerce_before_subcategory_title', $category );
		?>
		<div class="cat-name">
            <h3>
                <?php
                    echo $category->name;
    
                ?>
            </h3>
            
            <?php if ( $category->count > 0 )
                        echo apply_filters( 'woocommerce_subcategory_count_html', ' <span class="count-cat">(' . $category->count . ')</span>', $category );
            ?>
        </div>
		<?php
			/**
			 * woocommerce_after_subcategory_title hook
			 */
			do_action( 'woocommerce_after_subcategory_title', $category );
		?>

	</a>

	<?php do_action( 'woocommerce_after_subcategory', $category ); ?>

</div>
<?php
// end a row
global $count_term_pro;
if((0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns']) && ($woocommerce_loop['loop'] < $count_term_pro)){
?>
</div> <!-- end <div class="products row-fluid"> -->
<div class="products row-fluid">
<?php
}
if($woocommerce_loop['loop']==$count_term_pro){
?>
</div> <!-- end <div class="products row-fluid"> -->
<?php
}