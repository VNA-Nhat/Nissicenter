<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blogcorner
 */
get_header();
$archive_style = blogcorner_get_option( 'archive_style' );
?>
    <section class="site-section site-base-section">
    <main id="site-content" role="main">
        <div class="wrapper">
            <div id="primary" class="content-area theme-sticky-component">

                <?php if (have_posts()) : ?>

                    <header class="page-header">
                        <?php
                        the_archive_title('<h1 class="page-title">', '</h1>');
                        the_archive_description('<div class="archive-description">', '</div>');
                        ?>
                    </header><!-- .page-header -->

                    <?php

                    echo '<div class="blogcorner-article-wrapper">';
                    /* Start the Loop */
                    while (have_posts()) :
                        the_post();

                        /*
                         * Include the Post-Type-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                         */
                        get_template_part('template-parts/content', $archive_style);

                    endwhile;

                    echo '</div><!-- .blogcorner-article-wrapper -->';

                    get_template_part('template-parts/pagination');

                else :

                    get_template_part('template-parts/content', 'none');

                endif;
                ?>

            </div> <!-- #primary -->

        </div>
    </main> <!-- #site-content-->
    </section>
<?php
get_footer();