<?php
if ( ! function_exists( 'bevro_get_pro_url' ) ) :
	/**
	 * Returns an URL with utm tags
	 * the admin settings page.
	 *
	 * @param string $url    URL fo the site.
	 * @param string $source utm source.
	 * @param string $medium utm medium.
	 * @param string $campaign utm campaign.
	 * @return mixed
	 */
	function bevro_get_pro_url( $url, $source = '', $medium = '', $campaign = '' ){

		$url = trailingslashit( $url );

		// Set up our URL if we have a source.
		if ( isset( $source ) ){
			$url = add_query_arg( 'utm_source', sanitize_text_field( $source ), $url );
		}
		// Set up our URL if we have a medium.
		if ( isset( $medium ) ){
			$url = add_query_arg( 'utm_medium', sanitize_text_field( $medium ), $url );
		}
		// Set up our URL if we have a campaign.
		if ( isset( $campaign ) ){
			$url = add_query_arg( 'utm_campaign', sanitize_text_field( $campaign ), $url );
		}

		return esc_url( $url );
	}

endif;
/**
 * Add admin notice when active theme, just show one time
 *
 * @return bool|null
 */
add_action( 'admin_notices', 'bevro_admin_notice' );
function bevro_admin_notice(){
  global $current_user;
  $user_id   = $current_user->ID;
  $theme_data  = wp_get_theme();
  $bevro_icon    = apply_filters( 'bevro_page_top_icon', true );
  $bevro_nme     = apply_filters( 'bevro_welcome_page_notice_header_site_title','');
  if ( !get_user_meta( $user_id, esc_html( $theme_data->get( 'TextDomain' ) ) . '_notice_ignore' ) ) {
    ?>
    <div class="notice bevro-notice">
      <h1>
        <?php
        if(!$bevro_icon){
        	 printf( esc_html__( 'Thank you for Installing %1$s - Version %2$s', 'bevro' ), esc_html($bevro_nme ), esc_html( $theme_data->Version ) );
        }else{
        /* translators: %1$s: theme name, %2$s theme version */
        printf( esc_html__( 'Thank you for Installing %1$s - Version %2$s', 'bevro' ), esc_html($theme_data->Name), esc_html( $theme_data->Version ) );
        }
        ?>
      </h1>
      <p>
        <?php
        if(!$bevro_icon){
        printf( __( 'Visit %1$s options page to take full advantage of theme.', 'bevro' ), esc_html( $bevro_nme ), esc_url( admin_url( 'themes.php?page=bevro' ) ) );
        printf( '<a href="%1$s" class="notice-dismiss dashicons dashicons-dismiss dashicons-dismiss-icon"></a>', '?' . esc_html( $theme_data->get( 'TextDomain' ) ) . '_notice_ignore=0' );
        }else{
         /* translators: %1$s: theme name, %2$s link */
        printf( __( 'Visit %1$s options page to take full advantage of theme.', 'bevro' ), esc_html( $theme_data->Name ), esc_url( admin_url( 'themes.php?page=bevro' ) ) );
        printf( '<a href="%1$s" class="notice-dismiss dashicons dashicons-dismiss dashicons-dismiss-icon"></a>', '?' . esc_html( $theme_data->get( 'TextDomain' ) ) . '_notice_ignore=0' );	
        }
        ?>
      </p>
      <p>
        <a href="<?php echo esc_url( admin_url( 'themes.php?page=bevro' ) ) ?>"  style="text-decoration: none;">
          <?php
          if(!$bevro_icon){
          /* translators: %s theme name */
          printf( esc_html__( 'Get started with %s', 'bevro' ), esc_html( $bevro_nme ) );
          }else{
          /* translators: %s theme name */
          printf( esc_html__( 'Get started with %s', 'bevro' ), esc_html( $theme_data->Name ) );
          }
          ?>
        </a>
      </p>
    </div>
    <?php
  }
}
add_action( 'admin_init', 'bevro_notice_ignore' );
function bevro_notice_ignore(){
  global $current_user;
  $theme_data  = wp_get_theme();
  $user_id   = $current_user->ID;
  /* If user clicks to ignore the notice, add that to their user meta */
  if ( isset( $_GET[ esc_html( $theme_data->get( 'TextDomain' ) ) . '_notice_ignore' ] ) && '0' == $_GET[ esc_html( $theme_data->get( 'TextDomain' ) ) . '_notice_ignore' ] ) {
    add_user_meta( $user_id, esc_html( $theme_data->get( 'TextDomain' ) ) . '_notice_ignore', 'true', true );
  }
}