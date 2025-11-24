<?php
/**
 *Content Function for Bevro Theme
 */
if ( ! function_exists( 'bevro_page_content_layout' ) ){
function bevro_page_content_layout($page_post_meta_set='default', $default=''){
    $bevro_containerpage     = get_theme_mod('bevro_containerpage',$default);
    $bevro_containerblogpage = get_theme_mod('bevro_containerblogpage',$default);
    $bevro_containerwoopage  = get_theme_mod('bevro_containerwoopage',$default);
    $layout='';
if($page_post_meta_set=='default' || $page_post_meta_set==''){
    if((class_exists( 'WooCommerce' ))&&(is_woocommerce() || is_checkout() || is_cart() || is_account_page())){
       $layout = $bevro_containerwoopage;
       
    }
    elseif(is_page()){
       $layout = $bevro_containerpage;
      
    }
    elseif(is_single()){
       $layout = $bevro_containerblogpage;
    }
    
    else{
       $layout = '';
    }   
    return apply_filters( 'bevro_page_content_layout', $layout, $default ); 
  }else{
      if(is_page()){
       $layout = $page_post_meta_set;
      }
      elseif(is_single()){
       $layout = $page_post_meta_set;
      } 
      elseif((class_exists( 'WooCommerce' )) && (is_woocommerce() || is_checkout() || is_cart() || is_account_page())){
       $layout = $page_post_meta_set;
      } 
   else{
       $layout = '';
     }
    return apply_filters( 'bevro_page_content_layout',$layout, $default ); 
    }
  }
}
/******************/
// Page Title
/******************/
if ( ! function_exists( 'bevro_page_title_post_meta' ) ){
function bevro_page_title_post_meta($page_post_meta_set){
if($page_post_meta_set!=='on'){?>
<h1 class='entry-title'><?php the_title();?></h1>
 <?php     }
    }
  }

/******************/
// Page Feature image
/******************/
if ( ! function_exists( 'bevro_page_feature_img_post_meta' ) ){
function bevro_page_feature_img_post_meta($page_post_meta_set){
if($page_post_meta_set!=='on'){
      if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())){
        the_post_thumbnail('post-thumbnails'); 
      }
     }
    }
  }


function bevro_full_header_markup() {

$bevro_default_container    = get_theme_mod('bevro_default_container','boxed');
$bevro_main_header_layout   = get_theme_mod('bevro_main_header_layout','mhdrleft');
$bevro_above_header_layout  = get_theme_mod('bevro_above_header_layout','abv-two');
$bevro_bottom_header_layout = get_theme_mod('bevro_bottom_header_layout','abv-two');
// add-pro-feature
$bevro_container_site_layout = get_theme_mod('bevro_container_site_layout','fullwidth');
// page post meta
if ((is_single() || is_page()) || ((class_exists( 'WooCommerce' ))&&(is_woocommerce() || is_checkout() || is_cart() || is_account_page()))
 ){
    $postid = '';
    if(class_exists( 'WooCommerce' ) && is_shop()){
               $shop_page_id = get_option( 'woocommerce_shop_page_id' );
               $postid=$shop_page_id;   
        }else{
               $postid = get_the_ID();
             }
              $bevro_transparent_header_dyn = get_post_meta($postid, 'bevro_transparent_header_dyn', true );
              $bevro_disable_main_header_dyn = get_post_meta($postid, 'bevro_disable_main_header_dyn', true );
              $bevro_disable_above_header_dyn = get_post_meta($postid, 'bevro_disable_above_header_dyn', true );
              $bevro_disable_bottom_header_dyn = get_post_meta($postid, 'bevro_disable_bottom_header_dyn', true );
              if(is_search() || is_404()){
                     $bevro_sticky_header_dyn='';
               }else{
                     $bevro_sticky_header_dyn = get_post_meta($postid, 'bevro_sticky_header_dyn', true );
                   }
     }else{
      $bevro_disable_above_header_dyn='';   
      $bevro_disable_main_header_dyn='';
      $bevro_disable_bottom_header_dyn='';
      $bevro_transparent_header_dyn='';
      $bevro_sticky_header_dyn='';
     }
       ?>
    <header class="<?php echo esc_attr($bevro_main_header_layout);?> <?php if(function_exists('bevro_sticky_above_header_class')){
    echo esc_attr(bevro_sticky_above_header_class($bevro_sticky_header_dyn));
}?> <?php if(function_exists('bevro_sticky_main_header_class')){
    echo esc_attr(bevro_sticky_main_header_class($bevro_sticky_header_dyn));
}?> <?php if(function_exists('bevro_sticky_bottom_header_class')){
    echo esc_attr(bevro_sticky_bottom_header_class($bevro_sticky_header_dyn));
}?> <?php if(function_exists('bevro_stick_animation_class')){ echo esc_attr(bevro_stick_animation_class());} ?> <?php echo esc_attr(bevro_header_transparent_class($bevro_transparent_header_dyn));?>">
<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'bevro' ); ?></a>
    <?php if($bevro_main_header_layout=='mhdrrightpan' || $bevro_main_header_layout=='mhdrleftpan'):?>
        <div class="header-pan-icon">
        <span class="pan-icon">
        </span>
        </div>
        <div class="pan-content">
        <div class="container">
        <?php bevro_logo();?>
        </div>
    <?php endif;?>
    <!-- minbar header -->
    <?php if($bevro_main_header_layout=='mhdminbarleft' || $bevro_main_header_layout=='mhdminbarright'){?>
    <?php bevro_minbar_header_markup();?>
    <div class="pan-content">   
    <?php } ?>
    <!-- end minbar header -->
    <!-- top-header start -->
    <?php 
    bevro_header_abv_post_meta($bevro_disable_above_header_dyn);
    bevro_header_main_post_meta($bevro_disable_main_header_dyn);
    bevro_header_btm_post_meta($bevro_disable_bottom_header_dyn); ?>
    <!-- bottom-header end-->
    <?php if($bevro_main_header_layout=='mhdrrightpan' || $bevro_main_header_layout=='mhdrleftpan'):?>
    </div>
    <?php endif;?>
    <?php if($bevro_main_header_layout=='mhdminbarleft'){?>
    </div>  
    <?php } ?>
</header>
  <?php   }

// Hook the custom header function into 'zita_header'
add_action('bevro_header', 'bevro_full_header_markup');