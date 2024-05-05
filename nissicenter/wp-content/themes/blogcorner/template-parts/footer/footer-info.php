<?php
$enable_footer_nav = blogcorner_get_option('enable_footer_nav');
?>
<div class="theme-footer-bottom">
    <div class="wrapper">
        <div class="theme-author-credit">
            <span class="theme-copyright-info">
                <?php
                $copyright_text = blogcorner_get_option('copyright_text');
                if ($copyright_text):
                    echo wp_kses_post($copyright_text);
                endif;
                $active_theme = wp_get_theme();
                $active_theme_textdomain = esc_html($active_theme->get('TextDomain'));
                $copyright_date_format = blogcorner_get_option('copyright_date_format', 'Y');
                if ($copyright_date_format) {
                    echo ' ' . date_i18n($copyright_date_format, current_time('timestamp'));
                }
                printf(esc_html__(' %1$s.', 'blogcorner'), $active_theme_textdomain);
                ?>
            </span><!-- .theme-copyright-info -->
            <span class="theme-credit-info"><?php printf(esc_html__('Designed & Developed by %1$s', 'blogcorner'), '<a href="https://themeinwp.com/" target = "_blank" rel="designer">ThemeinWP Team</a>'); ?></span>
        </div><!-- .theme-author-credit-->
        <?php if ($enable_footer_nav): ?>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'footer-menu',
                'container_class' => 'footer-navigation',
                'fallback_cb' => false,
                'depth' => 1,
                'menu_class' => 'theme-footer-navigation theme-menu theme-footer-navigation'
            ));
            ?>
        <?php endif; ?>
    </div>
</div><!-- .theme-footer-bottom-->
