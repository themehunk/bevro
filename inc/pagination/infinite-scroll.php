<?php 
//**********************/
// Inifinite pagination
//**********************/
function bevro_scrolling_ajax(){
global $wp_query;
?>
<div class="infinite-loader"><span class="inifiniteLoader"></span></div>
<div class="scroll-error"></div>
<?php
echo'<a href="#" id="loadMore"  data-page="1" data-url="'.esc_url(admin_url("admin-ajax.php")).'"  data-ppp="'.get_option('posts_per_page').'" data-total="'.esc_attr($wp_query->max_num_pages).'" ></a>';
}
/*
 * load more script ajax hooks
 */
add_action('wp_ajax_nopriv_bevro_ajax_script_load_more', 'bevro_ajax_script_load_more');
add_action('wp_ajax_bevro_ajax_script_load_more', 'bevro_ajax_script_load_more');
/*
 * enqueue js script
 */
add_action( 'wp_enqueue_scripts', 'bevro_ajax_enqueue_script' );
/*
 * enqueue js script call back
 */
function bevro_ajax_enqueue_script(){
wp_enqueue_script( 'script_ajax', get_parent_theme_file_uri() . '/inc/pagination/js/infinite-scroll.js', array( 'jquery' ), '0.1', true );
}
function bevro_ajax_script_load_more(){
bevro_scroll($_POST,'infinite');
}
function bevro_scroll($post,$scroll){
$offset = $_POST["offset"];
$paged  = $_POST["paged"];
header("Content-Type: text/html");
$args = array(
      'post_type'       => 'post',
      'post_status'     => 'publish',
      'paged'           =>  $paged,
      );  
$loop = new WP_Query($args);
  if ( $loop->have_posts() ){
      // Start the post formate loop.
      while ($loop->have_posts()) : $loop->the_post();
      get_template_part( 'template-parts/content', get_post_format() );
      endwhile;
      // Start the post formate grid.
      wp_reset_postdata();
    }
    // If no content, include the "No posts found" template.
exit;
}