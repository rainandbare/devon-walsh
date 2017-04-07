<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>
	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20 (removed in functions.php)
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

			<h1 class="page-title order"><?php woocommerce_page_title(); ?></h1>

		<?php endif; ?>
		<?php wc_print_notices(); ?>
<section class="main clearfix">
	<section class='order_selections clearfix'>
		<div class="bowls_options">
			  <?php
			  $week = what_week_is_it();
		        $params = array(
		            'posts_per_page' => -1,
		            'post_type' => 'product',
		            'product_cat' => $week,
		            'orderby' => 'title',
		            'order' => 'ASC'
		        ); 
		        $wc_query = new WP_Query($params); 
		    ?>
		  <?php if ($wc_query->have_posts()) :  ?>
		  	<?php woocommerce_product_loop_start(); ?>
		    <?php while ($wc_query->have_posts()) : 
		                $wc_query->the_post();  ?>
		     <?php wc_get_template_part( 'content', 'product' ); ?>
		    <?php endwhile; ?>
		    <li class="product type-product directions">
		    	<h3>Something inspirational and happy to fill the space!</h3>
		    </li>
		    <?php woocommerce_product_loop_end(); ?>
		  <?php wp_reset_postdata();  ?>
			<?php else:  ?>
		  <p>
		       <?php _e( 'No Bowls Right Now' );  ?>
		  </p>
			<?php endif; ?>
		</div>
		<div class="snacks_options">
			<?php
			    $params = array(
			        'posts_per_page' => -1,
			        'post_type' => 'product',
			        'product_cat' => 'snacks'
			  ); 
			    $wc_query = new WP_Query($params); ?>
			 <?php if ($wc_query->have_posts()) :  ?>
			  	<?php woocommerce_product_loop_start(); ?>
			    <?php while ($wc_query->have_posts()) : 
			                $wc_query->the_post();  ?>
			     <?php wc_get_template_part( 'content', 'product' ); ?>
			    <?php endwhile; ?>
			    <?php woocommerce_product_loop_end(); ?>
			  <?php wp_reset_postdata();  ?>
			<?php else:  ?>
			  <p>
			       <?php _e( 'No Snacks Right Now' );  ?>
			  </p>

			<?php endif; ?>
		</div>
	</section>
	<?php do_action( 'woocommerce_before_cart' ); ?>
	<form action="<?php echo esc_url( wc_get_cart_url() ); ?>" class="cart_sidebar" method="post">
		<?php do_action( 'woocommerce_before_cart_table' ); ?>
			<div id="sunday" class="droppable_cart">
				<h4>Sunday</h4>
				<h6>Delivery on <?php 
					$menuDates = get_menu_dates();
		            $sundayDelivery = $menuDates[0];
		            echo $sundayDelivery;
				?></h6>
				
				<table class="shop_table shop_table_responsive cart" cellspacing="0">
					<tbody>
						<?php 
							do_action( 'woocommerce_before_cart_contents' ); 
							$sunday_is_Empty = true;
						?>
						<?php
						foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
							$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
							$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
							$deliveryDay = $cart_item['variation']['attribute_delivery-day'];
							if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) && $deliveryDay === 'Sunday' ) {
								$sunday_is_Empty = false;
								$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
								?>
								<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
										<td class="product-name" data-title="<?php _e( 'Product', 'woocommerce' ); ?>">
										<?php
											if ( $_product->is_sold_individually() ) {
												$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
											} else {
												$product_quantity = woocommerce_quantity_input( array(
													'input_name'  => "cart[{$cart_item_key}][qty]",
													'input_value' => $cart_item['quantity'],
													'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
													'min_value'   => '0'
												), $_product, false );
												$textQuantity = $cart_item['quantity'];
											}
											echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
										?>
									<p class="product-entry">
										<?php
											if ( ! $product_permalink ) {
												echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
											} else {
												echo apply_filters( 'woocommerce_cart_item_name', sprintf( '%s',$_product->get_title() ), $cart_item, $cart_item_key );
											}
											$id_product = $_product->id;
											$term_list = wp_get_post_terms($id_product,'product_cat',array('fields'=>'slugs'));
											$cat_slug = $term_list[0];
											if ($cat_slug === 'bowls') {
											 	echo " with ";
											 }
											
											$proteinInfo = WC()->cart->get_item_data( $cart_item );
										     if ($proteinInfo === 'justVeg') {
											 	$proteinInfo = 'just veg';
											 }
										    echo $proteinInfo;
								
										?>
									</p>
									</td>
									<td>
										<?php
											echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
												'<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
												esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
												__( 'Remove this item', 'woocommerce' ),
												esc_attr( $product_id ),
												esc_attr( $_product->get_sku() )
											), $cart_item_key );
										?>
									</td>
								</tr>
								<?php
							} 
						}
						if ($sunday_is_Empty){ ?>
							<tr><td>No items to be delivered on Sunday yet.</td></tr>
						<?php }
						do_action( 'woocommerce_cart_contents' );
						?>
						<tr>
							<td colspan="6" class="actions">
							<label class="arrows">
								<div>
									<svg viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve"><path d="M22.98 3.984l-2.6 2.608c0.995 1.53 1.587 3.402 1.587 5.412 0 2.758-1.114 5.256-2.917 7.068-1.773 1.775-4.225 2.873-6.933 2.873-0.041 0-0.082-0-0.123-0.001l0.006-1.981c0.023 0 0.051 0 0.079 0 2.172 0 4.139-0.881 5.561-2.306 1.431-1.446 2.315-3.435 2.315-5.631 0-1.454-0.388-2.818-1.066-3.993l-2.889 2.952v-6.985zM5.090 15.931l2.91-2.916v6.985l-6.98 0.016 2.6-2.608c-0.995-1.53-1.587-3.402-1.587-5.412 0-2.758 1.114-5.256 2.917-7.068 1.773-1.775 4.225-2.873 6.933-2.873 0.041 0 0.082 0 0.123 0.001l-0.006 1.984c-0.024-0-0.053-0-0.082-0-2.171 0-4.136 0.881-5.558 2.305-1.433 1.444-2.319 3.433-2.319 5.629 0 1.456 0.389 2.82 1.069 3.996z"/></svg>
								</div>
								<input type="submit" class="button update_cart" name="update_cart" value="<?php esc_attr_e( 'Update Cart', 'woocommerce' ); ?>" />
							</label>
								<?php do_action( 'woocommerce_cart_actions' ); ?>

								<?php wp_nonce_field( 'woocommerce-cart' ); ?>
							</td>
						</tr>
						<?php do_action( 'woocommerce_after_cart_contents' ); ?>
					</tbody>
				</table>
			</div>
			<div id="wednesday" class="droppable_cart">
				<h4>Wednesday</h4>
				<h6>Delivery on <?php echo $menuDates[3]; ?></h6>
				<table class="shop_table shop_table_responsive cart" cellspacing="0">
					<tbody>
						<?php 
							do_action( 'woocommerce_before_cart_contents' ); 
							$wednesday_is_Empty = true;
						?>
						<?php
						foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
							$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
							$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
							$deliveryDay = $cart_item['variation']['attribute_delivery-day'];
							if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) && $deliveryDay === 'Wednesday' ) {
								$wednesday_is_Empty = false;
								$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
								?>
								<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
										<td class="product-name" data-title="<?php _e( 'Product', 'woocommerce' ); ?>">
										<?php
											if ( $_product->is_sold_individually() ) {
												$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
											} else {
												$product_quantity = woocommerce_quantity_input( array(
													'input_name'  => "cart[{$cart_item_key}][qty]",
													'input_value' => $cart_item['quantity'],
													'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
													'min_value'   => '0'
												), $_product, false );
												$textQuantity = $cart_item['quantity'];
											}
											echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
										?>
									<p class="product-entry">
										<?php
											if ( ! $product_permalink ) {
												echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
											} else {
												echo apply_filters( 'woocommerce_cart_item_name', sprintf( '%s',$_product->get_title() ), $cart_item, $cart_item_key );
											}
											$id_product = $_product->id;
											$term_list = wp_get_post_terms($id_product,'product_cat',array('fields'=>'slugs'));
											$cat_slug = $term_list[0];
											if ($cat_slug === 'bowls') {
											 	echo " with ";
											 }
											
											$proteinInfo = WC()->cart->get_item_data( $cart_item );
										     if ($proteinInfo === 'justVeg') {
											 	$proteinInfo = 'just veg';
											 }
										    echo $proteinInfo;
										?>
									</p>
									</td>
									<td>
										<?php
											echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
												'<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
												esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
												__( 'Remove this item', 'woocommerce' ),
												esc_attr( $product_id ),
												esc_attr( $_product->get_sku() )
											), $cart_item_key );
										?>
									</td>
								</tr>
								<?php
							} 
						}
						if ($wednesday_is_Empty){ ?>
							<tr><td>No items to be delivered on Wednesday yet.</td></tr>
						<?php }
						do_action( 'woocommerce_cart_contents' );
						?>
						<tr>
							<td colspan="6" class="actions">
							<label class="arrows">
								<div>
									<svg viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve"><path d="M22.98 3.984l-2.6 2.608c0.995 1.53 1.587 3.402 1.587 5.412 0 2.758-1.114 5.256-2.917 7.068-1.773 1.775-4.225 2.873-6.933 2.873-0.041 0-0.082-0-0.123-0.001l0.006-1.981c0.023 0 0.051 0 0.079 0 2.172 0 4.139-0.881 5.561-2.306 1.431-1.446 2.315-3.435 2.315-5.631 0-1.454-0.388-2.818-1.066-3.993l-2.889 2.952v-6.985zM5.090 15.931l2.91-2.916v6.985l-6.98 0.016 2.6-2.608c-0.995-1.53-1.587-3.402-1.587-5.412 0-2.758 1.114-5.256 2.917-7.068 1.773-1.775 4.225-2.873 6.933-2.873 0.041 0 0.082 0 0.123 0.001l-0.006 1.984c-0.024-0-0.053-0-0.082-0-2.171 0-4.136 0.881-5.558 2.305-1.433 1.444-2.319 3.433-2.319 5.629 0 1.456 0.389 2.82 1.069 3.996z"/></svg>
								</div>
								<input type="submit" class="button update_cart" name="update_cart" value="<?php esc_attr_e( 'Update Cart', 'woocommerce' ); ?>" />
							</label>

								<?php do_action( 'woocommerce_cart_actions' ); ?>

								<?php wp_nonce_field( 'woocommerce-cart' ); ?>
							</td>
						</tr>
						<?php do_action( 'woocommerce_after_cart_contents' ); ?>
					</tbody>
				</table>
			</div>
		<?php do_action( 'woocommerce_after_cart_table' ); ?>
	</form>
