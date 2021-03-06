<?php
/**
 * Perform all main WooCommerce Common function for this theme
 *
 * @package Themehunk
 * @subpackage  Bevro
 * @since 1.0.0
 */
// sale badge add class
function bevro_sale_badge_style(){
$sale_style = get_theme_mod('bevro_sale_bagde_style','circle');	
return '<span class="onsale '.esc_attr($sale_style).'"> <p>'. esc_html__( 'Sale', 'bevro' ).'</p></span>';
}
if ( ! function_exists( 'bevro_woo_shop_thumbnail_wrap_start' ) ){

	/**
	 * Thumbnail wrap start.
	 */
	function bevro_woo_shop_thumbnail_wrap_start(){

		echo '<div class="bevro-shop-thumbnail-wrap">';
	}
}

if ( ! function_exists( 'bevro_woo_shop_thumbnail_wrap_end' ) ){
	/**
	 * Thumbnail wrap end.
	 */
	function bevro_woo_shop_thumbnail_wrap_end(){

		echo '</div>';
	}
}
if ( ! function_exists( 'bevro_woo_woocommerce_template_loop_product_title' ) ) {

	/**
	 * Show the product title in the product loop. By default this is an H2.
	 */
	function bevro_woo_woocommerce_template_loop_product_title() {

		echo '<a href="' . esc_url( get_the_permalink() ) . '" class="brv-loop-product__link">';
			woocommerce_template_loop_product_title();
		echo '</a>';
	}
}


/**
 * Shop page - Short Description
 */
if ( ! function_exists( 'bevro_woo_shop_product_short_description' ) ) :
	/**
	 * Product short description
	 *
	 * @hooked woocommerce_after_shop_loop_item
	 *
	 * @since 1.1.0
	 */
	function bevro_woo_shop_product_short_description() {
		?>
		<?php if ( has_excerpt() ) { ?>
		<div class="brv-woo-shop-product-description">
			<?php the_excerpt(); ?>
		</div>
	<?php } ?>
		<?php
	}
endif;
/**
 * Shop page - Parent Category
 */
if ( ! function_exists( 'bevro_woo_shop_parent_category' ) ) :
	/**
	 * Add and/or Remove Categories from shop archive page.
	 *
	 * @hooked woocommerce_after_shop_loop_item - 9
	 *
	 * @since 1.1.0
	 */
	function bevro_woo_shop_parent_category() {
		if ( apply_filters( 'bevro_woo_shop_parent_category', true ) ) : ?>
			<span class="brv-woo-product-category">
				<?php
				global $product;
				$product_categories = function_exists( 'wc_get_product_category_list' ) ? wc_get_product_category_list( get_the_ID(), ';', '', '' ) : $product->get_categories( ';', '', '' );

				$product_categories = htmlspecialchars_decode( strip_tags( $product_categories ) );
				if ( $product_categories ) {
					list( $parent_cat ) = explode( ';', $product_categories );
					echo esc_html( $parent_cat );
				}

				?>
			</span> 
			<?php
		endif;
	}
endif;
if ( ! function_exists( 'bevro_woo_woocommerce_shop_product_content' ) ){
	/**
	 * Show the product title in the product loop. By default this is an H2.
	 */
	function bevro_woo_woocommerce_shop_product_content(){
		$shop_structure = apply_filters( 'bevro_woo_shop_product_structure', bevro_get_option( 'bevro-product-structure' ) );
		if ( is_array( $shop_structure ) && ! empty( $shop_structure ) ) {

			do_action( 'bevro_woo_shop_before_summary_wrap' );
			echo '<div class="bevro-shop-summary-wrap">';
			do_action( 'bevro_woo_shop_summary_wrap_top' );
			foreach ( $shop_structure as $value ){
				switch ( $value ){
					case 'title':
						/**
						 * Add Product Title on shop page for all products.
						 */
						do_action( 'bevro_woo_shop_title_before' );
						bevro_woo_woocommerce_template_loop_product_title();
						do_action( 'bevro_woo_shop_title_after' );
						break;
					case 'price':
						/**
						 * Add Product Price on shop page for all products.
						 */
						do_action( 'bevro_woo_shop_price_before' );
						woocommerce_template_loop_price();
						do_action( 'bevro_woo_shop_price_after' );
						break;
					case 'ratings':
						/**
						 * Add rating on shop page for all products.
						 */
						do_action( 'bevro_woo_shop_rating_before' );
						woocommerce_template_loop_rating();
						do_action( 'bevro_woo_shop_rating_after' );
						break;
					case 'short_desc':
						do_action( 'bevro_woo_shop_short_description_before' );
						bevro_woo_shop_product_short_description();
						do_action( 'bevro_woo_shop_short_description_after' );
						break;
					case 'add_cart':
						do_action( 'bevro_woo_shop_add_to_cart_before' );
						woocommerce_template_loop_add_to_cart();
						do_action( 'bevro_woo_shop_add_to_cart_after' );
						break;
					case 'category':
						/**
						 * Add and/or Remove Categories from shop archive page.
						 */
						do_action( 'bevro_woo_shop_category_before' );
						bevro_woo_shop_parent_category();
						do_action( 'bevro_woo_shop_category_after' );
						break;
					default:
						break;
				}
			}
			do_action( 'bevro_woo_shop_summary_wrap_bottom' );
			echo '</div>';
			do_action( 'bevro_woo_shop_after_summary_wrap' );
		}
	}
}
// search widget style
if ( ! function_exists( 'bevro_custom_product_searchform' ) ){
function bevro_custom_product_searchform( $form ){
    $form = '<form role="search" method="get" id="searchform" action="' . esc_url( home_url( '/'  ) ) . '">
		<div class="form-content">
			<label class="screen-reader-text" for="s">' . __( 'Search for:', 'bevro' ) . '</label>
			<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . __( 'Product search', 'bevro' ) . '" />
			<input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search', 'bevro' ) .'" />
			<input type="hidden" name="post_type" value="product" />
		</div>
	</form>';
    return $form;
 
  }
}
/**********************/
// Add to cart 
/**********************/
/**
 * Query WooCommerce activation
 */
