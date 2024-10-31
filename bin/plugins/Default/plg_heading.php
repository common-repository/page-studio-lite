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
	'name' => ps_trans('Heading'),
	'ico' => PAGESTUDIO_PLUGIN_PATH . '/assets/img/container-heading.png',
	'editor' => array('transform', 'typo','hyperlink', 'class', 'effect', 'simple-editor'),
	'default' => 'typo',
	'target' => '.chk_heading',
	'model' => 'check_h1',
	'defaultClass' => array('chk_heading'),
	'html' => '<h1 class="chk_heading font-montserrat" data-typo="h1">'.ps_trans('Enter your text').'</h1>'
);

//Registra o componente
ps_register_component('chk_comp_heading', 'elements', $componentData);

//Registra e trata o shortcode
add_shortcode('check_h1', 'pshort_check_h1');
/**
 * @param array $atts
 *  Atributos retornados diretamente do framework do wordpress
 * @param null $content
 *  Conteúdo do shortcode caso tenha
 *
 * @since 1.0.0
 * @since 1.0.4
 *  Adicionada o elemento typo para modificação do tipo de heading.
 * @return string
 *  O Shortcode processado
 * @shortcode [check_h1]
 */
function pshort_check_h1( $atts, $content = null ) {
	$base = ps_shortcode_base( 'chk_comp_heading', $atts );

	$finalObj = '';
	//Esta verificação se faz necessária devido a versões anteriores
	if ( isset( $base->default['data-typo'] ) ) {
		$finalObj .= '<' . strtolower( $base->default['data-typo'] ) . ' class="' . $base->target['class'] . '" data-typo="' . $base->default['data-typo'] . '">' . $content . '</' . strtolower( $base->default['data-typo'] ) . '>';
	} else {
		$finalObj .= '<h1 class="' . $base->target['class'] . '" data-typo="h1" data-typo="h1">' . $content . '</h1>';
	}

	return ps_render_shortcode( $base->element, $finalObj );
}