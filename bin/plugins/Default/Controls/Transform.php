<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * Transform.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 21/06/2016 - 16:52
 */

$html = '<label>' . ps_trans( 'Display Settings' ) . '<div class="marker"></div></label>
    <div class="button-list border-element-style">
        <button class="button-base border-sty tooltip" data-brd="block" title="' . ps_trans( 'Block' ) . '" type="button">
            <div class="btn-inner">
                <img class="b-post" src="' . PAGESTUDIO_PLUGIN_PATH . '/assets/img/border-block.png">
            </div>
        </button>
        <button class="button-base border-sty tooltip" data-brd="inline-block" title="' . ps_trans( 'Inline Block' ) . '" type="button">
            <div class="btn-inner">
                <img class="b-post" src="' . PAGESTUDIO_PLUGIN_PATH . '/assets/img/border-inline-block.png">
            </div>
        </button>
        <button class="button-base border-sty tooltip" data-brd="inline" title="' . ps_trans( 'Inline' ) . '" type="button">
            <div class="btn-inner">
                <img class="b-post" src="' . PAGESTUDIO_PLUGIN_PATH . '/assets/img/border-inline.png">
            </div>
        </button>
        <button class="button-base border-sty tooltip" data-brd="flex" title="' . ps_trans( 'Flex' ) . '" type="button">
            <div class="btn-inner">
                <img class="b-post" src="' . PAGESTUDIO_PLUGIN_PATH . '/assets/img/border-flex.png">
            </div>
        </button>
        <button class="button-base border-sty tooltip" data-brd="none" title="' . ps_trans( 'Hide' ) . '" type="button">
            <div class="btn-inner">
                <i class="fa fa-eye-slash" aria-hidden="true"></i>
            </div>
        </button>
    </div>

    <label>' . ps_trans( 'Padding and Margin' ) . '<div class="marker"></div></label>

    <div class="spacing-guidance">
        <div class="guid-margin">
            <div class="guid-panel guid-panel-top tooltip" data-rel="margin-top" title="' . ps_trans( 'Margin Top' ) . '"><span class="title">' . strtolower( ps_trans( 'margin' ) ) . '</span><input type="text" class="spacing-control-input inp-top" name="margin_top" placeholder="0" value=""></div>
            <div class="guid-panel guid-panel-bottom tooltip" data-rel="margin-bottom" title="' . ps_trans( 'Margin Bottom' ) . '"><input class="spacing-control-input inp-bottom" type="text" name="margin_bottom" placeholder="0" value=""></div>
            <div class="guid-panel guid-panel-left tooltip" data-rel="margin-left" title="' . ps_trans( 'Margin Left' ) . '"><input class="spacing-control-input inp-left" type="text" name="margin_left" placeholder="0" value=""></div>
            <div class="guid-panel guid-panel-right tooltip" data-rel="margin-right" title="' . ps_trans( 'Margin Right' ) . '"><input class="spacing-control-input inp-right" type="text" name="margin_right" placeholder="0" value=""></div>
            <div class="guid-padding">
                <div class="guid-panel guid-panel-top tooltip" data-rel="padding-top" title="' . ps_trans( 'Padding Top' ) . '"><span class="title">' . strtolower( ps_trans( 'padding' ) ) . '</span><input type="text" class="spacing-control-input inp-top" name="padding_top" placeholder="0" value=""></div>
                <div class="guid-panel guid-panel-bottom tooltip" data-rel="padding-bottom" title="' . ps_trans( 'Padding Bottom' ) . '"><input class="spacing-control-input inp-bottom" type="text" name="padding_bottom" placeholder="0" value=""></div>
                <div class="guid-panel guid-panel-left tooltip" data-rel="padding-left" title="' . ps_trans( 'Padding Left' ) . '"><input class="spacing-control-input inp-left" type="text" name="padding_left" placeholder="0" value=""></div>
                <div class="guid-panel guid-panel-right tooltip" data-rel="padding-right" title="' . ps_trans( 'Padding Right' ) . '"><input class="spacing-control-input inp-right" type="text" name="padding_right" placeholder="0" value=""></div>
            </div>
        </div>
    </div>

    <label>' . ps_trans( 'Size and Alignment' ) . '<div class="marker"></div></label>

    <label class="pres small-sep">' . ps_trans( 'Width' ) . '</label>
    <div class="width-height-container">
		<input type="hidden" name="default-transform-width" value="">
		<input class="wh-input" type="text" placeholder="'.ps_trans('auto').'" name="transform-width">
		<button class="button-base transform-width-size button-small-font tooltip" data-brd="auto" title="' . ps_trans( 'Auto' ) . '">' . ps_trans( 'auto' ) . '</button>
		<button class="button-base transform-width-size button-small-font tooltip" data-brd="px" title="' . ps_trans( 'Pixels' ) . '">' . ps_trans( 'px' ) . '</button>
		<button class="button-base transform-width-size button-small-font tooltip" data-brd="%" title="' . ps_trans( 'Percents' ) . '">' . ps_trans( '%' ) . '</button>
		<button class="button-base transform-width-size button-small-font tooltip" data-brd="max" title="' . ps_trans( 'Maximum Width' ) . '">' . ps_trans( 'max' ) . '</button>
	</div>
    <label class="pres small-sep">' . ps_trans( 'Height' ) . '</label>
    <div class="width-height-container">
		<input type="hidden" name="default-transform-height" value="">
		<input class="wh-input" type="text" placeholder="'.ps_trans('auto').'" name="transform-height">
		<button class="button-base transform-height-size button-small-font tooltip" data-brd="auto" title="' . ps_trans( 'Auto' ) . '">' . ps_trans( 'auto' ) . '</button>
		<button class="button-base transform-height-size button-small-font tooltip" data-brd="px" title="' . ps_trans( 'Pixels' ) . '">' . ps_trans( 'px' ) . '</button>
		<button class="button-base transform-height-size button-small-font tooltip" data-brd="%" title="' . ps_trans( 'Percents' ) . '">' . ps_trans( '%' ) . '</button>
		<button class="button-base transform-height-size button-small-font tooltip" data-brd="max" title="' . ps_trans( 'Maximum Height' ) . '">' . ps_trans( 'max' ) . '</button>
	</div>

	<div class="transform-aligment">
	    <label class="pres small-sep">' . ps_trans( 'Alignment' ) . '</label>
        <div class="dropdown dropdown-dark">
	    <select class="dropdown-select" name="transform-content-align">
	        <option value="left">'.ps_trans('Left').'</option>
	        <option value="center">'.ps_trans('Center').'</option>
	        <option value="right">'.ps_trans('Right').'</option>
	    </select>
    </div>
	</div>

    <label>' . ps_trans( 'Border Settings and Style' ) . '<div class="marker"></div></label>

    <label class="pres">' . ps_trans( 'Border Size' ) . '</label>
    <div class="border-sizer-data">
        <div id="border-slider-size" class="border-size-handle"></div>
        <div class="border-size-info">
            <input type="text" data-rel="border-width" name="border-size" value="0">
        </div>
    </div>

    <label class="pres zero-sep">' . ps_trans( 'Border Radius' ) . '</label>
    <div class="border-sizer-data">
        <div id="border-slider-radius" class="border-size-handle"></div>
        <div class="border-size-info">
            <input type="text" data-rel="border-radius" name="border-radius" value="0">
        </div>
    </div>

    <div class="style-checkbox">
        <div class="checkbox-item">
            <span class="checkbox-title">' . ps_trans( 'Border Radius Format:') . '</span>
            <div class="checkbox-position">
                <input type="checkbox" name="radius-format" value="1">
            </div>
        </div>
    </div>

    <label class="pres">' . ps_trans( 'Border Color' ) . '</label>
    <div class="color-selector border-color-handler" data-rel="border-color">
        <div class="component-font-color" color-editor-prefix="#" contenteditable="true">000000</div>
        <div class="font-color-disc"></div>
    </div>

    <label class="pres">' . ps_trans( 'Border Type' ) . '</label>
    <div class="button-list">
        <button class="button-base border-type-sty tooltip" data-brd="solid" title="' . ps_trans( 'Solid' ) . '" type="button">
            <div class="btn-inner">
                <img class="b-post" src="' . PAGESTUDIO_PLUGIN_PATH . '/assets/img/border-solid.png">
            </div>
        </button>
        <button class="button-base border-type-sty tooltip" data-brd="dashed" title="' . ps_trans( 'Dashed' ) . '" type="button">
            <div class="btn-inner">
                <img class="b-post" src="' . PAGESTUDIO_PLUGIN_PATH . '/assets/img/border-dashed.png">
            </div>
        </button>
        <button class="button-base border-type-sty tooltip" data-brd="dotted" title="' . ps_trans( 'Dotted' ) . '" type="button">
            <div class="btn-inner">
                <img class="b-post" src="' . PAGESTUDIO_PLUGIN_PATH . '/assets/img/border-dotted.png">
            </div>
        </button>
        <button class="button-base border-type-sty tooltip" data-brd="none" title="' . ps_trans( 'None' ) . '" type="button">
            <div class="btn-inner">
                <i class="fa fa-times" aria-hidden="true"></i>
            </div>
        </button>
        <button class="button-base border-type-reset tooltip" title="' . ps_trans( 'Reset All Values' ) . '" type="button">
            <div class="btn-inner">
                <i class="fa fa-eraser" aria-hidden="true"></i>
            </div>
        </button>
    </div>';

ps_register_editor('transform', ps_trans( 'Design' ), $html);