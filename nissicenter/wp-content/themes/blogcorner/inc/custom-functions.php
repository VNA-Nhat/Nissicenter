<?php
/**
 * Custom Functions.
 *
 * @package Blogcorner
 */

if (!function_exists('blogcorner_fonts_url')) :

    //Google Fonts URL
    function blogcorner_fonts_url()
    {

        $font_families = array(
            'Aleo:wght@100..900&display=swap',
            'Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&display=swap',
        );

        $fonts_url = add_query_arg(array(
            'family' => implode('&family=', $font_families),
            'display' => 'swap',
        ), 'https://fonts.googleapis.com/css2');

        return esc_url_raw($fonts_url);
    }

endif;

if (!function_exists('blogcorner_get_option')) :
    /**
     * Get customizer value by key.
     *
     * @param string $key Option key.
     * @return mixed Option value.
     * @since 1.0.0
     *
     */
    function blogcorner_get_option($key)
    {
        $key_value = '';
        if (!$key) {
            return $key_value;
        }
        $default_values = blogcorner_get_default_customizer_values();
        $customizer_values = get_theme_mod('blogcorner_options');
        $customizer_values = wp_parse_args($customizer_values, $default_values);

        $key_value = (isset($customizer_values[$key])) ? $customizer_values[$key] : '';
        return $key_value;
    }
endif;


/**
 * Blogcorner SVG Icon helper functions
 *
 * @package Blogcorner
 * @since 1.0.0
 */
