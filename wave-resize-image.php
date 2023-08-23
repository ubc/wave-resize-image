<?php
/*
Plugin Name: Wave Resize Image
Plugin URI: github.com/ubc/
Description: Enables us to resize the images with a photon like api
Version: 0.2
Author: Enej
Author URI: http://ctlt.ubc.ca
*/

/* Implementation
 1. add the following to the htaccess file

#Send images to timthumb to be resized
RewriteCond %{REQUEST_FILENAME} -f
RewriteCond %{REQUEST_URI} \.(gif|png|jpg|jpeg)
RewriteCond %{QUERY_STRING} (b|w|h|zc|q|a)=(.*)$
RewriteRule (.*) /wp-content/plugins/wave-resize-image/resize.php?src=$1&%1=%2&%3=%4&%5=%6&%7=%8&%9=%10&%11=%12 [L]
# end of rewrite images

2. add this file to /wp-content/mu-plugins/wave-resize-image.php
and the folder wave-resize-image as well into the mu-plugins directory

 */


/* API */

/**
 * wave_resize_image_url function.
 *
 * @access public
 * @param mixed $url
 * @param mixed $options
 * @return string
 */
function wave_resize_image_url( $url, $args ) {
	$blog_id = get_current_blog_id();

	extract( shortcode_atts( array(
		'width' => 150,
		'height' => null,
		'zc' => 1,
		'blog_id'=> $blog_id
	), $args ) );

	$exploded = explode( 'files', $url);

	$height = 	filter_var( $height, FILTER_SANITIZE_NUMBER_INT );
	$width 	= 	filter_var( $width, FILTER_SANITIZE_NUMBER_INT );
	$h = ( isset( $height ) ? '&h='.$height : '' );

	// we don't find
	if( $url == $exploded[0] ) {
		return esc_url( $url."?w=".$width.$h.'&zc='.$zc );

	}


	if( defined( 'SUBDOMAIN_INSTALL') &&  SUBDOMAIN_INSTALL )
		return get_site_url().esc_url( "/wp-content/blogs.dir/".$blog_id."/files".$exploded[1]."?b=".$blog_id."&w=".$width.$h.'&zc='.$zc );
	else
		return  esc_url( "/wp-content/blogs.dir/".$blog_id."/files".$exploded[1]."?b=".$blog_id."&w=".$width.$h.'&zc='.$zc );
}

/**
 * wave_resize_featured_image function.
 *
 * @access public
 * @param mixed $post_id
 * @param mixed $width
 * @param mixed $height (default: null)
 * @param int $zc (default: 1)
 * @return mixed
 */
function wave_resize_featured_image_url( $post_id, $width, $height=null, $zc=1 ) {
	$attachment_id = get_post_thumbnail_id( $post_id );
	$url = wp_get_attachment_image_src( $attachment_id,'full', false );
	$args = array(
		'width' => $width,
		'height' => $height,
		'zc' => $zc
	);
	return  wave_resize_image_url( $url[0], $args );
}

/**
 * wave_resize_featured_image function.
 *
 * @access public
 * @param mixed $post_id
 * @param mixed $width
 * @param mixed $height (default: null)
 * @param int $zc (default: 1)
 * @return mixed
 */
function wave_resize_featured_image($post_id, $width, $height=null, $zc=1 ) {

	$url = wave_resize_featured_image_url($post_id, $width, $height, $zc);
	$attachment_id = get_post_thumbnail_id( $post_id );

	// If the post does not have a thumbnail, return nothing.
	if( empty( $attachment_id ) ) {
		return;
	}

	$alt = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );

	return '<img src="'. esc_url( $url ) .'" width="' . esc_attr( $width ) . '" class="attachment-resized" alt="' . esc_attr( $alt ) . '" />';
}
