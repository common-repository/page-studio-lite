<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * Background.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 21/06/2016 - 17:06
 */

$html = '<label>' . ps_trans( 'Image' ) . '<div class="marker"></div></label>
    <div class="button-full-handler button-no-min">
        <button class="button-base wordpress-media button-full-width" title="' . ps_trans( 'Wordpress Media Collection' ) . '">' . ps_trans( 'Media Library' ) . '</button>
    </div>
    <label class="pres small-sep">' . ps_trans( 'URL (Use http://)' ) . '</label>
    <input class="no-abs" type="text" name="background-url">
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
    <div class="no-vid-background">
	    <label>' . ps_trans( 'Properties' ) . '<div class="marker"></div></label>
		<label class="pres small-sep">' . ps_trans( 'Background Style' ) . '</label>
		<div class="dropdown dropdown-dark">
			<select class="dropdown-select" name="background-propriety">
				<!--<option value="parallax">' . ps_trans( 'Parallax' ) . '</option>-->
				<option value="cover">' . ps_trans( 'Cover' ) . '</option>
				<option value="normal">' . ps_trans( 'Normal' ) . '</option>
				<option value="contain">' . ps_trans( 'Contain' ) . '</option>
			</select>
		</div>

		<label class="pres small-sep">' . ps_trans( 'Background Attachment' ) . '</label>
		<div class="dropdown dropdown-dark">
			<select class="dropdown-select" name="background-attachment">
				<option value="scroll">' . ps_trans( 'Scroll' ) . '</option>
				<option value="fixed">' . ps_trans( 'Fixed' ) . '</option>
			</select>
		</div>

		<label class="pres small-sep">' . ps_trans( 'Background Position' ) . '</label>
		<div class="dropdown dropdown-dark">
			<select class="dropdown-select" name="background-position">
				<option value="fixed">' . ps_trans( 'Fixed' ) . '</option>
				<option value="left top">' . ps_trans( 'Left Top' ) . '</option>
				<option value="left center">' . ps_trans( 'Left Center' ) . '</option>
				<option value="left bottom">' . ps_trans( 'Left Bottom' ) . '</option>
				<option value="right top">' . ps_trans( 'Right Top' ) . '</option>
				<option value="right center">' . ps_trans( 'Right Center' ) . '</option>
				<option value="right bottom">' . ps_trans( 'Right Bottom' ) . '</option>
				<option value="center top">' . ps_trans( 'Center Top' ) . '</option>
				<option value="center center">' . ps_trans( 'Center Center' ) . '</option>
				<option value="center bottom">' . ps_trans( 'Center Bottom' ) . '</option>
			</select>
		</div>

		<label class="pres small-sep">' . ps_trans( 'Background Color' ) . '</label>
		<div class="dropdown dropdown-dark">
			<select class="dropdown-select" name="background-color-type">
				<option value="transparent">' . ps_trans( 'Transparent' ) . '</option>
				<option value="simple">' . ps_trans( 'Simple' ) . '</option>
				<!--<option value="gradient">' . ps_trans( 'Gradient' ) . '</option>-->
			</select>
		</div>

		<div id="background-simple-color" style="margin-top:20px;">
			<div class="color-selector background-color-handle" data-rel="background-color">
		        <div class="component-font-color" color-editor-prefix="#" contenteditable="true">FFFFFF</div>
		        <div class="font-color-disc"></div>
		    </div>
	    </div>

	    <div id="background-gradient-color" style="margin-top:20px;">
	        <div class="color-selector background-color1-handle" data-rel="background-color">
		        <div class="component-font-color" color-editor-prefix="#" contenteditable="true">FFFFFF</div>
		        <div class="font-color-disc"></div>
		    </div>
		    <div class="color-selector background-color2-handle" data-rel="background-color">
		        <div class="component-font-color" color-editor-prefix="#" contenteditable="true">FFFFFF</div>
		        <div class="font-color-disc"></div>
		    </div>
	    </div>
	</div>
	';

ps_register_editor('background', ps_trans( 'Background' ), $html);