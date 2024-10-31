<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * Url.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 21/06/2016 - 17:04
 */

$colorName = array(
	'white' => '#FFFFFF',
	'black' => '#000000',
	'orange' => '#c74e2c',
	'green' => '#058e05',
	'red' => '#9C2F2F',
	'magenta' =>'#a01a3b',
	'cyan' => '#058e9e',
	'yellow' => '#e69c1b',
	'blue' => '#2d7edb',
	'purple' => '#5638a8',
	'gray' => '#444444',
);

$html = '<label>' . ps_trans( 'Enter the destination URL' ) . '<div class="marker"></div></label>
    <label class="pres">' . ps_trans( 'URL (Use http://)' ) . '</label>
    <input class="no-abs" type="text" name="link-url">
    <label>' . ps_trans( 'Or link to existing content' ) . '<div class="marker"></div></label>
	<ul class="chk-page-selector">
		' . ps_getPagePost() . '
	</ul>
	<label>' . ps_trans( 'Link Settings' ) . '<div class="marker"></div></label>
	<div class="container">
		<div class="row">
			<div class="gr-6">
		        <button class="button-base link-target button-full-width tooltip" data-brd="_self" title="' . ps_trans( 'Opens the linked document in the same frame as it was clicked' ) . '">
		            <i class="fa fa-link" aria-hidden="true"></i>
		        </button>
			</div>
			<div class="gr-6">
		        <button class="button-base link-target button-full-width tooltip" data-brd="_blank" title="' . ps_trans( 'Opens the linked document in a new window or tab' ) . '">
		            <i class="fa fa-external-link" aria-hidden="true"></i>
		        </button>
			</div>
		</div>
	</div>
	<label>' . ps_trans( 'Link Colors' ) . '<div class="marker"></div></label>
	<div class="color-list">
		<ul>';

		foreach ($colorName as $name => $color) {
			$html .= '<li class="tooltip" title="' . ucfirst( $name ) . '" data-colorname="btn_' . $name . '" style="background: ' . $color . '"></li>';
		}

$html .= '</ul>
	</div>

	<div class="style-checkbox">
        <div class="checkbox-item">
            <span class="checkbox-title">' . ps_trans( 'Reverse Button Colors:') . '</span>
            <div class="checkbox-position">
                <input type="checkbox" name="reverse-colors" value="1">
            </div>
        </div>
    </div>
	';

ps_register_editor('url', ps_trans( 'URL' ), $html);