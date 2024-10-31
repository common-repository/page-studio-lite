<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * WP.Archives.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 29/06/2016 - 15:28
 */

$componentData = array(
	'name' => ps_trans('Pages'),
	'ico' => PAGESTUDIO_PLUGIN_PATH . '/bin/plugins/Addons/img/component-wordpress.png',
	'editor' => array('transform', 'class', 'effect'),
	'model' => 'wordpress_pages',
	'target' => '.chk_wp_widget',
	'defaultClass' => array(),
	'noContent' => true,
	'widget' => true,
	'widget-name' => 'WP_Widget_Pages',
	'html' => '<div class="chk_wp_widget">%s</div>'
);

//Registra o componente
ps_register_component('chk_comp_wordpress_pages', 'wordpress', $componentData);

add_shortcode('wordpress_pages', 'pshort_wordpress_pages');
function pshort_wordpress_pages( $atts, $content = null ) {
	$base     = ps_shortcode_base( 'chk_comp_wordpress_pages', $atts );
	$finalObj = '<div class="chk_wp_widget">' . ps_get_widget( 'WP_Widget_Pages' ) . '</div>';
	return ps_render_shortcode($base->element, $finalObj);
}