<?php
/**
 * Proceed to checkout button
 *
 * Contains the markup for the proceed to checkout button on the cart.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/proceed-to-checkout-button.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<?php 
	$bowlsInCart = 0;
	foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
		
		$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
		$quantity = $cart_item['quantity'];
		$terms = get_the_terms( $product_id,'product_cat');
		if ( $terms && ! is_wp_error( $terms ) ) : 
            foreach ( $terms as $term ) {
                $product_cat_slug = $term->slug;
                if( $product_cat_slug == 'bowls'){
                	$bowlsInCart = $bowlsInCart + (1 * $quantity);
                	//echo "   " . $bowlsInCart;
              	}
            }
        endif;
	}

	if ($bowlsInCart < 4){ ?>
		<!-- //disable proceed to checkout button
		//provide note -->
		<a href="<?php echo esc_url( wc_get_checkout_url() ) ;?>" class="checkout-button button alt wc-forward disabled disabled-proceed-to-cart">
			<?php echo __( 'Proceed to Checkout', 'woocommerce' ); ?>
		</a>
		<p class="disabled-warning">Add at least 4 bowls to proceed to checkout!</p>
		<p class="disabled-warning"> (plus as many Snacks as you would like ;) </p>
	<?php } else { ?>
		<a href="<?php echo esc_url( wc_get_checkout_url() ) ;?>" class="checkout-button button alt wc-forward">
			<?php echo __( 'Proceed to Checkout', 'woocommerce' ); ?>
		</a>
<?php } ?>
