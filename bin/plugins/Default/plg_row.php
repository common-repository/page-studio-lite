<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * plg_row.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 01/06/2016 - 17:31
 */

$componentData = array(
	'name' => ps_trans('Row'),
	'ico' => PAGESTUDIO_PLUGIN_PATH . '/assets/img/container-row.png',
	'editor' => array('transform', 'grid', 'class', 'background', 'responsive'),
	'default' => 'grid',
	'defaultClass' => array( 'chk_element', 'chk_main_int'),
	'model' => 'check_row',
);

ps_int_register_component('int-row', 'layout', $componentData);

//Registra a coluna de modo fantasma (isso não vai aparecer no final)
$componentColumn = array(
	'name' => ps_trans('Column'),
	'editor' => array('transform', 'class', 'background'),
	'defaultClass' => array('chk_element', 'chk_column', 'chk_column_int'),
	'model' => 'check_column',
);

ps_int_register_component('int-col', 'layout', $componentColumn, false);

$componentFullPage = array(
	'name' => ps_trans('Fullpage'),
	'ico' => PAGESTUDIO_PLUGIN_PATH . '/assets/img/container-fullpage.png',
	'editor' => array('transform', 'fullpage', 'grid', 'class', 'background'),
	'default' => 'fullpage',
	'defaultClass' => array('chk_element_fullpage', 'chk_main_int'),
	'model' => 'check_fullpage'
);

//ps_int_register_component('int-fullpage', 'layout', $componentFullPage);