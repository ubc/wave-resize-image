=== Wave Resize Image ===
Contributors: enej 
Tags: resize images
Requires at least: 3.5
Tested up to: 3.5
Stable tag: trunk

Implements the simple wordpress resizing api


== Installation ==

Extract the zip file and just drop the contents in the wp-content/plugins/ directory of your WordPress installation and then activate the Plugin from Plugins page.

Also add the following to your .htaccess file

`
#Send images to timthumb to be resized   
RewriteCond %{REQUEST_FILENAME} -f  
RewriteCond %{REQUEST_URI} \\.(gif|png|jpg|jpeg)  
RewriteCond %{QUERY_STRING} (b|w|h|zc|q|a)=(.*)$  
RewriteRule (.*) /wp-content/plugins/wave-resize-image/resize.php?src=$1&%1=%2&%3=%4&%5=%6&%7=%8&%9=%10&%11=%12 [L] 
# end of rewrite images

`
== Changelog ==
0.2 Initial release

== FAQ ==
What is the API

//return back the image url in the proper format
wave_resize_image_url( $image_url, 
    array(
		'width' => 150,
		'height' => null,
		'zc' => 1,
		'blog_id'=> get_current_blog_id()
	    )
	);
// return back the url of the featured image
wave_resize_featured_image_url( $post_id, $width, $height=null, $zc=1 );

// return the image tag as a string
wave_resize_featured_image( $post_id, $width, $height=null, $zc=1 );


== Ideas to implement ==
- filter the get_attachment_url to get back the right size image instead of just sized image
- make images resize based on device. might need some js
- 