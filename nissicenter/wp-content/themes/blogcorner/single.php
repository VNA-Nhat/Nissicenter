<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Blogcorner
 */

get_header();
// Add a main container in case if sidebar is present
$page_layout = blogcorner_get_page_layout();
?>
<?php
global $post;
$blogcorner_post_layout = esc_html(get_post_meta($post->ID, 'blogcorner_post_layout', true));
$blogcorner_header_overlay = esc_html( get_post_meta( $post->ID, 'blogcorner_header_overlay', true ) ); 
if (empty($blogcorner_post_layout)) {
    $blogcorner_post_layout = 'layout-2';
}
$site_fallback_image = blogcorner_get_option('site_fallback_image');
$author_id = get_post_field( 'post_author', get_the_ID() );
if ($blogcorner_post_layout == "layout-2") { ?>
    <div class="single-featured-banner <?php if($blogcorner_header_overlay == 'enable-overlay'){ echo "has-single-banner-overlay";} ?>">
        <div class="featured-banner-media <?php echo (!empty($video)) ? 'featured-banner-image' : 'featured-banner-video'; ?>">
            <div class="theme-entry-image">
                <figure class="featured-media featured-media-large">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php
                        the_post_thumbnail('full', [
                            'alt' => get_the_title(),
                            'class' => 'featured-banner-image',
                        ]);
                        ?>
                    <?php else : ?>
                        <img src="<?php echo esc_url($site_fallback_image); ?>" class="featured-banner-image"
                             alt="<?php echo esc_attr(get_the_title()); ?>">
                    <?php endif; ?>
                </figure>
            </div>
        </div>


        <div class="featured-banner-content">
            <div class="wrapper">

                <header class="entry-header">
                    <?php
                    if (is_singular()) :
                        the_title('<h1 class="entry-title entry-title-large">', '</h1>');
                    else :
                        the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                    endif;

                    if ('post' === get_post_type()) :
                        ?>
                        <div class="entry-meta">
                            <?php $single_post_meta = blogcorner_get_option('single_post_meta'); ?>

                            <?php if (in_array('author', $single_post_meta)) : ?>
                                <span class="entry-meta-item entry-posted-by">
                                    <a class="url fn n" href="<?php echo esc_url(get_author_posts_url($author_id));?>"> <?php echo get_avatar(get_the_author_meta('ID'), 30); ?></a> <?php echo esc_html(get_the_author_meta( 'display_name', $author_id )); ?>
                                </span>
                            <?php endif; ?>

                            <?php if (in_array('date', $single_post_meta)) : ?>
                                <?php blogcorner_posted_on(); ?>
                            <?php endif; ?>
                        </div><!-- .entry-meta -->
                    <?php endif; ?>
                </header><!-- .entry-header -->
            </div>
        </div>
    </div>
<?php } ?>

    <main id="site-content" role="main">
        <div class="wrapper">
            <div id="primary" class="content-area theme-sticky-component">

                <?php
                while (have_posts()) :
                    the_post();

                    get_template_part('template-parts/content', get_post_type());

                    the_post_navigation(
                        array(
                            'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'blogcorner') . '</span> <span class="nav-title">%title</span>',
                            'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'blogcorner') . '</span> <span class="nav-title">%title</span>',
                        )
                    );

                    if ('post' === get_post_type()) :

                        // Get Author Info & related/Author posts
                        $show_author_info = blogcorner_get_option('show_author_info');
                        $show_related_posts = blogcorner_get_option('show_related_posts');
                        $show_author_posts = blogcorner_get_option('show_author_posts');

                        if ($show_author_info):
                            get_template_part('template-parts/single/author-info');
                        endif;

                        if ($show_related_posts):
                            get_template_part('template-parts/single/related-posts');
                        endif;

                        if ($show_author_posts):
                            get_template_part('template-parts/single/author-posts');
                        endif;

                    endif;

                    // If comments are open or we have at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;

                endwhile; // End of the loop.
                ?>

            </div><!-- #primary -->
            <?php
            if ('no-sidebar' != $page_layout && is_singular( 'post' )) {
                get_sidebar();
            }
            ?>
        </div>
    </main>


    <!--sticky-article-navigation starts-->
<?php
/**
 * Navigation
 *
 * @hooked thevoice_post_floating_nav - 10
 * @hooked thevoice_related_posts - 20
 * @hooked thevoice_single_post_navigation - 30
 */

do_action('blogcorner_navigation_action');
?>
<?php
get_footer();
