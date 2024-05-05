<?php
/**
* Sidebar Metabox.
*
* @package Blogcorner
*/
if( !function_exists( 'blogcorner_sanitize_sidebar_option_meta' ) ) :

    // Sidebar Option Sanitize.
    function blogcorner_sanitize_sidebar_option_meta( $input ){

        $metabox_options = array('global-sidebar','left-sidebar','right-sidebar','no-sidebar' );
        if( in_array( $input,$metabox_options ) ){

            return $input;

        }else{

            return '';

        }
    }

endif;

if( !function_exists('blogcorner_sanitize_meta_pagination') ):

    /** Sanitize Enable Disable Checkbox **/
    function blogcorner_sanitize_meta_pagination( $input ) {

        $valid_keys = array('global-layout','no-navigation','norma-navigation','ajax-next-post-load');
        if ( in_array( $input , $valid_keys ) ) {
            return $input;
        }
        return '';

    }

endif;

if( !function_exists( 'blogcorner_sanitize_post_layout_option_meta' ) ) :

    // Sidebar Option Sanitize.
    function blogcorner_sanitize_post_layout_option_meta( $input ){

        $metabox_options = array( 'global-layout','layout-1','layout-2' );
        if( in_array( $input,$metabox_options ) ){

            return $input;

        }else{

            return '';

        }

    }

endif;


if( !function_exists( 'blogcorner_sanitize_header_overlay_option_meta' ) ) :

    // Sidebar Option Sanitize.
    function blogcorner_sanitize_header_overlay_option_meta( $input ){

        $metabox_options = array( 'global-layout','enable-overlay' );
        if( in_array( $input,$metabox_options ) ){

            return $input;

        }else{

            return '';

        }

    }

endif;

add_action( 'add_meta_boxes', 'blogcorner_metabox' );

if( ! function_exists( 'blogcorner_metabox' ) ):


    function  blogcorner_metabox() {
        
        add_meta_box(
            'theme-custom-metabox',
            esc_html__( 'Layout Settings', 'blogcorner' ),
            'blogcorner_post_metafield_callback',
            'post', 
            'normal', 
            'high'
        );
        add_meta_box(
            'theme-custom-metabox',
            esc_html__( 'Layout Settings', 'blogcorner' ),
            'blogcorner_post_metafield_callback',
            'page',
            'normal', 
            'high'
        ); 
    }

endif;

$blogcorner_page_layout_options = array(
    'layout-1' => esc_html__( 'Simple Layout', 'blogcorner' ),
    'layout-2' => esc_html__( 'Banner Layout', 'blogcorner' ),
);

$blogcorner_post_sidebar_fields = array(
        'global-sidebar' => array(
                    'id'        => 'post-global-sidebar',
                    'value' => 'global-sidebar',
                    'label' => esc_html__( 'Global sidebar', 'blogcorner' ),
                ),
    'right-sidebar' => array(
                    'id'        => 'post-left-sidebar',
                    'value' => 'right-sidebar',
                    'label' => esc_html__( 'Right sidebar', 'blogcorner' ),
                ),
    'left-sidebar' => array(
                    'id'        => 'post-right-sidebar',
                    'value'     => 'left-sidebar',
                    'label'     => esc_html__( 'Left sidebar', 'blogcorner' ),
                ),
    'no-sidebar' => array(
                    'id'        => 'post-no-sidebar',
                    'value'     => 'no-sidebar',
                    'label'     => esc_html__( 'No sidebar', 'blogcorner' ),
                ),
);

$blogcorner_post_layout_options = array(
    'layout-1' => esc_html__( 'Simple Layout', 'blogcorner' ),
    'layout-2' => esc_html__( 'Banner Layout', 'blogcorner' ),
);

$blogcorner_header_overlay_options = array(
    'global-layout' => esc_html__( 'Global Layout', 'blogcorner' ),
    'enable-overlay' => esc_html__( 'Enable Header Overlay', 'blogcorner' ),
);


