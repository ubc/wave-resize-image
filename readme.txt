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

 

