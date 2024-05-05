<?php
/**
 * Default customizer values.
 *
 * @package Blogcorner
 */
if (!function_exists('blogcorner_get_default_customizer_values')) :
    /**
     * Get default customizer values.
     *
     * @return array Default customizer values.
     * @since 1.0.0
     *
     */
    function blogcorner_get_default_customizer_values()
    {

        $defaults = array();

        $defaults['background_color'] = 'ffffff';

        // header image section
        $defaults['enable_header_bg_overlay'] = false;
        $defaults['header_image_size'] = 'none';

        //Site title options
        $defaults['hide_title'] = false;
        $defaults['hide_tagline'] = false;
        $defaults['site_title_text_size'] = 32;
        $defaults['site_tagline_text_size'] = 14;

        // General options
        $defaults['enable_cursor_dot_outline'] = false;
        $defaults['site_fallback_image'] = get_template_directory_uri() . '/assets/images/no-image.jpg';

        $defaults['show_preloader'] = true;
        $defaults['preloader_style'] = 'theme-preloader-spinner-1';
        $defaults['show_progressbar'] = false;
        $defaults['progressbar_position'] = 'top';
        $defaults['progressbar_color'] = '#00ADEF';

        // Top bar.
        $defaults['top_bar_bg_color'] = '#000000';
        $defaults['top_bar_text_color'] = '#fff';

        // Header
        $defaults['header_bg_color'] = '#ffffff';
        $defaults['header_style'] = 'header_style_1';
        $defaults['enable_top_nav'] = true;

        $defaults['enable_search_on_header'] = true;
        $defaults['header_search_btn_style'] = 'style_1';
        $defaults['enable_mini_cart_header'] = true;
        $defaults['enable_woo_my_account'] = true;
        $defaults['enable_sticky_menu'] = true;

        // shop page
        $defaults['enable_shop_section'] = true;
        $defaults['shop_post_title'] = __('Shop Now', 'blogcorner');
        $defaults['shop_post_description'] = '';
        $defaults['shop_number_of_column'] = 4;
        $defaults['shop_number_of_product'] = 4;
        $defaults['shop_select_product_from'] = 'recent-products';
        $defaults['select_product_category'] = '';
        $defaults['shop_post_button_text'] = __('Shop Now', 'blogcorner');

        // Front Page category
        $defaults['enable_category_section'] = false;
        $defaults['number_of_category'] = '4';
        $defaults['category_post_title'] = __('Featured Categories', 'blogcorner');

        // front page banner sectiion
        $defaults['enable_banner_section'] = true;
        $defaults['enable_banner_overlay'] = true;
        $defaults['number_of_slider_post'] = 4;
        $defaults['banner_section_cat'] = '';
        $defaults['enable_banner_tag_meta'] = true;
        $defaults['enable_banner_cat_meta'] = true;
        $defaults['enable_banner_post_description'] = true;
        $defaults['enable_banner_author_meta'] = true;
        $defaults['enable_banner_date_meta'] = true;

        //newsletter section
        $defaults['enable_newsletter_section'] = false;

        $defaults['enable_featured_post'] = false;
        $defaults['featured_post_cat'] = '';
        $defaults['enable_featured_post_description'] = '';
        $defaults['enable_featured_post_cat_meta'] = true;
        $defaults['enable_featured_post_author_meta'] = true;
        $defaults['enable_featured_post_date_meta'] = true;

        // Single options
        $defaults['single_sidebar_layout'] = 'right-sidebar';
        $defaults['hide_single_sidebar_mobile'] = false;
        $defaults['single_post_meta'] = array('author', 'date', 'comment', 'category', 'tags');

        $defaults['show_author_info'] = true;
        $defaults['show_fixed_next_previous_post_navigation'] = true;

        $defaults['show_related_posts'] = true;
        $defaults['related_posts_text'] = __('You May Also Like', 'blogcorner');
        $defaults['related_posts_orderby'] = 'date';
        $defaults['related_posts_order'] = 'desc';
        $defaults['author_posts_orderby'] = 'date';
        $defaults['author_posts_order'] = 'desc';

        $defaults['show_author_posts'] = true;
        $defaults['author_posts_text'] = __('More From Author', 'blogcorner');

        // Archive
        $defaults['archive_post_meta_1'] = array('date','category','social-share');
        $defaults['archive_style'] = 'archive-style-2';

        // pagination
        $defaults['pagination_type'] = 'default';

        // readtime option
        $defaults['words_per_minute'] = 200;

        // footer related post
        $defaults['enable_footer_recommended_post_section'] = true;
        $defaults['select_number_of_post'] = 6;
        $defaults['select_number_of_col'] = 'column-4';
        $defaults['footer_recommended_post_title'] = esc_html__('You May Also Like:', 'blogcorner');
        $defaults['select_font_size'] = 'entry-title-small';
        $defaults['select_image_size'] = 'featured-media-medium';
        $defaults['enable_category_meta'] = true;
        $defaults['enable_date_meta'] = true;
        $defaults['enable_author_meta'] = false;
        $defaults['enable_social_share'] = true;
        $defaults['select_cat_for_footer_recommended_post'] = '';

        /*Footer*/
        $defaults['footer_column_layout'] = 'footer_layout_1';
        $defaults['enable_footer_sticky'] = false;
        $defaults['enable_footer_image_overlay'] = false;
        $defaults['copyright_text'] = esc_html__('Copyright &copy;', 'blogcorner');
        $defaults['copyright_date_format'] = 'Y';
        $defaults['enable_footer_nav'] = false;
        $defaults['enable_footer_social_nav'] = false;
        $defaults['enable_scroll_to_top'] = true;

        $defaults['footer_widgetarea_bg_color'] = '#000';
        $defaults['footer_widgetarea_text_color'] = '#fff';
        $defaults['footer_middlearea_bg_color'] = '#000';
        $defaults['footer_middlearea_text_color'] = '#fff';
        $defaults['footer_credit_bg_color'] = '#000';
        $defaults['footer_credit_text_color'] = '#fff';

        $defaults['enable_facebook'] = true;
        $defaults['enable_twitter'] = true;
        $defaults['enable_pinterest'] = true;
        $defaults['enable_linkedin'] = false;
        $defaults['enable_telegram'] = false;
        $defaults['enable_stumbleupon'] = false;
        $defaults['enable_email'] = false;

        $defaults = apply_filters('blogcorner_default_customizer_values', $defaults);
        return $defaults;
    }
endif;