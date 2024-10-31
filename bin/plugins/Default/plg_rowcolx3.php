<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * plg_rowcolx3.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 01/06/2016 - 17:36
 */

$componentData = array(
	'name' => ps_trans('Col x 3'),
	'ico' => PAGESTUDIO_PLUGIN_PATH . '/assets/img/container-colx3.png',
);

ps_int_register_component('int-colx3', 'layout', $componentData);