/**
 * Callback function for post option.
*/
if( ! function_exists( 'blogcorner_post_metafield_callback' ) ):
    
    function blogcorner_post_metafield_callback() {
        global $post, $blogcorner_post_sidebar_fields, $blogcorner_post_layout_options,  $blogcorner_page_layout_options, $blogcorner_header_overlay_options;
        $post_type = get_post_type($post->ID);
        wp_nonce_field( basename( __FILE__ ), 'blogcorner_post_meta_nonce' ); ?>
        
        <div class="metabox-main-block">

            <div class="metabox-navbar">
                <ul>

                    <li>
                        <a id="metabox-navbar-appearance"  class="metabox-navbar-active" href="javascript:void(0)">

                            <?php esc_html_e('Appearance Settings', 'blogcorner'); ?>

                        </a>
                    </li>

                    <?php if ($post_type != 'page') { ?>
                        <li>
                            <a id="metabox-navbar-general" href="javascript:void(0)">

                                <?php esc_html_e('General Settings', 'blogcorner'); ?>

                            </a>
                        </li>
                    <?php } ?>


                    <?php if( $post_type == 'post' && class_exists('Booster_Extension_Class') ): ?>
                        <li>
                            <a id="twp-tab-booster" href="javascript:void(0)">

                                <?php esc_html_e('Booster Extension Settings', 'blogcorner'); ?>

                            </a>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>

            <div class="twp-tab-content">

                <div id="metabox-navbar-general-content" class="metabox-content-wrap">

                    <div class="metabox-opt-panel">

                        <h3 class="meta-opt-title"><?php esc_html_e('Sidebar Layout','blogcorner'); ?></h3>

                        <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                            <?php
                            $blogcorner_post_sidebar = esc_html( get_post_meta( $post->ID, 'blogcorner_post_sidebar_option', true ) ); 
                            if( $blogcorner_post_sidebar == '' ){ $blogcorner_post_sidebar = 'global-sidebar'; }

                            foreach ( $blogcorner_post_sidebar_fields as $blogcorner_post_sidebar_field) { ?>

                                <label class="description">

                                    <input type="radio" name="blogcorner_post_sidebar_option" value="<?php echo esc_attr( $blogcorner_post_sidebar_field['value'] ); ?>" <?php if( $blogcorner_post_sidebar_field['value'] == $blogcorner_post_sidebar ){ echo "checked='checked'";} if( empty( $blogcorner_post_sidebar ) && $blogcorner_post_sidebar_field['value']=='right-sidebar' ){ echo "checked='checked'"; } ?>/>&nbsp;<?php echo esc_html( $blogcorner_post_sidebar_field['label'] ); ?>

                                </label>

                            <?php } ?>

                        </div>

                    </div>

                </div>


                <div id="metabox-navbar-appearance-content" class="metabox-content-wrap metabox-content-wrap-active">

                    <?php if( $post_type == 'page' ): ?>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Banner Layout','blogcorner'); ?></h3>

                            <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                                <?php
                                $blogcorner_page_layout = esc_html( get_post_meta( $post->ID, 'blogcorner_page_layout', true ) ); 
                                if( $blogcorner_page_layout == '' ){ $blogcorner_page_layout = 'layout-2'; }

                                foreach ( $blogcorner_page_layout_options as $key => $blogcorner_page_layout_option) { ?>

                                    <label class="description">
                                        <input type="radio" name="blogcorner_page_layout" value="<?php echo esc_attr( $key ); ?>" <?php if( $key == $blogcorner_page_layout ){ echo "checked='checked'";} ?>/>&nbsp;<?php echo esc_html( $blogcorner_page_layout_option ); ?>
                                    </label>

                                <?php } ?>

                            </div>

                        </div>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Header Overlay','blogcorner'); ?></h3>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                <?php
                                $blogcorner_ed_header_overlay = esc_attr( get_post_meta( $post->ID, 'blogcorner_ed_header_overlay', true ) ); ?>

                                <input type="checkbox" id="blogcorner-header-overlay" name="blogcorner_ed_header_overlay" value="1" <?php if( $blogcorner_ed_header_overlay ){ echo "checked='checked'";} ?>/>

                                <label for="blogcorner-header-overlay"><?php esc_html_e( 'Enable Header Overlay','blogcorner' ); ?></label>

                            </div>

                        </div>

                    <?php endif; ?>

                    <?php if( $post_type == 'post' ): ?>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Header Title Layout','blogcorner'); ?></h3>

                            <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                                <?php
                                $blogcorner_post_layout = esc_html( get_post_meta( $post->ID, 'blogcorner_post_layout', true ) ); 
                                if( $blogcorner_post_layout == '' ){ $blogcorner_post_layout = 'layout-2'; }

                                foreach ( $blogcorner_post_layout_options as $key => $blogcorner_post_layout_option) { ?>

                                    <label class="description">
                                        <input type="radio" name="blogcorner_post_layout" value="<?php echo esc_attr( $key ); ?>" <?php if( $key == $blogcorner_post_layout ){ echo "checked='checked'";} ?>/>&nbsp;<?php echo esc_html( $blogcorner_post_layout_option ); ?>
                                    </label>

                                <?php } ?>

                            </div>

                        </div>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Header Overlay','blogcorner'); ?></h3>

                            <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                                <?php
                                $blogcorner_header_overlay = esc_html( get_post_meta( $post->ID, 'blogcorner_header_overlay', true ) ); 
                                if( $blogcorner_header_overlay == '' ){ $blogcorner_header_overlay = 'global-layout'; }

                                foreach ( $blogcorner_header_overlay_options as $key => $blogcorner_header_overlay_option) { ?>

                                    <label class="description">
                                        <input type="radio" name="blogcorner_header_overlay" value="<?php echo esc_attr( $key ); ?>" <?php if( $key == $blogcorner_header_overlay ){ echo "checked='checked'";} ?>/>&nbsp;<?php echo esc_html( $blogcorner_header_overlay_option ); ?>
                                    </label>

                                <?php } ?>

                            </div>

                        </div>

                    <?php endif; ?>

                </div>

                <?php if( $post_type == 'post' && class_exists('Booster_Extension_Class') ):

                    
                    $blogcorner_ed_post_views = esc_html( get_post_meta( $post->ID, 'blogcorner_ed_post_views', true ) );
                    $blogcorner_ed_post_like_dislike = esc_html( get_post_meta( $post->ID, 'blogcorner_ed_post_like_dislike', true ) );
                    $blogcorner_ed_post_author_box = esc_html( get_post_meta( $post->ID, 'blogcorner_ed_post_author_box', true ) );
                    $blogcorner_ed_post_social_share = esc_html( get_post_meta( $post->ID, 'blogcorner_ed_post_social_share', true ) );
                    $blogcorner_ed_post_reaction = esc_html( get_post_meta( $post->ID, 'blogcorner_ed_post_reaction', true ) );
                    $blogcorner_ed_post_rating = esc_html( get_post_meta( $post->ID, 'blogcorner_ed_post_rating', true ) );
                    ?>

                    <div id="twp-tab-booster-content" class="metabox-content-wrap">

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Booster Extension Plugin Content','blogcorner'); ?></h3>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="blogcorner-ed-post-views" name="blogcorner_ed_post_views" value="1" <?php if( $blogcorner_ed_post_views ){ echo "checked='checked'";} ?>/>
                                    <label for="blogcorner-ed-post-views"><?php esc_html_e( 'Disable Post Views','blogcorner' ); ?></label>

                            </div>


                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="blogcorner-ed-post-like-dislike" name="blogcorner_ed_post_like_dislike" value="1" <?php if( $blogcorner_ed_post_like_dislike ){ echo "checked='checked'";} ?>/>
                                    <label for="blogcorner-ed-post-like-dislike"><?php esc_html_e( 'Disable Post Like Dislike','blogcorner' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="blogcorner-ed-post-author-box" name="blogcorner_ed_post_author_box" value="1" <?php if( $blogcorner_ed_post_author_box ){ echo "checked='checked'";} ?>/>
                                    <label for="blogcorner-ed-post-author-box"><?php esc_html_e( 'Disable Post Author Box','blogcorner' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="blogcorner-ed-post-social-share" name="blogcorner_ed_post_social_share" value="1" <?php if( $blogcorner_ed_post_social_share ){ echo "checked='checked'";} ?>/>
                                    <label for="blogcorner-ed-post-social-share"><?php esc_html_e( 'Disable Post Social Share','blogcorner' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="blogcorner-ed-post-reaction" name="blogcorner_ed_post_reaction" value="1" <?php if( $blogcorner_ed_post_reaction ){ echo "checked='checked'";} ?>/>
                                    <label for="blogcorner-ed-post-reaction"><?php esc_html_e( 'Disable Post Reaction','blogcorner' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="blogcorner-ed-post-rating" name="blogcorner_ed_post_rating" value="1" <?php if( $blogcorner_ed_post_rating ){ echo "checked='checked'";} ?>/>
                                    <label for="blogcorner-ed-post-rating"><?php esc_html_e( 'Disable Post Rating','blogcorner' ); ?></label>

                            </div>

                        </div>

                    </div>

                <?php endif; ?>
                
            </div>

        </div>  
            
    <?php }
endif;

// Save metabox value.
add_action( 'save_post', 'blogcorner_save_post_meta' );

if( ! function_exists( 'blogcorner_save_post_meta' ) ):

    function blogcorner_save_post_meta( $post_id ) {

        global $post, $blogcorner_post_sidebar_fields, $blogcorner_post_layout_options, $blogcorner_header_overlay_options,  $blogcorner_page_layout_options;

        if ( !isset( $_POST[ 'blogcorner_post_meta_nonce' ] ) || !wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['blogcorner_post_meta_nonce'] ) ), basename( __FILE__ ) ) ){

            return;

        }

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){

            return;

        }
            
        if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {  

            if ( !current_user_can( 'edit_page', $post_id ) ){  

                return $post_id;

            }

        }elseif( !current_user_can( 'edit_post', $post_id ) ) {

            return $post_id;

        }


        foreach ( $blogcorner_post_sidebar_fields as $blogcorner_post_sidebar_field ) {  
            

                $old = esc_html( get_post_meta( $post_id, 'blogcorner_post_sidebar_option', true ) ); 
                $new = isset( $_POST['blogcorner_post_sidebar_option'] ) ? blogcorner_sanitize_sidebar_option_meta( wp_unslash( $_POST['blogcorner_post_sidebar_option'] ) ) : '';

                if ( $new && $new != $old ){

                    update_post_meta ( $post_id, 'blogcorner_post_sidebar_option', $new );

                }elseif( '' == $new && $old ) {

                    delete_post_meta( $post_id,'blogcorner_post_sidebar_option', $old );

                }

            
        }

        $twp_disable_ajax_load_next_post_old = esc_html( get_post_meta( $post_id, 'twp_disable_ajax_load_next_post', true ) ); 
        $twp_disable_ajax_load_next_post_new = isset( $_POST['twp_disable_ajax_load_next_post'] ) ? blogcorner_sanitize_meta_pagination( wp_unslash( $_POST['twp_disable_ajax_load_next_post'] ) ) : '';

        if( $twp_disable_ajax_load_next_post_new && $twp_disable_ajax_load_next_post_new != $twp_disable_ajax_load_next_post_old ){

            update_post_meta ( $post_id, 'twp_disable_ajax_load_next_post', $twp_disable_ajax_load_next_post_new );

        }elseif( '' == $twp_disable_ajax_load_next_post_new && $twp_disable_ajax_load_next_post_old ) {

            delete_post_meta( $post_id,'twp_disable_ajax_load_next_post', $twp_disable_ajax_load_next_post_old );

        }


        foreach ( $blogcorner_post_layout_options as $blogcorner_post_layout_option ) {  
            
            $blogcorner_post_layout_old = esc_html( get_post_meta( $post_id, 'blogcorner_post_layout', true ) ); 
            $blogcorner_post_layout_new = isset( $_POST['blogcorner_post_layout'] ) ? blogcorner_sanitize_post_layout_option_meta( wp_unslash( $_POST['blogcorner_post_layout'] ) ) : '';

            if ( $blogcorner_post_layout_new && $blogcorner_post_layout_new != $blogcorner_post_layout_old ){

                update_post_meta ( $post_id, 'blogcorner_post_layout', $blogcorner_post_layout_new );

            }elseif( '' == $blogcorner_post_layout_new && $blogcorner_post_layout_old ) {

                delete_post_meta( $post_id,'blogcorner_post_layout', $blogcorner_post_layout_old );

            }
            
        }



        foreach ( $blogcorner_header_overlay_options as $blogcorner_header_overlay_option ) {  
            
            $blogcorner_header_overlay_old = esc_html( get_post_meta( $post_id, 'blogcorner_header_overlay', true ) ); 
            $blogcorner_header_overlay_new = isset( $_POST['blogcorner_header_overlay'] ) ? blogcorner_sanitize_header_overlay_option_meta( wp_unslash( $_POST['blogcorner_header_overlay'] ) ) : '';

            if ( $blogcorner_header_overlay_new && $blogcorner_header_overlay_new != $blogcorner_header_overlay_old ){

                update_post_meta ( $post_id, 'blogcorner_header_overlay', $blogcorner_header_overlay_new );

            }elseif( '' == $blogcorner_header_overlay_new && $blogcorner_header_overlay_old ) {

                delete_post_meta( $post_id,'blogcorner_header_overlay', $blogcorner_header_overlay_old );

            }
            
        }


        $blogcorner_ed_post_views_old = esc_html( get_post_meta( $post_id, 'blogcorner_ed_post_views', true ) ); 
        $blogcorner_ed_post_views_new = isset( $_POST['blogcorner_ed_post_views'] ) ? absint( wp_unslash( $_POST['blogcorner_ed_post_views'] ) ) : '';

        if ( $blogcorner_ed_post_views_new && $blogcorner_ed_post_views_new != $blogcorner_ed_post_views_old ){

            update_post_meta ( $post_id, 'blogcorner_ed_post_views', $blogcorner_ed_post_views_new );

        }elseif( '' == $blogcorner_ed_post_views_new && $blogcorner_ed_post_views_old ) {

            delete_post_meta( $post_id,'blogcorner_ed_post_views', $blogcorner_ed_post_views_old );

        }





        $blogcorner_ed_post_like_dislike_old = esc_html( get_post_meta( $post_id, 'blogcorner_ed_post_like_dislike', true ) ); 
        $blogcorner_ed_post_like_dislike_new = isset( $_POST['blogcorner_ed_post_like_dislike'] ) ? absint( wp_unslash( $_POST['blogcorner_ed_post_like_dislike'] ) ) : '';

        if ( $blogcorner_ed_post_like_dislike_new && $blogcorner_ed_post_like_dislike_new != $blogcorner_ed_post_like_dislike_old ){

            update_post_meta ( $post_id, 'blogcorner_ed_post_like_dislike', $blogcorner_ed_post_like_dislike_new );

        }elseif( '' == $blogcorner_ed_post_like_dislike_new && $blogcorner_ed_post_like_dislike_old ) {

            delete_post_meta( $post_id,'blogcorner_ed_post_like_dislike', $blogcorner_ed_post_like_dislike_old );

        }



        $blogcorner_ed_post_author_box_old = esc_html( get_post_meta( $post_id, 'blogcorner_ed_post_author_box', true ) ); 
        $blogcorner_ed_post_author_box_new = isset( $_POST['blogcorner_ed_post_author_box'] ) ? absint( wp_unslash( $_POST['blogcorner_ed_post_author_box'] ) ) : '';

        if ( $blogcorner_ed_post_author_box_new && $blogcorner_ed_post_author_box_new != $blogcorner_ed_post_author_box_old ){

            update_post_meta ( $post_id, 'blogcorner_ed_post_author_box', $blogcorner_ed_post_author_box_new );

        }elseif( '' == $blogcorner_ed_post_author_box_new && $blogcorner_ed_post_author_box_old ) {

            delete_post_meta( $post_id,'blogcorner_ed_post_author_box', $blogcorner_ed_post_author_box_old );

        }



        $blogcorner_ed_post_social_share_old = esc_html( get_post_meta( $post_id, 'blogcorner_ed_post_social_share', true ) ); 
        $blogcorner_ed_post_social_share_new = isset( $_POST['blogcorner_ed_post_social_share'] ) ? absint( wp_unslash( $_POST['blogcorner_ed_post_social_share'] ) ) : '';

        if ( $blogcorner_ed_post_social_share_new && $blogcorner_ed_post_social_share_new != $blogcorner_ed_post_social_share_old ){

            update_post_meta ( $post_id, 'blogcorner_ed_post_social_share', $blogcorner_ed_post_social_share_new );

        }elseif( '' == $blogcorner_ed_post_social_share_new && $blogcorner_ed_post_social_share_old ) {

            delete_post_meta( $post_id,'blogcorner_ed_post_social_share', $blogcorner_ed_post_social_share_old );

        }



        $blogcorner_ed_post_reaction_old = esc_html( get_post_meta( $post_id, 'blogcorner_ed_post_reaction', true ) ); 
        $blogcorner_ed_post_reaction_new = isset( $_POST['blogcorner_ed_post_reaction'] ) ? absint( wp_unslash( $_POST['blogcorner_ed_post_reaction'] ) ) : '';

        if ( $blogcorner_ed_post_reaction_new && $blogcorner_ed_post_reaction_new != $blogcorner_ed_post_reaction_old ){

            update_post_meta ( $post_id, 'blogcorner_ed_post_reaction', $blogcorner_ed_post_reaction_new );

        }elseif( '' == $blogcorner_ed_post_reaction_new && $blogcorner_ed_post_reaction_old ) {

            delete_post_meta( $post_id,'blogcorner_ed_post_reaction', $blogcorner_ed_post_reaction_old );

        }



        $blogcorner_ed_post_rating_old = esc_html( get_post_meta( $post_id, 'blogcorner_ed_post_rating', true ) ); 
        $blogcorner_ed_post_rating_new = isset( $_POST['blogcorner_ed_post_rating'] ) ? absint( wp_unslash( $_POST['blogcorner_ed_post_rating'] ) ) : '';

        if ( $blogcorner_ed_post_rating_new && $blogcorner_ed_post_rating_new != $blogcorner_ed_post_rating_old ){

            update_post_meta ( $post_id, 'blogcorner_ed_post_rating', $blogcorner_ed_post_rating_new );

        }elseif( '' == $blogcorner_ed_post_rating_new && $blogcorner_ed_post_rating_old ) {

            delete_post_meta( $post_id,'blogcorner_ed_post_rating', $blogcorner_ed_post_rating_old );

        }

        foreach ( $blogcorner_page_layout_options as $blogcorner_post_layout_option ) {  
        
            $blogcorner_page_layout_old = sanitize_text_field( get_post_meta( $post_id, 'blogcorner_page_layout', true ) ); 
            $blogcorner_page_layout_new = isset( $_POST['blogcorner_page_layout'] ) ? blogcorner_sanitize_post_layout_option_meta( wp_unslash( $_POST['blogcorner_page_layout'] ) ) : '';

            if ( $blogcorner_page_layout_new && $blogcorner_page_layout_new != $blogcorner_page_layout_old ){

                update_post_meta ( $post_id, 'blogcorner_page_layout', $blogcorner_page_layout_new );

            }elseif( '' == $blogcorner_page_layout_new && $blogcorner_page_layout_old ) {

                delete_post_meta( $post_id,'blogcorner_page_layout', $blogcorner_page_layout_old );

            }
            
        }

        $blogcorner_ed_header_overlay_old = absint( get_post_meta( $post_id, 'blogcorner_ed_header_overlay', true ) ); 
        $blogcorner_ed_header_overlay_new = isset( $_POST['blogcorner_ed_header_overlay'] ) ? absint( wp_unslash( $_POST['blogcorner_ed_header_overlay'] ) ) : '';

        if ( $blogcorner_ed_header_overlay_new && $blogcorner_ed_header_overlay_new != $blogcorner_ed_header_overlay_old ){

            update_post_meta ( $post_id, 'blogcorner_ed_header_overlay', $blogcorner_ed_header_overlay_new );

        }elseif( '' == $blogcorner_ed_header_overlay_new && $blogcorner_ed_header_overlay_old ) {

            delete_post_meta( $post_id,'blogcorner_ed_header_overlay', $blogcorner_ed_header_overlay_old );

        }

    }

endif;   