<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * plg_hr.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 17/06/2016 - 14:09
 */

$componentData = array(
	'name' => ps_trans('Line'),
	'ico' => PAGESTUDIO_PLUGIN_PATH . '/assets/img/container-hr.png',
	'editor' => array('transform', 'effect'),
	'target' => '.trg_hr',
	'model' => 'check_hr',
	'defaultClass' => array('trg_hr', 'chk_hr'),
	'html' => '<hr class="trg_hr chk_hr">'
);

//Registra o componente
ps_register_component('chk_comp_hr', 'elements', $componentData);

add_shortcode('check_hr', 'pshort_check_hr');
function pshort_check_hr( $atts, $content = null ) {
	$base     = ps_shortcode_base( 'chk_comp_hr', $atts );
	$finalObj = '<hr ' . $base->targetAttr . '>';

	return ps_render_shortcode( $base->element, $finalObj );
}