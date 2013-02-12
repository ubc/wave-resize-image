<?php 


$blog_id = false;
if( isset($_GET['b']) && is_numeric( $_GET['b'] ) )
	$blog_id = (int) $_GET['b'];

if( $blog_id && $blog_id != 1):
	
	$blog_dir = '../../blogs.dir/'.$blog_id;
	if( file_exists ( $blog_dir ) ):
		if( !file_exists ( $blog_dir."/files" ) )
			mkdir( $blog_dir."/files");
		
		if( !file_exists ( $blog_dir."/files/resizecache" ) )
			mkdir( $blog_dir."/files/resizecache");
		
		define ('FILE_CACHE_DIRECTORY', $blog_dir."/files/resizecache" );
	
	else: // the blog doesn't seem to exist something fishy is going on
		die();
	endif;
	
else:
	// lets create the cache forlder in the upload directory
	$blog_dir = '../../uploads';
	if( file_exists ( $blog_dir ) ):
		if( !file_exists ( $blog_dir."/resizecache" ) )
			mkdir( $blog_dir."/resizecache");
	
		define ('FILE_CACHE_DIRECTORY', $blog_dir."/resizecache" );
	endif;
endif;

define ('NOT_FOUND_IMAGE', dirname(__FILE__).'/default.gif' );
// var_dump(FILE_CACHE_DIRECTORY);
$ALLOWED_SITES = array (
			'flickr.com',
			'picasa.com',
			'img.youtube.com',
			'upload.wikimedia.org',
			'photobucket.com',
			'imgur.com',
			'imageshack.us',
			'tinypic.com',
			'ubc.ca'
	);

