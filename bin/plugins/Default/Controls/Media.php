<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * Media.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 21/06/2016 - 17:07
 */

$html = '<label>' . ps_trans( 'Image' ) . '<div class="marker"></div></label>
    <div class="button-full-handler button-no-min">
        <button class="button-base wordpress-media button-full-width" title="' . ps_trans( 'Wordpress Media Collection' ) . '">' . ps_trans( 'Media Library' ) . '</button>
    </div>
    <label class="pres small-sep">' . ps_trans( 'URL (Use http://)' ) . '</label>
    <input class="no-abs" type="text" name="media-url">

	<div class="media-show-loading">
		<img src="' . PAGESTUDIO_PLUGIN_PATH . '/assets/img/714.gif">
	</div>
    <div class="media-show-data">
        <div class="media-show-thumbnail">
            <img class="media-thumbnail" src="http://placehold.it/64x64" height="100%">
        </div>
        <div class="media-show-info">
            <label id="selected-filename">' . ps_trans( 'No File' ) . '</label>
            <label id="selected-size"></label>
            <label id="selected-filesize"></label>
        </div>
    </div>

    <label>' . ps_trans( 'Properties' ) . '<div class="marker"></div></label>
	<label class="pres">' . ps_trans( 'Alt' ) . '</label>
	<input class="no-abs" type="text" placeholder="'.ps_trans('e.g.: Photo of a passion fruit').'" name="image-alt">
	<label class="pres small-sep">' . ps_trans( 'Width' ) . '</label>
	<div class="width-height-container">
		<input type="hidden" name="default-image-width" value="">
		<input class="wh-input" type="text" placeholder="'.ps_trans('auto').'" name="image-width">
		<button class="button-base image-width-size button-small-font tooltip" data-brd="auto" title="' . ps_trans( 'Auto' ) . '">' . ps_trans( 'auto' ) . '</button>
		<button class="button-base image-width-size button-small-font tooltip" data-brd="px" title="' . ps_trans( 'Pixels' ) . '">' . ps_trans( 'px' ) . '</button>
		<button class="button-base image-width-size button-small-font tooltip" data-brd="%" title="' . ps_trans( 'Percents' ) . '">' . ps_trans( '%' ) . '</button>
		<button class="button-base image-width-size button-small-font tooltip" data-brd="max" title="' . ps_trans( 'Maximum Width' ) . '">' . ps_trans( 'max' ) . '</button>
	</div>

	<label class="pres small-sep">' . ps_trans( 'Height' ) . '</label>
	<div class="width-height-container">
		<input type="hidden" name="default-image-height" value="">
		<input class="wh-input" type="text" placeholder="'.ps_trans('auto').'" name="image-height">
		<button class="button-base image-height-size button-small-font tooltip" data-brd="auto" title="' . ps_trans( 'Auto' ) . '">' . ps_trans( 'auto' ) . '</button>
		<button class="button-base image-height-size button-small-font tooltip" data-brd="px" title="' . ps_trans( 'Pixels' ) . '">' . ps_trans( 'px' ) . '</button>
		<button class="button-base image-height-size button-small-font tooltip" data-brd="%" title="' . ps_trans( 'Percents' ) . '">' . ps_trans( '%' ) . '</button>
		<button class="button-base image-height-size button-small-font tooltip" data-brd="max" title="' . ps_trans( 'Maximum Height' ) . '">' . ps_trans( 'max' ) . '</button>
	</div>
	<div class="style-checkbox">
        <div class="checkbox-item">
            <span class="checkbox-title">' . ps_trans( 'Open Image in lightbox:') . '</span>
            <div class="checkbox-position">
                <input type="checkbox" name="image-lightbox" value="1">
            </div>
        </div>
        <div class="checkbox-item">
            <span class="checkbox-title">' . ps_trans( 'Load images on scroll:') . '</span>
            <div class="checkbox-position">
                <input type="checkbox" name="image-unveil" value="1">
            </div>
        </div>
    </div>
';

ps_register_editor('media', ps_trans( 'Media' ), $html);