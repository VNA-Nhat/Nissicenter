<?php

if (!defined('ABSPATH')) {
    exit;
}

class Blogcorner_Social_Menu extends Blogcorner_Widget_Base
{

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->widget_cssclass = 'blogcorner-widget-social-menu';
        $this->widget_description = __("Displays social menu if you have set it.", 'blogcorner');
        $this->widget_id = 'blogcorner_social_menu';
        $this->widget_name = __('Blogcorner: Social Menu', 'blogcorner');
        $this->settings = array(
            'title' => array(
                'type' => 'text',
                'label' => __('Title', 'blogcorner'),
            ),
            'style' => array(
                'type' => 'select',
                'label' => __('Style', 'blogcorner'),
                'options' => array(
                    'style_1' => __('Style 1', 'blogcorner'),
                    'style_2' => __('Style 2', 'blogcorner'),
                    'style_3' => __('Style 3', 'blogcorner'),
                ),
                'std' => 'style_1',
            ),
        );

        parent::__construct();
    }

    /**
     * Output widget.
     *
     * @see WP_Widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance)
    {
        ob_start();

        $this->widget_start($args, $instance);

        do_action( 'blogcorner_before_social_menu');

        $style = $instance['style'];

        ?>
        <div class="blogcorner-social-menu-widget <?php echo esc_attr($style);?>">
            <?php

            if ( has_nav_menu( 'social-menu' ) ) {
                wp_nav_menu(array(
                    'theme_location' => 'social-menu',
                    'container_class' => 'footer-navigation',
                    'fallback_cb' => false,
                    'depth' => 1,
                    'menu_class' => 'blogcorner-social-icons reset-list-style',
                    'link_before' => '<span class="social-media-title">',
                    'link_after' => '</span>',
                ) );
            }else{
                esc_html_e( 'Social menu is not set. You need to create menu and assign it to Social Menu on Menu Settings.', 'blogcorner' );
            }
            ?>
        </div>
        <?php

        do_action( 'blogcorner_after_social_menu');

        $this->widget_end($args);

        echo ob_get_clean();
    }
}