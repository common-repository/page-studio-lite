<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * WP.navmenu.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 04/01/2017 - 22:17
 */

$componentData = array(
	'name' => ps_trans('Nav Menu'),
	'ico' => PAGESTUDIO_PLUGIN_PATH . '/bin/plugins/Addons/img/component-wordpress.png',
	'editor' => array('transform', 'class', 'effect'),
	'model' => 'wordpress_navmenu',
	'target' => '.chk_wp_widget',
	'defaultClass' => array(),
	'noContent' => true,
	'widget' => true,
	'widget-name' => 'WP_Nav_Menu_Widget',
	'html' => '<div class="chk_wp_widget">%s</div>'
);

//Registra o componente
ps_register_component('chk_comp_wordpress_navmenu', 'wordpress', $componentData);

add_shortcode('wordpress_navmenu', 'pshort_wordpress_navmenu');
function pshort_wordpress_navmenu( $atts, $content = null ) {
	$base     = ps_shortcode_base( 'chk_comp_wordpress_navmenu', $atts );
	$finalObj = '<div class="chk_wp_widget">' . ps_get_widget( 'WP_Nav_Menu_Widget' ) . '</div>';
	return ps_render_shortcode($base->element, $finalObj);
}