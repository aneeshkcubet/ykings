<?php
/**
 * Order details
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version 2.5.3
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$order = wc_get_order( $order_id );
?>
<div class="row-fluid">
<div class="span6">
<?php echo do_shortcode('[heading heading="'.esc_html__( 'Order Details', 'woocommerce' ).'" firstword="yes" dotted="yes" style="dot" firstword="no" ]');?>

<table class="shop_table order_details">
	<thead>
		<tr>
			<th class="product-name"><?php _e( 'Product', 'woocommerce' ); ?></th>
			<th class="product-total"><?php _e( 'Total', 'woocommerce' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach( $order->get_items() as $item_id => $item ) {
				$product = apply_filters( 'woocommerce_order_item_product', $order->get_product_from_item( $item ), $item );
				$purchase_note = get_post_meta( $product->id, '_purchase_note', true );

				wc_get_template( 'order/order-details-item.php', array(
					'order'					=> $order,
					'item_id'				=> $item_id,
					'item'					=> $item,
					'show_purchase_note'	=> $show_purchase_note,
					'purchase_note'			=> $purchase_note,
					'product'				=> $product,
				) );
			}
		?>
		<?php do_action( 'woocommerce_order_items_table', $order ); ?>
	</tbody>
	<tfoot>
		<?php
			foreach ( $order->get_order_item_totals() as $key => $total ) {
				?>
				<tr>
					<th scope="row"><?php echo $total['label']; ?></th>
					<td><?php echo $total['value']; ?></td>
				</tr>
				<?php
			}
		?>
	</tfoot>
</table>

<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>
</div>
<div class="span6 customer-details">
	<style type="text/css">.customer-details header h2{ display:none}</style>
	<?php echo do_shortcode('[heading heading="'.esc_html__( 'Customer details', 'woocommerce' ).'" firstword="yes" dotted="yes" style="dot" firstword="no" ]');?>
    <?php wc_get_template( 'order/order-details-customer.php', array( 'order' =>  $order ) ); ?>
</div><!-- end span6 -->
</div><!-- end row-fluid -->
<div class="clear"></div>
