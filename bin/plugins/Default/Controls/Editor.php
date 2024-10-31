<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * Editor.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 21/06/2016 - 16:59
 */

$html = '<label class="pres">' . ps_trans( 'Wordpress Editor' ) . '</label>
    <div class="button-full-handler">
        <button class="button-base full-editor button-full-width" title="' . ps_trans( 'Open Wordpress Editor' ) . '">' . ps_trans( 'Wordpress Editor' ) . '</button>
    </div>';

ps_register_editor('editor', ps_trans( 'Editor' ), $html);