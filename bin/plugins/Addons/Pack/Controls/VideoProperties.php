<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * VideoProperties.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 25/07/2016 - 18:39
 */

$html = '<label>' . ps_trans( 'Video' ) . '<div class="marker"></div></label>
	<div class="button-full-handler button-no-min">
        <button class="button-base wordpress-gallery button-full-width tooltip" title="' . ps_trans( 'Wordpress Media Collection' ) . '">' . ps_trans( 'Media Library' ) . '</button>
    </div>
    <label class="pres small-sep">' . ps_trans( 'URL (Use http://)' ) . '</label>
    <input class="no-abs" type="text" name="background-url">

    <div class="style-checkbox">
        <div class="checkbox-item">
	        <span class="checkbox-title">' . ps_trans( 'Preload video.') . '</span>
	        <div class="checkbox-position">
	            <input type="checkbox" name="mp4-preload" value="1">
	        </div>
	    </div>
	    <div class="checkbox-item">
	        <span class="checkbox-title">' . ps_trans( 'Loop.') . '</span>
	        <div class="checkbox-position">
	            <input type="checkbox" name="mp4-loop" value="1">
	        </div>
	    </div>
	    <div class="checkbox-item">
	        <span class="checkbox-title">' . ps_trans( 'Autoplay.') . '</span>
	        <div class="checkbox-position">
	            <input type="checkbox" name="mp4-autoplay" value="1">
	        </div>
	    </div>
	    <div class="checkbox-item">
	        <span class="checkbox-title">' . ps_trans( 'Muted.') . '</span>
	        <div class="checkbox-position">
	            <input type="checkbox" name="mp4-muted" value="1">
	        </div>
	    </div>
	    <div class="checkbox-item">
	        <span class="checkbox-title">' . ps_trans( 'Video Controls.') . '</span>
	        <div class="checkbox-position">
	            <input type="checkbox" name="mp4-controls" value="1">
	        </div>
	    </div>
    </div>

    ';

ps_register_editor('video', ps_trans('Video Properties'), $html);