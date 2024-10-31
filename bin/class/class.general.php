<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * class.general.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 19/05/2016 - 14:33
 */

namespace Checkcms\Internal {

	/**
	 * Class General
	 * @package Checkcms\Internal
	 */
	class General {
		/**
		 * Retorna toda a lista de vari�veis padronizadas que s�o utilizadas pelo sistema APENAS
		 * em sua instalação, pode ser utilizada em casos para retornar valores padrões do sistema,
		 * ou resetar as entradas do banco de dados
		 *
		 * @param string $option_name
		 *      Caso este campo seja preenchido, será retornado apenas uma string contendo o valor da opção
		 *      selecionada, se for mantido null (como padrão) será retornado o array da estrutura.
		 *
		 * @return mixed
		 *      Array caso o campo $option_name tenha sido mantido nulo, ou String caso o desenvolvedor
		 *      queira resgatar algum valor ($option_name not null).
		 * @since 1.0.0
		 */
		public function getAllOptions( $option_name = null ) {
			$pack = new Package();

			$genConfigArray = array(
				PAGESTUDIO_PREFIX . '-installed'      => true,
				PAGESTUDIO_PREFIX . '-date-installed' => mktime(),
				PAGESTUDIO_PREFIX . '-version'        => $pack->version,
				PAGESTUDIO_PREFIX . '-config'         => array(
					'notices'        => null,
					'usepermission'  => false,
					'editorautosave' => true,
					'pagestudiosign' => true,
					'blankspace'     => false,
					'autosavetimer'  => 5,
					'minifycss'      => true,
					'permissionlist' => null,
					'helpsys'        => true,
					'supportedtypes' => null,
				)
			);

			//Primeiramente verifica se a variável é nula
			if ( is_null( $option_name ) ) {
				return $genConfigArray;
			} else {
				return $genConfigArray[ $option_name ];
			}
		}

		public function defaultPermissions() {

			$defaultPermissions = array(
				'accesseditor'          => array( 'name' => ps_trans( 'Access Editor' ), 'default' => true ),
				'configpage'            => array( 'name' => ps_trans( 'Change Configurations' ), 'default' => true ),
				'changepermission'      => array( 'name' => ps_trans( 'Change Permissions' ), 'default' => true ),
				'saveconfig'            => array( 'name' => ps_trans( 'Save Configurations' ), 'default' => true ),
				'editor-css'            => array( 'name' => ps_trans( 'Customizable CSS' ), 'default' => true ),
				'change-resolution'     => array( 'name' => ps_trans( 'Change Resolution' ), 'default' => true ),
				'ignore-default-editor' => array( 'name' => ps_trans( 'Ignore wordpress default editor.' ), 'default' => false ),
				'change-title'          => array( 'name' => ps_trans( 'Change post title' ), 'default' => true ),
				'save-drafts'           => array( 'name' => ps_trans( 'Save Drafts' ), 'default' => true )
			);

			return $defaultPermissions;
		}
	}
}