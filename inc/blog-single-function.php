<?php 
/**
 * Blog Single Function for Bevro Theme.
 *
 * @package Themehunk
 * @subpackage  Bevro
 * @since 1.0.0
 */
// related post by category
function bevro_get_related_sigle_post_by_optn(){
global $post; if(wp_get_post_categories($post->ID)!=null && wp_get_post_tags( $post->ID )!=null ):?>
<div class="bevro-related-post"> 
<ul>
<?php 
    
    if(get_theme_mod('bevro_single_related_post_option')=='category'):
     $args = array(
               'category__in' => wp_get_post_categories($post->ID),
               'post__not_in' => array($post->ID),
               'post_status' => array('publish'),                         
               'meta_key' => '_thumbnail_id',
               'posts_per_page' => 3,
            );
   else:
    $tags = wp_get_post_tags( $post->ID );    
        if ( $tags ) {
            foreach ( $tags as $tag ){   
               $tagID[] = $tag->term_id;

            }
    $args = array(
               'tag__in' => $tagID,
               'post__not_in' => array($post->ID),
               'post_status' => array('publish'),                         
               'meta_key' => '_thumbnail_id',
               'posts_per_page' => 3,
            );
   }
  endif;
        $my_query = new WP_Query($args);
        if ($my_query->have_posts()) {
            while ($my_query->have_posts()) : $my_query->the_post();
                ?>
               <li class="brv-related-thumbnail">
                    <div class="brv-related-thumbnail-size">
                        <?php
                       if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) {
                            ?>
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('post-thumbnails'); ?></a>
                            <?php
                        } ?>
                      </div>
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                </li>
                <?php
            endwhile;
        }
    wp_reset_postdata(); // to use the original query again
    ?>
</ul>
</div>
<?php endif;} 
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
if ( ! function_exists( 'bevro_single_post_get_post_meta' ) ){
  /**
   * Prints HTML with meta information for the current post-date/time and author.
   *
   * @since 1.0
   * @return mixed            Markup.
   */
  function bevro_single_post_get_post_meta(){
    $post_meta   = bevro_get_option( 'bevro-blog-meta-single','');
    $post_meta_seprator = get_theme_mod( 'bevro_single_meta_seprator','/' );
    if ( 'post' == get_post_type() && is_array( $post_meta )){

      $output_str = bevro_get_post_meta( $post_meta, $post_meta_seprator);

      if ( ! empty( $output_str ) ){
        echo apply_filters( 'bevro_single_post_meta', '<div class="entry-meta">' . $output_str . '</div>', $output_str ); // WPCS: XSS OK.
      }
    }
  }
}
/**************************************************************************/
//Single post title and featured image odering
/*************************************************************************/
/**
 * Blog Post Thumbnail / Title & Meta Order
 */
if ( ! function_exists( 'bevro_single_post_thumbnai_and_title_order' ) ){
  /**
   * Blog post Thubmnail, Title & Blog Meta order
   *
   * @since  1.0.8
   */
  function bevro_single_post_thumbnai_and_title_order($bevro_disable_title_dyn,$bevro_disable_feature_image_dyn){
    $single_post_thumb_title_order = bevro_get_option('bevro-blog-single-structure-meta');
    if ( is_array( $single_post_thumb_title_order ) ){
      // Append the custom class for second element for single post.
      foreach ( $single_post_thumb_title_order as $single_thumb_title_order ){
        switch ( $single_thumb_title_order ){

          // Single Post Featured Image.
          case 'image':
            bevro_before_single_feature_img_markup($bevro_disable_feature_image_dyn);
          break;

          // Single Post Title and Blog Post Meta.
          case 'title':
            bevro_after_single_feature_img_markup($bevro_disable_title_dyn);
          break;
          
        }
      }
    }
  }
}
/**************************************/
//Single layout archive function before
/**************************************/
if ( ! function_exists( 'bevro_before_single_feature_img_markup' ) ){  
function bevro_before_single_feature_img_markup($bevro_disable_feature_image_dyn){ if($bevro_disable_feature_image_dyn!=='on'):?>
<div class="single-post-img-wrapper">
 
  <?php
      if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())){?>
         <div class="post-img">
        <?php the_post_thumbnail('post-thumbnails'); ?>
        </div>
      <?php }
     ?> 
  
</div>
   <?php endif; }
}
/**************************************/
//Blog layout archive function after
/**************************************/
if ( ! function_exists( 'bevro_after_single_feature_img_markup' ) ){ 
function bevro_after_single_feature_img_markup($bevro_disable_title_dyn){ ?>
<div class="entry-header entry-page">
<?php if($bevro_disable_title_dyn!=='on'):?>
<h1 class="entry-title">
  <?php the_title(); ?>
</h1>
<?php endif; ?>
<?php bevro_single_post_get_post_meta();?>
</div>   
<?php }
}
/*********************/
// No space featured image
/*********************/
function bevro_single_post_ftr_img_space_class( $classes ){
$bevro_single_remove_img_pad = get_theme_mod('bevro_single_remove_img_pad');
if ($bevro_single_remove_img_pad ){
$classes = 'no-single-img-space';
}
return $classes;  
}
add_filter( 'bevro_single_post_ftr_img_space_classes','bevro_single_post_ftr_img_space_class', 999 );