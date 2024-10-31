<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * AudioProperties.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 06/01/2017 - 17:24
 */

$html = '<label>' . ps_trans( 'Audio' ) . '<div class="marker"></div></label>
	<div class="button-full-handler button-no-min">
        <button class="button-base wordpress-gallery button-full-width tooltip" title="' . ps_trans( 'Wordpress Media Collection' ) . '">' . ps_trans( 'Media Library' ) . '</button>
    </div>
    ';

ps_register_editor('audio', ps_trans('Audio Properties'), $html);