function bevro_is_woocommerce_activated(){
  return class_exists( 'woocommerce' ) ? true : false;
}
if ( ! function_exists( 'bevro_cart_total_item' ) ){
  /**
   * Cart Link
   * Displayed a link to the cart including the number of items present and the cart total
   */
 function bevro_cart_total_item(){
   global $woocommerce; 
   $bevro_woo_cart_disable = get_theme_mod('bevro_woo_cart_disable','icon'); 
   $ordertotal       = wp_kses_data( $woocommerce->cart->get_total() );
   $productadd       = wp_kses_data($woocommerce->cart->cart_contents_count);
  ?>
  
  <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="cart-contents" >
    <?php if($bevro_woo_cart_disable =='icon'){?>
    <i class="fa fa-shopping-basket"></i>
    <?php } elseif($bevro_woo_cart_disable =='icon+cartcount'){?>
    <i class="fa fa-shopping-basket"></i>
    <span class="cart-crl"><?php echo esc_html($woocommerce->cart->cart_contents_count); ?></span>
    <?php } elseif($bevro_woo_cart_disable =='icon+total'){?>
    <i class="fa fa-shopping-basket"></i>
    <span class="cart-total"><?php echo esc_html($ordertotal);?></span>  
    <?php } else { ?>
     <i class="fa fa-shopping-basket"></i>
    <span class="cart-crl"><?php echo esc_html($woocommerce->cart->cart_contents_count); ?></span>
    <span class="cart-total"><?php echo esc_html($ordertotal);?></span>
    <?php } ?>
  </a>
 
  <?php }
}
if ( ! function_exists( 'bevro_cart_count_product' ) ){
  function bevro_cart_count_product(){
    if ( bevro_is_woocommerce_activated() ){
       bevro_cart_total_item();
    }
  }
}
/** Sidebar Add Cart Product **/
function bevro_menu_woo_cart_product(){
global $woocommerce;
?>
<div id="bevro-cart" class="bevro-cart">
<div class="bevro-quickcart-dropdown">
<?php 
woocommerce_mini_cart(); 
?>
</div>
</div>
    <?php
}
//cart view function
function bevro_menu_cart_view($cart_view){
	global $woocommerce;
    $cart_view= bevro_cart_count_product();
    return $cart_view;
}
add_filter('woocommerce_add_to_cart_fragments', 'bevro_add_to_cart_dropdown_fragment');
function bevro_add_to_cart_dropdown_fragment( $fragments ){
   ob_start();
   ?>
   <div class="bevro-quickcart-dropdown">
       <?php woocommerce_mini_cart(); ?>
   </div>
   <?php $fragments['div.bevro-quickcart-dropdown'] = ob_get_clean();

   return $fragments;

}

add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_add_to_cart_count_fragments');
function woocommerce_add_to_cart_count_fragments( $fragments ){

       global $woocommerce;
   $productadd       = wp_kses_data($woocommerce->cart->cart_contents_count);
   ob_start();
   ?>

   <span class="cart-crl"><?php echo esc_html( $productadd); ?></span>

 <?php $fragments['span.cart-crl'] = ob_get_clean();

   return $fragments;

}
add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_add_to_cart_total_fragments');
function woocommerce_add_to_cart_total_fragments( $fragments ){
global $woocommerce;
$ordertotal = wp_kses_data( $woocommerce->cart->get_total() );
   ob_start();
?>
<span class="cart-total"><?php echo  esc_html($ordertotal); ?></span>
<?php $fragments['span.cart-total'] = ob_get_clean();
   return $fragments;

}
// Plus Minus Quantity Buttons @ WooCommerce Single Product Page
add_action( 'woocommerce_before_add_to_cart_quantity', 'bevro_display_quantity_plus',10,2 );
function bevro_display_quantity_plus(){
    echo '<div class="bevro-quantity"><button type="button" class="plus" >+</button>';
}
add_action( 'woocommerce_after_add_to_cart_quantity', 'bevro_display_quantity_minus',10,2 );
function bevro_display_quantity_minus(){
    echo '<button type="button" class="minus" >-</button></div>';
}