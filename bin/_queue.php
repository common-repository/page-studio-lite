<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * _queue.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 19/05/2016 - 15:42
 */

add_action( 'chk_plugin_pages' , 'ps_queue_content' );
add_action( 'admin_enqueue_scripts', 'ps_media_files' );

/**
 * Função responsável por carregar conteúdos dentro do sistema
 */
function ps_queue_content() {
	wp_enqueue_script( 'pagestudio-main-script' );
	//Registra o CSS interno
	wp_enqueue_style( 'pagestudio-main-style' );
}

/**
 * Função responsável por carregar conteúdos de media dentro do sistema.
 */
function ps_media_files() {
	wp_enqueue_script( 'pagestudio-main-script' );
	wp_enqueue_style( 'pagestudio-main-style' );
	wp_enqueue_media();
}

if (is_admin()) {
	// Força a execução dos scripts relativos ao administrador na função ps_queue_content,
	// não sei porque, mas algumas vezes os scripts não foram chamados.
	do_action( 'wp_admin_scripts' );
	ps_kbs();
}