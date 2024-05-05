<?php 
/**
 * Displays before footer widget area.
 *
 * @package Blogcorner
 */

if ( is_active_sidebar( 'fullwidth-footer-widgetarea' ) ) : ?>

<section class="site-section site-widgetarea site-widgetarea-full site-widgetarea-footer" role="complementary">
    <?php dynamic_sidebar( 'fullwidth-footer-widgetarea' ); ?>
</section>

<?php endif; ?>