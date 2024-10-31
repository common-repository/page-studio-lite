<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * Audio.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 06/01/2017 - 16:44
 */

$componetData = array(
	'name'         => ps_trans( 'Audio' ),
	'ico'          => PAGESTUDIO_PLUGIN_PATH . '/bin/plugins/Addons/img/component_audio.png',
	'editor'       => array( 'transform', 'audio', 'class', 'effect' ),
	'default'      => 'audio',
	'model'        => 'audio_embed',
	'target'       => '.chk_audio',
	'defaultClass' => array( 'chk_audio' ),
	'html'         => '<div class="chk_audio">' . do_shortcode( '[audio src="' . PAGESTUDIO_PLUGIN_PATH . '/bin/plugins/Addons/img/Preview.mp3"]' ) . '</div>'
);

ps_register_component( 'chk_comp_audio', 'components', $componetData );

add_shortcode( 'audio_embed', 'pshort_check_audio' );
function pshort_check_audio( $atts, $content = null ) {
	$base = ps_shortcode_base( 'chk_comp_audio', $atts );

	$finalObj = '<div class="' . $base->target['class'] . '" data-media="' . $base->default['data-media'] . '">';
	if ( isset( $base->default['data-media'] ) ) {
		$imageUrl = wp_get_attachment_url( $base->default['data-media'] );
		$finalObj .= do_shortcode( '[audio src="' . $imageUrl . '"]' );
	} else {
		$finalObj .= do_shortcode( '[audio src="' . PAGESTUDIO_PLUGIN_PATH . '/bin/plugins/Addons/img/Preview.mp3"]' );
	}
	$finalObj .= '</div>';

	return ps_render_shortcode( $base->element, $finalObj );
}
