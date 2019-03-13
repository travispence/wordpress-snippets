<?php

/** 
 *  Custom MIME Type Registration. This changes the behaviour of WordPress to allow for 
 *  the new filetypes to be uploaded into the media library. 
 *  This can be a potential security hole as certain filetypes such as
 *  SVG/XML etc can contain embedded scripts. Be sure to trust the source of said documents.
 *  Further steps may be needed to configure NGINX/Apache2 to allow for the filetypes to be 
 *  uploaded as well
 */
function tcp_mime_types($mime_types){
	$mime_types['svg'] = 'image/svg+xml'; 
	$mime_types['gpx'] = 'application/xml'; 
	$mime_types['kml'] = 'vnd.google-earth.kml+xml'; 
	$mime_types['kmz'] = 'vnd.google-earth.kmz'; 
    return $mime_types;
}
add_filter('upload_mimes', 'tcp_mime_types');