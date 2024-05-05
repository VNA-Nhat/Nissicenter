<?php
/**
 * Displays Category Section
 *
 * @package Blogcorner
 */
$enable_category_section = blogcorner_get_option('enable_category_section');
$number_of_category = blogcorner_get_option('number_of_category');
$category_post_title = blogcorner_get_option('category_post_title');
$category_based_class = "";
if ($enable_category_section) {
    ?>
    <section class="site-section site-categories-section">
        <?php if (!empty($category_post_title)) { ?>
            <div class="wrapper">
                <header class="section-header site-section-header">
                    <?php if (!empty($category_post_title)){ ?>
                        <h2 class="site-section-title"><?php echo esc_html($category_post_title); ?> </h2>
                    <?php } ?>
                </header>
            </div>
        <?php } ?>

        <div class="wrapper">
            <div class="column-row">
                <?php
                switch ($number_of_category) {
                  case "2":
                    $category_based_class = "column-6 column-xs-12";
                    break;
                  case "3":
                    $category_based_class = "column-4 column-md-6 mb-md-20 column-sm-6 mb-sm-20 column-xs-12";
                    break;
                  case "4":
                    $category_based_class = "column-3 column-md-6 mb-md-20 column-sm-6 mb-sm-20 column-xs-12";
                    break;
                  default:
                    $category_based_class = "";
                }
                for ($x = 1; $x <= $number_of_category; $x++) {
                    $c_category = get_theme_mod('select_featured_cat_' . $x);
                    if ($c_category) {
                        $cat_obj = get_category_by_slug($c_category);
                        $cat_name = isset($cat_obj->name) ? $cat_obj->name : '';
                        $cat_id = isset($cat_obj->term_id) ? $cat_obj->term_id : '';
                        $count = isset($cat_obj->count) ? $cat_obj->count : '';
                        $cat_link = get_category_link($cat_id);
                        $twp_term_image = get_term_meta($cat_id, 'twp-term-featured-image', true); ?>
                        <div class="column <?php echo esc_attr($category_based_class); ?>">
                            <article class="site-categories-panel">
                                <?php if (!empty($twp_term_image)) { ?>
                                    <div class="theme-entry-image image-hover image-radius">
                                        <figure class="featured-media featured-media-small">
                                            <a href="<?php echo esc_url($cat_link); ?>">
                                                <img src="<?php echo esc_url($twp_term_image); ?>">
                                            </a>
                                        </figure>
                                    </div>
                                <?php } ?>

                                <div class="site-categories-detail">
                                  <h2 class="entry-title entry-title-small">
                                      <?php
                                      if ($cat_name) { ?>
                                          <a href="<?php echo esc_url($cat_link); ?>">
                                              <?php echo esc_html($cat_name); ?>
                                          </a>
                                      <?php } ?>
                                  </h2>
  
                                  <div class="entry-count">
                                      <a href="<?php echo esc_url($cat_link); ?>">
                                          <?php if ($count): ?>
                                              <span class="entry-count-label"><?php echo esc_html($count); ?></span> Posts
                                          <?php endif; ?>
                                      </a>
                                  </div>
                                </div>
                            </article>
                        </div>
                        <?php
                    }
                } ?>
            </div>
        </div>
    </section>
<?php }