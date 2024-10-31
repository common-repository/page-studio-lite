<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * _custom.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 20/06/2016 - 11:00
 */

use Checkcms\Internal;

if (ps_get('chkcustom', false)) {
	//Verifica se o ID da página foi realmente informado
	if (ps_get('pid', false)) {
		$pid = ps_get('pid');
		//Carrega o CSS da página
		$css = new Internal\CustomCSS();
		$css->from($pid);
	}
	exit;
}