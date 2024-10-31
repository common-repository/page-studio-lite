<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * class.customcss.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 20/06/2016 - 11:24
 */

namespace Checkcms\Internal {

	class CustomCSS {
		protected $expire_offset = 31536000;
		private $cssLines = array();

		/**
		 * Recupera todo o CSS relativo a um determinado post
		 *
		 * @param int $post_id
		 *  ID do post que está sendo analizado
		 *
		 * @since 1.0.0
		 */
		public function from( $post_id ) {
			$postData = get_post( $post_id, ARRAY_A );

			//imprime os headers mesmo se a página foi publicada ou não
			$this->headers();

			//Verifica se a página foi mesmo publicada e é uma página e não um post
			if ( ($postData['post_status'] == 'publish' || $postData['post_status'] == 'draft') && ps_support_editor($postData['post_type'])) {

				$customCSS  = ps_getCustomCSS( $post_id );
				$customData = ps_getpost_styles( $post_id );

				if ( count( $customData ) > 0 ) {
					$this->dataCSS( $customData );
				}
				//Adiciona na listagem
				array_push( $this->cssLines, $customCSS[0] );
				$this->renderFile();
			}
		}

		/**
		 * Renderiza o CSS completo
		 * @since 1.0.0
		 */
		private function renderFile() {
			$idented = ps_get_internal('minifycss', true);
			//$idented = false;
			$compiledCSS = "";

			//Reune todo o código CSS
			foreach ( $this->cssLines as $x ) {
				$compiledCSS .= $x;
			}

			//Trabalha na identação ou na minificação do código CSS
			if (!$idented) {
				//Código Identado
				$compiledCSS = trim(str_replace(array('\t','\n','\r'), "", $compiledCSS));
				$compiledCSS = str_replace(array('{','}',';'), array("{\n\t","\n}\n\n",";\n\t"), $compiledCSS);
			} else {
				//Código Minificado
				$compiledCSS = preg_replace( "/([\t\n ]+)/", " ", $compiledCSS );
				$compiledCSS = str_replace( array( ";", "{", "}" ), array("; ","{ ","} "), $compiledCSS );
			}

			//Essa linha evita o bug em que o predefined class não consegue ser superior ao grid
			$compiledCSS = preg_replace("/(padding-left|padding-right)\:.?([0-9a-zA-Z]+)\;/", "$1: $2 !important;", $compiledCSS);
			echo $compiledCSS;
		}

		/**
		 * Recria toda a estrutura CSS
		 *
		 * @param array $cssArray
		 *  Array de dados CSS relativos aos elementos criados no page studio
		 *
		 * @since 1.0.0
		 */
		private function dataCSS( $cssArray ) {
			foreach ( $cssArray[0] as $name => $value ) {
				$cssLine = '.' . PAGESTUDIO_PREDEFINED_CLASS . $name . ' { ' . $value . ' }';
				array_push( $this->cssLines, $cssLine );
			}
		}

		/**
		 * Cria os headers do CSS e comentários iniciais.
		 * @since 1.0.0
		 */
		private function headers() {
			header( 'Content-Type: text/css; charset=UTF-8' );
			header( 'Expires: ' . gmdate( "D, d M Y H:i:s", time() + $this->expire_offset ) . ' GMT' );
			header( "Cache-Control: no-store, no-cache, must-revalidate, max-age=0" );
			header( "Cache-Control: post-check=0, pre-check=0", false );
			header( "Pragma: no-cache" );
			header( "X-Content-Type-Options: nosniff" );

			$pack = new Package();
			$sign = '/* CSS file rendered by: ' . $pack->name . ' - Version: ' . $pack->version . ' */' . chr( 13 ) . chr( 13 );
			echo $sign;
		}
	}
}