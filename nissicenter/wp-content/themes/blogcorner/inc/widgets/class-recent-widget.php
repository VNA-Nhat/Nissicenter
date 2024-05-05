<?php
if (!defined('ABSPATH')) {
    exit;
}

class Blogcorner_Recent_Posts extends Blogcorner_Widget_Base
{
    /**
     * Sets up a new widget instance.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->widget_cssclass = 'blogcorner-widget-recent-post';
        $this->widget_description = __("Displays recent posts with an image", 'blogcorner');
        $this->widget_id = 'blogcorner_recent_posts';
        $this->widget_name = __('Blogcorner: Recent Posts', 'blogcorner');
        $this->settings = array(
            'title' => array(
                'type' => 'text',
                'label' => __('Title', 'blogcorner'),
            ),
            'category' => array(
                'type' => 'dropdown-taxonomies',
                'label' => __('Select Category', 'blogcorner'),
                'desc' => __('Leave empty if you don\'t want the posts to be category specific', 'blogcorner'),
                'args' => array(
                    'taxonomy' => 'category',
                    'class' => 'widefat',
                    'hierarchical' => true,
                    'show_count' => 1,
                    'show_option_all' => __('&mdash; Select &mdash;', 'blogcorner'),
                ),
            ),
            'title_size' => array(
                'type' => 'select',
                'label' => __('Title Size', 'blogcorner'),
                'options' => array(
                    'entry-title-medium' => __('Medium', 'blogcorner'),
                    'entry-title-small' => __('Small', 'blogcorner'),
                ),
                'std' => 'entry-title-small',
            ),
            'number' => array(
                'type' => 'number',
                'step' => 1,
                'min' => 1,
                'max' => '',
                'std' => 5,
                'label' => __('Number of posts to show', 'blogcorner'),
            ),
            'orderby' => array(
                'type' => 'select',
                'std' => 'date',
                'label' => __('Order by', 'blogcorner'),
                'options' => array(
                    'date' => __('Date', 'blogcorner'),
                    'ID' => __('ID', 'blogcorner'),
                    'title' => __('Title', 'blogcorner'),
                    'rand' => __('Random', 'blogcorner'),
                ),
            ),
            'order' => array(
                'type' => 'select',
                'std' => 'desc',
                'label' => __('Order', 'blogcorner'),
                'options' => array(
                    'asc' => __('ASC', 'blogcorner'),
                    'desc' => __('DESC', 'blogcorner'),
                ),
            ),
            'show_date' => array(
                'type' => 'checkbox',
                'label' => __('Show Date', 'blogcorner'),
                'std' => true,
            ),
            'date_format' => array(
                'type' => 'select',
                'label' => __('Date Format', 'blogcorner'),
                'options' => array(
                    'format_1' => __('Format 1', 'blogcorner'),
                    'format_2' => __('Format 2', 'blogcorner'),
                ),
                'std' => 'format_2',
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
     * Query the posts and return them.
     * @param array $args
     * @param array $instance
     * @return WP_Query
     */
    public function get_posts($args, $instance)
    {
        $number = !empty($instance['number']) ? absint($instance['number']) : $this->settings['number']['std'];
        $orderby = !empty($instance['orderby']) ? sanitize_text_field($instance['orderby']) : $this->settings['orderby']['std'];
        $order = !empty($instance['order']) ? sanitize_text_field($instance['order']) : $this->settings['order']['std'];
        $query_args = array(
            'posts_per_page' => $number,
            'post_status' => 'publish',
            'no_found_rows' => 1,
            'orderby' => $orderby,
            'order' => $order,
            'ignore_sticky_posts' => 1
        );
        if (!empty($instance['category']) && -1 != $instance['category'] && 0 != $instance['category']) {
            $query_args['tax_query'][] = array(
                'taxonomy' => 'category',
                'field' => 'term_id',
                'terms' => $instance['category'],
            );
        }
        return new WP_Query(apply_filters('blogcorner_recent_posts_query_args', $query_args));
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
        if (($posts = $this->get_posts($args, $instance)) && $posts->have_posts()) {
            $this->widget_start($args, $instance);
            do_action('blogcorner_before_recent_posts_with_image');
            $style = $instance['style'];
            ?>
            <div class="theme-recent-widget theme-widget-list <?php echo esc_attr($style); ?>">
                <?php
                while ($posts->have_posts()): $posts->the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('theme-article-post theme-widget-article'); ?>>
                        <?php
                        if (has_post_thumbnail()) {
                            ?>
                            <div class="theme-entry-image">
                                <figure class="featured-media">
                                    <a href="<?php the_permalink() ?>">
                                        <?php
                                        the_post_thumbnail('thumbnail', array(
                                            'alt' => the_title_attribute(array(
                                                'echo' => false,
                                            )),
                                        ));
                                        ?>
                                    </a>

                                </figure>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="theme-entry-details">
                            <?php the_title( '<h3 class="entry-title ' . $instance['title_size'] . '"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
                            <?php
                            if ($instance['show_date']) { ?>
                                <div class="entry-meta">
                                <span class="entry-meta-item entry-posted-on">
                                        <?php
                                        $date_format = $instance['date_format'];
                                        if ('format_1' == $date_format) {
                                            echo esc_html(human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ' . __('ago', 'blogcorner'));
                                        } else {
                                            echo esc_html(get_the_date());
                                        }
                                        ?>
                                </span>
                                </div>
                            <?php } ?>
                        </div>
                    </article>
                <?php endwhile;
                wp_reset_postdata(); ?>
            </div>
            <?php
            do_action('blogcorner_after_recent_posts_with_image');
            $this->widget_end($args);
        }
        echo ob_get_clean();
    }
}