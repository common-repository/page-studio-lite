<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * SimpleEditor.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 21/06/2016 - 17:00
 */

$html = '<label class="pres">' . ps_trans( 'Text Content' ) . '<div class="marker"></div></label>
  <textarea class="text-check"></textarea>';

ps_register_editor('simple-editor', ps_trans( 'Text' ), $html);