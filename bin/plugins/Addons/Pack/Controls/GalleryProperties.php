<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * GalleryProperties.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 22/06/2016 - 20:09
 */

$galleryColors = array(
	'black'             => '#000000',
	'aqua'              => '#00FFFF',
	'blue'              => '#0000FF',
	'Brown'             => '#A52A2A',
	'chartreuse'        => '#7FFF00',
	'chocolate'         => '#D2691E',
	'coral'             => '#FF7F50',
	'darkgray'          => '#A9A9A9',
	'darkmagenta'       => '#8B008B',
	'Green'             => '#008000',
	'GreenYellow'       => '#ADFF2F',
	'Lime'              => '#00FF00',
	'LimeGreen'         => '#32CD32',
	'MediumSeaGreen'    => '#3CB371',
	'MediumSlateBlue'   => '#7B68EE',
	'MediumSpringGreen' => '#00FA9A',
	'Orange'            => '#FFA500',
	'OrangeRed'         => '#FF4500',
	'Orchid'            => '#DA70D6',
	'Red'               => '#FF0000',
	'RoyalBlue'         => '#4169E1',
	'SkyBlue'           => '#87CEEB',
	'SlateBlue'         => '#6A5ACD',
	'SlateGray'         => '#708090',
);

$html = '<label>' . ps_trans( 'Image List' ) . '<div class="marker"></div></label>
	<div class="button-full-handler button-no-min">
        <button class="button-base wordpress-gallery button-full-width tooltip" title="' . ps_trans( 'Wordpress Media Collection' ) . '">' . ps_trans( 'Media Library' ) . '</button>
    </div>

    <div class="media-show-list">
        <ul>
            <li><img src="http://placehold.it/64x64"></li>
        </ul>
    </div>

    <label>' . ps_trans( 'Properties' ) . '<div class="marker"></div></label>
    <label class="pres">' . ps_trans( 'Spacing' ) . '</label>
    <div class="border-sizer-data">
        <div id="gallery-spacing-handle" class="border-size-handle"></div>
        <div class="border-size-info">
            <input type="text" name="gallery-spacing" value="0">
        </div>
    </div>

    <label class="pres small-sep">' . ps_trans( 'Effect Color' ) . '</label>
    <div class="color-list">
        <ul>';

			foreach ($galleryColors as $name => $color) {
				$html .= '<li class="tooltip" title="'.$name.'" data-colorname="gallery-'.$name.'" style="background: '.$color.'"></li>';
			}
		$html .= '
        </ul>
    </div>

    <label class="pres small-sep">' . ps_trans( 'Hover Effect' ) . '</label>
    <div class="dropdown dropdown-dark">
	    <select class="dropdown-select" name="gallery-hover">
	        <option value="hover-scale-only">'.ps_trans('Scale').'</option>
	        <option value="hover-opacity-only">'.ps_trans('Opacity').'</option>
	        <option value="hover-both">'.ps_trans('Both').'</option>
	    </select>
    </div>

    <label class="pres small-sep">' . ps_trans( 'Justify Gallery' ) . '</label>
    <div class="dropdown dropdown-dark">
	    <select class="dropdown-select" name="justify-content">
	        <option value="initial">'.ps_trans('Initial').'</option>
	        <option value="space-between">'.ps_trans('Space Between').'</option>
	        <option value="space-around">'.ps_trans('Space Around').'</option>
	        <option value="center">'.ps_trans('Center').'</option>
	    </select>
    </div>

    <label class="pres small-sep">' . ps_trans( 'Display Mode' ) . '</label>
    <div class="dropdown dropdown-dark">
        <select class="dropdown-select" name="display-mode">
            <option value="normallink">' . ps_trans( 'Normal Link' ) . '</option>
            <option value="magnific">' . ps_trans( 'Magnific Popup' ) . '</option>
        </select>
    </div>
';

ps_register_editor('gallery', ps_trans('Image Gallery'), $html);