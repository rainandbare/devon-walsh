<?php
add_theme_support( 'woocommerce' );
/** Tell WordPress to run theme_setup() when the 'after_setup_theme' hook is run. */

if ( ! function_exists( 'theme_setup' ) ):

function theme_setup() {

	/* This theme uses post thumbnails (aka "featured images")
	*  all images will be cropped to thumbnail size (below), as well as
	*  a square size (also below). You can add more of your own crop
	*  sizes with add_image_size. */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size(120, 90, true);
	add_image_size('square', 150, 150, true);


	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	/* This theme uses wp_nav_menu() in one location.
	* You can allow clients to create multiple menus by
  * adding additional menus to the array. */
	register_nav_menus( array(
		'primary' => 'Primary Navigation'
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

}
endif;

add_action( 'after_setup_theme', 'theme_setup' );

/* Add all our CSS files here.
We'll let WordPress add them to our templates automatically instead
of writing our own link tags in the header. */

function hackeryou_styles(){
	wp_enqueue_style('style', get_stylesheet_uri() );

	wp_enqueue_style('fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
}

add_action( 'wp_enqueue_scripts', 'hackeryou_styles');
/* Add all our JavaScript files here.
We'll let WordPress add them to our templates automatically instead
of writing our own script tags in the header and footer. */

function hackeryou_scripts() {

	//Don't use WordPress' local copy of jquery, load our own version from a CDN instead
	wp_deregister_script('jquery');
  wp_enqueue_script(
  	'jquery',
  	"http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js",
  	false, //dependencies
  	null, //version number
  	true //load in footer
  );

    wp_enqueue_script(
  	'jqueryUI',
  	"http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js",
  	array( 'jquery' ), //dependencies
  	null, //version number
  	true //load in footer
  );

  wp_enqueue_script(
    'plugins', //handle
    get_template_directory_uri() . '/js/plugins.js', //source
    array( 'jquery', 'jqueryUI' ), //dependencies
    null, // version number
    true //load in footer
  );

  wp_enqueue_script(
    'scripts', //handle
    get_template_directory_uri() . '/js/main.min.js', //source
    array( 'jquery', 'plugins', 'jqueryUI' ), //dependencies
    null, // version number
    true //load in footer
  );
}

add_action( 'wp_enqueue_scripts', 'hackeryou_scripts');


/* Custom Title Tags */

function hackeryou_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'hackeryou' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'hackeryou_wp_title', 10, 2 );

/*
  Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function hackeryou_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'hackeryou_page_menu_args' );


/*
 * Sets the post excerpt length to 40 characters.
 */
function hackeryou_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'hackeryou_excerpt_length' );

/*
 * Returns a "Continue Reading" link for excerpts
 */
function hackeryou_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">Continue reading <span class="meta-nav">&rarr;</span></a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and hackeryou_continue_reading_link().
 */
function hackeryou_auto_excerpt_more( $more ) {
	return ' &hellip;' . hackeryou_continue_reading_link();
}
add_filter( 'excerpt_more', 'hackeryou_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 */
function hackeryou_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= hackeryou_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'hackeryou_custom_excerpt_more' );


/*
 * Register a single widget area.
 * You can register additional widget areas by using register_sidebar again
 * within hackeryou_widgets_init.
 * Display in your template with dynamic_sidebar()
 */
function hackeryou_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => 'Primary Widget Area',
		'id' => 'primary-widget-area',
		'description' => 'The primary widget area',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

}

add_action( 'widgets_init', 'hackeryou_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 */
function hackeryou_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'hackeryou_remove_recent_comments_style' );


