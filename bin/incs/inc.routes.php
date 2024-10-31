<?php
/**
*       _               _                    _
*      | |             | |                  | |
*   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
*  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
* | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
*  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
*
* inc.routes.php - Created using PhpStorm for checkcms.
* Developer: Miguel Couto | Created Date: 06/01/2017 - 19:15
*/

function ps_route_render_audio( $atts ) {
	$imageUrl = wp_get_attachment_url( $atts['id'] );
	echo do_shortcode( '[audio src="' . $imageUrl . '"]' );
}
add_action('ps_route_render_audio', 'ps_route_render_audio');

function ps_route_render_playlist( $atts ) {
	//$imageUrl = wp_get_attachment_url( $atts['id'] );
	//echo do_shortcode( '[audio src="' . $imageUrl . '"]' );
}
add_action('ps_route_render_playlist', 'ps_route_render_playlist');