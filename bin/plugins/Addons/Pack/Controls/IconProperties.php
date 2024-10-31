<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * IconProperties.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 28/06/2016 - 19:51
 */

//Recupera todos os icones registrados
$iconData = ps_get_icons();
$ul = '';
$options = '';
foreach($iconData as $x => $y) {
	$options .= '<option value="'.$x.'">'.$x.'</option>';
	$ul .= '<ul data-category="'.$x.'">';
	foreach($y as $p) {
		$ul .= '<li class="tooltip" title="'.$p['name'].'" data-fa="'.$p['id'].'"><i class="fa '.$p['id'].'" aria-hidden="true"></i></li>';
	}
	$ul .= '</ul>';
}

$html = '<label>' . ps_trans( 'Icon List' ) . '<div class="marker"></div></label>
	<div class="dropdown dropdown-dark">
	    <select class="dropdown-select" name="gallery-hover">
	        '.$options.'
	    </select>
    </div>
	<div class="icon-list">
		'.$ul.'
	</div>
	<label class="pres no-mrg">' . ps_trans( 'Font Color' ) . '</label>
    <div class="color-selector font-color-handler" data-rel="color">
        <div class="component-font-color" color-editor-prefix="#" contenteditable="true">000000</div>
        <div class="font-color-disc"></div>
    </div>
    <label class="pres">' . ps_trans( 'Font Size' ) . '</label>
    <div class="border-sizer-data">
        <div id="font-size-handle" class="border-size-handle"></div>
        <div class="border-size-info">
            <input type="text" data-rel="font-size" name="font-size" value="0">
        </div>
    </div>
    <div class="simple-editor-mode">
        <label class="pres" style="margin-top:5px;">' . ps_trans( 'Font Position' ) . '</label>
        <div class="button-list">
            <button class="button-base btn-font-pos tooltip" data-brd="left" title="' . ps_trans( 'Left' ) . '" type="button">
                <div class="btn-inner">
                    <i class="fa fa-align-left" aria-hidden="true"></i>
                </div>
            </button>
            <button class="button-base btn-font-pos tooltip" data-brd="right" title="' . ps_trans( 'Right' ) . '" type="button">
                <div class="btn-inner">
                    <i class="fa fa-align-right" aria-hidden="true"></i>
                </div>
            </button>
            <button class="button-base btn-font-pos tooltip" data-brd="center" title="' . ps_trans( 'Center' ) . '" type="button">
                <div class="btn-inner">
                    <i class="fa fa-align-center" aria-hidden="true"></i>
                </div>
            </button>
            <button class="button-base btn-font-pos tooltip" data-brd="justify" title="' . ps_trans( 'Justify' ) . '" type="button">
                <div class="btn-inner">
                    <i class="fa fa-align-justify" aria-hidden="true"></i>
                </div>
            </button>
        </div>
    </div>
';

ps_register_editor('icon', ps_trans('Icon Gallery'), $html);