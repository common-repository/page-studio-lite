<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * plg_html.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 27/06/2016 - 21:23
 */

$componentData = array(
	'name'   => ps_trans( 'HTML' ),
	'ico'    => PAGESTUDIO_PLUGIN_PATH . '/assets/img/container-html.png',
	'editor' => array( 'html' ),
	'model'  => 'html_code',
	'target' => '.html-element',
	'defaultClass' => array('html-element'),
	'html'   => '<div class="html_element_handler">
			<div class="html-element">
		        <div class="sample-class"><strong>' . ps_trans( 'Open this element on the html editor' ) . '</strong></div>
		   </div></div>'
);

ps_register_component( 'chk_comp_htmlbox', 'elements', $componentData );

add_shortcode( 'html_code', 'pshort_html_code' );
function pshort_html_code( $atts, $content = null ) {
	$base = ps_shortcode_base( 'chk_comp_htmlbox', $atts );
	//Adiciona o objeto ao elemento final
	$finalHtml = '<div class="html_element_handler"><div ' . $base->targetAttr . '>' . $content .'</div></div>';
	return ps_render_shortcode( $base->element, $finalHtml );
}