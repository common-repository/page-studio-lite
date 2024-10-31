<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * Video.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 25/07/2016 - 17:25
 */

$componentData = array(
	'name'         => ps_trans( 'MP4 Video' ),
	'ico'          => PAGESTUDIO_PLUGIN_PATH . '/bin/plugins/Addons/img/component-video.png',
	'editor'       => array( 'transform', 'video', 'hyperlink', 'class', 'effect' ),
	'default'      => 'video',
	'model'        => 'check_video',
	'target'       => '.chk_video',
	'defaultClass' => array( 'chk_video_base', 'chk_video' ),
	'noContent'     => true,
	'html'         =>   '<div class="chk_video_base chk_video" data-preload="true" data-loop="true" data-autoplay="true" data-muted="true" data-controls="false">
							<video class="base-movie lazy" data-setup="{}" preload="auto" loop="loop" autoplay="autoplay" id="internal-video" muted>
								<source src="' . PAGESTUDIO_PLUGIN_PATH . '/bin/plugins/Addons/img/demo.mp4">
							</video>
						 </div>'
);

//Registra o componente
ps_register_component( 'chk_comp_video', 'components', $componentData );

add_shortcode('check_video', 'pshort_check_video');
function pshort_check_video( $atts, $content = null ) {
	$base = ps_shortcode_base( 'chk_comp_video', $atts );

	$finalURL = PAGESTUDIO_PLUGIN_PATH . '/bin/plugins/Addons/img/demo.mp4';
	//Verifica para saber se o elemento existe
	if ( isset( $base->default['data-video'] ) ) {

		$mediafile = wp_get_attachment_url( $base->default['data-video'] );
		$type      = wp_check_filetype( $mediafile );
		if ( $type['type'] == 'video/mp4' ) {
			$finalURL = $mediafile;
		}
	}

	$insAttr = array(
		'data-video'    => $base->default['data-video'],
		'data-preload'  => ( isset( $base->default['data-preload'] ) ? $base->default['data-preload'] : 'false' ),
		'data-loop'     => ( isset( $base->default['data-loop'] ) ? $base->default['data-loop'] : 'false' ),
		'data-autoplay' => ( isset( $base->default['data-autoplay'] ) ? $base->default['data-autoplay'] : 'false' ),
		'data-muted'    => ( isset( $base->default['data-muted'] ) ? $base->default['data-muted'] : 'false' ),
		'data-controls' => ( isset( $base->default['data-controls'] ) ? $base->default['data-controls'] : 'false' ),
	);

	$vidAttr = array();

	foreach ( $insAttr as $k => $v ) {
		if ( $v != 'false' ) {
			$vidAttr[ str_replace( 'data-', '', $k ) ] = '';
		}
	}

	$finalObj = '<div ' . $base->targetAttr . ' ' . ps_generate_attribute( $insAttr ) . '>
					<video id="internal-video" class="base-movie lazy" data-setup="{}" ' . ps_generate_attribute( $vidAttr ) . '>
						<source src="' . $finalURL . '">
					</video>
				</div>';

	return ps_render_shortcode( $base->element, $finalObj );
}