<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * plg_heading.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 01/06/2016 - 16:02
 */


$componentData = array(
	'name' => ps_trans('Spacing'),
	'ico' => PAGESTUDIO_PLUGIN_PATH . '/assets/img/container-space.png',
	'editor' => array('transform'),
	'target' => '.chk_spacing',
	'model' => 'check_space',
	'defaultClass' => array('chk_spacing'),
	'html' => '<div class="chk_spacing">&nbsp;</div>'
);

ps_register_component('chk_comp_spacing', 'elements', $componentData);

add_shortcode('check_space', 'pshort_check_space');
/**
 * @param array $atts
 *  Atributos retornados diretamente do framework do wordpress
 * @param null $content
 *  Conteúdo do shortcode caso tenha
 *
 * @since 1.0.0
 * @return string
 *  O Shortcode processado
 * @shortcode [check_space]
 */
function pshort_check_space($atts, $content = null) {
	$base = ps_shortcode_base('chk_comp_spacing', $atts);
	$finalObj = '<div ' . $base->targetAttr . '>&nbsp;</div>';
	return ps_render_shortcode( $base->element, $finalObj );
}