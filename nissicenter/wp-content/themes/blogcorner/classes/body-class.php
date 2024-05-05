<?php
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function blogcorner_body_classes( $classes ) {
    global $post;
    $post_type = "";
    if (!empty($post)) {
        $post_type = get_post_type($post->ID);
    }
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

    $archive_style = blogcorner_get_option('archive_style');
    $classes[] = $archive_style;

    $classes[] = ' blogcorner-header_style_1';

    if ($post_type == 'product') {
        if ( ! is_active_sidebar( 'shop-sidebar' ) ) {
            $classes[] = 'no-sidebar';
        } else {
            $page_layout = blogcorner_get_page_layout();
            if('no-sidebar' != $page_layout ){
                $classes[] = 'has-sidebar '.esc_attr($page_layout);
            }
        }
    } else {
        if (is_singular( 'post' )) { 
        	$page_layout = blogcorner_get_page_layout();
            if('no-sidebar' != $page_layout ){
                $classes[] = 'has-sidebar '.esc_attr($page_layout);
            }else{

                $classes[] = esc_attr($page_layout);
            }
        }
    }


	return $classes;
}
add_filter( 'body_class', 'blogcorner_body_classes' );
