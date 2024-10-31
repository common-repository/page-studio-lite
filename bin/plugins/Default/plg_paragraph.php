<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * plg_paragraph.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 01/06/2016 - 16:05
 */

$componentData = array(
	'name' => ps_trans('Paragraph'),
	'ico' => PAGESTUDIO_PLUGIN_PATH . '/assets/img/container-paragraph.png',
	'editor' => array('transform', 'typo', 'hyperlink', 'class', 'effect', 'editor'),
	'default' => 'typo',
	'target' => '.chk_paragraph',
	'model' => 'check_p',
	'defaultClass' => array('chk_paragraph'),
	'html' => '<div class="chk_paragraph font-open-sans"><p>'.ps_trans('The noise had brought Dejah Thoris to the door of her apartment, and there she stood throughout the conflict with Sola at her back peering over her shoulder.  Her face was set and emotionless and I knew that she did not recognize me, nor did Sola.').'</p></div>'
);

ps_register_component('chk_comp_paragraph', 'elements', $componentData);

add_shortcode('check_p', 'pshort_check_p');
/**
 * @param array $atts
 *  Atributos retornados diretamente do framework do wordpress
 * @param null $content
 *  Conteúdo do shortcode caso tenha
 *
 * @since 1.0.0
 * @return string
 *  O Shortcode processado
 * @shortcode [check_p]
 */
function pshort_check_p( $atts, $content = null ) {
	$base     = ps_shortcode_base( 'chk_comp_paragraph', $atts );
	$finalObj = '<div ' . $base->targetAttr . '>' . $content . '</div>';

	return ps_render_shortcode( $base->element, $finalObj );
}