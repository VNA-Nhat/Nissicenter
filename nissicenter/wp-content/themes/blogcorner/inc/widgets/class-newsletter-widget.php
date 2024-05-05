<?php
if (!defined('ABSPATH')) {
    exit;
}
class Blogcorner_Mailchimp_Form extends Blogcorner_Widget_Base
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->widget_cssclass = 'blogcorner-widget-newsletter';
        $this->widget_description = __("Displays MailChimp form if you have any", 'blogcorner');
        $this->widget_id = 'blogcorner_mailchimp_form';
        $this->widget_name = __('Blogcorner: MailChimp Form', 'blogcorner');
        $this->settings = array(
            'title' => array(
                'label' => esc_html__('Widget Title', 'blogcorner'),
                'type' => 'text',
                'class' => 'widefat',
            ),
            'desc' => array(
                'type' => 'textarea',
                'label' => __('Description', 'blogcorner'),
                'rows' => 10,
            ),
            'form_shortcode' => array(
                'type' => 'textarea',
                'label' => __('MailChimp Form Shortcode', 'blogcorner'),
                'rows' => 5,

            ),
            'style' => array(
                'type' => 'select',
                'label' => __('Style', 'blogcorner'),
                'options' => array(
                    'style_1' => __('Style 1', 'blogcorner'),
                    'style_2' => __('Style 2', 'blogcorner'),
                ),
                'std' => 'style_1',
            ),
            'msg' => array(
                'type' => 'message',
                'label' => __('Additonal Settings', 'blogcorner'),
            ),
            'height' => array(
                'type' => 'number',
                'step' => 20,
                'min' => 300,
                'max' => 700,
                'std' => 400,
                'label' => __('Height: Between 300px and 700px (Default 500px)', 'blogcorner'),
            ),
            'bg_color_option' => array(
                'type' => 'color',
                'label' => __('Background Color', 'blogcorner'),
                'std' => '#ffffff',
            ),
            'text_color_option' => array(
                'type' => 'color',
                'label' => __('Text Color', 'blogcorner'),
                'std' => '#3A5161',
            ),
            'text_align' => array(
                'type' => 'select',
                'label' => __('Text Alignment', 'blogcorner'),
                'options' => array(
                    'left' => __('Left Align', 'blogcorner'),
                    'center' => __('Center Align', 'blogcorner'),
                    'right' => __('Right Align', 'blogcorner'),
                ),
                'std' => 'left',
            ),
            'bg_image' => array(
                'type' => 'image',
                'label' => __('Background Image', 'blogcorner'),
                'desc' => __('Don\'t upload any image if you do not want to show the background image.', 'blogcorner'),
            ),
            'enable_fixed_bg' => array(
                'type' => 'checkbox',
                'label' => __('Enable Fixed Background Image', 'blogcorner'),
                'std' => true,
            ),
            'bg_overlay_color' => array(
                'type' => 'color',
                'label' => __('Overlay Background Color', 'blogcorner'),
                'std' => '#000000',
            ),
            'overlay_opacity' => array(
                'type' => 'number',
                'step' => 10,
                'min' => 0,
                'max' => 100,
                'std' => 50,
                'label' => __('Overlay Opacity (Default 50%)', 'blogcorner'),
            ),
        );
        parent::__construct();
    }
    /**
     * Output widget.
     *
     * @param array $args
     * @param array $instance
     * @see WP_Widget
     *
     */
    public function widget($args, $instance)
    {
        ob_start();
        $class = '';
        $image_enabled = false;
        if ($instance['bg_image'] && 0 != $instance['bg_image']) {
            $image_enabled = true;
            if ($instance['enable_fixed_bg']) {
                $class .= 'blogcorner-bg-image blogcorner-bg-attachment-fixed ';
            }
        }
        $bg_color_option = "";
        if (isset($instance['bg_color_option'])) {
            $bg_color_option = $instance['bg_color_option'];
        }
        $class .= $instance['style'];
        $class .= ' newsletter-align-'.$instance['text_align'] ;
        $style_text = 'color:' . $instance['text_color_option'] . ';';
        $style_text .= 'background-color:' . $bg_color_option . ';';
        $style_text .= 'min-height:' . $instance['height'] . 'px;';
        echo $args['before_widget'];
        do_action('blogcorner_before_mailchimp');
        ?>
        <div class="blogcorner-mailchimp-widget blogcorner-cover-block <?php echo esc_attr($class); ?>" style="<?php echo esc_attr($style_text); ?>">
            <?php
            if ($image_enabled) {
                $style = 'background-color:' . $instance['bg_overlay_color'] . ';';
                $style .= 'opacity:' . ($instance['overlay_opacity'] / 100) . ';';
                ?>
                <span aria-hidden="true" class="blogcorner-block-overlay" style="<?php echo esc_attr($style); ?>"></span>
                <?php echo wp_get_attachment_image($instance['bg_image'], 'full'); ?>
                <?php
            }
            ?>
            <div class="wrapper blogcorner-mailchimp-inner-wrapper blogcorner-block-inner-wrapper">
                <div class="mailchimp-content-group_1">
                    <?php if ($instance['title']) : ?>
                        <h2 class="entry-title entry-title-large">
                            <?php echo esc_html($instance['title']); ?>
                        </h2>
                    <?php endif; ?>
                    <div class="entry-summary">
                        <?php
                        if ($instance['desc']) {
                            echo wpautop(wp_kses_post($instance['desc']));
                        }
                        ?>
                    </div>
                </div>
                <div class="mailchimp-content-group_2">
                    <footer class="entry-footer">
                        <?php echo do_shortcode($instance['form_shortcode']); ?>
                    </footer>
                </div>
            </div>
        </div>
        <?php
        do_action('blogcorner_after_mailchimp');
        echo $args['after_widget'];
        echo ob_get_clean();
    }
}