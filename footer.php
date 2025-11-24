<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package Themehunk
 * @subpackage  Bevro
 * @since 1.0.0
 */ 
?>

<?php do_action( 'bevro_before_footer' ); ?>
<!-- Main Footer (rendered via hook) -->
<?php do_action( 'bevro_footer' ); ?> <!-- Footer content injected via hook -->
<?php do_action( 'bevro_after_footer' ); ?>
<?php wp_footer(); ?>
</body>
</html>