if ( ! function_exists( 'hackeryou_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 */
function hackeryou_posted_on() {
	printf('%1$s',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		)
	);
}
endif;

if ( ! function_exists( 'hackeryou_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 */
function hackeryou_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.';
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.';
	} else {
		$posted_in = 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.';
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

/* Get rid of junk! - Gets rid of all the crap in the header that you dont need */

function clean_stuff_up() {
	// windows live
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	// wordpress gen tag
	remove_action('wp_head', 'wp_generator');
	// comments RSS
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'feed_links', 3 );
}

add_action('init', 'clean_stuff_up');


/* get_post_parent() - Returns the current posts parent, if current post if top level, returns itself */
function get_post_parent($post) {
	if ($post->post_parent) {
		return $post->post_parent;
	}
	else {
		return $post->ID;
	}
}

//WOOCOMMERCE ALTERATIONS

//archive-product.php
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', '20');
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', '30' );
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', '20' );

add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}

remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', '5');
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', '10');
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', '10' );
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_single_add_to_cart', '30' );


remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', '10');
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', '5');

function devonwalsh_custom_billing_fields( $fields = array() ){
	
	unset( $fields['billing_company']);
	// unset( $fields['billing_country']);
	// unset( $fields['billing_city']);
	// unset( $fields['billing_state']);
	return $fields;
}
add_filter('woocommerce_billing_fields', 'devonwalsh_custom_billing_fields');
remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', '10' );

// Hook in
add_filter( 'woocommerce_billing_fields', 'rs_custom_billing_fields' );
 
// Function Hook
function rs_custom_billing_fields( $fields )  {
 	$fields['billing_sunday_delivery'] = array(
     	'type' 			=> 'select',
        'label'     	=> __('Sunday Delivery', 'woocommerce'),
    	'placeholder'   => _x('Sunday Delivery', 'placeholder', 'woocommerce'),
    	'required'  	=> true,
    	'class'     	=> array('form-row-first'),
    	'clear'     	=> false,
   		'options' 		=> array(
						  '6pm-8pm' => '6pm-8pm',
						  '8pm-10pm' => '8pm-10pm'
						  )
	);
     $fields['billing_wednesday_delivery'] = array(
     	'type' 			=> 'select',
        'label'     	=> __('Wednesday Delivery', 'woocommerce'),
    	'placeholder'   => _x('Wednesday Delivery', 'placeholder', 'woocommerce'),
    	'required'  	=> true,
    	'class'     	=> array('form-row-last'),
    	'clear'     	=> true,
   		'options' 		=> array(
						  '6pm-8pm' => '6pm-8pm',
						  '8pm-10pm' => '8pm-10pm'
						  )
	);
     $fields['billing_allergies'] = array(
     	'type' 			=> 'textarea',
        'label'     	=> __('Please list any allergies separated by a comma.', 'woocommerce'),
    	'placeholder'   => _x('More than 3 allergies will result in an additional fee.', 'placeholder', 'woocommerce'),
    	'required'  	=> false,
    	'class'     	=> array('form-row'),
    	'clear'     	=> true
	); 
	$fields['billing_delivery_instructions'] = array(
     	'type' 			=> 'textarea',
        'label'     	=> __('Please provide detailed delivery notes.', 'woocommerce'),
    	'placeholder'   => _x('(eg. buzzer code, where to leave your bag, etc.)', 'placeholder', 'woocommerce'),
    	'required'  	=> false,
    	'class'     	=> array('form-row'),
    	'clear'     	=> true
	); 
    // just copy same format if you’d like to add more fields
 
	return $fields;
}


add_action( 'woocommerce_admin_order_data_after_billing_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );

function my_custom_checkout_field_display_admin_order_meta($order){
    echo '<p><strong>'.__('Sunday Delivery').':</strong> ' . get_post_meta( $order->id, '_billing_sunday_delivery', true ) . '</p>';
    echo '<p><strong>'.__('Wednesday Delivery').':</strong> ' . get_post_meta( $order->id, '_billing_wednesday_delivery', true ) . '</p>';
    echo '<p><strong>'.__('Delivery Instructions').':</strong> ' . get_post_meta( $order->id, '_billing_delivery_instructions', true ) . '</p>';
    echo '<p><strong>'.__('Allergies').':</strong> ' . get_post_meta( $order->id, '_billing_allergies', true ) . '</p>';
}
    
// * Add new register fields for WooCommerce registration.
// * @return string Register fields HTML.
// */

function wooc_extra_register_fields() {
       ?>
       <p class="form-row form-row-first">
       <label for="reg_billing_first_name"><?php _e( 'First name', 'woocommerce' ); ?><span class="required">*</span></label>
       <input type="text" class="input-text" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />
       </p>

       <p class="form-row form-row-last">
       <label for="reg_billing_last_name"><?php _e( 'Last name', 'woocommerce' ); ?><span class="required">*</span></label>
       <input type="text" class="input-text" name="billing_last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" />
       </p>

       <div class="clear"></div>
	
       <?php

}

add_action( 'woocommerce_register_form_start', 'wooc_extra_register_fields' );

/**

* Validate the extra register fields.
*
* @param string $username         Current username.
* @param string $email             Current email.
* @param object $validation_errorsWP_Error object.
*
* @return void
*/

function wooc_validate_extra_register_fields( $username, $email, $validation_errors ) {
       if ( isset( $_POST['billing_first_name'] ) && empty( $_POST['billing_first_name'] ) ) {
              $validation_errors->add( 'billing_first_name_error', __( '<strong>Error</strong>: First name is required!', 'woocommerce' ) );
       }

       if ( isset( $_POST['billing_last_name'] ) && empty( $_POST['billing_last_name'] ) ) {
              $validation_errors->add( 'billing_last_name_error', __( '<strong>Error</strong>: Last name is required!.', 'woocommerce' ) );
       }
}

add_action( 'woocommerce_register_post', 'wooc_validate_extra_register_fields', 10, 3 );

/**
* Save the extra register fields.
*
* @paramint $customer_id Current customer ID.
*
* @return void
*/

function wooc_save_extra_register_fields( $customer_id ) {
       if ( isset( $_POST['billing_first_name'] ) ) {
              // WordPress default first name field.
              update_user_meta( $customer_id, 'first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
              // WooCommerce billing first name.
              update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
       }

       if ( isset( $_POST['billing_last_name'] ) ) {
              // WordPress default last name field.
              update_user_meta( $customer_id, 'last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
              // WooCommerce billing last name.
              update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
       }
}

add_action( 'woocommerce_created_customer', 'wooc_save_extra_register_fields' );

function devon_featured_url(){
	$thumb_id = get_post_thumbnail_id();
	$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
	$thumb_url = $thumb_url_array[0];
	return $thumb_url;
}

function devon_excerpt_length( $length ) {
    return 8;
}
add_filter( 'excerpt_length', 'devon_excerpt_length', 999 );

function devon_excerpt_more( $more ) {
    return '<a href="'.get_the_permalink().'" rel="nofollow"><span class="meta-nav">&rarr;</span></a>';
}
add_filter( 'excerpt_more', 'devon_excerpt_more' );

function wpb_set_post_views($postID) {

    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
		delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function wpb_track_post_views ($post_id) {
	if ( !is_single() ) return;
	if ( empty ( $post_id) ) {
			global $post;
			$post_id = $post->ID;   
	    }
	    wpb_set_post_views($post_id);
}
add_action( 'wp_head', 'wpb_track_post_views');

function wpb_get_post_views($postID){
	$count_key = 'wpb_post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
	 	delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
	 	return "0 View";
	 }
	    return $count.' Views';
}
function devon_post_queries( $query ) {
  // do not alter the query on wp-admin pages and only alter it if it's the main query
  if (!is_admin() && $query->is_main_query()){

    // alter the query for the home and category pages 

    if(is_home()){
      $query->set('posts_per_page', 5);
    }

    if(is_category()){
      $query->set('posts_per_page', 5);
    }

  }
}
add_action( 'pre_get_posts', 'devon_post_queries' );

function what_week_is_it(){
	date_default_timezone_set('America/New_York');
	// $ddate = "2017-01-10";
	// echo "Date: $ddate <br>";
	$thedate = new DateTime;
	$week = $thedate->format("W");

	
	$day_of_week = $thedate->format("l");
	if ($day_of_week == 'Saturday' || $day_of_week == 'Sunday'){
			$week = $week + 1;
			//echo "This is a Sunday or a Saturday<br>";
		}
	$year = $thedate->format("Y");
	$yearOffset = $year - 2017;
	$week = $week + ($yearOffset * 52);
	
	//echo "Day of Week: $day_of_week <br>";
	//echo "Week of Year: $week <br>";
	$which_menu = round(get_fraction($week) * 3);
	if ($which_menu == '0'){
		$which_menu = '3';
	}
	// echo "Which Menu: Menu $which_menu";
	return "week-" . $which_menu;
}

function get_menu_dates(){
 date_default_timezone_set('America/New_York');
	$now = new DateTime;
    $nowString = $now->format('Y-m-d') . "\n";
    $date = $now;
    //echo $date->format( 'Y-m-d g:i a' );
    $day_of_week = date('N', strtotime($date->format('D')));
    if($day_of_week > 5){
      $interval = (7 - $day_of_week) + 7;
    } else {
      $interval = 7 - $day_of_week;
    }
    $menuStarts = date_add($date, date_interval_create_from_date_string($interval . 'days'));
    $menuStartsSave = $menuStarts->format('M d') . "\n";
    
    $menuEnds = date_add($menuStarts, date_interval_create_from_date_string('6 days')); 
    $menuEndsSave = $menuEnds->format('M d') . "\n";

    $orderBy = date_sub($menuEnds, date_interval_create_from_date_string('8 days'));
    $orderBySave = $orderBy->format('l, M d') . "\n";

    $wednesdayDelivery = date_add($menuEnds, date_interval_create_from_date_string('5 days')); 
    $wednesdayDeliverySave = $wednesdayDelivery->format('M d') . "\n";

    return array($menuStartsSave, $menuEndsSave, $orderBySave, $wednesdayDeliverySave);
}

function get_fraction($var){
	$num = $var / 3 ;
	$intpart = floor( $num ) ;   // results in 3
	$fraction = $num - $intpart ;// results in 0.75
	$roundFraction = round($fraction, 3);
	return $roundFraction;
}

add_action( 'woocommerce_checkout_order_review', 'devon_checkout_coupon' );

function devon_checkout_coupon(){?>
	<form class="checkout_coupon " method="post">
	<div class="checkout-coupon-code clearfix">
	<p class="form-row form-row-first">
		<input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" id="coupon_code" value="" />
	</p>

	<p class="form-row form-row-last">
		<input type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply Coupon', 'woocommerce' ); ?>" />
	</p>
	</div>
	</form>
<?php 
}

// define the woocommerce_shipping_package_name callback 
function filter_woocommerce_shipping_package_name( $sprintf, $i, $package ) { 
    // make filter magic happen here...
    $sprintf = sprintf( _n( 'Delivery Fee', 'Delivery %d', ( $i + 1 ), 'woocommerce' ), ( $i + 1 ) ) ;
    return $sprintf; 
}; 
         
// add the filter 
add_filter( 'woocommerce_shipping_package_name', 'filter_woocommerce_shipping_package_name', 10, 3 ); 

// function woo_add_cart_fee() {
//  $more_than_three_allergies = true;
//   global $woocommerce;
// 	if($more_than_three_allergies){
// 		$woocommerce->cart->add_fee( __('Allergy Fee', 'woocommerce'), 5 );
// 	}	
// }
// add_action( 'woocommerce_cart_calculate_fees', 'woo_add_cart_fee' );
//add_action('woocommerce_checkout_billing', 'wc_allergy_note_after_cart', 30);
function wc_allergy_note_after_cart() {
global $woocommerce;
$product_id = 1307;
$found = false;
foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values ) {
    $_product = $values['data'];
    if ( $_product->id == $product_id )
        $found = true;
    }
    // if product not found, add it
if ( ! $found ): ?>
	

   <a href="<?php echo do_shortcode('[add_to_cart_url id="1307"]'); ?>"><?php _e( 'Extra Allergies (+$5)' ); ?></a>
<?php else: ?>
<?php endif;
}


