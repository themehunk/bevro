<?php
/**
 * The template for displaying all single posts
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Themehunk
 * @subpackage  Bevro
 * @since 1.0.0
 */
get_header();
$page_post_meta_set     = get_post_meta( $post->ID, 'bevro_sidebar_dyn', true );
$page_content_post_meta_set = get_post_meta( $post->ID, 'bevro_content_dyn', true );?>
<div id="content" class="site-content blog-single <?php echo esc_attr(bevro_page_content_layout($page_content_post_meta_set,'')); ?>">
  <div id="container" class="site-container <?php echo esc_attr(bevro_sidebar_layout($page_post_meta_set,''));?>">
	<div id="primary" class="main content-area">
		<main id="main" class="site-main" role="main">
		<?php
		    while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/content-post', get_post_type() );
		   if(get_theme_mod('bevro_single_share_icon',true)):
		   if(bevro_pro_activation_class()!==''):	
			    bevro_post_share();
		    endif;
		    endif;
		    if(get_theme_mod('bevro_single_authr_bio')):
			// Author bio.
			if ( 'post' === get_post_type() ) :
				get_template_part( 'template-parts/author-bio' );
			endif;
		    endif;
			the_post_navigation();
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		    endwhile; // End of the loop.
		    if(get_theme_mod('bevro_single_related_post')):
		       bevro_get_related_sigle_post_by_optn();
		    endif;?>
		</main>
	</div>
	<?php if(bevro_sidebar_layout($page_post_meta_set,'')!=='no-sidebar'): get_sidebar(); endif; ?>
  </div>
</div>
<?php get_footer();