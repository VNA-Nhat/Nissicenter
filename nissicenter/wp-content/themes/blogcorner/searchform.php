<?php
/**
 * Search Template for search form
 *
 * @package Blogcorner
 * @since 1.0.0
 */
?>
<form role="search" method="get" class="search-form-default" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label>
        <input type="search" class="search-field-default" placeholder="<?php esc_attr_e('Search videos, articles, and more','blogcorner'); ?>" value="<?php echo esc_attr( get_search_query() ) ?>" name="s">
        <?php blogcorner_theme_svg('search' ); ?>
    </label>
</form>