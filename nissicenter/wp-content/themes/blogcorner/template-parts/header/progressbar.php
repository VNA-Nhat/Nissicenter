<?php
/**
 * Displays progressbar
 *
 * @package Blogcorner
 */

$show_progressbar = blogcorner_get_option( 'show_progressbar' );

if ( $show_progressbar ) :
	$progressbar_position = blogcorner_get_option( 'progressbar_position' );
	echo '<div id="blogcorner-progress-bar" class="theme-progress-bar ' . esc_attr( $progressbar_position ) . '"></div>';
endif;
