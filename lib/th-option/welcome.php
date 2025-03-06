
<!--- tab first -->
<div class="theme_link">
    <h3><?php _e('1. Install Recommended Plugins','bevro'); ?></h3>
    <p><?php _e('We highly Recommend to install ThemeHunk Customizer plugin to get all customization options in Bevro theme. Also install recommended plugins available in recommended tab.','bevro'); ?></p>
</div>
<div class="theme_link">
    <h3><?php _e('2. Setup Home Page','bevro'); ?><!-- <php echo $theme_config['plugin_title']; ?> --></h3>
        <p><?php _e('To set up the HomePage in Bevro theme, Just follow the below given Instructions.','bevro'); ?> </p>
<p><?php _e('Go to Wp Dashboard > Pages > Add New > Create a Page using “Home Page Template” available in Page attribute.','bevro'); ?> </p>
<p><?php _e('Now go to Settings > Reading > Your homepage displays > A static page (select below) and set that page as your homepage.','bevro'); ?> </p>
     <p>
        <?php
		if($this->_check_homepage_setup()){
            $class = "activated";
            $btn_text = __("Home Page Activated",'bevro');
            $Bstyle = "display:none;";
            $style = "display:inline-block;";
        }else{
            $class = "default-home";
             $btn_text = __("Set Home Page",'bevro');
             $Bstyle = "display:inline-block;";
            $style = "display:none;";


        }
        ?>
        <button style="<?php echo esc_attr($Bstyle); ?>" class="button activate-now <?php echo esc_attr($class); ?>">

            <?php echo esc_html($btn_text);?>
                
        </button>
		
         </p>
		 	 
		 
    <p>
        <a target="_blank" href="https://themehunk.com/docs/bevro/#homepage-setting" class="button"><?php _e('Go to Doc','bevro'); ?></a>
    </p>
</div>

<!--- tab third -->

<!--- tab second -->

<div class="theme_link">
    <h3><?php _e('3. Customize Your Website','bevro'); ?></h3>

    <p><?php _e('Bevro theme support live customizer for home page set up. Everything visible at home page can be changed through customize panel','bevro'); ?></p>
    <p>
    <a href="<?php echo admin_url('customize.php'); ?>" class="button button-primary"><?php _e("Start Customize","bevro"); ?></a>
    </p>
</div>
<!--- tab third -->

  <div class="theme_link">
    <h3><?php _e("4. Customizer Links","bevro"); ?></h3>
    <div class="card-content">
        <div class="columns">
                <div class="col">
                    <a href="<?php echo admin_url('customize.php?autofocus[control]=custom_logo'); ?>" class="components-button is-link"><?php _e("Upload Logo","bevro"); ?></a>
                    <hr><a href="<?php echo admin_url('customize.php?autofocus[section]=bevro-gloabal-color'); ?>" class="components-button is-link"><?php _e("Global Colors","bevro"); ?></a><hr>
                    <a href="<?php echo admin_url('customize.php?autofocus[panel]=woocommerce'); ?>" class="components-button is-link"><?php _e("Woocommerce","bevro"); ?></a><hr>

                </div>

               <div class="col">
                <a href="<?php echo admin_url('customize.php?autofocus[section]=bevro-section-header-group'); ?>" class="components-button is-link"><?php _e("Header Options","bevro"); ?></a>
                <hr>

                <a href="<?php echo admin_url('customize.php?autofocus[panel]=bevro-panel-frontpage'); ?>" class="components-button is-link"><?php _e("FrontPage Sections","bevro"); ?></a><hr>


                 <a href="<?php echo admin_url('customize.php?autofocus[section]=bevro-section-footer-group'); ?>" class="components-button is-link"><?php _e("Footer Section","bevro"); ?></a><hr>
            </div>

        </div>
    </div>

</div>
<!--- tab fourth -->