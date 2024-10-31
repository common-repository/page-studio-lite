<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * Typography.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 21/06/2016 - 16:56
 */

$html = '
<div class="f-pres">
    <label>' . ps_trans( 'Font Presentation' ) . '<div class="marker"></div></label>
    <div class="dropdown dropdown-dark">
        <select class="dropdown-select" name="tag-type">
            <option value="h1">' . ps_trans( 'Heading' ) . ' 1</option>
            <option value="h2">' . ps_trans( 'Heading' ) . ' 2</option>
            <option value="h3">' . ps_trans( 'Heading' ) . ' 3</option>
            <option value="h4">' . ps_trans( 'Heading' ) . ' 4</option>
            <option value="h5">' . ps_trans( 'Heading' ) . ' 5</option>
            <option value="h6">' . ps_trans( 'Heading' ) . ' 6</option>
        </select>
    </div>
</div>
<label>' . ps_trans( 'Font Style' ) . '<div class="marker"></div></label>
    <div class="font-selector">
        <div class="component-font-family font-text-selector">Montserrat</div>
        <div class="font-drop-selector">
            <ul>
                '.ps_get_fonts().'
            </ul>
        </div>
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

    <label class="pres">' . ps_trans( 'Line Spacing' ) . '</label>
    <div class="border-sizer-data">
        <div id="line-height-handle" class="border-size-handle"></div>
        <div class="border-size-info">
            <input type="text" data-rel="line-height" name="line-height" value="0">
        </div>
    </div>

    <div class="style-checkbox">
        <div class="checkbox-item">
            <span class="checkbox-title">' . ps_trans( 'Word Spacing') . '</span>
            <div class="checkbox-position">
                <input type="checkbox" name="typo-word-spacing" value="0">
            </div>
        </div>

        <div class="word-spacing-box separator-box-check" style="display: none;">
            <div class="border-sizer-data">
                <div id="word-spacing-handle" class="border-size-handle"></div>
                <div class="border-size-info">
                    <input type="text" data-rel="word-spacing" name="word-spacing" value="0">
                </div>
            </div>
        </div>

        <div class="checkbox-item">
            <span class="checkbox-title">' . ps_trans( 'Letter Spacing') . '</span>
            <div class="checkbox-position">
                <input type="checkbox" name="typo-letter-spacing" value="0">
            </div>
        </div>

        <div class="letter-spacing-box separator-box-check" style="display: none;">
            <div class="border-sizer-data">
                <div id="letter-spacing-handle" class="border-size-handle"></div>
                <div class="border-size-info">
                    <input type="text" data-rel="letter-spacing" name="letter-spacing" value="0">
                </div>
            </div>
        </div>
    </div>

    <label class="pres">' . ps_trans( 'Font Style' ) . '</label>
    <div class="button-list">
        <button class="button-base btn-font-weight tooltip" data-brd="bold" title="' . ps_trans( 'Bold' ) . '" type="button">
            <div class="btn-inner">
                <i class="fa fa-bold" aria-hidden="true"></i>
            </div>
        </button>
        <button class="button-base btn-font-style tooltip" data-brd="italic" title="' . ps_trans( 'Italic' ) . '" type="button">
            <div class="btn-inner">
                <i class="fa fa-italic" aria-hidden="true"></i>
            </div>
        </button>
        <button class="button-base btn-text-underline tooltip" data-brd="underline" title="' . ps_trans( 'Underline' ) . '" type="button">
            <div class="btn-inner">
                <i class="fa fa-underline" aria-hidden="true"></i>
            </div>
        </button>
        <button class="button-base btn-text-linethro tooltip" data-brd="line-through" title="' . ps_trans( 'Line Through' ) . '" type="button">
            <div class="btn-inner">
                <i class="fa fa-strikethrough" aria-hidden="true"></i>
            </div>
        </button>
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
    </div>';

ps_register_editor('typo', ps_trans( 'Typography' ), $html);