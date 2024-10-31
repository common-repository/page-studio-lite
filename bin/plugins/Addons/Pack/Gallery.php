<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * Gallery.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 22/06/2016 - 19:30
 */

global $arrayimages;
$arrayimages = array();
for ($i = 1; $i < 29; $i++) {
	array_push($arrayimages, "http://res.cloudinary.com/dh7xfkfvk/image/upload/v1490882195/rnd/placeimg".sprintf("%02d",$i).".jpg");
}

$componentData = array(
	'name' => ps_trans('Gallery'),
	'ico' => PAGESTUDIO_PLUGIN_PATH . '/bin/plugins/Addons/img/component-gallery.png',
	'editor' => array('transform', 'gallery', 'class'),
	'default' => 'gallery',
	'model' => 'css_gallery',
	'target' => '.chk_main_gallery',
	'defaultClass' => array('chk_main_gallery'),
	'noContent' => true,
	'html' =>   '<div class="chk_main_gallery gallery-black hover-both gallery-spc-6px" chk-initiated="false" data-color="gallery-black" data-hover="hover-both" data-spacing="6">
		            <a class="chk_main_gallery_link" href="'.$arrayimages[rand(1,(count($arrayimages) - 1))].'">
		                <figure><img src="'.$arrayimages[rand(1,(count($arrayimages) - 1))].'" alt=""></figure>
		            </a>
		            <a class="chk_main_gallery_link" href="'.$arrayimages[rand(1,(count($arrayimages) - 1))].'">
		                <figure><img src="'.$arrayimages[rand(1,(count($arrayimages) - 1))].'" alt=""></figure>
		            </a>
		            <a class="chk_main_gallery_link" href="'.$arrayimages[rand(1,(count($arrayimages) - 1))].'">
		                <figure><img src="'.$arrayimages[rand(1,(count($arrayimages) - 1))].'" alt=""></figure>
		            </a>
		            <a class="chk_main_gallery_link" href="'.$arrayimages[rand(1,(count($arrayimages) - 1))].'">
		                <figure><img src="'.$arrayimages[rand(1,(count($arrayimages) - 1))].'" alt=""></figure>
		            </a>
            	</div>'
);

//Registra o componente
ps_register_component('chk_comp_cssgallery', 'components', $componentData);

//Shortcode
add_shortcode('css_gallery', 'pshort_css_gallery');
function pshort_css_gallery( $atts, $content = null ) {
	global $arrayimages;
	$base = ps_shortcode_base( 'chk_comp_cssgallery', $atts );

	$fields = array( 'chk-initiated', 'data-color', 'data-media', 'data-hover', 'data-spacing' );
	$spa = null;
	foreach($fields as $d) {
		if ( isset( $base->default[ $d ] ) ) {
			$spa .= ' ' . $d . '="' . $base->default[ $d ] . '"';
		}
	}

	$finalObj = '<div class="' . $base->target['class'] . ' ' . $base->default['data-color'] . ' ' . $base->default['data-hover'] . ' gallery-spc-' . $base->default['data-spacing'] . 'px"'.$spa.'>';

	//Verifica se há alguma media registrada
	if ( isset( $base->default['data-media'] ) ) {

		//array de medias
		$mediaArray = explode( ',', $base->default['data-media'] );

		foreach ( $mediaArray as $m ) {
			$image = wp_get_attachment_image_src( $m, 'full', false );
			list( $src, $width, $height ) = $image;
			$finalObj .= '
			<a class="chk_main_gallery_link" href="' . $src . '">
	            <figure><img src="' . $src . '" alt=""></figure>
	        </a>
		';
		}
	} else {
		$finalObj .= '<a class="chk_main_gallery_link" href="'.$arrayimages[rand(1,(count($arrayimages) - 1))].'">
	                <figure><img src="'.$arrayimages[rand(1,(count($arrayimages) - 1))].'" alt=""></figure>
	            </a>
	            <a class="chk_main_gallery_link" href="'.$arrayimages[rand(1,(count($arrayimages) - 1))].'">
	                <figure><img src="'.$arrayimages[rand(1,(count($arrayimages) - 1))].'" alt=""></figure>
	            </a>
	            <a class="chk_main_gallery_link" href="'.$arrayimages[rand(1,(count($arrayimages) - 1))].'">
	                <figure><img src="'.$arrayimages[rand(1,(count($arrayimages) - 1))].'" alt=""></figure>
	            </a>
	            <a class="chk_main_gallery_link" href="'.$arrayimages[rand(1,(count($arrayimages) - 1))].'">
	                <figure><img src="'.$arrayimages[rand(1,(count($arrayimages) - 1))].'" alt=""></figure>
	            </a>';
	}

	$finalObj .= '</div>';

	return ps_render_shortcode( $base->element, $finalObj );
}