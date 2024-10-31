<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * prototype.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 31/05/2016 - 16:05
 */

/*
Plugin Name: Page Studio Lite Plugin
Plugin URI: http://pagestudio.pro/?utm_campaign=plugin&utm_medium=pluginlist
Description: Page Studio is a simple and easy page editor for wordpress, where you can create your pages in a few minutes. You can know more on the website http://pagestudio.pro.
Version: 1.0.6
Author: Checkmate Digital
Author URI: http://www.checkmatedigital.com/?utm_campaign=plugin&utm_medium=pluginlist
Text Domain: ps
Domain Path: /bin/languages/
*/

//Bloqueia o acesso direto ao código informando 403 caso este arquivo esteja sendo tentado
//acesso direto.
if(!defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

include_once( dirname(__FILE__) . '/_defines.php' );              //Constantes principais do sistema
include_once( PAGESTUDIO_PATH . '/bin/class/class.package.php' );  //Classe que controla o package do sistema
include_once( PAGESTUDIO_PATH . '/bin/const/_data.php' );          //Outras constantes e globais necessárias
include_once( PAGESTUDIO_PATH . '/bin/class/class.general.php' );  //Classe de funções gerais e de controle do plugin
include_once( PAGESTUDIO_PATH . '/bin/class/class.DOMElement.php');
include_once( PAGESTUDIO_PATH . '/bin/class/class.session.php');
include_once( PAGESTUDIO_PATH  . '/bin/class/class.PostType.php' );
include_once( PAGESTUDIO_PATH . '/bin/incs/inc.posttype.php' );
include_once( PAGESTUDIO_PATH . '/bin/incs/inc.general.php' );     //Funções principais do plugin
include_once( PAGESTUDIO_PATH . '/bin/incs/inc.plugin.php' );      //Funções do editor que são utilizadas tanto pelo front e backend
include_once( PAGESTUDIO_PATH . '/bin/incs/inc.extensible.php' );  //Funções específicas ligadas a hooks do plugin
include_once( PAGESTUDIO_PATH . '/bin/incs/inc.routes.php');
include_once( PAGESTUDIO_PATH . '/bin/incs/inc.roles.php' );       //Funções relaticas as roles e permissões
include_once( PAGESTUDIO_PATH . '/bin/incs/inc.element.php');


if (!class_exists('CHK_Activation')) {
	/**
	 * Classe específica para instalação do plugin, esta classe não pode ficar registrada em outro arquivo porque o wordpress
	 * não realiza transições através de includes ou required quando um plugin não está instalado.
	 * Class CHK_Activation
	 */
	class CHK_Activation {
		/**
		 * Função responsável pela ativação do plugin
		 */
		public static function system_activation() {
			if ( ! get_option( PAGESTUDIO_PREFIX . '-installed', false ) ) {
				//Reseta todas as opções
				ps_reset_options();
				//Reseta todas as permissões baseadas em todos os componentes instalados no plugin
				ps_reset_all_permissions();
				//Adiciona o básico para a edição utilizando o editor
				ps_add_supported_posttype( array( 'page', 'post' ) );
			}
		}

		/**
		 * Função responsável pela remoção do plugin
		 */
		public static function system_remove() {
			$allConfs = new \Checkcms\Internal\General();
			//Retorna todas as opções que devem ser instaladas junto com o plugin
			$configArray = $allConfs->getAllOptions();
			//Adiciona todas elas no banco de dados em looping
			foreach ( $configArray as $opKey => $opValue ) {
				delete_option( $opKey, $opValue );
			}
		}

		/**
		 * Função responsável pelo redirect da página quando um plugin acabou de ser instalado
		 *
		 * @param string $plugin
		 *  Nome do plugin, esta função apenas o wordpress pode repassar
		 */
		public static function system_redirect( $plugin ) {
			if ( $plugin == plugin_basename( __FILE__ ) ) {
				//Ap�s a instala��o, o sistema envia o usu�rio para a p�gina de about do sistema
				exit( wp_redirect( admin_url( 'admin.php?page=' . PAGESTUDIO_SLUG . '-about' ) ) );
			}
		}

		/**
		 * Configura o idioma do plugin e a pasta onde se encontram os arquivos de idioma
		 */
		public static function system_language() {
			//Carrega o arquivo de Idiomas do sistema
			load_plugin_textdomain( PAGESTUDIO_TRANSLATION, false, basename( dirname( __FILE__ ) ) . '/bin/languages' );
		}
	}
}


//Registro do plugin
register_activation_hook( __FILE__, array( 'CHK_Activation', 'system_activation' ) );
register_deactivation_hook( __FILE__, array( 'CHK_Activation', 'system_remove' ) );

//Atividads a serem realizadas após o plugin ter sido ativado
add_action( 'activated_plugin', array( 'CHK_Activation', 'system_redirect' ) );
//Atividades a serem realizadas após o plugin estar carregado, sendo assim possível carregar os idiomas
add_action( 'init', array( 'CHK_Activation', 'system_language' ) );
//Inicialização do plugin
include_once( PAGESTUDIO_PATH . '/_init.php' );