if (!function_exists('blogcorner_theme_svg')):
    /**
     * Output and Get Theme SVG.
     * Output and get the SVG markup for an icon in the Blogcorner_SVG_Icons class.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function blogcorner_theme_svg($svg_name, $return = false)
    {

        if ($return) {

            return blogcorner_get_theme_svg($svg_name); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in blogcorner_get_theme_svg();.

        } else {

            echo blogcorner_get_theme_svg($svg_name); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in blogcorner_get_theme_svg();.

        }
    }

endif;

if (!function_exists('blogcorner_get_theme_svg')):

    /**
     * Get information about the SVG icon.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function blogcorner_get_theme_svg($svg_name)
    {

        // Make sure that only our allowed tags and attributes are included.
        $svg = wp_kses(
            Blogcorner_SVG_Icons::get_svg($svg_name),
            array(
                'svg' => array(
                    'class' => true,
                    'xmlns' => true,
                    'width' => true,
                    'height' => true,
                    'viewbox' => true,
                    'aria-hidden' => true,
                    'role' => true,
                    'focusable' => true,
                ),
                'path' => array(
                    'fill' => true,
                    'fill-rule' => true,
                    'd' => true,
                    'transform' => true,
                ),
                'polygon' => array(
                    'fill' => true,
                    'fill-rule' => true,
                    'points' => true,
                    'transform' => true,
                    'focusable' => true,
                ),

                'line' => array(
                    'stroke' => true,
                    'x1' => true,
                    'x2' => true,
                    'y1' => true,
                    'y2' => true,
                ),
            )
        );
        if (!$svg) {
            return false;
        }
        return $svg;

    }

endif;

if (!function_exists('blogcorner_svg_escape')):

    /**
     * Get information about the SVG icon.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function blogcorner_svg_escape($input)
    {

        // Make sure that only our allowed tags and attributes are included.
        $svg = wp_kses(
            $input,
            array(
                'svg' => array(
                    'class' => true,
                    'xmlns' => true,
                    'width' => true,
                    'height' => true,
                    'viewbox' => true,
                    'aria-hidden' => true,
                    'role' => true,
                    'focusable' => true,
                ),
                'path' => array(
                    'fill' => true,
                    'fill-rule' => true,
                    'd' => true,
                    'transform' => true,
                ),
                'polygon' => array(
                    'fill' => true,
                    'fill-rule' => true,
                    'points' => true,
                    'transform' => true,
                    'focusable' => true,
                ),
            )
        );

        if (!$svg) {
            return false;
        }

        return $svg;

    }

endif;

if (!function_exists('blogcorner_social_menu_icon')) :

    function blogcorner_social_menu_icon($item_output, $item, $depth, $args)
    {

        // Add Icon
        if (isset($args->theme_location) && 'social-menu' === $args->theme_location) {

            $svg = Blogcorner_SVG_Icons::get_theme_svg_name($item->url);

            if (empty($svg)) {
                $svg = blogcorner_theme_svg('link', $return = true);
            }

            $item_output = str_replace($args->link_after, '</span>' . $svg, $item_output);
        }

        return $item_output;
    }

endif;

add_filter('walker_nav_menu_start_el', 'blogcorner_social_menu_icon', 10, 4);


if (!function_exists('blogcorner_comment_form_custom_fields')) :
    /**
     * Custom comment form fields.
     *
     * @param array $fields
     *
     * @return array
     */
    function blogcorner_comment_form_custom_fields($fields)
    {

        $commenter = wp_get_current_commenter();
        $req = get_option('require_name_email');
        $aria_req = ($req ? ' aria-required="true"' : '');

        if (is_user_logged_in()) {
            $fields = array_merge($fields, array(
                'author' => '<p class="comment-form-author"><label for="author" class="show-on-ie8">' . __('Name', 'blogcorner') . '</label><input id="author" name="author" value="' . esc_attr($commenter['comment_author']) . '" type="text" placeholder="' . __('Name', 'blogcorner') . '..." size="30" ' . $aria_req . ' /></p>',
                'email' => '<p class="comment-form-email"><label for="email" class="show-on-ie8">' . __('Email', 'blogcorner') . '</label><input id="email" name="email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" type="text" placeholder="' . __('your@email.com', 'blogcorner') . '..." ' . $aria_req . ' /></p>',
            ));
        } else {
            $fields = array_merge($fields, array(
                'author' => '<p class="comment-form-author"><label for="author" class="show-on-ie8">' . __('Name', 'blogcorner') . '</label><input id="author" name="author" value="' . esc_attr($commenter['comment_author']) . '" type="text" placeholder="' . __('Name', 'blogcorner') . '..." size="30" ' . $aria_req . ' /></p><!--',
                'email' => '--><p class="comment-form-email"><label for="name" class="show-on-ie8">' . __('Email', 'blogcorner') . '</label><input id="email" name="email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" type="text" placeholder="' . __('your@email.com', 'blogcorner') . '..." ' . $aria_req . ' /></p><!--',
                'url' => '--><p class="comment-form-url"><label for="url" class="show-on-ie8">' . __('Url', 'blogcorner') . '</label><input id="url" name="url" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" placeholder="' . __('Website', 'blogcorner') . '..." type="text"></p>',
            ));
        }

        return $fields;
    }
endif;
add_filter('comment_form_default_fields', 'blogcorner_comment_form_custom_fields');

if( !function_exists( 'blogcorner_post_category_list' ) ) :

    // Post Category List.
    function blogcorner_post_category_list( $select_cat = true ){

        $post_cat_lists = get_categories(
            array(
                'hide_empty' => '0',
                'exclude' => '1',
            )
        );

        $post_cat_cat_array = array();
        if( $select_cat ){

            $post_cat_cat_array[''] = esc_html__( '-- Select Category --','blogcorner' );

        }

        foreach ( $post_cat_lists as $post_cat_list ) {

            $post_cat_cat_array[$post_cat_list->slug] = $post_cat_list->name;

        }

        return $post_cat_cat_array;
    }

endif;

