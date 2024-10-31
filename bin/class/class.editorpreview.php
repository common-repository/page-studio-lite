<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * class.editorpreview.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 01/06/2016 - 22:45
 */

namespace Checkcms\Editor {

	//Sem isso aqui, não é possível verificar o nonce do wordpress na página
	require_once( ABSPATH . 'wp-includes/pluggable.php' );

	/**
	 * Class EditorPreview
	 * @package Checkcms\Editor
	 */
	class EditorPreview {

		public $post_id = null;

		public function Check() {
			ps_editor_status( false );
			//Primeiramente o sistema verifica para saber se a página está carregada no modo editor
			if ( ps_get( 'chk_editor' ) == 'full' ) {
				//Agora o sistema verifica o nonce da página, para saber se está correto.
				if ( wp_verify_nonce( ps_get( 'wpn' ), ps_get( 'pid' ) ) ) {
					//Está correto, então o sistema registra os dados do post que está sendo aberto no editor
					$this->post_id = ps_get( 'pid' );
					//Marca uma página como sendo editável
					ps_editor_status( true );
					//Carrega as dependências
					$this->LoadDependencies();

				} else {
					// O código chegará neste ponto apenas se o nonce for falso, e isso apenas ocorrerá caso o usuário
					// esteja tentando acessar a página de preview do editor "na mão" (essa é a unica forma do nonce ir errado).
					// Portanto, o sistema deve redirecionar o meliante para a página de 404
					add_action( 'wp', 'ps_force_404' );
				}
			} else {
				// Se chegou até aqui é porque o sistema não está abrindo mais a página no editor, e sim na
				// visualização final, portando, o sistema deve informar os dados sempre depois que o tema for
				// inicializado no cliente
				//add_action( 'wp_enqueue_scripts', 'ps_theme_dependencies' );
				add_action('get_footer', 'ps_theme_dependencies');
			}
		}

		private function LoadDependencies() {
			// Executa a extensão das dependências que devem ser carregadas, a função básica
			// está em inc.extensible.php, na função ps_theme_dependencies() e também disponível
			// para que outros plugins possam utilizar
			do_action( 'chk_preview_dependencies' );
			//Força não mostrar a barra de admin na página dentro do editor
			show_admin_bar( false );
		}

	}
}