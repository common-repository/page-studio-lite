<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * frontend.editor.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 31/05/2016 - 17:02
 */

if(!defined('PAGESTUDIO_ROOT')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

use Checkcms\Editor;
$frontend = new Editor\Frontend();
$frontend->init();
$frontend->renderEditor();
