<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * _loads.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 22/06/2016 - 20:37
 */

function ps_addonpack_script() {
	wp_enqueue_script( 'chk_addonpack_controls', PAGESTUDIO_PLUGIN_PATH . '/bin/plugins/Addons/Pack/chk.packconfig.js' );
}

//Carrega o script que deve ser lido pelo editor
add_action( 'chk_editor_dependencies', 'ps_addonpack_script' );

//Registra os addons
include_once( PAGESTUDIO_BIN . 'plugins/Addons/Pack/Gallery.php' );
include_once( PAGESTUDIO_BIN . 'plugins/Addons/Pack/Video.php' );
include_once( PAGESTUDIO_BIN . 'plugins/Addons/Pack/Icon.php' );
include_once( PAGESTUDIO_BIN . 'plugins/Addons/Pack/Audio.php');

//Registra os controles
include_once( PAGESTUDIO_BIN . 'plugins/Addons/Pack/Controls/GalleryProperties.php' );
include_once( PAGESTUDIO_BIN . 'plugins/Addons/Pack/Controls/IconProperties.php' );
include_once( PAGESTUDIO_BIN . 'plugins/Addons/Pack/Controls/VideoProperties.php' );
include_once( PAGESTUDIO_BIN . 'plugins/Addons/Pack/Controls/AudioProperties.php' );