if( !function_exists( 'blogcorner_woocommerce_product_cat' ) ) :

    // Post Category List.
    function blogcorner_woocommerce_product_cat(){

        $post_cat_lists = get_categories(
            array(
                'taxonomy'     => 'product_cat',
                'orderby'      => 'name',
                'show_count'   => 0,
                'pad_counts'   => 0,
                'hide_empty' => '0',
                'exclude' => '1',
            )
        );

        $post_cat_cat_array = array();
        $post_cat_cat_array[''] = esc_html__( '--Select Category--','blogcorner' );

        foreach ( $post_cat_lists as $post_cat_list ) {

            $post_cat_cat_array[$post_cat_list->slug] = $post_cat_list->name;

        }

        return $post_cat_cat_array;
    }

endif;

if (!function_exists('blogcorner_get_page_layout')) :
    /**
     * Get Page Layout based on the post meta or customizer value
     *
     * @return string Page Layout.
     * @since 1.0.0
     *
     */
    function blogcorner_get_page_layout()
    {

        global $post;

        $page_layout = '';

        if( is_singular( 'post' ) ){
            $blogcorner_post_sidebar = esc_attr( get_post_meta( $post->ID, 'blogcorner_post_sidebar_option', true ) );
            if( $blogcorner_post_sidebar == 'global-sidebar' || empty( $blogcorner_post_sidebar ) ){

                $page_layout = blogcorner_get_option('single_sidebar_layout');
            }else{
                $page_layout = $blogcorner_post_sidebar;
            }

        }

        return $page_layout;
    }
endif;

if ( ! function_exists( 'blogcorner_get_footer_layouts' ) ) :
    /**
     * Returns footer layout options.
     *
     * @since 1.0.0
     *
     * @return array Options array.
     */
    function blogcorner_get_footer_layouts() {
        $options = apply_filters( 'blogcorner_footer_layouts', array(
            'footer_layout_1'  => array(
                'url'   => get_template_directory_uri().'/assets/images/widget-column-4.png',
                'label' => esc_html__( 'Four Columns', 'blogcorner' ),
            ),
            'footer_layout_2' => array(
                'url'   => get_template_directory_uri().'/assets/images/widget-column-3.png',
                'label' => esc_html__( 'Three Columns', 'blogcorner' ),
            ),
            'footer_layout_3' => array(
                'url'   => get_template_directory_uri().'/assets/images/widget-column-2.png',
                'label' => esc_html__( 'Two Columns', 'blogcorner' ),
            ),

            'footer_layout_4' => array(
                'url'   => get_template_directory_uri().'/assets/images/widget-column-2.png',
                'label' => esc_html__( 'Four Columns', 'blogcorner' ),
            ),
            'footer_layout_5' => array(
                'url'   => get_template_directory_uri().'/assets/images/widget-column-2.png',
                'label' => esc_html__( 'five Columns', 'blogcorner' ),
            ),
            'footer_layout_6' => array(
                'url'   => get_template_directory_uri().'/assets/images/widget-column-2.png',
                'label' => esc_html__( 'six Columns', 'blogcorner' ),
            ),
        ) );
        return $options;
    }
endif;

if (!function_exists('blogcorner_print_first_instance_of_block')):

    /** Print the first instance of a block in the content, and then break away.
     * @param string $block_name The full block type name, or a partial match.
     *                                Example: `core/image`, `core-embed/*`.
     * @param string|null $content The content to search in. Use null for get_the_content().
     * @param int $instances How many instances of the block will be printed (max). Default  1.
     * @return bool Returns true if a block was located & printed, otherwise false.
     */
    function blogcorner_print_first_instance_of_block($block_name, $content = null, $instances = 1)
    {
        $instances_count = 0;
        $blocks_content = '';

        if (!$content) {
            $content = get_the_content();
        }

        // Parse blocks in the content.
        $blocks = parse_blocks($content);

        // Loop blocks.
        foreach ($blocks as $block) {

            // Sanity check.
            if (!isset($block['blockName'])) {
                continue;
            }

            // Check if this the block matches the $block_name.
            $is_matching_block = false;

            // If the block ends with *, try to match the first portion.
            if ('*' === $block_name[-1]) {
                $is_matching_block = 0 === strpos($block['blockName'], rtrim($block_name, '*'));
            } else {
                $is_matching_block = $block_name === $block['blockName'];
            }

            if ($is_matching_block) {
                // Increment count.
                $instances_count++;

                // Add the block HTML.
                $blocks_content .= render_block($block);

                // Break the loop if the $instances count was reached.
                if ($instances_count >= $instances) {
                    break;
                }
            }
        }

        if ($blocks_content) {
            /** This filter is documented in wp-includes/post-template.php */
            echo apply_filters('the_content', $blocks_content); // phpcs:ignore WordPress.Security.EscapeOutput
            return true;
        }

        return false;
    }