</section>


<?php 
if (WC()->cart->get_cart_contents_count() == 0): ?>
<!-- html code to run if cart is empty -->
<?php else: ?>
<!-- html code to run if cart has something in it -->
<section class="order-summary">
	<div class="container">
		<h3>Order Summary</h3>
	<?php	do_action( 'woocommerce_before_cart' ); ?>

	<form action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

		<?php do_action( 'woocommerce_before_cart_table' ); ?>

		<table class="shop_table shop_table_responsive cart complete-order" cellspacing="0">
			<thead>
				<tr>
					<th class="product-delivery-day">&nbsp;</th>
					<th class="product-remove">&nbsp;</th>
					<th class="product-thumbnail">&nbsp;</th>
					<th class="product-name"><?php _e( 'Product', 'woocommerce' ); ?></th>
					<th class="product-price"><?php _e( 'Price', 'woocommerce' ); ?></th>
					<th class="product-quantity"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
					<th class="product-subtotal"><?php _e( 'Total', 'woocommerce' ); ?></th>
					<th class="product-refresh">&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<div>
				<?php do_action( 'woocommerce_before_cart_contents' ); ?>

				<?php
				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
					$deliveryDay = $cart_item['variation']['attribute_delivery-day'];
							if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) && $deliveryDay === 'Sunday' ) {
						$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
						?>

						<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
							<td class="product-delivery-day sunday"></td>
							<td class="product-remove">
								<?php
									echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
										'<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
										esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
										__( 'Remove this item', 'woocommerce' ),
										esc_attr( $product_id ),
										esc_attr( $_product->get_sku() )
									), $cart_item_key );
								?>
							</td>

							<td class="product-thumbnail">
								<?php
									$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

									if ( ! $product_permalink ) {
										echo $thumbnail;
									} else {
										printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
									}
								?>
							</td>

							<td class="product-name" data-title="<?php _e( 'Product', 'woocommerce' ); ?>">
								<?php
									if ( ! $product_permalink ) {
										echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
									} else {
										echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_title() ), $cart_item, $cart_item_key );
									}
									$id_product = $_product->id;
									$term_list = wp_get_post_terms($id_product,'product_cat',array('fields'=>'slugs'));
									$cat_slug = $term_list[0];
									if ($cat_slug === 'bowls') {
									 	echo " with ";
									 }
									
									$proteinInfo = WC()->cart->get_item_data( $cart_item );
								     if ($proteinInfo === 'justVeg') {
									 	$proteinInfo = 'just veg';
									 }
								    echo $proteinInfo;
									// Backorder notification
									if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
										echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>';
									}
								?>
							</td>

							<td class="product-price" data-title="<?php _e( 'Price', 'woocommerce' ); ?>">
								<?php
									echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
								?>
							</td>

							<td class="product-quantity" data-title="<?php _e( 'Quantity', 'woocommerce' ); ?>">
								<?php
									if ( $_product->is_sold_individually() ) {
										$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
									} else {
										$product_quantity = woocommerce_quantity_input( array(
											'input_name'  => "cart[{$cart_item_key}][qty]",
											'input_value' => $cart_item['quantity'],
											'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
											'min_value'   => '0'
										), $_product, false );
									}

									echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
								?>
							</td>

							<td class="product-subtotal" data-title="<?php _e( 'Total', 'woocommerce' ); ?>">
								<?php
									echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
								?>
							</td>
							<td class="product-refresh">
									<label class="arrows">
										<div>
											<svg viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve"><path d="M22.98 3.984l-2.6 2.608c0.995 1.53 1.587 3.402 1.587 5.412 0 2.758-1.114 5.256-2.917 7.068-1.773 1.775-4.225 2.873-6.933 2.873-0.041 0-0.082-0-0.123-0.001l0.006-1.981c0.023 0 0.051 0 0.079 0 2.172 0 4.139-0.881 5.561-2.306 1.431-1.446 2.315-3.435 2.315-5.631 0-1.454-0.388-2.818-1.066-3.993l-2.889 2.952v-6.985zM5.090 15.931l2.91-2.916v6.985l-6.98 0.016 2.6-2.608c-0.995-1.53-1.587-3.402-1.587-5.412 0-2.758 1.114-5.256 2.917-7.068 1.773-1.775 4.225-2.873 6.933-2.873 0.041 0 0.082 0 0.123 0.001l-0.006 1.984c-0.024-0-0.053-0-0.082-0-2.171 0-4.136 0.881-5.558 2.305-1.433 1.444-2.319 3.433-2.319 5.629 0 1.456 0.389 2.82 1.069 3.996z"/></svg>
										</div>
										<input type="submit" class="button update_cart" name="update_cart" value="<?php esc_attr_e( 'Update Cart', 'woocommerce' ); ?>" />
									</label>
							</td>
						</tr>
						<?php
					}
				}
				?>

				<?php
				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
					$deliveryDay = $cart_item['variation']['attribute_delivery-day'];
							if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) && $deliveryDay === 'Wednesday' ) {
						$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
						?>
						<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
							<td class="product-delivery-day wednesday"></td>
							<td class="product-remove">
								<?php
									echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
										'<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
										esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
										__( 'Remove this item', 'woocommerce' ),
										esc_attr( $product_id ),
										esc_attr( $_product->get_sku() )
									), $cart_item_key );
								?>
							</td>

							<td class="product-thumbnail">
								<?php
									$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

									if ( ! $product_permalink ) {
										echo $thumbnail;
									} else {
										printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
									}
								?>
							</td>

							<td class="product-name" data-title="<?php _e( 'Product', 'woocommerce' ); ?>">
								<?php
									if ( ! $product_permalink ) {
										echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
									} else {
										echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_title() ), $cart_item, $cart_item_key );
									}
									$id_product = $_product->id;
									$term_list = wp_get_post_terms($id_product,'product_cat',array('fields'=>'slugs'));
									$cat_slug = $term_list[0];
									if ($cat_slug === 'bowls') {
									 	echo " with ";
									 }
									
									$proteinInfo = WC()->cart->get_item_data( $cart_item );
								     if ($proteinInfo === 'justVeg') {
									 	$proteinInfo = 'just veg';
									 }
								    echo $proteinInfo;
									// Backorder notification
									if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
										echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>';
									}
								?>
							</td>

							<td class="product-price" data-title="<?php _e( 'Price', 'woocommerce' ); ?>">
								<?php
									echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
								?>
							</td>

							<td class="product-quantity" data-title="<?php _e( 'Quantity', 'woocommerce' ); ?>">
								<?php
									if ( $_product->is_sold_individually() ) {
										$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
									} else {
										$product_quantity = woocommerce_quantity_input( array(
											'input_name'  => "cart[{$cart_item_key}][qty]",
											'input_value' => $cart_item['quantity'],
											'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
											'min_value'   => '0'
										), $_product, false );
									}

									echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
								?>
							</td>

							<td class="product-subtotal" data-title="<?php _e( 'Total', 'woocommerce' ); ?>">
								<?php
									echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
								?>
							</td>
							<td class="product-refresh">
									<label class="arrows">
										<div>
											<svg viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve"><path d="M22.98 3.984l-2.6 2.608c0.995 1.53 1.587 3.402 1.587 5.412 0 2.758-1.114 5.256-2.917 7.068-1.773 1.775-4.225 2.873-6.933 2.873-0.041 0-0.082-0-0.123-0.001l0.006-1.981c0.023 0 0.051 0 0.079 0 2.172 0 4.139-0.881 5.561-2.306 1.431-1.446 2.315-3.435 2.315-5.631 0-1.454-0.388-2.818-1.066-3.993l-2.889 2.952v-6.985zM5.090 15.931l2.91-2.916v6.985l-6.98 0.016 2.6-2.608c-0.995-1.53-1.587-3.402-1.587-5.412 0-2.758 1.114-5.256 2.917-7.068 1.773-1.775 4.225-2.873 6.933-2.873 0.041 0 0.082 0 0.123 0.001l-0.006 1.984c-0.024-0-0.053-0-0.082-0-2.171 0-4.136 0.881-5.558 2.305-1.433 1.444-2.319 3.433-2.319 5.629 0 1.456 0.389 2.82 1.069 3.996z"/></svg>
										</div>
										<input type="submit" class="button update_cart" name="update_cart" value="<?php esc_attr_e( 'Update Cart', 'woocommerce' ); ?>" />
									</label>
							</td>
						</tr>
						<?php
					}
				}

				do_action( 'woocommerce_cart_contents' );
				?>
				</div>
				<tr>
					<td colspan="6" class="actions">

						<?php do_action( 'woocommerce_cart_actions' ); ?>

						<?php wp_nonce_field( 'woocommerce-cart' ); ?>
					</td>
				</tr>

				<?php do_action( 'woocommerce_after_cart_contents' ); ?>
			</tbody>
		</table>

		<?php do_action( 'woocommerce_after_cart_table' ); ?>

	</form>
	<div class="devon_order_subtotals">
	<p class="total"><strong><?php _e( 'Subtotal', 'woocommerce' ); ?>:</strong> <?php echo WC()->cart->get_cart_subtotal(); ?></p>
	<div class="wc-proceed-to-checkout">
		<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
	</div>
		
		<?php
		//do_action( 'woocommerce_cart_collaterals' ); ?>

	</div>
	<?php do_action( 'woocommerce_after_cart' ); ?>
</section>
<?php endif ?>


<?php get_footer( 'shop' ); ?>
