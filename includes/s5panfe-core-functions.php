<?php
/**
 * s5panfe Core Functions
 *
 * General core functions available on both the front-end and admin.
 *
 * @author      sFive
 * @category    Core
 * @package     s5panfe/Functions
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add xml in autorized mime types to upload.
 *
 * @param  array $mimetypes
 * @param  int|WP_User|null $user
 * @return array
 */
function s5panfe_add_mime_xml( $mimetypes ) {
	$mimetypes['xml'] = 'application/xml';
	return $mimetypes;
}
add_filter( 'upload_mimes', 's5panfe_add_mime_xml', 10 );