endif;

function blogcorner_gravatar_alt($blogcorner_gravatar) {
    if (have_comments()) {
        $alt = get_comment_author();
    }
    else {
        $alt = get_the_author_meta('display_name');
    }
    $blogcorner_gravatar = str_replace('alt=\'\'', 'alt=\'Avatar for ' . $alt . '\'', $blogcorner_gravatar);
    return $blogcorner_gravatar;
}
add_filter('get_avatar', 'blogcorner_gravatar_alt');

if( ! function_exists( 'blogcorner_iframe_escape' ) ):

    /** Escape Iframe **/
    function blogcorner_iframe_escape( $input ){

        $all_tags = array(
            'iframe'=>array(
                'width'=>array(),
                'height'=>array(),
                'src'=>array(),
                'frameborder'=>array(),
                'allow'=>array(),
                'allowfullscreen'=>array(),
            ),
            'video'=>array(
                'width'=>array(),
                'height'=>array(),
                'src'=>array(),
                'style'=>array(),
                'controls'=>array(),
            )
        );

        return wp_kses($input,$all_tags);

    }

endif;

if ( ! function_exists( 'blogcorner_social_share' ) ):

    /**
     * Social Share
    **/

    function blogcorner_social_share() {
        
        $enable_facebook = blogcorner_get_option( 'enable_facebook');
        $enable_twitter = blogcorner_get_option( 'enable_twitter' );
        $enable_pinterest = blogcorner_get_option( 'enable_pinterest');
        $enable_linkedin = blogcorner_get_option( 'enable_linkedin');
        $enable_telegram = blogcorner_get_option('enable_telegram');
        $enable_stumbleupon = blogcorner_get_option('enable_stumbleupon');
        $enable_email = blogcorner_get_option( 'enable_email');

        if( $enable_facebook || $enable_twitter || $enable_pinterest || $enable_linkedin || $enable_email || $enable_telegram || $enable_stumbleupon) {

            $permalink = urlencode( get_the_permalink() );
            $post_title = html_entity_decode( get_the_title(), ENT_COMPAT, 'UTF-8' );
            $media_url = urlencode( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ); ?>
            <div class="twp-social-share">


                    <?php if ($enable_facebook) { ?>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($permalink); ?>"
                           target="popup" class="twp-social-share-icon twp-share-icon-facebook"
                           onclick="window.open(this.href,'<?php echo esc_html__('Facebook', 'blogcorner'); ?>','width=600,height=400')">
                            <span><?php blogcorner_theme_svg('facebook'); ?></span>
                        </a>
                    <?php } ?>

                    <?php if ($enable_twitter) {

                        $twitter_id = blogcorner_get_option('twitter_id'); ?>
                        <a href="https://twitter.com/intent/tweet?text=<?php echo esc_html($post_title); ?>&amp;url=<?php echo esc_url($permalink); ?>&amp;via=<?php echo esc_html($twitter_id); ?>"
                           target="popup" class="twp-social-share-icon twp-share-icon-twitter"
                           onclick="window.open(this.href,'<?php echo esc_html__('Twitter', 'blogcorner'); ?>','width=600,height=400')">
                            <span><?php blogcorner_theme_svg('twitter'); ?></span>
                        </a>
                    <?php } ?>

                    <?php if ($enable_pinterest) { ?>
                        <a href="http://pinterest.com/pin/create/button/?url=<?php echo esc_url($permalink); ?>&amp;media=<?php echo $media_url; ?>&amp;description=<?php echo esc_html($post_title); ?>"
                           target="popup" class="twp-social-share-icon twp-share-icon-pinterest"
                           onclick="window.open(this.href,'<?php echo esc_html__('Pinterest', 'blogcorner'); ?>','width=600,height=400')">
                            <span><?php blogcorner_theme_svg('pinterest'); ?></span>
                        </a>
                    <?php } ?>

                    <?php if ($enable_linkedin) { ?>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url($permalink); ?>&title=<?php echo esc_html($post_title); ?>"
                           target="popup" class="twp-social-share-icon twp-share-icon-linkedin"
                           onclick="window.open(this.href,'<?php echo esc_html__('LinkedIn', 'blogcorner'); ?>','width=600,height=400')">
                            <span><?php blogcorner_theme_svg('linkedin'); ?></span>
                        </a>
                    <?php } ?>

                    <?php if ($enable_telegram) { ?>
                        <a href="https://telegram.me/share/url?url=<?php echo esc_attr($permalink); ?>&text=<?php echo esc_html($post_title); ?>"
                           target="popup" class="twp-social-share-icon twp-share-icon-telegram"
                           onclick="window.open(this.href,'<?php echo esc_html__('Telegram', 'blogcorner'); ?>','width=600,height=400')">
                            <span><?php blogcorner_theme_svg('telegram'); ?></span>
                        </a>
                    <?php } ?>


                    <?php if ($enable_stumbleupon) { ?>
                        <a href="http://www.stumbleupon.com/submit?url=<?php echo esc_attr($permalink); ?>&title=<?php echo esc_html($post_title); ?>"
                           target="popup" class="twp-social-share-icon twp-share-icon-stumbleupon"
                           onclick="window.open(this.href,'<?php echo esc_html__('Stumbleupon', 'blogcorner'); ?>','width=600,height=400')">
                            <span><?php blogcorner_theme_svg('stumbleupon'); ?></span>
                        </a>
                    <?php } ?>

                    <?php if ($enable_email) { ?>
                        <a href="mailto:?subject=<?php echo esc_html($post_title); ?>&body=<?php echo esc_html($post_title) . " " . esc_url($permalink); ?>"
                           target="_blank" class="twp-social-share-icon twp-share-icon-email">
                            <span><?php blogcorner_theme_svg('mail'); ?></span>
                        </a>
                    <?php } ?>


            </div>
            <?php
        }

    }

