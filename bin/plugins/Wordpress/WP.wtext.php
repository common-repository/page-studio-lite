<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * WP.wtext.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 04/01/2017 - 22:16
 */

$componentData = array(
	'name' => ps_trans('Text'),
	'ico' => PAGESTUDIO_PLUGIN_PATH . '/bin/plugins/Addons/img/component-wordpress.png',
	'editor' => array('transform', 'class', 'effect'),
	'model' => 'wordpress_text',
	'target' => '.chk_wp_widget',
	'defaultClass' => array(),
	'noContent' => true,
	'widget' => true,
	'widget-name' => 'WP_Widget_Text',
	'html' => '<div class="chk_wp_widget">%s</div>'
);

//Registra o componente
ps_register_component('chk_comp_wordpress_text', 'wordpress', $componentData);

add_shortcode('wordpress_text', 'pshort_wordpress_text');
function pshort_wordpress_text( $atts, $content = null ) {
	$base     = ps_shortcode_base( 'chk_comp_wordpress_text', $atts );
	$finalObj = '<div class="chk_wp_widget">' . ps_get_widget( 'WP_Widget_Text' ) . '</div>';
	return ps_render_shortcode($base->element, $finalObj);
}