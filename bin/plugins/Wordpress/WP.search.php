<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * WP.search.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 04/01/2017 - 22:13
 */

$componentData = array(
	'name' => ps_trans('Search'),
	'ico' => PAGESTUDIO_PLUGIN_PATH . '/bin/plugins/Addons/img/component-wordpress.png',
	'editor' => array('transform', 'class', 'effect'),
	'model' => 'wordpress_search',
	'target' => '.chk_wp_widget',
	'defaultClass' => array(),
	'noContent' => true,
	'widget' => true,
	'widget-name' => 'WP_Widget_Search',
	'html' => '<div class="chk_wp_widget">%s</div>'
);

//Registra o componente
ps_register_component('chk_comp_wordpress_search', 'wordpress', $componentData);

add_shortcode('wordpress_search', 'pshort_wordpress_search');
function pshort_wordpress_search( $atts, $content = null ) {
	$base     = ps_shortcode_base( 'chk_comp_wordpress_search', $atts );
	$finalObj = '<div class="chk_wp_widget">' . ps_get_widget( 'WP_Widget_Search' ) . '</div>';
	return ps_render_shortcode($base->element, $finalObj);
}