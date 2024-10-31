<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * plg_image.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 01/06/2016 - 16:08
 */

$defaultimage = PAGESTUDIO_PLUGIN_PATH . '/bin/plugins/Addons/img/grayscale.jpg';

$componentData = array(
	'name' => ps_trans('Image'),
	'ico' => PAGESTUDIO_PLUGIN_PATH . '/assets/img/container-image.png',
	'editor' => array('transform', 'media', 'hyperlink', 'class', 'effect'),
	'default' => 'media',
	'target' => '.chk_image_source',
	'model' => 'check_image',
	'defaultClass' => array('chk_image_source', 'lazy'),
	'html' => '<div class="chk_image_wrapper">
					<img class="chk_image_source lazy" src="' . $defaultimage . '" data-original="' . $defaultimage . '" data-lazy="true" alt="'.ps_trans('Eg: Photo of a black and white desert.').'" width="100%" height="auto">
			   </div>'
);

ps_register_component('chk_comp_image', 'elements', $componentData);

add_shortcode('check_image', 'pshort_check_image');
/**
 * @param array $atts
 *  Atributos retornados diretamente do framework do wordpress
 * @param null $content
 *  Conteúdo do shortcode caso tenha
 *
 * @since 1.0.0
 * @return string
 *  O Shortcode processado
 * @shortcode [check_image]
 */
function pshort_check_image( $atts, $content = null ) {
	$base = ps_shortcode_base( 'chk_comp_image', $atts );

	//Verifica se o objeto deve abrir em lightbox
	$lightbox = ( isset( $base->default['data-lightbox'] ) ? ' data-lightbox="true"' : '' );
	//Verifica se o lazy está ativo (pela classe) isso é o modo de compatibilidade com versões anteriores a 1.0.4
	$lazyclass = (isset($base->default['data-lazy']) ? ' data-lazy="true"' : '' );
	//Limpa a classe de elementos, para compatibilidade com versões anteriores a 1.0.4
	$elementclass = (!isset($base->default['data-lazy']) ? str_replace(' lazy', '', $base->target['class']) : $base->target['class']);

	//Inicializa o objeto
	$finalObj = '<div class="chk_image_wrapper">';

	if ( isset( $base->target['data-media'] ) ) {
		if (isset($base->default['data-lazy'])) {
			//Imagem com a tag lazy
			$finalObj .= '<img class="' . $elementclass . '" ' . $lightbox . $lazyclass . ' data-original="' . $base->target['data-original'] . '" data-media="' . $base->target['data-media'] . '" alt="' . $base->default['alt'] . '" width="' . $base->target['width'] . '" height="' . $base->target['height'] . '">';
		} else {
			//Imagem sem a tag lazy
			$finalObj .= '<img class="' . $elementclass . '" ' . $lightbox . $lazyclass . ' src="' . $base->target['data-original'] . '" data-original="' . $base->target['data-original'] . '" data-media="' . $base->target['data-media'] . '" alt="' . $base->default['alt'] . '" width="' . $base->target['width'] . '" height="' . $base->target['height'] . '">';
		}
	} else {
		//Elemento não possui o data-media, então é verificado para saber se ao menos possui o src
		//assim o sistema irá saber que a imagem é de alguma URL externa
		if (isset($base->default['src'])) {
			if (isset($base->default['data-lazy'])) {
				//Imagem com a tag lazy
				$finalObj .= '<img class="' . $elementclass . '" ' . $lightbox . $lazyclass . ' data-original="' . $base->default['src'] . '" alt="' . $base->default['alt'] . '" width="' . $base->target['width'] . '" height="' . $base->target['height'] . '">';
			} else {
				//Imagem sem a tag lazy
				$finalObj .= '<img class="' . $elementclass . '" ' . $lightbox . $lazyclass . ' src="' . $base->default['src'] . '" data-original="' . $base->default['src'] . '" alt="' . $base->default['alt'] . '" width="' . $base->target['width'] . '" height="' . $base->target['height'] . '">';
			}
		} else {
			//Imagem também não possui SRC, então o sistema irá imprimir a versão padrão
			$finalObj .= '<img ' . $base->targetAttr . $lightbox . ' src="' . PAGESTUDIO_PLUGIN_PATH . '/bin/plugins/Addons/img/grayscale.jpg" data-original="' . PAGESTUDIO_PLUGIN_PATH . '/bin/plugins/Addons/img/grayscale.jpg" alt="' . $base->default['alt'] . '" width="100%" height="auto">';
		}
	}

	$finalObj .='</div>';

	return ps_render_shortcode( $base->element, $finalObj );
}