endif;

if (!function_exists('blogcorner_404_posts')):

    function blogcorner_404_posts()
    {

        $lead_post_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 4, 'post__not_in' => get_option("sticky_posts")));
        $site_fallback_image = blogcorner_get_option('site_fallback_image');
        if ($lead_post_query->have_posts()): ?>
            <div class="wrapper">
                <div class="column-row">
                    <?php
                    while ($lead_post_query->have_posts()) {
                        $lead_post_query->the_post();
                        ?>

                        <div class="column column-3 column-sm-6 column-xs-12">
                            <article id="blogcorner-error-<?php the_ID(); ?>" <?php post_class('theme-article-post theme-error-post'); ?>>

                                <div class="theme-entry-image">
                                    <figure class="featured-media featured-media-medium">
                                        <a href="<?php the_permalink() ?>">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <?php
                                                the_post_thumbnail('medium_large', array(
                                                    'alt' => the_title_attribute(array(
                                                        'echo' => false,
                                                    )),
                                                ));
                                                ?>
                                            <?php else : ?>
                                                <img src="<?php echo esc_url($site_fallback_image); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                                            <?php endif; ?>
                                        </a>
                                    </figure>
                                </div>

                                <div class="article-content">

                                    <?php the_title('<h3 class="entry-title entry-title-small"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>

                                    <div class="entry-meta">
                                        <?php blogcorner_posted_on(); ?>
                                        <?php blogcorner_posted_by(); ?>
                                    </div>

                                </div>

                            </article>
                        </div>

                    <?php } ?>


                </div>
            </div>
            <?php
            wp_reset_postdata();
        endif;

    }

