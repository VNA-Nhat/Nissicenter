<?php

/* Theme Widget sidebars. */
require get_template_directory() . '/inc/widgets/widgets.php';
require get_template_directory() . '/inc/widgets/widget-base/widgetbase.php';

require get_template_directory() . '/inc/widgets/class-recent-widget.php';
require get_template_directory() . '/inc/widgets/class-social-widget.php';
require get_template_directory() . '/inc/widgets/class-newsletter-widget.php';
require get_template_directory() . '/inc/widgets/class-author-widget.php';
require get_template_directory() . '/inc/widgets/class-tab-widget.php';
require get_template_directory() . '/inc/widgets/class-cta-widget.php';
require get_template_directory() . '/inc/widgets/class-image-widget.php';
require get_template_directory() . '/inc/widgets/class-advanced-recent-widget.php';
require get_template_directory() . '/inc/widgets/class-metro-post-widget.php';
require get_template_directory() . '/inc/widgets/class-featured-post-widget.php';
require get_template_directory() . '/inc/widgets/class-article-post-widget.php';





/* Register site widgets */
if ( ! function_exists( 'blogcorner_widgets' ) ) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function blogcorner_widgets() {
        register_widget( 'Blogcorner_Recent_Posts' );
        register_widget( 'Blogcorner_Social_Menu' );
        register_widget( 'Blogcorner_Author_Info' );
        register_widget( 'Blogcorner_Mailchimp_Form' );
        register_widget( 'Blogcorner_Tab_Posts' );
        register_widget( 'Blogcorner_Call_To_Action' );
        register_widget( 'Blogcorner_Image_Widget' );
        register_widget( 'Blogcorner_Advanced_Recent_Widget' );
        register_widget( 'Blogcorner_Metro_Post_Widget' );
        register_widget( 'Blogcorner_Featured_Post_Widget' );
        register_widget( 'Blogcorner_Article_Post_Widget' );
    }
endif;
add_action( 'widgets_init', 'blogcorner_widgets' );