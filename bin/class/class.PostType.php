<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * PostType.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 27/01/2017 - 15:37
 */

namespace Checkcms\Internal {
	/**
	 * Class PostType
	 * @package Checkcms\Internal
	 * @since 1.0.5
	 */
	final class PostType {
		public $active = false;
		/**
		 * Informa se o PostType deve aparecer nas listagens
		 * @var
		 * @since 1.0.5
		 */
		public $in_list = false;
		/**
		 * Informa se o PostType deve possuir a opção de clonagem de post
		 * @var
		 * @since 1.0.5
		 */
		public $clone = false;
		/**
		 * Informa se o PostType deve redirecionar diretamente para o editor.
		 * @var
		 * @since 1.0.5
		 */
		public $redirect = false;

		public static function instance($post_type) {
			if (ps_support_editor($post_type)) {
				$cfg = get_option(PAGESTUDIO_PREFIX . '-config');
				return new PostType($cfg['supportedtypes'][ $post_type ]);
			} else {
				return new PostType();
			}
		}

		public function __construct($post_data = null) {
			if (!is_null($post_data)) {
				$this->active = true;
				$this->in_list  = $post_data['inlist'];
				$this->clone    = $post_data['clone'];
				$this->redirect = $post_data['instaredirect'];
			}
		}
	}
}