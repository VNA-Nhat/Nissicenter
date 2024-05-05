<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blogcorner
 */
$site_fallback_image = blogcorner_get_option('site_fallback_image');
$single_post_meta = blogcorner_get_option('single_post_meta');

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	if (is_single()) {
		global $post;
		$blogcorner_post_layout = esc_html( get_post_meta( $post->ID, 'blogcorner_post_layout', true ) ); 
		if (empty($blogcorner_post_layout)) {
		    $blogcorner_post_layout = 'layout-2';
		}
		if ($blogcorner_post_layout == "layout-1") { ?>

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
            <header class="entry-header">
                <?php
                if ( is_singular() ) :
                    the_title( '<h1 class="entry-title entry-title-large">', '</h1>' );
                else :
                    the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                endif;

                if ( 'post' === get_post_type() ) :
                    ?>
                    <div class="entry-meta">
                        <?php if (in_array('author', $single_post_meta)) : ?>
                            <?php blogcorner_posted_by()?>
                        <?php endif; ?>

                        <?php if (in_array('date', $single_post_meta)) : ?>
                            <?php blogcorner_posted_on()?>
                        <?php endif; ?>
                    </div><!-- .entry-meta -->
                <?php endif; ?>
            </header><!-- .entry-header -->
		<?php } ?>
	<?php } else { ?>
		<header class="entry-header">
			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title entry-title-large">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;

			if ( 'post' === get_post_type() ) :
				?>
				<div class="entry-meta">
					<?php if (in_array('author', $single_post_meta)) : ?>
					    <?php blogcorner_posted_by()?>
					<?php endif; ?>

					<?php if (in_array('date', $single_post_meta)) : ?>
					    <?php blogcorner_posted_on()?>
					<?php endif; ?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<?php blogcorner_post_thumbnail(); ?>
	<?php } ?>
	<div class="entry-content">
		<?php
		if (is_single()) {
			add_filter('the_content', 'blogcorner_remove_embed_block_content');
			the_content();
		}else {
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'blogcorner' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
		}
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'blogcorner' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->
    <?php if (in_array('tags', $single_post_meta)) : ?>
		<footer class="entry-footer">
			<?php blogcorner_entry_footer_all(); ?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
