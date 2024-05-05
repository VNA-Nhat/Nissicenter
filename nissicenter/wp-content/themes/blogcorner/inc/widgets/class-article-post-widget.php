<?php
if (!defined('ABSPATH')) {
    exit;
}

class Blogcorner_Article_Post_Widget extends Blogcorner_Widget_Base
{
    /**
     * Sets up a new widget instance.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->widget_cssclass = 'blogcorner-widget-article-post';
        $this->widget_description = __("Displays article posts with an image", 'blogcorner');
        $this->widget_id = 'Blogcorner_Article_Post_Widget';
        $this->widget_name = __('Blogcorner: Article Post Widget', 'blogcorner');
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
            'show_category' => array(
                'type' => 'checkbox',
                'label' => __('Show Category', 'blogcorner'),
                'std' => false,
            ),
            'show_description' => array(
                'type' => 'checkbox',
                'label' => __('Show Description', 'blogcorner'),
                'std' => true,
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
            'text_color_option' => array(
                'type' => 'color',
                'label' => __('Text Color', 'blogcorner'),
                'std' => '#000',
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
        $query_args = array(
            'posts_per_page' => 3,
            'post_status' => 'publish',
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
        return new WP_Query(apply_filters('Blogcorner_Article_Post_Widget_query_args', $query_args));
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
            echo $args['before_widget'];
            do_action('blogcorner_before_carousel_widget');
            $site_fallback_image = blogcorner_get_option('site_fallback_image');
            ?>
            <section class="theme-article-block">
                <?php if ($instance['title']){?>
              <div class="section-header site-section-header">
                <h2 class="site-section-title"> <?php echo esc_html($instance['title']); ?></h2>
              </div>
              <?php } ?>
              <div class="column-row">
                <?php
                $count = 1; ?>
                    <?php while ($posts->have_posts()): $posts->the_post(); ?>
                        <div class="column <?php if ($count %2 == 0) { echo "column-6 column-sm-12"; } else {echo "column-3 column-sm-12";} ?>">
                          <article id="<?php the_ID(); ?>" <?php post_class('theme-article-post mb-sm-40'); ?>>

                            <div class="theme-entry-image image-hover image-radius mb-15">
                              <figure class="featured-media featured-media-big">
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

                            <div class="theme-entry-details">
                              <div class="entry-meta mb-15">
                                <?php if ($instance['show_category']) { ?>
                                    <div class="entry-categories">
                                        <?php the_category(' '); ?>
                                    </div><!-- .entry-categories -->
                                <?php } ?>
                              </div>

                              <?php the_title('<h3 class="entry-title entry-title-medium line-clamp line-clamp-3 mb-15"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>

                              <?php
                              if ($instance['show_description']  && has_excerpt()): ?>
                                  <div class="entry-content">
                                      <?php the_excerpt(); ?>
                                  </div>
                              <?php elseif ($instance['show_description']): ?>
                                  <div class="entry-content">
                                    <p>
                                      <?php echo esc_html(wp_trim_words(get_the_content(), 20, '...')); ?>
                                    </p>
                                  </div>
                              <?php endif; ?>

                              <div class="entry-meta mb-20">
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
                        </div>
                    <?php
                    $count++;
                    endwhile;
                    ?>
              </div>
            </section>

            <?php
            do_action('blogcorner_after_carousel_widget');
            echo $args['after_widget'];
        }
        echo ob_get_clean();
    }
}