endif;

function blogcorner_remove_embed_block_content($content) {
    // Define the pattern to match the wp-block-embed div and its content
    $pattern = '/<div class="wp-block-embed.*?">(.*?)<\/div>/is';

    // Remove the content inside wp-block-embed divs from the content
    $content = preg_replace($pattern, '<div class="wp-block-embed"></div>', $content);

    return $content;
}

if( !function_exists('blogcorner_post_floating_nav') ):

    function blogcorner_post_floating_nav(){

        $show_fixed_next_previous_post_navigation = blogcorner_get_option('show_fixed_next_previous_post_navigation');


        if( 'post' === get_post_type() && $show_fixed_next_previous_post_navigation ){

            $next_post = get_next_post();
            $prev_post = get_previous_post();

            if( isset( $prev_post->ID ) ){

                $prev_link = get_permalink( $prev_post->ID );?>

                <div class="floating-post-navigation floating-navigation-prev">
                    <?php if( get_the_post_thumbnail( $prev_post->ID,'medium' ) ){ ?>
                        <?php echo wp_kses_post( get_the_post_thumbnail( $prev_post->ID,'medium_large' ) ); ?>
                    <?php } ?>
                    <a href="<?php echo esc_url( $prev_link ); ?>">
                        <span class="floating-navigation-label"><?php echo esc_html__('Previous', 'blogcorner'); ?></span>
                        <span class="floating-navigation-title"><?php echo esc_html( get_the_title( $prev_post->ID ) ); ?></span>
                    </a>
                </div>

            <?php }

            if( isset( $next_post->ID ) ){

                $next_link = get_permalink( $next_post->ID );?>

                <div class="floating-post-navigation floating-navigation-next">
                    <?php if( get_the_post_thumbnail( $next_post->ID,'medium' ) ){ ?>
                        <?php echo wp_kses_post( get_the_post_thumbnail( $next_post->ID,'medium_large' ) ); ?>
                    <?php } ?>
                    <a href="<?php echo esc_url( $next_link ); ?>">
                        <span class="floating-navigation-label"><?php echo esc_html__('Next', 'blogcorner'); ?></span>
                        <span class="floating-navigation-title"><?php echo esc_html( get_the_title( $next_post->ID ) ); ?></span>
                    </a>
                </div>

                <?php
            }

        }

    }

endif;

add_action( 'blogcorner_navigation_action','blogcorner_post_floating_nav',10 );

if (!function_exists('blogcorner_get_general_layouts')) :
    /**
     * Returns general layout options.
     *
     * @return array Options array.
     * @since 1.0.0
     *
     */
    function blogcorner_get_general_layouts()
    {
        $options = apply_filters('blogcorner_general_layouts', array(
            'left-sidebar' => array(
                'url' => get_template_directory_uri() . '/assets/images/left_sidebar.png',
                'label' => esc_html__('Left Sidebar', 'blogcorner'),
            ),
            'right-sidebar' => array(
                'url' => get_template_directory_uri() . '/assets/images/right_sidebar.png',
                'label' => esc_html__('Right Sidebar', 'blogcorner'),
            ),
            'no-sidebar' => array(
                'url' => get_template_directory_uri() . '/assets/images/no_sidebar.png',
                'label' => esc_html__('No Sidebar', 'blogcorner'),
            ),
        ));
        return $options;
    }

endif;