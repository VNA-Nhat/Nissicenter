<?php
/* ------------------------------------------------------------------------- *
 *  Dynamic styles
/* ------------------------------------------------------------------------- */
/*  Convert hexadecimal to rgb
/* ------------------------------------ */
if (!function_exists('blogcorner_hex2rgb')) {
    function blogcorner_hex2rgb($hex, $array = false)
    {
        $hex = str_replace("#", "", $hex);
        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgb = array($r, $g, $b);
        if (!$array) {
            $rgb = implode(",", $rgb);
        }
        return $rgb;
    }
}
if (!function_exists('blogcorner_get_inline_css')) :
    /**
     * Outputs theme custom CSS.
     *
     * @since 1.0.0
     */
    function blogcorner_get_inline_css()
    {
        $defaults = blogcorner_get_default_customizer_values();

        $background_color = get_theme_mod('background_color');
        $site_title_text_size = blogcorner_get_option('site_title_text_size');
        $site_tagline_text_size = blogcorner_get_option('site_tagline_text_size');

        $header_bg_color = blogcorner_get_option('header_bg_color');
        $progressbar_color = blogcorner_get_option('progressbar_color');

        $footer_widgetarea_bg_color = blogcorner_get_option('footer_widgetarea_bg_color');
        $footer_widgetarea_text_color = blogcorner_get_option('footer_widgetarea_text_color');
        $footer_middlearea_bg_color = blogcorner_get_option('footer_middlearea_bg_color');
        $footer_middlearea_text_color = blogcorner_get_option('footer_middlearea_text_color');
        $footer_credit_bg_color = blogcorner_get_option('footer_credit_bg_color');
        $footer_credit_text_color = blogcorner_get_option('footer_credit_text_color');

        ob_start();
        ?>

        <?php if (!empty($background_color) && $background_color != 'ffffff') :
        ?>
        :root {
        --theme-bg-color: #<?php echo esc_attr($background_color); ?>;
        }
    <?php endif; ?>

        <?php if ($site_title_text_size != $defaults['site_title_text_size']) : ?>
        @media (min-width: 1000px){
        .site-title {
        font-size: <?php echo esc_attr($site_title_text_size) . 'px'; ?>;
        }
        }
    <?php endif; ?>
        <?php if ($site_tagline_text_size != $defaults['site_tagline_text_size']) : ?>
        @media (min-width: 1000px){
        .site-description {
        font-size: <?php echo esc_attr($site_tagline_text_size) . 'px'; ?>;
        }
        }
    <?php endif; ?>
        <?php if ($header_bg_color != $defaults['header_bg_color']) : ?>
        .site-header{
        background-color: <?php echo esc_attr($header_bg_color); ?>;
        }
    <?php endif; ?>
        <?php if ($progressbar_color != $defaults['progressbar_color']) : ?>
        #blogcorner-progress-bar{
        background-color: <?php echo esc_attr($progressbar_color); ?>;
        }
    <?php endif; ?>

        <?php if ($footer_widgetarea_bg_color != $defaults['footer_widgetarea_bg_color']) : ?>
        :root {
        --theme-footer-widgetarea-bg: <?php echo esc_attr($footer_widgetarea_bg_color); ?>;
        }
    <?php endif; ?>

        <?php if ($footer_widgetarea_text_color != $defaults['footer_widgetarea_text_color']) : ?>
        :root {
        --theme-footer-widgetarea-color: <?php echo esc_attr($footer_widgetarea_text_color); ?>;
        }
    <?php endif; ?>

        <?php if ($footer_middlearea_bg_color != $defaults['footer_middlearea_bg_color']) : ?>
        :root {
        --theme-footer-middlearea-bg: <?php echo esc_attr($footer_middlearea_bg_color); ?>;
        }
    <?php endif; ?>

        <?php if ($footer_middlearea_text_color != $defaults['footer_middlearea_text_color']) : ?>
        :root {
        --theme-footer-middlearea-color: <?php echo esc_attr($footer_middlearea_text_color); ?>;
        }
    <?php endif; ?>

        <?php if ($footer_credit_bg_color != $defaults['footer_credit_bg_color']) : ?>
        :root {
        --theme-footer-credit-bg: <?php echo esc_attr($footer_credit_bg_color); ?>;
        }
    <?php endif; ?>

        <?php if ($footer_credit_text_color != $defaults['footer_credit_text_color']) : ?>
        :root {
        --theme-footer-credit-color: <?php echo esc_attr($footer_credit_text_color); ?>;
        }
    <?php endif; ?>

        <?php
        return ob_get_clean();
    }
endif;
