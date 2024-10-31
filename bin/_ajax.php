<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * _ajax.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 06/01/2017 - 14:55
 */

header( 'Content-Type: text/css; charset=UTF-8' );
//header( 'Expires: ' . gmdate( "D, d M Y H:i:s", time() + 31536000 ) . ' GMT' );
header( "Cache-Control: no-store, no-cache, must-revalidate, max-age=0" );
header( "Cache-Control: post-check=0, pre-check=0", false );
header( "Pragma: no-cache" );
header( "X-Content-Type-Options: nosniff" );

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

if (ps_post('reqtg', false)) {
	//Significa que a requisiчуo veio do editor, o que щ correto
	if (ps_post('reqtg') == 'editor') {
		//Trabalha na rota
		$routename = ps_post('route');
		do_action("ps_route_{$routename}", ps_post('params'));
	}
	exit;
}