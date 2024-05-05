<?php
/**
 * Displays Featured Section
 *
 * @package Blogcorner
 */
$enable_featured_post = blogcorner_get_option('enable_featured_post');
$featured_post_section_title = blogcorner_get_option('featured_post_section_title');
$featured_post_cat = blogcorner_get_option('featured_post_cat');
$enable_featured_post_description = blogcorner_get_option('enable_featured_post_description');
$enable_featured_post_cat_meta = blogcorner_get_option('enable_featured_post_cat_meta');
$enable_featured_post_author_meta = blogcorner_get_option('enable_featured_post_author_meta');
$enable_featured_post_date_meta = blogcorner_get_option('enable_featured_post_date_meta');
if ($enable_featured_post) {
?>
<section class="site-section theme-article-block">
  <div class="section-header site-section-header">
    <h2 class="site-section-title"> <?php echo esc_html($featured_post_section_title); ?></h2>
  </div>

  <div class="column-row">
    <?php
    $count = 1;
    $featured_postpost_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 3, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($featured_post_cat)));
    if ($featured_postpost_query->have_posts()): ?>
        <?php while ($featured_postpost_query->have_posts()): $featured_postpost_query->the_post(); ?>

            <div class="column <?php if ($count %2 == 0) { echo "column-6"; } else {echo "column-3";} ?>">
              <article id="<?php the_ID(); ?>" <?php post_class('theme-article-post'); ?>>

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
                      <?php if ($enable_featured_post_cat_meta) { ?>
                          <span class="entry-categories">
                              <?php the_category(' '); ?>
                          </span>
                      <?php } ?>
                  </div>

                  <?php the_title('<h3 class="entry-title entry-title-small line-clamp line-clamp-3 mb-15"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>

                  <?php
                  if ($enable_featured_post_description && has_excerpt()): ?>
                      <div class="entry-content">
                          <?php the_excerpt(); ?>
                      </div>
                  <?php elseif ($enable_featured_post_description): ?>
                      <div class="entry-content">
                        <p>
                          <?php echo esc_html(wp_trim_words(get_the_content(), 20, '...')); ?>
                        </p>
                      </div>
                  <?php endif; ?>

                  <div class="entry-meta mb-20">
                      <?php if ($enable_featured_post_date_meta) {
                          blogcorner_posted_on();
                      } ?>
                      <?php if ($enable_featured_post_author_meta) {
                          blogcorner_posted_by();
                      } ?>
                  </div>
                </div>
              </article>
            </div>
        <?php
        $count++;
        endwhile;
        wp_reset_postdata();
        ?>
    <?php endif; ?>
  </div>
</section>

<?php }