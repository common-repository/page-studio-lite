<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * class.package.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 19/05/2016 - 14:22
 */

namespace Checkcms\Internal {

	/**
	 * Class Package
	 * @package Checkcms\Internal
	 * @since 1.0.0
	 */
	class Package {
		/**
		 * @var string Nome do aplicativo
		 */
		public $name = null;
		/**
		 * @var string Versão do aplicativo
		 */
		public $version = null;
		/**
		 * @var string descrição do projeto
		 */
		public $description = null;

		/**
		 * Realiza a leitura de um package.json retornando assim valores essenciais do plugin
		 * @since 1.0.0
		 * @since 1.0.3
		 *  Removido a necessidade de acessar o arquivo package
		 */
		public function __construct()
		{
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			$pluginData = get_plugin_data(ABSPATH . 'wp-content/plugins/checkcms/prototype.php');
			$this->name = $pluginData['Name'];
			$this->version = $pluginData['Version'];
			$this->description = $pluginData['Description'];
		}
	}
}