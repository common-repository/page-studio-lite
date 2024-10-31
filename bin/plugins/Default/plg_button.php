<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * plg_button.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 01/06/2016 - 16:06
 */

$componentData = array(
	'name'   => ps_trans( 'Button' ),
	'ico'    => PAGESTUDIO_PLUGIN_PATH . '/assets/img/container-button.png',
	'editor' => array( 'transform', 'typo', 'simple-editor', 'url', 'class', 'effect' ),
	'default' => 'url',
	'target' => '.trg_button',
	'model'  => 'check_button',
	'defaultClass' => array('trg_button', 'chk_button'),
	'html'   => '<a class="trg_button font-montserrat chk_button btn_blue" data-color="btn_blue" href="#">'.ps_trans('See More...').'</a>'
);

//Registra o componente dentro da aba Elements
ps_register_component('chk_comp_button', 'elements', $componentData);

add_shortcode( 'check_button', 'pshort_check_button' );
function pshort_check_button( $atts, $content = null ) {
	$base     = ps_shortcode_base( 'chk_comp_button', $atts );
	$finalObj = '<a class="' . $base->target['class'] . ' ' . $base->default['data-color'] . '" data-color="' . $base->default['data-color'] . '"' . ( isset( $base->target['href'] ) ? ' href="' . $base->target['href'] . '"' : '' ) . '>' . $content . '</a>';

	return ps_render_shortcode( $base->element, $finalObj );
}