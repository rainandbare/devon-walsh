<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
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
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_navigation' );
$current_user = wp_get_current_user()
?>

<nav class="woocommerce-MyAccount-navigation">
	<p class="nav_user">
	<?php
		echo sprintf( esc_attr__( 'Hello %s%s%s!', 'woocommerce' ), '<strong>', esc_html( $current_user->user_firstname ), '</strong>');
	?>
	</p>
	<p class="nav_user_signout">
	<?php
		echo sprintf( esc_attr__( '(not %s? %sSign out%s)', 'woocommerce' ), esc_html( $current_user->user_firstname ),'<a href="' . esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) ) . '">', '</a>' );
	?>
	</p>

	<ul>
		<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
			<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>
