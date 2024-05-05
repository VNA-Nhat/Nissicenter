<?php

$enable_footer_social_nav = blogcorner_get_option('enable_footer_social_nav');

if ($enable_footer_social_nav):
    ?>
    <div class="theme-footer-middle">
        <div class="wrapper">
            <?php if ($enable_footer_social_nav): ?>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'social-menu',
                        'container_class' => 'footer-social-navigation',
                        'fallback_cb' => false,
                        'depth' => 1,
                        'menu_class' => 'theme-social-navigation theme-menu theme-footer-navigation',
                        'link_before' => '<span class="screen-reader-text">',
                        'link_after' => '</span>',
                    ));
                    ?>
            <?php endif; ?>
        </div>
    </div><!-- .theme-footer-middle-->

<?php
endif;