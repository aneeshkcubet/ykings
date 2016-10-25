<?php
/**
 * Customer new account email
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php do_action( 'woocommerce_email_header', $email_heading ); ?>

<p><?php printf(wp_kses(__("Thanks for creating an account on %s. Your username is <strong>%s</strong>.", 'woocommerce'),array('strong'=>array())), esc_html( $blogname ), esc_html( $user_login ) ); ?></p>

<p><?php printf(esc_html__( 'You can access your account area here: %s.', 'woocommerce' ), get_permalink(woocommerce_get_page_id('myaccount'))); ?></p>

<?php do_action( 'woocommerce_email_footer' ); ?>