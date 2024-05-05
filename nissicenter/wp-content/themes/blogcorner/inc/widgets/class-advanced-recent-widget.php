<?php
if (!defined('ABSPATH')) {
    exit;
}
class Blogcorner_Advanced_Recent_Widget extends Blogcorner_Widget_Base
{
    /**
     * Sets up a new widget instance.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->widget_cssclass = 'blogcorner-widget-advanced-recent';
        $this->widget_description = __("Displays featured posts with an image", 'blogcorner');
        $this->widget_id = 'Blogcorner_Advanced_Recent_Widget';
        $this->widget_name = __('Blogcorner: Advanced Recent Post', 'blogcorner');
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
            'bg_color_option' => array(
                'type' => 'color',
                'label' => __('Background Color', 'blogcorner'),
                'std' => '#c8ccc7',
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
        return new WP_Query(apply_filters('Blogcorner_Advanced_Recent_Widget_query_args', $query_args));
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

            if (is_active_widget(false, false, $this->id_base, true)) {
                $dynamic_css = 'background-color: '.$instance['bg_color_option'].'; color: '.$instance['text_color_option'].';'; // Replace with your dynamic styles
                $args['before_widget'] = preg_replace('/class="/', 'style="'. $dynamic_css . '" class="', $args['before_widget'], 1);
            }

            do_action('blogcorner_before_advanced_recent_widget');
            echo $args['before_widget'];

            $site_fallback_image = blogcorner_get_option('site_fallback_image');
            ?>
            <?php if ($instance['title'] || !empty($instance['category'])) : ?>
                <header class="section-header site-section-header">
                    <?php if ($instance['title']){?>
                        <h2 class="site-section-title">
                            <?php echo esc_html($instance['title']); ?>
                        </h2>
                    <?php } ?>

                </header>
            <?php endif; ?>
                <div class="column-row">
                    <?php
                    $count = 1;
                    while ($posts->have_posts()): $posts->the_post();
                        ?>
                        <?php if ($count == 1) { ?>
                            <div class="column column-8 column-md-12 column-sm-12 mb-20">
                                <article id="advanced-recent-<?php the_ID(); ?>" <?php post_class('theme-article-post theme-recent-post'); ?>>
                                  <div class="theme-entry-image image-hover image-radius">
                                      <figure class="featured-media-large">
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

                                  <div class="theme-entry-detail">
                                    <?php if ($instance['show_category']) { ?>
                                        <div class="entry-categories mb-15">
                                            <?php the_category(' '); ?>
                                        </div><!-- .entry-categories -->
                                    <?php } ?>
                                    <?php the_title('<h3 class="entry-title entry-title-medium"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>

                                    <?php if ($instance['show_description'] && has_excerpt()): ?>
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
                            </div>
                            <div class="column column-4 column-md-12 column-sm-12">
                        <?php $count++; } else { ?>
                            <article id="advanced-recent-<?php the_ID(); ?>" <?php post_class('theme-article-post theme-recent-post theme-article-overlap'); ?>>
                              <div class="theme-entry-image image-hover image-overlay image-radius">
                                  <figure class="featured-media-medium">
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
                                <?php if ($instance['show_category']) { ?>
                                    <div class="entry-categories mb-15">
                                        <?php the_category(' '); ?>
                                    </div><!-- .entry-categories -->
                                <?php } ?>
                                <?php the_title('<h3 class="entry-title entry-title-small"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>

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
                        <?php } ?>
                        <?php if ($posts->current_post + 1 == $posts->post_count) {
                            echo '</div>';
                        } ?>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                </div>

            <?php
            do_action('blogcorner_after_advanced_recent_widget');
            echo $args['after_widget'];
        }
        echo ob_get_clean();
    }
}