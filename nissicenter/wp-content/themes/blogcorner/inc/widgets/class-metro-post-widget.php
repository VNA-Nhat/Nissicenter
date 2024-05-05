<?php
if (!defined('ABSPATH')) {
    exit;
}
class Blogcorner_Metro_Post_Widget extends Blogcorner_Widget_Base
{
    /**
     * Sets up a new widget instance.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->widget_cssclass = 'blogcorner-widget-metro-post';
        $this->widget_description = __("Displays featured posts with an image", 'blogcorner');
        $this->widget_id = 'Blogcorner_Metro_Post_Widget';
        $this->widget_name = __('Blogcorner: Metro Post', 'blogcorner');
        $this->settings = array(
            'title' => array(
                'type' => 'text',
                'label' => __('Title', 'blogcorner'),
            ),
            'layout_style' => array(
                'type' => 'select',
                'label' => __('Style Layout', 'blogcorner'),
                'options' => array(
                    'metro-layout-1' => __('Layout 1', 'blogcorner'),
                    'metro-layout-2' => __('Layout 2', 'blogcorner'),
                    'metro-layout-3' => __('Layout 3', 'blogcorner'),
                    'metro-layout-4' => __('Layout 4', 'blogcorner'),
                    'metro-layout-5' => __('Layout 5', 'blogcorner'),
                ),
                'std' => 'metro-layout-1',
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
            'show_category' => array(
                'type' => 'checkbox',
                'label' => __('Show Category', 'blogcorner'),
                'std' => false,
            ),
            'show_author' => array(
                'type' => 'checkbox',
                'label' => __('Show Author', 'blogcorner'),
                'std' => false,
            ),
            'show_date' => array(
                'type' => 'checkbox',
                'label' => __('Show Date', 'blogcorner'),
                'std' => true,
            ),
            'show_share' => array(
                'type' => 'checkbox',
                'label' => __('Show Share', 'blogcorner'),
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
        $post_count = "";
        switch ($instance['layout_style']) {
            case "metro-layout-1":
                $post_count = "6";
                break;
            case "metro-layout-2":
                $post_count = "5";
                break;
            case "metro-layout-3":
                $post_count = "5";
                break;
            case "metro-layout-4":
                $post_count = "5";
                break;
            case "metro-layout-5":
                $post_count = "3";
                break;
            default:
                $post_count = "";
        }
        $query_args = array(
            'post_status' => 'publish',
            'posts_per_page' => $post_count,
            'no_found_rows' => 1,
            'ignore_sticky_posts' => 1
        );
        if (!empty($instance['category']) && -1 != $instance['category'] && 0 != $instance['category']) {
            $query_args['tax_query'][] = array(
                'taxonomy' => 'category',
                'field' => 'term_id',
                'terms' => $instance['category'],
            );
        }
        return new WP_Query(apply_filters('Blogcorner_Metro_Post_Widget_query_args', $query_args));
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
        echo $args['before_widget'];
        do_action('blogcorner_before_metro_widget');
        $counter = 1;
        if (($posts = $this->get_posts($args, $instance)) && $posts->have_posts()) {
            ?>
            <div class="metro-layout-style <?php echo esc_attr($instance['layout_style']); ?>">
                <?php if ($instance['title']) : ?>
                    <header class="section-header site-section-header">
                        <h2 class="site-section-title">
                            <?php echo esc_html($instance['title']); ?>
                        </h2>
                    </header>
                <?php endif; ?>
                <div class="section-content">
                    <div class="column-row-grid">
                        <?php
                        while ($posts->have_posts()): $posts->the_post();
                            $image_class = "";
                            $title_class = "";
                            switch ($instance['layout_style']) {
                                case "metro-layout-1":
                                    if ($counter == 1) {
                                        $image_class = "featured-media-prime";
                                        $title_class = "entry-title-big";
                                    } elseif ($counter == 6) {
                                        $image_class = "featured-media-prime";
                                        $title_class = "entry-title-small";
                                    } else {
                                        $image_class = "featured-media-medium";
                                        $title_class = "entry-title-small";
                                    }
                                    break;
                                case "metro-layout-2":
                                    if ($counter == 1) {
                                        $image_class = "featured-media-prime";
                                        $title_class = "entry-title-medium";
                                    } elseif ($counter == 5) {
                                        $image_class = "featured-media-prime";
                                        $title_class = "entry-title-small";
                                    } else {
                                        $image_class = "featured-media-medium";
                                        $title_class = "entry-title-small";
                                    }
                                    break;
                                case "metro-layout-3":
                                    if ($counter == 2) {
                                        $image_class = "featured-media-prime";
                                        $title_class = "entry-title-medium";
                                    } else {
                                        $image_class = "featured-media-medium";
                                        $title_class = "entry-title-small";
                                    }
                                    break;
                                case "metro-layout-4":
                                    if ($counter == 5) {
                                        $image_class = "featured-media-prime";
                                        $title_class = "entry-title-big";
                                    } else {
                                        $image_class = "featured-media-medium";
                                        $title_class = "entry-title-small";
                                    }
                                    break;
                                case "metro-layout-5":
                                    $image_class = "featured-media-prime";
                                    $title_class = "entry-title-medium";
                                    break;
                                default:
                                    $image_class = "featured-media-medium";
                                    $title_class = "entry-title-small";
                            }
                            ?>
                            <article id="metro-article-<?php the_ID(); ?>" <?php post_class('theme-article-post theme-article-overlap overlap-has-bg theme-metro-post theme-metro-post-' . $counter . ''); ?>>
                                <?php if (has_post_thumbnail()): ?>
                                    <div class="theme-entry-image image-hover image-overlay image-radius">
                                        <figure class="featured-media <?php echo esc_attr($image_class); ?>">
                                            <a href="<?php the_permalink() ?>">
                                                <?php
                                                the_post_thumbnail('medium_large', array(
                                                    'alt' => the_title_attribute(array(
                                                        'echo' => false,
                                                    )),
                                                ));
                                                ?>
                                            </a>
                                        </figure>
                                    </div>
                                <?php endif; ?>
                                <div class="theme-entry-details">
                                    <?php if ($instance['show_category']) { ?>
                                        <div class="entry-categories">
                                            <?php the_category(' '); ?>
                                        </div><!-- .entry-categories -->
                                    <?php } ?>
                                    <?php the_title('<h3 class="entry-title ' . esc_attr($title_class) . '"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>
                                    <div class="entry-meta">
                                        <?php
                                        if ($instance['show_date']) { ?>
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
                                        <?php } ?>
                                        <?php if ($instance['show_author']) {
                                            blogcorner_posted_by();
                                        } ?>
                                    </div>
                                </div>
                            </article>
                            <?php
                            $counter++;
                        endwhile;
                        wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
            <?php
        }
        do_action('blogcorner_after_metro_widget');
        echo $args['after_widget'];
        echo ob_get_clean();
    }
}