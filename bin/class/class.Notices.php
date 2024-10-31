<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * class.Notices.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 02/01/2017 - 18:47
 */

namespace Checkcms\Internal {

	/**
	 * Class Notice
	 * @package Checkcms\Internal
	 * @since 1.0.4
	 */
	class Notice {
		public $id;
		public $message;
		public $type;
		public $dismissible;

		public function __construct($id, $message, $type = 'success', $dismissible = false) {
			$this->id = $id;
			$this->message = $message;
			$this->type = $type;
			$this->dismissible = $dismissible;
		}

		public function toArray() {
			return Array(
				'id' => $this->id,
				'message' => $this->message,
				'type' => $this->type,
				'dismissible' => $this->dismissible
			);
		}
	}


	/**
	 * Class Notices
	 * @package Checkcms\Internal
	 * @since 1.0.4
	 */
	class Notices {

		public function register_notice(Notice $notice) {
			update_user_meta(get_current_user_id(), PAGESTUDIO_METAPREFIX . '__notices', $notice->toArray());
		}

		public function check_notices() {
			$user_notices = get_user_meta(get_current_user_id(), PAGESTUDIO_METAPREFIX . '__notices');
			if ( current_user_can( 'manage_options' ) ) {
				if ( is_array( $user_notices[0] ) && count( $user_notices[0] ) > 0 ) {
					$class = 'notice notice-' . $user_notices[0]['type'] . ( $user_notices[0]['dismissible'] ? ' is-dismissible' : '' );
					printf( '<div id="%1$s" class="%2$s"><p>%3$s</p></div>', $user_notices[0]['id'], $class, $user_notices[0]['message'] );
					update_user_meta(get_current_user_id(), PAGESTUDIO_METAPREFIX . '__notices', array());
				}
			}

		}
	}
}