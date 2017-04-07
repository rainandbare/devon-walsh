<?php
/**
 * Variable product add to cart
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 *
 * Modified to use radio buttons instead of dropdowns
 * @author 8manos
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! function_exists( 'print_attribute_radio' ) ) {
	function print_attribute_radio( $checked_value, $value, $label, $name, $product ) {
		// This handles < 2.4.0 bw compatibility where text attributes were not sanitized.
		$checked = sanitize_title( $checked_value ) === $checked_value ? checked( $checked_value, sanitize_title( $value ), false ) : checked( $checked_value, $value, false );

		$productID = absint( $product->id ); 

		$input_name = 'attribute_' . esc_attr( $name ) ;
		$esc_value = esc_attr( $value );
		$id = esc_attr( $name . '_v_' . $value . '_' . $productID);
		$filtered_label = apply_filters( 'woocommerce_variation_option_name', $label );
		if($filtered_label === 'chicken'){
			$filtered_label_suzette = '<div class="protein_type chicken" data-protein-type="chicken">
				<svg viewBox="0 0 34 33">
				    <title>chicken</title>
				        <g>
				            <path d="M16.0473448,25.2440487 L16.0473448,30.2619789 L15.025462,30.2619789 C14.6848344,30.2619789 14.3820543,30.5321752 14.3820543,30.9181698 C14.3820543,31.265565 14.6469868,31.5743607 15.025462,31.5743607 L16.6907524,31.5743607 L20.7025886,31.5743607 C21.0432162,31.5743607 21.3459963,31.3041644 21.3459963,30.9181698 C21.3459963,30.5707746 21.0810638,30.2619789 20.7025886,30.2619789 L17.2963126,30.2619789 L17.2963126,25.2440487 C17.0692276,25.2440487 16.87999,25.2826482 16.6529049,25.2826482 C16.5015149,25.2440487 16.2744298,25.2440487 16.0473448,25.2440487 L16.0473448,25.2440487 Z"></path>
				            <path d="M33.684285,2.97215864 C33.2679624,1.85277422 32.4731646,0.964986573 31.4512818,0.424594092 C30.5429416,-0.0385994629 29.4453637,-0.115798389 28.4613284,0.231596777 C27.9314633,0.424594092 27.4772931,0.694790332 27.098818,1.08078496 L27.098818,1.08078496 C26.7960379,1.38958066 26.5689529,1.69837637 26.3797153,2.084371 L26.3797153,2.12297046 C25.0550524,4.90213179 22.4814217,6.94790332 19.4536208,7.56549473 L18.0532629,7.83569097 C15.8202597,8.29888453 13.5115615,7.95148936 11.5056434,6.90930386 L7.45595971,4.74773394 C5.18510904,3.55115059 2.61147827,2.85636026 0.0378475112,2.7019624 L3.86044614,14.1660029 C4.61739637,16.5977691 6.0556018,18.759339 7.94797736,20.4191159 L8.40214749,20.8051105 C10.5594556,22.6964842 13.2466289,23.7772692 16.0851923,23.931667 L16.7286,23.931667 C16.955685,23.931667 17.1449226,23.931667 17.3720077,23.8930675 C21.913709,23.7000702 26.0390877,21.2683041 28.4613284,17.3697583 C30.202314,14.5133981 30.7321791,10.9622475 29.8616864,7.52689527 C29.7859913,7.29529849 29.7859913,7.06370171 29.7859913,6.83210494 C29.7859913,5.24952696 31.0349592,3.97574468 32.5867072,3.97574468 L33.7978275,3.97574468 L33.7978275,3.97574468 L34.1006076,3.97574468 L33.684285,2.97215864 L33.684285,2.97215864 Z M24.2224072,14.590597 C21.838014,16.9837637 18.658823,18.257546 15.4417846,18.257546 C13.549409,18.257546 11.6191859,17.8329519 9.84035292,16.9065648 C9.68896287,16.8293658 9.53757283,16.674968 9.49972532,16.4819707 C9.46187781,16.2889733 9.49972532,16.095976 9.61326785,15.9415782 L12.0355086,12.4676265 C12.2247461,12.1974303 12.6410687,12.1202314 12.9060013,12.3132287 C13.2087814,12.506226 13.2466289,12.9308201 13.0573914,13.2010163 L11.0514733,16.0187771 C15.2146995,17.7943524 20.0591809,16.9065648 23.3140669,13.6256104 C23.5789995,13.3940136 23.9574746,13.3940136 24.2224072,13.6256104 C24.4873398,13.9344061 24.4873398,14.3590002 24.2224072,14.590597 L24.2224072,14.590597 Z"></path>
				        </g>
				</svg>
			</div>';
		} elseif ($filtered_label === 'beef') {
			$filtered_label_suzette = '<div class="protein_type cow" data-protein-type="beef">
				<svg viewBox="0 0 36 32">
				    <title>cow</title>
				        <path d="M27.6584205,6.96334311 C27.4124117,7.06884831 27.0961146,6.92817471 26.9906823,6.68199591 C26.8501058,6.43581712 26.9203941,6.15446992 27.1312588,5.94345952 L28.2558705,4.99391273 C29.7319235,3.76301875 30.6808146,2.07493557 30.9619676,0.246178797 L30.4699499,0.527525993 C28.8181764,1.44190438 26.9906823,1.96943037 25.1280441,2.07493557 C25.0226117,2.07493557 24.9171794,2.03976717 24.811747,2.00459877 C23.8277117,1.47707278 23.50963,1.33639918 21.7190647,0.808873189 C19.9284993,0.281347199 15.648742,0.281347197 13.6007735,0.808873189 C11.552805,1.33639918 11.4569823,1.44190438 10.5080912,2.00459877 C10.4026588,2.07493557 10.2972264,2.07493557 10.1917941,2.07493557 C8.32915586,1.96943037 6.46651763,1.44190438 4.84988822,0.527525993 L4.21729411,0.281347196 C4.46330293,2.11010397 5.4121941,3.79818715 6.92339116,5.02908113 L8.04800292,5.97862792 C8.25886763,6.15446992 8.32915586,6.47098552 8.18857939,6.71716431 C8.04800292,6.96334311 7.76684998,7.06884831 7.48569704,6.99851151 C6.74767057,6.75233271 5.97449999,6.61165911 5.16618528,6.61165911 C2.31951176,6.61165911 3.55271368e-15,8.15906869 3.55271368e-15,10.0229939 C3.55271368e-15,11.886919 2.31951176,13.4343286 5.16618528,13.4343286 C6.36108528,13.4343286 7.45055292,13.1881498 8.3994441,12.6957922 C8.46973233,12.6606238 8.57516469,12.6254554 8.68059704,12.6254554 C8.75088527,12.6254554 8.85631763,12.6606238 8.92660586,12.6957922 C9.10232645,12.766129 9.2077588,12.9068026 9.24290292,13.0826446 L10.1917941,17.338021 C10.5080912,18.7095886 10.6486676,19.9756509 10.6135235,21.1362081 C10.5783794,22.9297965 10.2620823,24.7233849 9.62948821,26.4114681 C9.2077588,27.5720252 9.38347939,28.8029192 10.0863617,29.8228028 C10.7892441,30.8426864 11.9138559,31.4053808 13.1439,31.4053808 L22.0353617,31.4053808 C23.2654058,31.4053808 24.3900176,30.8426864 25.0928999,29.8228028 C25.7957823,28.8029192 25.9715029,27.5720252 25.5497735,26.4114681 C24.9523235,24.7233849 24.6008823,22.9297965 24.6008823,21.1362081 C24.5657382,19.9404825 24.7063146,18.7095886 25.0226117,17.338021 L25.9715029,13.0826446 C26.006647,12.9068026 26.1472235,12.766129 26.2877999,12.6957922 C26.4635205,12.6254554 26.6392411,12.6254554 26.7798176,12.6957922 C27.6935646,13.1881498 28.8181764,13.4343286 30.0130764,13.4343286 C32.8597499,13.4343286 35.1792617,11.886919 35.1792617,10.0229939 C35.1792617,8.15906869 32.8246058,6.57649071 29.9779323,6.57649071 C29.1696176,6.57649071 28.3613029,6.71716431 27.6584205,6.96334311 Z M7.48569704,10.5153515 C7.38026469,10.6911935 7.2045441,10.7615303 6.9936794,10.7615303 C6.88824704,10.7615303 6.78281469,10.7263619 6.67738234,10.6560251 L6.57194998,10.5856883 C5.65820293,9.98782547 4.63902352,9.70647827 3.54955587,9.70647827 C3.23325882,9.70647827 2.98724999,9.46029948 2.98724999,9.14378388 C2.98724999,8.82726829 3.23325882,8.58108949 3.54955587,8.58108949 C4.84988822,8.58108949 6.07993234,8.96794188 7.16939998,9.63614147 L7.27483234,9.70647827 C7.55598528,9.88232027 7.66141763,10.2340043 7.48569704,10.5153515 L7.48569704,10.5153515 Z M31.5594176,9.74164667 C30.505094,9.74164667 29.4507705,10.0581623 28.5370235,10.6208567 L28.4667352,10.6911935 C28.3613029,10.7615303 28.2558705,10.7966987 28.1504382,10.7966987 C27.9747176,10.7966987 27.7638529,10.6911935 27.6584205,10.5505199 C27.4826999,10.2691727 27.5529882,9.91748867 27.8341411,9.74164667 L27.9395735,9.67130987 C29.0290411,8.96794188 30.2942293,8.61625789 31.5594176,8.61625789 C31.8757146,8.61625789 32.1217235,8.86243668 32.1217235,9.17895228 C32.1568676,9.46029948 31.8757146,9.74164667 31.5594176,9.74164667 L31.5594176,9.74164667 Z">             
				</svg>
			</div>';
		} elseif ($filtered_label === 'tofu') {
			$filtered_label_suzette = '<div class="protein_type tofu" data-protein-type="tofu">
				<svg viewBox="0 0 28 32">
    				<title>tofu</title>
                    <g>
                        <path d="M27.4022199,9.18563428 C27.4022199,8.97567893 27.2904616,8.78225273 27.109118,8.6774509 C26.9277743,8.57264907 26.7049606,8.57335244 26.523617,8.67815427 L15.2065082,15.2166631 C14.6044895,15.5644786 14.2333676,16.2070052 14.2333676,16.9029879 L14.2333676,29.9803572 C14.2333676,30.1896092 14.3447745,30.3830354 14.5261181,30.4874856 C14.7071103,30.5922874 14.9302755,30.5926391 15.1119706,30.4878372 L25.9964552,24.1993757 C26.8666236,23.6964676 27.4022199,22.7680219 27.4022199,21.7625573 L27.4022199,9.18563428 L27.4022199,9.18563428 Z"></path>
                        <path d="M0.888794733,8.67780259 C0.707451087,8.57335244 0.484637381,8.57300076 0.303293735,8.67780259 C0.121950088,8.78260442 0.0101917941,8.97567893 0.0101917941,9.18493091 L0.0101917941,9.18563428 L0.0101917941,21.7625573 C0.0101917941,22.7676702 0.546139587,23.6964676 1.4159565,24.1993757 L12.3004411,30.4874856 C12.3004411,30.4874856 12.3007926,30.4878372 12.301144,30.4878372 C12.4824877,30.5926391 12.7056528,30.5922874 12.8869965,30.4874856 C13.0679887,30.3826837 13.1790441,30.1889059 13.1790441,29.9800056 L13.1790441,16.9026362 C13.1790441,16.2066536 12.8082736,15.5641269 12.2059035,15.2163114 L0.888794733,8.67780259 L0.888794733,8.67780259 Z"></path>
                        <path d="M26.2895571,7.25735093 C26.2895571,7.04809895 26.1785017,6.85432107 25.9971581,6.74987092 L15.1119706,0.460706034 C14.2418022,-0.0418503955 13.1702581,-0.0418503955 12.3004411,0.460706034 L1.4159565,6.74881587 C1.23390997,6.85396939 1.12250311,7.04774727 1.12250311,7.25699925 C1.12285456,7.46660291 1.23461285,7.65932574 1.4159565,7.76412757 L12.7330652,14.3029881 C13.335084,14.6508036 14.0769763,14.6508036 14.678995,14.3029881 L25.9964552,7.76447925 C26.1777988,7.6600291 26.2892057,7.46660291 26.2895571,7.25735093 Z"></path>
                    </g>
				</svg>
			</div>';
			
		} elseif ($filtered_label === 'justVeg') {
			$filtered_label_suzette = '<div class="protein_type justVeg" data-protein-type="justVeg">
				<svg viewBox="0 0 29 32">
				    <title>broccoli</title>
				        <path d="M26.9996855,20.3732702 C26.4492812,19.5679948 25.3919014,19.2789579 24.4521792,19.5648747 C23.5090691,18.966662 22.2317739,18.9048268 21.2011904,19.5013376 C20.3637258,19.9866586 19.8887827,20.7950542 19.8318018,21.6403239 C18.8936198,21.9633985 17.841476,22.4407774 17.242407,23.0716096 C17.2608872,21.6494007 17.3061639,20.2246389 17.3600647,18.9357444 C19.0165136,18.7547772 20.4194747,17.8646912 21.2116626,16.5908299 C21.4361979,16.6481267 21.6678174,16.6884047 21.9114491,16.6884047 C23.3763191,16.6884047 24.5646009,15.5926741 24.5646009,14.2433626 C24.5646009,14.0192811 24.5208643,13.8059781 24.4604954,13.5989154 C26.0109907,12.7814431 27.0668305,11.2588229 27.0668305,9.49566965 C27.0668305,6.87278058 24.7592599,4.747693 21.9114491,4.747693 C21.8171997,4.747693 21.7281863,4.76159173 21.6345529,4.76613009 C21.3191562,3.82668934 20.3791261,3.14026223 19.2579892,3.14026223 C19.174212,3.14026223 19.0969028,3.1555792 19.0165136,3.16210309 C18.3065629,1.3243505 16.4184946,0 14.1777609,0 C12.3904101,0 10.8177385,0.837611269 9.89218457,2.10977061 C9.61528841,2.03261847 9.32668807,1.97844179 9.0220715,1.97844179 C7.92465102,1.97844179 6.97384074,2.52559795 6.44838485,3.33541176 C6.03381062,3.23329863 5.60506818,3.16550686 5.15538143,3.16550686 C2.30849467,3.16522322 0,5.2903108 0,7.91291621 C0,9.21287302 0.58058872,10.3749771 1.49936652,11.2313091 C1.265283,11.6318195 1.11928881,12.084521 1.11928881,12.5726785 C1.11928881,14.0918948 2.41414026,15.322358 4.04009668,15.4057504 C4.60559317,17.4627625 6.6119353,18.9916229 9.0220715,18.9916229 C9.13788124,18.9916229 9.24445084,18.9635418 9.35779654,18.9575852 C9.77298678,21.9622639 10.3914601,27.213715 10.0960836,30.070046 C14.6071194,32.6415949 16.5404644,30.6634367 17.6147846,30.070046 C17.4235137,29.233853 17.3209481,27.975876 17.2707434,26.5417539 C17.8784365,25.0069369 19.6673274,24.1860609 20.7983204,23.8122134 C21.506731,24.4010657 22.4732495,24.6376278 23.3963394,24.4538242 C23.8731305,25.1028098 24.8196288,25.2976757 25.5412836,24.8787282 C26.1637609,24.5170776 26.3904524,23.832636 26.1788532,23.2157025 C26.2225898,23.1958472 26.2678665,23.1941453 26.3100631,23.1711699 C27.3387986,22.5723898 27.6474192,21.3189512 26.9996855,20.3732702 L26.9996855,20.3732702 Z M13.5331072,24.382345 L12.4363028,19.0006997 C12.584761,19.0347374 12.7282912,19.084092 12.8887616,19.084092 C13.4718143,19.084092 13.9729379,18.8245545 14.316979,18.4399284 L13.5331072,24.382345 L13.5331072,24.382345 Z"/>
				</svg>
			</div>	';
		} else {
			$filtered_label_suzette = $filtered_label;
		}
		printf( '<div><input type="radio" name="%1$s" value="%2$s" id="%3$s" %4$s><label class="%1$s" for="%3$s">%5$s</label></div>', $input_name, $esc_value, $id, $checked, $filtered_label_suzette );
	}
}
global $product;

$attribute_keys = array_keys( $attributes );

do_action( 'woocommerce_before_add_to_cart_form' );
 ?>

<form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->id ); ?>" data-product_variations="<?php echo htmlspecialchars( json_encode( $available_variations ) ) ?>">
	<?php do_action( 'woocommerce_before_variations_form' ); ?>

	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>
	<?php else : ?>
		<table class="variations" cellspacing="0">
			<tbody>
				<?php foreach ( $attributes as $name => $options ) : ?>
					<tr>
						<td class="label">
						<label for="<?php echo sanitize_title( $name ); ?>">
						<?php echo wc_attribute_label( $name ); ?>
						</label>
						</td>
						<?php
						$sanitized_name = sanitize_title( $name );
						// if ( isset( $_REQUEST[ 'attribute_' . $sanitized_name ] ) ) {
						// 	$checked_value = $_REQUEST[ 'attribute_' . $sanitized_name ];
						// } elseif ( isset( $selected_attributes[ $sanitized_name ] ) ) {
						// 	$checked_value = $selected_attributes[ $sanitized_name ];
						// } else {
							$checked_value = '';
						//}
						?>
						<td class="value">
							<?php
							if ( ! empty( $options ) ) {
								if ( taxonomy_exists( $name ) ) {
									// Get terms if this is a taxonomy - ordered. We need the names too.
									$terms = wc_get_product_terms( $product->id, $name, array( 'fields' => 'all' ) );

									foreach ( $terms as $term ) {
										if ( ! in_array( $term->slug, $options ) ) {
											continue;
										}
										print_attribute_radio( $checked_value, $term->slug, $term->name, $sanitized_name, $product );
									}
								} else {
									foreach ( $options as $option ) {
										print_attribute_radio( $checked_value, $option, $option, $sanitized_name, $product );
									}
								}
							}

							// echo end( $attribute_keys ) === $name ? apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . __( 'Clear', 'woocommerce' ) . '</a>' ) : '';
							?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<div class="single_variation_wrap">
			<?php do_action( 'woocommerce_before_single_variation' ); ?>

			<?php
			if ( has_action( 'woocommerce_single_variation' ) ) {
				do_action( 'woocommerce_single_variation' );
			} else {
				 // Backwards compatibility with WC < 2.4
			?> 
				<div class="woocommerce-variation single_variation"></div>
				
				<div class="woocommerce-variation-add-to-cart variations_button">
					<?php if ( ! $product->is_sold_individually() ) : ?>
						<?php woocommerce_quantity_input( array( 'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 ) ); ?>
					<?php endif; ?>
					<button type="submit" class="single_add_to_cart_button button alt otto"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
					<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->id ); ?>" />
					<input type="hidden" name="product_id" value="<?php echo absint( $product->id ); ?>" />
					<input type="hidden" name="variation_id" class="variation_id" value="0" />
				</div>
			 <?php } ?> 

			<?php do_action( 'woocommerce_after_single_variation' ); ?>
		</div>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	<?php endif; ?>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>