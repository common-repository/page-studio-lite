<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * Grid.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 21/06/2016 - 17:02
 */

$html = '<label>' . ps_trans( 'Select the correct grid' ) . '<div class="marker"></div></label>
    <div class="button-list grid-style-list">
        <button class="button-base button-grid-base grid-button tooltip" data-brd="gr-12" data-col="1" title="' . '1 ' . ps_trans( 'Column' ) . '" type="button">
            <img src="' . PAGESTUDIO_PLUGIN_PATH . '/assets/img/gr-12.png">
        </button>
        <button class="button-base button-grid-base grid-button tooltip" data-brd="gr-6" data-col="2" title="' .'2 ' .  ps_trans( 'Columns' ) . '" type="button">
            <img src="' . PAGESTUDIO_PLUGIN_PATH . '/assets/img/gr-6.png">
        </button>
        <button class="button-base button-grid-base grid-button tooltip" data-brd="gr-4" data-col="3" title="' .'3 ' .  ps_trans( 'Columns' ) . '" type="button">
            <img src="' . PAGESTUDIO_PLUGIN_PATH . '/assets/img/gr-4.png">
        </button>
        <button class="button-base button-grid-base grid-button tooltip" data-brd="gr-3" data-col="4" title="' .'4 ' .  ps_trans( 'Columns' ) . '" type="button">
            <img src="' . PAGESTUDIO_PLUGIN_PATH . '/assets/img/gr-3.png">
        </button>
        <button class="button-base button-grid-base grid-button tooltip" data-brd="gr-4x8" title="' .'4/8 ' .  ps_trans( 'Columns' ) . '" type="button">
            <img src="' . PAGESTUDIO_PLUGIN_PATH . '/assets/img/gr-3x7.png">
        </button>
        <button class="button-base button-grid-base grid-button tooltip" data-brd="gr-8x4" title="' .'8/4 ' .  ps_trans( 'Columns' ) . '" type="button">
            <img src="' . PAGESTUDIO_PLUGIN_PATH . '/assets/img/gr-7x3.png">
        </button>
        <button class="button-base button-grid-base grid-button tooltip" data-brd="gr-3x6x3" title="' .'3/6/3 ' .  ps_trans( 'Columns' ) . '" type="button">
            <img src="' . PAGESTUDIO_PLUGIN_PATH . '/assets/img/gr-3x6x3.png">
        </button>
        <button class="button-base button-grid-base grid-button tooltip" data-brd="gr-2" data-col="6" title="' .'6 ' .  ps_trans( 'Columns' ) . '" type="button">
            <img src="' . PAGESTUDIO_PLUGIN_PATH . '/assets/img/gr-2.png">
        </button>
        <button class="button-base button-grid-base grid-button tooltip" data-brd="gr-2x8x2" title="' .'2/8/2 ' .  ps_trans( 'Columns' ) . '" type="button">
            <img src="' . PAGESTUDIO_PLUGIN_PATH . '/assets/img/gr-2x8x2.png">
        </button>
        <button class="button-base button-grid-base grid-button tooltip" data-brd="gr-2x10" title="' .'2/10 ' .  ps_trans( 'Columns' ) . '" type="button">
            <img src="' . PAGESTUDIO_PLUGIN_PATH . '/assets/img/gr-2x10.png">
        </button>
        <button class="button-base button-grid-base grid-button tooltip" data-brd="gr-10x2" title="' .'10/2 ' .  ps_trans( 'Columns' ) . '" type="button">
            <img src="' . PAGESTUDIO_PLUGIN_PATH . '/assets/img/gr-10x2.png">
        </button>
        <button class="button-base button-grid-base grid-button tooltip" data-brd="gr-2x2x8" title="' .'2/2/8 ' .  ps_trans( 'Columns' ) . '" type="button">
            <img src="' . PAGESTUDIO_PLUGIN_PATH . '/assets/img/gr-2x2x8.png">
        </button>
    </div>

    <label class="pres">' . ps_trans( 'Choosing a smaller number of columns can remove any of the current content.' ) . '</label>

    <label>' . ps_trans( 'Custom Grid' ) . '<div class="marker"></div></label>
    <div class="button-list">
        <input type="text" class="no-abs" name="custom-grid" value="">
    </div>
    <label class="pres">' . ps_trans( 'You can change the grid layout manually, just type the division of the columns to define their size.' ) . '</label>

	<label>' . ps_trans( 'Row Configuration' ) . '<div class="marker"></div></label>

	<label class="pres small-sep">' . ps_trans( 'Max Width' ) . '</label>
	<div class="width-height-container">
		<input type="hidden" name="row-default-width" value="960">
		<input class="wh-input" type="text" placeholder="'.ps_trans('full').'" name="row-width">
		<button class="button-base row-width-size button-small-font tooltip" data-brd="full" title="' . ps_trans( 'Full Width (100%)' ) . '">' . ps_trans( 'full' ) . '</button>
		<button class="button-base row-width-size button-small-font tooltip" data-brd="px" title="' . ps_trans( 'Pixels' ) . '">' . ps_trans( 'px' ) . '</button>
		<button class="button-base row-width-size button-small-font tooltip" data-brd="%" title="' . ps_trans( 'Percents' ) . '">' . ps_trans( '%' ) . '</button>
		<button class="button-base row-width-size button-small-font tooltip" data-brd="max" title="' . ps_trans( 'Maximum Width (960px)' ) . '">' . ps_trans( 'max' ) . '</button>
	</div>';

ps_register_editor('grid', ps_trans( 'Grid' ), $html);