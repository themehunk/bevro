
<!--- tab first -->
<div class="theme_link">
    <h3><?php _e('1. Install Recommended Plugins','bevro'); ?></h3>
    <p><?php _e('We highly Recommend to install recommended plugin to get all customization options in Bevro theme. Also install recommended plugins available in recommended tab.','bevro'); ?></p>

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
        <button style="<?php echo $Bstyle; ?>"; class="button activate-now <?PHP echo $class; ?>"><?php _e($btn_text,'bevro'); ?></button>

        <a style="<?php echo $style; ?>";  target="_blank" href="<?php echo get_home_url(); ?>" class="button alink button-primary"><?php _e('View Home Page','bevro'); ?></a>
		
         </p>
		 	 
		 
    <p>
        <a target="_blank" href="https://themehunk.com/docs/bevro-wordpress-theme/" class="button"><?php _e('Go to Doc','bevro'); ?></a>
    </p>
</div>

<!--- tab third -->





<!--- tab second -->
<div class="theme_link">
    <h3><?php _e('3. Customize Your Website','bevro'); ?><!-- <php echo $theme_config['plugin_title']; ?> --></h3>
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
                    <hr><a href="<?php echo admin_url('customize.php?autofocus[panel]=bevro-panel-layout'); ?>" class="components-button is-link"><?php _e("Layout Options","bevro"); ?></a><hr>
                    <a href="<?php echo admin_url('customize.php?autofocus[panel]=woocommerce'); ?>" class="components-button is-link"><?php _e("Woocommerce","bevro"); ?></a><hr>

                </div>

               <div class="col">

                <a href="<?php echo admin_url('customize.php?autofocus[panel]=nav_menus'); ?>" class="components-button is-link"><?php _e("Menus","bevro"); ?></a><hr>

                <a href="<?php echo admin_url('customize.php?autofocus[section]=custom_css'); ?>" class="components-button is-link"><?php _e("Additional CSS","bevro"); ?></a>
                <hr>


                 <a href="<?php echo admin_url('customize.php?autofocus[panel]=widgets'); ?>" class="components-button is-link"><?php _e("Widgets","bevro"); ?></a><hr>
            </div>

        </div>
    </div>

</div>
<!--- tab fourth -->