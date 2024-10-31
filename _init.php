<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * _init.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 31/05/2016 - 16:36
 */

/**
 * @const string PAGESTUDIO_BIN
 *      Caminho absoluto para a pasta de Bin do sistema
 */
define("PAGESTUDIO_BIN", PAGESTUDIO_PATH . '/bin/');

if (is_admin()) {
	add_action( 'wp_loaded', 'ps_admin_scripts' );
}

// Init Freemius.
ps_frm_initialize();
// Signal that SDK was initiated.
do_action( 'ps_frm_initialize_loaded' );

//inicializa o plugin, forзa a funзгo a ser executada por ultimo para que dк tempo do usuбrio criar os objetos
add_action( 'init', 'ps_initialize_plugin', 999 );

// Inicializa as mecвnicas de suporte aos post_types, eles precisam ser executados depois do
// init, jб que o register_post_type do wordpress deve ser rodado sempre lб
add_action( 'wp_loaded', 'ps_type_supporting' );
//Executa o custom css de todas as pбginas com a mнnima prioridade possнvel
add_action( 'wp_loaded', 'ps_custom_css', 999 );