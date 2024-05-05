<?php
/**
 * Displays newsletter Section
 *
 * @package Blogcorner
 */
$enable_newsletter_section = blogcorner_get_option('enable_newsletter_section');
$newsletter_section_title = blogcorner_get_option('newsletter_section_title');
$newsletter_description = blogcorner_get_option('newsletter_description');
$newsletter_shortcode = blogcorner_get_option('newsletter_shortcode');
if ($enable_newsletter_section) {
    ?>

    <section class="site-section theme-newsletter">
      <div class="wrapper">
        <div class="newsletter-content">
          <div class="column-row column-row-center">
            <div class="column column-5 column-md-12 column-sm-12 mb-md-40 mb-sm-20">
              <h2 class="entry-title entry-title-large mb-15"><?php echo esc_html($newsletter_section_title); ?></h2>
              <p class="newsletter-description m-0">
                <?php echo esc_html($newsletter_description); ?>
              </p>
            </div>
            <div class="column column-1"></div>
            <div class="column column-6 column-md-12 column-sm-12">
               <?php echo do_shortcode($newsletter_shortcode); ?>
            </div>
          </div>
        </div>
      </div>
    </section>
<?php }
