<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * Class.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 21/06/2016 - 17:08
 */

$html = '<label class="pres">Add my own CSS class</label>
    <div class="button-list">
        <input type="text" class="no-abs" name="css-class" value="">
    </div>';

ps_register_editor('class', ps_trans( 'CSS Class' ), $html);