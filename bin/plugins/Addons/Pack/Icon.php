<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * Icon.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 28/06/2016 - 17:57
 */

$componentData = array(
	'name' => ps_trans('Icon'),
	'ico' => PAGESTUDIO_PLUGIN_PATH . '/bin/plugins/Addons/img/component-icon.png',
	'editor' => array('transform', 'icon', 'class', 'effect'),
	'default' => 'icon',
	'model' => 'chk_icon',
	'target' => '.chk_icon',
	'defaultClass' => array('chk_icon'),
	'noContent' => true,
	'html' => '<div class="chk_icon" data-icon="fa-heart"><i class="fa fa-heart" aria-hidden="true"></i></div>'
);

//Registra o componente
ps_register_component('chk_comp_fontawesome', 'components', $componentData);

add_shortcode('chk_icon', 'pshort_chk_icon');
function pshort_chk_icon( $atts, $content = null ) {
	$base = ps_shortcode_base( 'chk_comp_fontawesome', $atts );

	$finalObj = '<div ' . $base->targetAttr . ' data-icon="' . $base->default['data-icon'] . '">
				    <i class="fa ' . $base->default['data-icon'] . '" aria-hidden="true"></i>
				 </div>';

	//Adiciona o objeto ao elemento final
	return ps_render_shortcode( $base->element, $finalObj );
}