<?php
/**
*       _               _                    _
*      | |             | |                  | |
*   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
*  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
* | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
*  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
*
* inc.update.php - Created using PhpStorm for checkcms.
* Developer: Miguel Couto | Created Date: 17/08/2016 - 11:27
*/

/**
 * Adiciona links a mais nos actions do plugin dentro da listagem do wordpress
 *
 * @param array $links
 *  Array de opções passadas pelo wordpress
 *
 * @since 1.0.0
 * @return array
 *  Retorna o mesmo array passado pelo $links, modificado pela função
 */
function ps_plugin_actionlinks( $links ) {
	$mylinks = array( '<a href="' . PAGESTUDIO_PREMIUM_URL . '" style="color: #23bd51; font-weight: bold;">' . ps_trans( 'Upgrade to Pro' ) . '</a>' );

	return array_merge( $links, $mylinks );
}
add_filter('plugin_action_links_' . plugin_basename( PAGESTUDIO_ROOT ), 'ps_plugin_actionlinks');

function ps_kbs() {
	//Premium function, no need to exist
}